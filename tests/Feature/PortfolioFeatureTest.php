<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Portfolio;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class PortfolioFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /* ==================== PORTFOLIO INDEX TESTS ==================== */

    /**
     * Test portfolio index page loads successfully.
     */
    public function test_portfolio_index_page_loads_successfully(): void
    {
        $response = $this->get(route('portfolio'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.portfolio');
    }

    /**
     * Test portfolio index displays active portfolios.
     */
    public function test_portfolio_index_displays_active_portfolios(): void
    {
        $product = Product::factory()->create();
        
        $activePortfolio = Portfolio::create([
            'name' => 'Active Portfolio',
            'product_id' => $product->id,
            'description' => 'Active description',
            'image' => 'active.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio'));

        $response->assertStatus(200);
        $response->assertSee('Active Portfolio');
        $response->assertViewHas('portfolios', function ($portfolios) use ($activePortfolio) {
            return $portfolios->contains('id', $activePortfolio->id);
        });
    }

    /**
     * Test portfolio index does not display inactive portfolios.
     */
    public function test_portfolio_index_does_not_display_inactive_portfolios(): void
    {
        $product = Product::factory()->create();
        
        Portfolio::create([
            'name' => 'Inactive Portfolio',
            'product_id' => $product->id,
            'description' => 'Inactive description',
            'image' => 'inactive.jpg',
            'is_active' => false,
        ]);

        $response = $this->get(route('portfolio'));

        $response->assertStatus(200);
        $response->assertDontSee('Inactive Portfolio');
    }

    /**
     * Test portfolio index displays multiple portfolios.
     */
    public function test_portfolio_index_displays_multiple_portfolios(): void
    {
        $product = Product::factory()->create();
        
        $portfolio1 = Portfolio::create([
            'name' => 'Portfolio One',
            'product_id' => $product->id,
            'description' => 'First portfolio',
            'image' => 'one.jpg',
            'is_active' => true,
        ]);

        $portfolio2 = Portfolio::create([
            'name' => 'Portfolio Two',
            'product_id' => $product->id,
            'description' => 'Second portfolio',
            'image' => 'two.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio'));

        $response->assertStatus(200);
        $response->assertSee('Portfolio One');
        $response->assertSee('Portfolio Two');
        $response->assertViewHas('portfolios', function ($portfolios) {
            return $portfolios->count() === 2;
        });
    }

    /**
     * Test portfolio index displays portfolios with their products.
     */
    public function test_portfolio_index_loads_product_relationship(): void
    {
        $product = Product::factory()->create(['nama_produk' => 'Test Product']);
        
        Portfolio::create([
            'name' => 'Portfolio with Product',
            'product_id' => $product->id,
            'description' => 'Has product relation',
            'image' => 'product.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio'));

        $response->assertStatus(200);
        $response->assertViewHas('portfolios', function ($portfolios) {
            return $portfolios->first()->relationLoaded('product');
        });
    }

    /**
     * Test portfolio index displays latest portfolios first.
     */
    public function test_portfolio_index_displays_latest_first(): void
    {
        $product = Product::factory()->create();
        
        $oldPortfolio = Portfolio::create([
            'name' => 'Old Portfolio',
            'product_id' => $product->id,
            'description' => 'Created first',
            'image' => 'old.jpg',
            'is_active' => true,
        ]);

        sleep(1); // Wait 1 second to ensure different timestamp

        $newPortfolio = Portfolio::create([
            'name' => 'New Portfolio',
            'product_id' => $product->id,
            'description' => 'Created last',
            'image' => 'new.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio'));

        $response->assertStatus(200);
        $response->assertViewHas('portfolios', function ($portfolios) use ($newPortfolio, $oldPortfolio) {
            return $portfolios->first()->id === $newPortfolio->id &&
                   $portfolios->last()->id === $oldPortfolio->id;
        });
    }

    /**
     * Test portfolio index when no portfolios exist.
     */
    public function test_portfolio_index_when_no_portfolios_exist(): void
    {
        $response = $this->get(route('portfolio'));

        $response->assertStatus(200);
        $response->assertViewHas('portfolios', function ($portfolios) {
            return $portfolios->isEmpty();
        });
    }

    /* ==================== PORTFOLIO DETAIL TESTS ==================== */

    /**
     * Test portfolio detail page loads successfully.
     */
    public function test_portfolio_detail_page_loads_successfully(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Detail Test',
            'slug' => 'detail-test',
            'product_id' => $product->id,
            'description' => 'Detail description',
            'image' => 'detail.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio.detail', $portfolio->slug));

        $response->assertStatus(200);
        $response->assertViewIs('pages.portfolio-detail');
    }

    /**
     * Test portfolio detail displays correct portfolio.
     */
    public function test_portfolio_detail_displays_correct_portfolio(): void
    {
        $product = Product::factory()->create(['nama_produk' => 'Test Product']);
        
        $portfolio = Portfolio::create([
            'name' => 'Specific Portfolio',
            'slug' => 'specific-portfolio',
            'product_id' => $product->id,
            'description' => 'Specific description',
            'image' => 'specific.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio.detail', $portfolio->slug));

        $response->assertStatus(200);
        $response->assertSee('Specific Portfolio');
        $response->assertSee('Specific description');
        $response->assertViewHas('portfolio', function ($viewPortfolio) use ($portfolio) {
            return $viewPortfolio->id === $portfolio->id;
        });
    }

    /**
     * Test portfolio detail returns 404 for inactive portfolio.
     */
    public function test_portfolio_detail_returns_404_for_inactive_portfolio(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Inactive Detail',
            'slug' => 'inactive-detail',
            'product_id' => $product->id,
            'description' => 'Inactive',
            'image' => 'inactive.jpg',
            'is_active' => false,
        ]);

        $response = $this->get(route('portfolio.detail', $portfolio->slug));

        $response->assertStatus(404);
    }

    /**
     * Test portfolio detail returns 404 for non-existent slug.
     */
    public function test_portfolio_detail_returns_404_for_non_existent_slug(): void
    {
        $response = $this->get(route('portfolio.detail', 'non-existent-slug'));

        $response->assertStatus(404);
    }

    /**
     * Test portfolio detail loads product relationship.
     */
    public function test_portfolio_detail_loads_product_relationship(): void
    {
        $product = Product::factory()->create(['nama_produk' => 'Related Product']);
        
        $portfolio = Portfolio::create([
            'name' => 'Portfolio With Product',
            'slug' => 'portfolio-with-product',
            'product_id' => $product->id,
            'description' => 'Has product',
            'image' => 'product.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio.detail', $portfolio->slug));

        $response->assertStatus(200);
        $response->assertViewHas('portfolio', function ($portfolio) {
            return $portfolio->relationLoaded('product');
        });
    }

    /**
     * Test portfolio detail displays related portfolios.
     */
    public function test_portfolio_detail_displays_related_portfolios(): void
    {
        $product = Product::factory()->create();
        
        $mainPortfolio = Portfolio::create([
            'name' => 'Main Portfolio',
            'slug' => 'main-portfolio',
            'product_id' => $product->id,
            'description' => 'Main',
            'image' => 'main.jpg',
            'is_active' => true,
        ]);

        $relatedPortfolio = Portfolio::create([
            'name' => 'Related Portfolio',
            'slug' => 'related-portfolio',
            'product_id' => $product->id,
            'description' => 'Related',
            'image' => 'related.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio.detail', $mainPortfolio->slug));

        $response->assertStatus(200);
        $response->assertSee('Related Portfolio');
        $response->assertViewHas('relatedPortfolios', function ($relatedPortfolios) use ($relatedPortfolio) {
            return $relatedPortfolios->contains('id', $relatedPortfolio->id);
        });
    }

    /**
     * Test portfolio detail excludes current portfolio from related.
     */
    public function test_portfolio_detail_excludes_current_from_related(): void
    {
        $product = Product::factory()->create();
        
        $mainPortfolio = Portfolio::create([
            'name' => 'Main Portfolio',
            'slug' => 'main-portfolio',
            'product_id' => $product->id,
            'description' => 'Main',
            'image' => 'main.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio.detail', $mainPortfolio->slug));

        $response->assertStatus(200);
        $response->assertViewHas('relatedPortfolios', function ($relatedPortfolios) use ($mainPortfolio) {
            return !$relatedPortfolios->contains('id', $mainPortfolio->id);
        });
    }

    /**
     * Test portfolio detail limits related portfolios to 3.
     */
    public function test_portfolio_detail_limits_related_portfolios_to_three(): void
    {
        $product = Product::factory()->create();
        
        $mainPortfolio = Portfolio::create([
            'name' => 'Main Portfolio',
            'slug' => 'main-portfolio',
            'product_id' => $product->id,
            'description' => 'Main',
            'image' => 'main.jpg',
            'is_active' => true,
        ]);

        // Create 5 related portfolios
        for ($i = 1; $i <= 5; $i++) {
            Portfolio::create([
                'name' => "Related Portfolio $i",
                'slug' => "related-portfolio-$i",
                'product_id' => $product->id,
                'description' => "Related $i",
                'image' => "related$i.jpg",
                'is_active' => true,
            ]);
        }

        $response = $this->get(route('portfolio.detail', $mainPortfolio->slug));

        $response->assertStatus(200);
        $response->assertViewHas('relatedPortfolios', function ($relatedPortfolios) {
            return $relatedPortfolios->count() === 3;
        });
    }

    /**
     * Test portfolio detail does not show inactive related portfolios.
     */
    public function test_portfolio_detail_does_not_show_inactive_related(): void
    {
        $product = Product::factory()->create();
        
        $mainPortfolio = Portfolio::create([
            'name' => 'Main Portfolio',
            'slug' => 'main-portfolio',
            'product_id' => $product->id,
            'description' => 'Main',
            'image' => 'main.jpg',
            'is_active' => true,
        ]);

        $inactiveRelated = Portfolio::create([
            'name' => 'Inactive Related',
            'slug' => 'inactive-related',
            'product_id' => $product->id,
            'description' => 'Should not appear',
            'image' => 'inactive.jpg',
            'is_active' => false,
        ]);

        $response = $this->get(route('portfolio.detail', $mainPortfolio->slug));

        $response->assertStatus(200);
        $response->assertDontSee('Inactive Related');
        $response->assertViewHas('relatedPortfolios', function ($relatedPortfolios) use ($inactiveRelated) {
            return !$relatedPortfolios->contains('id', $inactiveRelated->id);
        });
    }

    /**
     * Test portfolio can be accessed by slug with special characters.
     */
    public function test_portfolio_can_be_accessed_by_slug_with_special_chars(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Special & Characters! Test',
            'slug' => 'special-characters-test',
            'product_id' => $product->id,
            'description' => 'Special chars',
            'image' => 'special.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('portfolio.detail', 'special-characters-test'));

        $response->assertStatus(200);
        $response->assertSee('Special & Characters! Test');
    }
}
