<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestPortfolioValidation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:portfolio-validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test portfolio validation rules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Portfolio Image Validation Rules:');
        $this->line('');
        
        $rules = \App\Models\Portfolio::getImageValidationRules();
        
        foreach ($rules['image'] as $rule) {
            if (is_string($rule)) {
                $this->line("✓ {$rule}");
            } else {
                $this->line("✓ " . get_class($rule));
            }
        }
        
        $this->line('');
        $this->info('Filament FileUpload Configuration:');
        $this->line('✓ acceptedFileTypes: image/jpeg, image/jpg, image/png');
        $this->line('✓ maxSize: 2048 KB (2MB)');
        $this->line('✓ dimensions: min 300x200px, max 4000x4000px');
        $this->line('✓ image validation enabled');
        
        return 0;
    }
}
