<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


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

        'App\Events\TaskCreated' => [
            'App\Listeners\AddTaskCreatedEventToActivity',
        ],

        'App\Events\TaskAssigned' => [
            'App\Listeners\AddTaskAssignedEventToActivity',
        ],
        
        'App\Events\TaskUpdated' => [
            'App\Listeners\AddTaskUpdatedEventToActivity',
        ],

        'App\Events\TaskDeleted' => [
            'App\Listeners\AddTaskDeletedEventToActivity',
        ],

        'App\Events\TaskApproved' => [
            'App\Listeners\AddTaskApprovedEventToActivity',
        ],

        'App\Events\TaskUnapproved' => [
            'App\Listeners\AddTaskUnapprovedEventToActivity',
        ],

        'App\Events\TaskStatusChanged' => [
            'App\Listeners\AddTaskStatusChangedEventToActivity',
        ],

        'App\Events\TaskCompleted' => [
            'App\Listeners\AddTaskCompletedEventToActivity',
        ],

        'App\Events\TaskNotCompleted' => [
            'App\Listeners\AddTaskNotCompletedEventToActivity',
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
