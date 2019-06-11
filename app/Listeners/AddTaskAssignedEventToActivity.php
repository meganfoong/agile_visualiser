<?php

namespace App\Listeners;

use App\Events\TaskAssigned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
use App\Project;
use App\User;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class AddTaskAssignedEventToActivity
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
     * @param  TaskAssigned  $event
     * @return void
     */
    public function handle(TaskAssigned $event)
    {
        
        $author = Auth::user()->first_name; // the currently logged in user

        $subtask = Task::where('id', $event->task->id)->get();
        foreach ($subtask as $item1) {
            $title = $item1->title;
            $pid = $item1->project_id;
            $uid = $item1->assign;
            $parent = $item1->parent_id;
        }
        
        $task = Task::where('id', $parent)->get();
        foreach ($task as $item2) {
            $tTitle = $item2->title;
        }

        $user = User::where('id', $uid)->get();
        foreach ($user as $item3) {
            $assign = $item3->first_name;
        }

        $project = Project::where("id", $pid)->get();
        foreach ($project as $item4) {
            $pTitle = $item4->title;
        }
        
        $insertData = new Activity([
            "project_id" => $pid,
            "body" => "$author assigned $assign to $title in task $tTitle",
            "created_at" => now()
        ]);
        $insertData->save();
    }
}
