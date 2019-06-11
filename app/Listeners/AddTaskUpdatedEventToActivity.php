<?php

namespace App\Listeners;

use App\Events\TaskUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Task;
use App\Activity;
use App\Project;
use Illuminate\Support\Facades\Auth;

class AddTaskUpdatedEventToActivity
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
     * @param  TaskUpdated  $event
     * @return void
     */
    public function handle(TaskUpdated $event)
    {
        $user = Auth::user(); // the currently logged in user
        // $event->task
        $title = $event->task->title;
        $projectid = $event->task->project_id;
        $project_name = Project::where("id", $projectid)->get();
        foreach ($project_name as $item2) {
            $pid = $item2->title;
        }
        
        $insertData = new Activity([
            "project_id" => $projectid,
            "body" => "$user->first_name updated the task $title in project $pid",
            "created_at" => now()
        ]);
        $insertData->save();
    }
}