<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Events\TaskCreated;
use App\Events\TaskAssigned;
use App\Events\TaskUpdated;
use App\Events\TaskDeleted;
use App\Events\TaskApproved;
use App\Events\TaskUnapproved;
use App\Events\TaskStatusChanged;
use App\Events\TaskCompleted;
use App\Events\TaskNotCompleted;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Retrieve form info to create new task
        $task = Task::create($request->all());

        // call our event here, to insert task into activity table
        event(new TaskCreated($task));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $tasks, $id)
    {
        //Gets information of subtasks within task
        $tasks = Task::with('parent')->where('parent_id', $id)->get();

        //Gets specfic of task to be used in form when creating a subtask
        $parentid = Task::with('parent')->where('id', $id)->get();
        foreach ($parentid as $item1) {
            $tid = $item1->id;
            $tname = $item1->title;
        }

        //Gets information of task
        $task = Task::get()->where('id', $id);

        //Gets id of project related to task
        $projectid = Task::with('projects')->where('id', $id)->get();
        foreach ($projectid as $item2) {
            $pid = $item2->project_id;
        }

        //Gets a collection of data about the current project to be passed in the view
        $project = Project::get()->where('id', $pid);

        //Gets assigned users to project to display to approveform when assigning a student to a task
        $assign = Project::with('users')->where('id', $pid)->get();
        foreach ($assign as $item3) {
            $aid = $item3->users;
        }

        //Gets information users of who has approved
        $approve = Task::has('users')->where('parent_id', $id)->get();
        foreach ($approve as $item4) {
            $uid = $item4->users;
        }

        //For the contribution chart
        //Counts tasks which have been assigned
        $userCounts = Task::with('parent')->where('parent_id', $tid)->wherenotNUll('assign')->get();

        //Gets list of users of who have been assigned to subtasks
        $members = User::join('tasks', 'users.id', 'tasks.assign')->where('tasks.parent_id', $tid)->select('users.first_name')->distinct()->get();

        //Gets array of assigned user ids
        foreach ($userCounts as $user) {
            $alluserCountdata[] = $user->assign;
        }

        //If statement stops an error from occurring when alluserCountdata is empty
        if (!empty($alluserCountdata)) {
            //Counts values in array
            $alltasks = array_count_values($alluserCountdata);

            //Creates an array of tasks
            foreach ($alltasks as $alltask) {
                $alltaskF[] = $alltask;
            }
            //Creates an array of members
            foreach ($members as $member) {
                $allmemberF[] = $member->first_name;
            }
        }
        
        //Stops an error from occuring when alltasks and/or uid is empty
        if (!empty($alltasks) && !empty($uid) ) {
            return view('task.index', compact('tasks', 'pid', 'tid', 'aid', 'project', 'task', 'uid', 'alltaskF', 'allmemberF', 'tname'));
        } 
        elseif (!empty($uid) && empty($alltasks)) {
            return view('task.index', compact('tasks', 'pid', 'tid', 'aid', 'project', 'task', 'uid'));
        } 
        elseif (empty($uid) && !empty($alltasks)) {
            return view('task.index', compact('tasks', 'pid', 'tid', 'aid', 'project', 'task', 'alltaskF', 'allmemberF', 'tname'));
        } 
        else {
            return view('task.index', compact('tasks', 'pid', 'tid', 'aid', 'project', 'task'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Finds task that needs to be updated
        $task = Task::findOrFail($request->taskid);

        //Updates who is assigned to a task
        if (!empty($request->assign)) {

            $task->update($request->all());

            event(new TaskAssigned($task));
            return back();
        }

        //Updates who is approved to a task
        if (!empty($request->approve)) {
            $task->update(collect($request)->except('approve')->toArray());
            //Adds user to pivot task user table
            if ($request->approve == 1) {
                $task->users()->attach(Auth::user()->id);
                event(new TaskApproved($task));
            } elseif ($request->approve == 2) {
                //Removes user to pivot task user table
                $task->users()->detach(Auth::user()->id);
                event(new TaskUnapproved($task));
            }
            return back();
        }

        //Updates whether the task is complete or not
        if (!empty($request->complete)) {
            if ($request->complete == 1) {

                $task->update($request->all());
                event(new TaskCompleted($task));
            } elseif ($request->complete == 2) {
                $task->update($request->all());
                event(new TaskNotCompleted($task));
                $task->users()->sync(NULL);
            }
            return back();
        }

        //Updates the status of the task
        if (!empty($request->status)) {

            $task->update($request->all());

            event(new TaskStatusChanged($task));
            return back();
        }
        
        //General update of task for name and description
        $task->update($request->all());

        // event to update task in activity table
        event(new TaskUpdated($task));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Deletes task or subtask
        $task = Task::findOrFail($request->taskid);

        $task->delete();

        event(new TaskDeleted($task));
        return back();
    }
}
