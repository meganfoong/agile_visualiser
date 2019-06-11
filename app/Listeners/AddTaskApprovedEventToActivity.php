<?php

namespace App\Listeners;

use App\Events\TaskApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
use App\Project;
use App\User;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class AddTaskApprovedEventToActivity
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
     * @param  TaskApproved  $event
     * @return void
     */
    public function handle(TaskApproved $event)
    {
        //
    }
}
