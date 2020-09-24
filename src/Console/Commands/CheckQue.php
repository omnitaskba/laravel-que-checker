<?php

namespace Omnitask\LaravelQueChecker\Console\Commands;

use Omnitask\LaravelQueChecker\Events\CheckQueEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckQue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:que-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store new que heartbeat in db via que';

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
        Log::info('Check que command called');
        event(new CheckQueEvent());
        Log::info('Check que command finished');
    }
}
