<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CodeAnalyse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:analyse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Analyse your code with PHPStan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       exec('./vendor/bin/phpstan analyse');
    }
}
