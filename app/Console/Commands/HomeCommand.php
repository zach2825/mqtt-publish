<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HomeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homeauto:commander {topic} {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish to the channel';

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
        // Open connection and get connection string
        $mqtt = app('Mqtt');

        $argument = $this->argument('message')? 'ON': 'OFF';

        $mqtt->publish($this->argument('topic'), $argument, 0);

        $mqtt->close();
    }

}
