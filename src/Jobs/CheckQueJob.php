<?php

namespace Omnitask\LaravelQueChecker\Jobs;

use Omnitask\LaravelQueChecker\Repositories\QueHeartbeatService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckQueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            QueHeartbeatService::createNewQueHeartbeatOrFail();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
