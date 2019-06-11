<?php

namespace App\Listeners;

use App\Events\TaskUapproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class AddTaskUnapprovedEventToActivity
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
     * @param  TaskUapproved  $event
     * @return void
     */
    public function handle(TaskUapproved $event)
    {
        $author = Auth::user()->first_name; // the currently logged in user

        $subtask = Task::where('id', $event->task->id)->get();
        foreach ($subtask as $item1) {
            $title = $item1->title;
            $pid = $item1->project_id;
            $parent = $item1->parent_id;
        }
        
        $task = Task::where('id', $parent)->get();
        foreach ($task as $item2) {
            $tTitle = $item2->title;
        }
        
        $insertData = new Activity([
            "project_id" => $pid,
            "body" => "$author unapproved $title in task $tTitle",
            "created_at" => now(),
            "type" => 'info'
        ]);
        $insertData->save();
    }
}
