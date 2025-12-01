<?php

use App\Models\Portfolio;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

describe('Portfolio Unit Tests', function () {

    beforeEach(function () {
        Storage::fake('public');
    });

    test('portfolio can be created with valid data', function () {
        $product = Product::factory()->create();
        
        $portfolioData = [
            'name' => 'Test Portfolio',
            'slug' => 'test-portfolio',
            'product_id' => $product->id,
            'description' => 'This is a test portfolio description',
            'image' => 'portfolios/test.jpg',
            'is_active' => true,
        ];

        $portfolio = Portfolio::create($portfolioData);

        expect($portfolio)->toBeInstanceOf(Portfolio::class)
            ->and($portfolio->name)->toBe('Test Portfolio')
            ->and($portfolio->slug)->toBe('test-portfolio')
            ->and($portfolio->product_id)->toBe($product->id)
            ->and($portfolio->is_active)->toBeTrue();
    });

    test('portfolio slug is auto-generated from name', function () {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'My Awesome Portfolio',
            'product_id' => $product->id,
            'description' => 'Description',
            'image' => 'portfolios/test.jpg',
        ]);

        expect($portfolio->slug)->toBe('my-awesome-portfolio');
    });

    test('portfolio belongs to a product', function () {
        $product = Product::factory()->create();
        $portfolio = Portfolio::factory()->forProduct($product)->create();

        expect($portfolio->product)->toBeInstanceOf(Product::class)
            ->and($portfolio->product->id)->toBe($product->id);
    });

    test('portfolio can be set as active', function () {
        $portfolio = Portfolio::factory()->active()->create();

        expect($portfolio->is_active)->toBeTrue();
    });

    test('portfolio can be set as inactive', function () {
        $portfolio = Portfolio::factory()->inactive()->create();

        expect($portfolio->is_active)->toBeFalse();
    });

    test('portfolio has correct fillable fields', function () {
        $fillable = (new Portfolio())->getFillable();

        expect($fillable)->toBeArray()
            ->and($fillable)->toContain('name')
            ->and($fillable)->toContain('slug')
            ->and($fillable)->toContain('product_id')
            ->and($fillable)->toContain('description')
            ->and($fillable)->toContain('image')
            ->and($fillable)->toContain('is_active');
    });

    test('portfolio is_active is cast to boolean', function () {
        $portfolio = Portfolio::factory()->create(['is_active' => 1]);

        expect($portfolio->is_active)->toBeBool()
            ->and($portfolio->is_active)->toBeTrue();
    });

    test('portfolio uses slug as route key', function () {
        $portfolio = new Portfolio();

        expect($portfolio->getRouteKeyName())->toBe('slug');
    });

    test('multiple portfolios can be created', function () {
        Portfolio::factory()->count(5)->create();

        expect(Portfolio::count())->toBe(5);
    });

    test('portfolio can be updated', function () {
        $portfolio = Portfolio::factory()->create([
            'name' => 'Original Name',
            'description' => 'Original Description'
        ]);

        $portfolio->update([
            'name' => 'Updated Name',
            'description' => 'Updated Description'
        ]);

        expect($portfolio->name)->toBe('Updated Name')
            ->and($portfolio->description)->toBe('Updated Description');
    });

    test('portfolio can be deleted', function () {
        $portfolio = Portfolio::factory()->create();
        $portfolioId = $portfolio->id;

        $portfolio->delete();

        expect(Portfolio::find($portfolioId))->toBeNull();
    });

    test('portfolio can be filtered by active status', function () {
        Portfolio::factory()->active()->count(3)->create();
        Portfolio::factory()->inactive()->count(2)->create();

        $activePortfolios = Portfolio::where('is_active', true)->get();

        expect($activePortfolios)->toHaveCount(3);
    });

    test('portfolio description is stored correctly', function () {
        $description = 'This is a detailed description of the portfolio project.';
        $portfolio = Portfolio::factory()->create(['description' => $description]);

        expect($portfolio->description)->toBe($description)
            ->and($portfolio->description)->toBeString();
    });

    test('portfolio image path is stored', function () {
        $imagePath = 'portfolios/sample-image.jpg';
        $portfolio = Portfolio::factory()->create(['image' => $imagePath]);

        expect($portfolio->image)->toBe($imagePath);
    });

    test('portfolio has timestamps', function () {
        $portfolio = Portfolio::factory()->create();

        expect($portfolio->created_at)->not->toBeNull()
            ->and($portfolio->updated_at)->not->toBeNull()
            ->and($portfolio->created_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
    });

    test('portfolio id is auto-generated', function () {
        $portfolio = Portfolio::factory()->create();

        expect($portfolio->id)->not->toBeNull()
            ->and($portfolio->id)->toBeInt()
            ->and($portfolio->id)->toBeGreaterThan(0);
    });

    test('portfolio name is required when creating', function () {
        $product = Product::factory()->create();
        
        expect(fn() => Portfolio::create([
            'product_id' => $product->id,
            'description' => 'Test',
            'image' => 'test.jpg',
        ]))->toThrow(\Illuminate\Database\QueryException::class);
    });

    test('portfolio slug is unique when generated', function () {
        $product = Product::factory()->create();
        
        $portfolio1 = Portfolio::create([
            'name' => 'Unique Portfolio',
            'slug' => 'unique-portfolio',
            'product_id' => $product->id,
            'description' => 'Test description',
            'image' => 'test.jpg',
        ]);

        expect($portfolio1->slug)->toBe('unique-portfolio');
    });

    test('portfolio can load product relationship', function () {
        $product = Product::factory()->create(['nama_produk' => 'Test Product']);
        $portfolio = Portfolio::factory()->forProduct($product)->create();

        $portfolio->load('product');

        expect($portfolio->relationLoaded('product'))->toBeTrue()
            ->and($portfolio->product->nama_produk)->toBe('Test Product');
    });

    test('active portfolios can be retrieved', function () {
        Portfolio::factory()->active()->count(4)->create();
        Portfolio::factory()->inactive()->count(2)->create();

        $activeCount = Portfolio::where('is_active', true)->count();

        expect($activeCount)->toBe(4);
    });

    test('portfolio slug handles special characters', function () {
        $product = Product::factory()->create();
        
        $portfolio = Portfolio::create([
            'name' => 'Portfolio & Design #1',
            'product_id' => $product->id,
            'description' => 'Test',
            'image' => 'test.jpg',
        ]);

        expect($portfolio->slug)->toBe('portfolio-design-1');
    });

    test('portfolio can be found by slug', function () {
        $portfolio = Portfolio::factory()->create([
            'name' => 'Find By Slug',
            'slug' => 'find-by-slug',
        ]);

        $found = Portfolio::where('slug', 'find-by-slug')->first();

        expect($found)->not->toBeNull()
            ->and($found->id)->toBe($portfolio->id);
    });

    test('portfolio model validates image rules', function () {
        $rules = Portfolio::getImageValidationRules();

        expect($rules)->toBeArray()
            ->and($rules)->toHaveKey('image')
            ->and($rules['image'])->toContain('required')
            ->and($rules['image'])->toContain('image');
    });
});
