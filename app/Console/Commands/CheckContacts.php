<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check contacts count in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = \App\Models\Contact::count();
        $this->info("Total contacts in database: {$count}");
        
        if ($count > 0) {
            $latest = \App\Models\Contact::latest()->first();
            $this->info("Latest contact: {$latest->full_name} ({$latest->email})");
        }
        
        return 0;
    }
}
