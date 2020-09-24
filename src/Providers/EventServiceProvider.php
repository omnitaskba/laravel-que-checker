<?php

namespace Omnitask\LaravelQueChecker\Providers;

use Omnitask\LaravelQueChecker\Events\CheckIsQueWorkingEvent;
use Omnitask\LaravelQueChecker\Events\CheckQueEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Omnitask\LaravelQueChecker\Listeners\CheckIsQueWorkingListener;
use Omnitask\LaravelQueChecker\Listeners\CheckQueListener;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CheckQueEvent::class => [
            CheckQueListener::class
        ],
        CheckIsQueWorkingEvent::class => [
            CheckIsQueWorkingListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
