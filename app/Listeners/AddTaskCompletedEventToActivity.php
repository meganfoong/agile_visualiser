<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class AddTaskCompletedEventToActivity
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
     * @param  TaskCompleted  $event
     * @return void
     */
    public function handle(TaskCompleted $event)
    {
        $author = Auth::user()->first_name; // the currently logged in user
        // $event->task
        $title = $event->task->title;
        $pid = $event->task->project_id;
        $status = $event->task->status;
        $parent = $event->task->parent_id;

        $task = Task::where('id', $parent)->get();
        foreach ($task as $item2) {
            $tTitle = $item2->title;
        }

        if ($status == 'success') {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author confirmed completion and changed $title status to complete in task $tTitle",
                "created_at" => now()
            ]);
            $insertData->save();
        }
        elseif ($status == 'warning') {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author changed $title status to on track as task is not yet complete",
                "created_at" => now()
            ]);
            $insertData->save();
        }
        elseif ($status == 'danger') {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author changed $title status to off track as task is not yet complete",
                "created_at" => now()
            ]);
            $insertData->save();
        }
    }
}
