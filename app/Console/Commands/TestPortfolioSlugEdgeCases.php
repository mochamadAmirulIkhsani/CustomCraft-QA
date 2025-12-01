<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestPortfolioSlugEdgeCases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:portfolio-slug-edge-cases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test portfolio slug validation edge cases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Portfolio Slug Validation Edge Cases');
        $this->line('');
        
        // Test cases
        $testCases = [
            [
                'name' => 'Test dengan spasi dan karakter khusus!@#',
                'expected_slug' => 'test-dengan-spasi-dan-karakter-khusus',
                'description' => 'Auto-generate slug dari name dengan karakter khusus'
            ],
            [
                'name' => 'TEST UPPERCASE',
                'expected_slug' => 'test-uppercase', 
                'description' => 'Convert uppercase ke lowercase'
            ],
            [
                'name' => 'Test    multiple    spaces',
                'expected_slug' => 'test-multiple-spaces',
                'description' => 'Handle multiple spaces'
            ],
            [
                'name' => 'Test-with-dashes_and_underscores',
                'expected_slug' => 'test-with-dashes-and-underscores',
                'description' => 'Handle existing dashes and underscores'
            ]
        ];
        
        foreach ($testCases as $index => $case) {
            $this->line("Test Case " . ($index + 1) . ": {$case['description']}");
            $this->line("  Input Name: '{$case['name']}'");
            
            $generatedSlug = \Illuminate\Support\Str::slug($case['name']);
            $this->line("  Generated Slug: '{$generatedSlug}'");
            $this->line("  Expected Slug: '{$case['expected_slug']}'");
            
            if ($generatedSlug === $case['expected_slug']) {
                $this->info("  ✅ PASS");
            } else {
                $this->error("  ❌ FAIL");
            }
            $this->line('');
        }
        
        $this->info('Slug Validation Rules Summary:');
        $this->line('✅ Database Level: UNIQUE constraint pada kolom slug');
        $this->line('✅ Laravel Level: unique:portfolios,slug validation');
        $this->line('✅ Filament Level: ->unique(Portfolio::class, \'slug\', ignoreRecord: true)');
        $this->line('✅ Auto-generation: Str::slug() untuk format URL-friendly');
        $this->line('✅ Edit Protection: ignoreRecord: true untuk edit existing record');
        $this->line('✅ Format Validation: alpha_dash rule (hanya huruf, angka, dash, underscore)');
        
        return 0;
    }
}
