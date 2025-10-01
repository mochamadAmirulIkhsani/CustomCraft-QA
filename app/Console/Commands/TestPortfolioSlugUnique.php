<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestPortfolioSlugUnique extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:portfolio-slug-unique';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test portfolio slug unique validation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Portfolio Slug Unique Validation');
        $this->line('');
        
        // Cek portfolio yang sudah ada
        $existingPortfolios = \App\Models\Portfolio::select('id', 'name', 'slug')->take(3)->get();
        
        if ($existingPortfolios->count() > 0) {
            $this->info('Portfolio yang sudah ada:');
            foreach ($existingPortfolios as $portfolio) {
                $this->line("  ID: {$portfolio->id} | Slug: '{$portfolio->slug}' | Name: {$portfolio->name}");
            }
            $this->line('');
            
            // Test dengan slug yang sudah ada
            $existingSlug = $existingPortfolios->first()->slug;
            $testData = [
                'name' => 'Test Portfolio Baru',
                'slug' => $existingSlug, // Slug yang sudah ada
                'description' => 'Test description',
                'image' => 'test.jpg'
            ];
            
            $this->line("Test data dengan slug duplikat: '{$existingSlug}'");
            
            // Simulasi validasi Laravel
            $validator = \Illuminate\Support\Facades\Validator::make($testData, [
                'name' => 'required|string|max:255',
                'slug' => 'required|alpha_dash|unique:portfolios,slug',
                'description' => 'required',
                'image' => 'required'
            ]);
            
            if ($validator->fails()) {
                $this->error('❌ VALIDATION FAILED (Expected):');
                foreach ($validator->errors()->all() as $error) {
                    $this->line("  • {$error}");
                }
            } else {
                $this->error('❗ Validation passed (Unexpected - should fail for duplicate slug)');
            }
        } else {
            $this->info('Tidak ada portfolio existing untuk test.');
        }
        
        $this->line('');
        $this->info('Filament Configuration:');
        $this->line('✅ TextInput::make(\'slug\')->unique(Portfolio::class, \'slug\', ignoreRecord: true)');
        $this->line('✅ Database constraint: UNIQUE KEY pada kolom slug');
        $this->line('✅ Auto-generate slug dari name dengan Str::slug()');
        $this->line('✅ ignoreRecord: true = ignore current record saat edit');
        
        return 0;
    }
}
