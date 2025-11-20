<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Portfolio;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PortfolioModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test that slug is auto-generated from name when creating portfolio.
     */
    public function test_slug_is_auto_generated_from_name(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Test Portfolio Name',
            'product_id' => $product->id,
            'description' => 'Test description',
            'image' => 'test.jpg',
            'is_active' => true,
        ]);

        $this->assertEquals('test-portfolio-name', $portfolio->slug);
    }

    /**
     * Test that custom slug is preserved if provided.
     */
    public function test_custom_slug_is_preserved(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Test Portfolio',
            'slug' => 'custom-slug',
            'product_id' => $product->id,
            'description' => 'Test description',
            'image' => 'test.jpg',
            'is_active' => true,
        ]);

        $this->assertEquals('custom-slug', $portfolio->slug);
    }

    /**
     * Test portfolio uses slug as route key.
     */
    public function test_portfolio_uses_slug_as_route_key(): void
    {
        $portfolio = new Portfolio();
        
        $this->assertEquals('slug', $portfolio->getRouteKeyName());
    }

    /**
     * Test portfolio belongs to product.
     */
    public function test_portfolio_belongs_to_product(): void
    {
        $product = Product::factory()->create(['nama_produk' => 'Test Product']);
        
        $portfolio = Portfolio::create([
            'name' => 'Test Portfolio',
            'product_id' => $product->id,
            'description' => 'Test description',
            'image' => 'test.jpg',
            'is_active' => true,
        ]);

        $this->assertInstanceOf(Product::class, $portfolio->product);
        $this->assertEquals('Test Product', $portfolio->product->nama_produk);
        $this->assertEquals($product->id, $portfolio->product_id);
    }

    /**
     * Test is_active is cast to boolean.
     */
    public function test_is_active_is_cast_to_boolean(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Test Portfolio',
            'product_id' => $product->id,
            'description' => 'Test description',
            'image' => 'test.jpg',
            'is_active' => 1,
        ]);

        $this->assertIsBool($portfolio->is_active);
        $this->assertTrue($portfolio->is_active);
    }

    /**
     * Test fillable attributes are correctly set.
     */
    public function test_fillable_attributes_are_set(): void
    {
        $product = Product::factory()->create();
        
        $data = [
            'name' => 'Fillable Test',
            'slug' => 'fillable-test',
            'product_id' => $product->id,
            'description' => 'Test description',
            'image' => 'fillable.jpg',
            'is_active' => true,
        ];

        $portfolio = Portfolio::create($data);

        $this->assertEquals('Fillable Test', $portfolio->name);
        $this->assertEquals('fillable-test', $portfolio->slug);
        $this->assertEquals($product->id, $portfolio->product_id);
        $this->assertEquals('Test description', $portfolio->description);
        $this->assertEquals('fillable.jpg', $portfolio->image);
        $this->assertTrue($portfolio->is_active);
    }

    /**
     * Test image validation rules method exists.
     */
    public function test_image_validation_rules_method_exists(): void
    {
        $this->assertTrue(method_exists(Portfolio::class, 'getImageValidationRules'));
    }

    /**
     * Test image validation rules return correct structure.
     */
    public function test_image_validation_rules_return_correct_structure(): void
    {
        $rules = Portfolio::getImageValidationRules();

        $this->assertArrayHasKey('image', $rules);
        $this->assertIsArray($rules['image']);
        
        $imageRules = $rules['image'];
        $this->assertContains('required', $imageRules);
        $this->assertContains('image', $imageRules);
        $this->assertContains('max:2048', $imageRules);
    }

    /**
     * Test portfolio can be created with all fillable fields.
     */
    public function test_portfolio_can_be_created_with_all_fields(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Complete Portfolio',
            'slug' => 'complete-portfolio',
            'product_id' => $product->id,
            'description' => 'Complete description for testing',
            'image' => 'portfolios/complete.jpg',
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('portfolios', [
            'name' => 'Complete Portfolio',
            'slug' => 'complete-portfolio',
            'product_id' => $product->id,
            'description' => 'Complete description for testing',
            'image' => 'portfolios/complete.jpg',
            'is_active' => true,
        ]);
    }

    /**
     * Test slug with special characters is properly formatted.
     */
    public function test_slug_with_special_characters_is_formatted(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Test@Portfolio#123 & Special!',
            'product_id' => $product->id,
            'description' => 'Test',
            'image' => 'test.jpg',
            'is_active' => true,
        ]);

        $expectedSlug = Str::slug('Test@Portfolio#123 & Special!');
        $this->assertEquals($expectedSlug, $portfolio->slug);
    }

    /**
     * Test portfolio can be inactive by default.
     */
    public function test_portfolio_can_be_inactive(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Inactive Portfolio',
            'product_id' => $product->id,
            'description' => 'This is inactive',
            'image' => 'inactive.jpg',
            'is_active' => false,
        ]);

        $this->assertFalse($portfolio->is_active);
        $this->assertDatabaseHas('portfolios', [
            'name' => 'Inactive Portfolio',
            'is_active' => false,
        ]);
    }

    /**
     * Test portfolio timestamps are automatically managed.
     */
    public function test_portfolio_timestamps_are_managed(): void
    {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Timestamp Test',
            'product_id' => $product->id,
            'description' => 'Testing timestamps',
            'image' => 'timestamp.jpg',
            'is_active' => true,
        ]);

        $this->assertNotNull($portfolio->created_at);
        $this->assertNotNull($portfolio->updated_at);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $portfolio->created_at);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $portfolio->updated_at);
    }
}
