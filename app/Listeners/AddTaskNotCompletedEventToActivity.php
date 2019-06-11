<?php

namespace App\Listeners;

use App\Events\TaskNotCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class AddTaskNotCompletedEventToActivity
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
     * @param  TaskNotCompleted  $event
     * @return void
     */
    public function handle(TaskNotCompleted $event)
    {
        $author = Auth::user()->first_name; // the currently logged in user
        // $event->task
        $title = $event->task->title;
        $pid = $event->task->project_id;
        $status = $event->task->status;

        if ($status == 'warning') {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author changed $title status to on track as task is not yet complete",
                "created_at" => now()
            ]);
            $insertData->save();
        } elseif ($status == 'danger') {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author changed $title status to off track as task is not yet complete",
                "created_at" => now()
            ]);
            $insertData->save();
        }
    }
}
