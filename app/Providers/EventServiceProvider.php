<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\TaskCreated;
use App\Listeners\AddTaskCreatedEventToActivity;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        TaskCreated::class => [
            AddTaskCreatedEventToActivity::class,
        ],

        'App\Events\TaskUpdated' => [
            'App\Listeners\AddTaskUpdatedEventToActivity',
        ],

        'App\Events\TaskDeleted' => [
            'App\Listeners\AddTaskDeletedEventToActivity',
        ],

        

      
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
