<?php

namespace Omnitask\LaravelQueChecker\Listeners;

use Omnitask\LaravelQueChecker\Events\CheckQueEvent;
use Omnitask\LaravelQueChecker\Jobs\CheckQueJob;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CheckQueListener implements ShouldQueue
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
    public function handle(CheckQueEvent $event)
    {
        try {
            CheckQueJob::dispatch();
        } catch (Exception $e) {
            Log::info('Failed to process check que event.Error:'. $e);
        }
    }
}
