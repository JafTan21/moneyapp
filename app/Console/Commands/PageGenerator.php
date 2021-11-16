<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PageGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate livewire page component (history and form)';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        Artisan::call('make:model ' . $name . ' -mc');
        $this->info("model, migration and controller created successfully");

        Artisan::call('livewire:make ' . $name . '/' . $name . 'Form');
        $this->info("Livewire form created successfully");

        Artisan::call('livewire:make ' . $name . '/' . $name . 'History');
        $this->info("Livewire history created successfully");

        Artisan::call('make:view ' . strtolower($name) . '/' . 'index');
        $this->info("view created successfully");

        $this->warn("Don't forget to edit controller and add it to the web.php");
        return Command::SUCCESS;
    }
}