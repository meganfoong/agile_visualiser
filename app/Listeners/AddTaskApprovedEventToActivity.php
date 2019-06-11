<?php

namespace App\Listeners;

use App\Events\TaskApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
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
        $author = Auth::user()->first_name; // the currently logged in user

        $subtask = Task::where('id', $event->task->id)->get();
        foreach ($subtask as $item1) {
            $title = $item1->title;
            $pid = $item1->project_id;
            $parent = $item1->parent_id;
            $status = $item1->status;
        }
        
        $task = Task::where('id', $parent)->get();
        foreach ($task as $item2) {
            $tTitle = $item2->title;
        }

        if ($status == 'success') {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author approved $title and changed status to complete in task $tTitle",
                "created_at" => now(),
                "type" => 'success'
            ]);
            $insertData->save();
        } else {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author approved $title in task $tTitle",
                "created_at" => now(),
                "type" => 'primary'
            ]);
            $insertData->save();
        }
    }
}
