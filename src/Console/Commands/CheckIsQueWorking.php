<?php

namespace Omnitask\LaravelQueChecker\Console\Commands;

use Omnitask\LaravelQueChecker\Events\CheckIsQueWorkingEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckIsQueWorking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:que-working';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check is there stored pending que heartbeat in db and send notification if there is not';

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
        Log::info('Command check is que working called');
        event(new CheckIsQueWorkingEvent());
        Log::info('Command check is que working finished');
    }
}
