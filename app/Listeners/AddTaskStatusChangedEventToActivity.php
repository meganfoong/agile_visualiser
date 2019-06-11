<?php

namespace App\Listeners;

use App\Events\TaskStatusChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;
use App\Activity;
use App\Project;
use Illuminate\Support\Facades\Auth;

class AddTaskStatusChangedEventToActivity
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
     * @param  TaskStatusChanged  $event
     * @return void
     */
    public function handle(TaskStatusChanged $event)
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

        $project = Project::where("id", $pid)->get();
        foreach ($project as $item1) {
            $pTitle = $item1->title;
        }

        if (!empty($event->task->parent_id)) {
            if ($status == 'warning') {
                $insertData = new Activity([
                    "project_id" => $pid,
                    "body" => "$author changed $title status to on track in task $tTitle",
                    "created_at" => now(),
                    "type" => 'warning'
                ]);
                $insertData->save();
            }
            elseif ($status == 'danger') {
                $insertData = new Activity([
                    "project_id" => $pid,
                    "body" => "$author changed $title status to off track in task $tTitle",
                    "created_at" => now(),
                    "type" => 'danger'
                ]);
                $insertData->save();
            }
        } else {
            if ($status == 'success') {
                $insertData = new Activity([
                    "project_id" => $pid,
                    "body" => "$author changed $title status to complete in project $pTitle",
                    "created_at" => now(),
                    "type" => 'success'
                ]);
                $insertData->save();
            }
            elseif ($status == 'warning') {
                $insertData = new Activity([
                    "project_id" => $pid,
                    "body" => "$author changed $title status to on track in project $pTitle",
                    "created_at" => now(),
                    "type" => 'warning'
                ]);
                $insertData->save();
            }
            elseif ($status == 'danger') {
                $insertData = new Activity([
                    "project_id" => $pid,
                    "body" => "$author changed $title status to off track in project $pTitle",
                    "created_at" => now(),
                    "type" => 'danger'
                ]);
                $insertData->save();
            }
        }

        
    }
}
