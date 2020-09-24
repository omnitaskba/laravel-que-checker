<?php

namespace Omnitask\LaravelQueChecker\Listeners;

use Omnitask\LaravelQueChecker\Events\CheckIsQueWorkingEvent;
use Omnitask\LaravelQueChecker\Jobs\CheckIsQueWorkingJob;
use Exception;

use Illuminate\Support\Facades\Log;

class CheckIsQueWorkingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CheckIsQueWorkingEvent $event)
    {
        try {
            CheckIsQueWorkingJob::dispatch();
        } catch (Exception $e) {
           Log::error('Failed to check is que working.Error:'. $e);
        }
    }
}
