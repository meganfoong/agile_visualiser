<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
use App\Activity;
use App\Project;
use Illuminate\Support\Facades\Auth;

class AddTaskCreatedEventToActivity
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
     * @param  TaskCreated  $event
     * @return void
     */
    public function handle(TaskCreated $event)
    {
        $author = Auth::user()->first_name; // the currently logged in user
        // $event->task
        $title = $event->task->title;
        $pid = $event->task->project_id;


        $project = Project::where("id", $pid)->get();
        foreach ($project as $item1) {
            $pTitle = $item1->title;
        }

        if (!empty($event->task->parent_id)) {
            $parent = $event->task->parent_id;

            $task = Task::where('id', $parent)->get();
            foreach ($task as $item2) {
                $tTitle = $item2->title;
            }
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author created the subtask $title in task $tTitle",
                "created_at" => now(),
                "type" => 'secondary'
            ]);
            $insertData->save();
        } else {
            $insertData = new Activity([
                "project_id" => $pid,
                "body" => "$author created the task $title in project $pTitle",
                "created_at" => now(),
                "type" => 'secondary'
            ]);
            $insertData->save();
        }
    }
}
