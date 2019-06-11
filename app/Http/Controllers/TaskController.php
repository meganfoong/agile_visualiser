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
        $projects = Task::with('users')->get();
        //dd($projects);
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
        $tasks = Task::with('parent')->where('parent_id', $id)->get();

        $parentid = Task::with('parent')->where('id', $id)->get();
        foreach ($parentid as $item1) {
            $tid = $item1->id;
        }

        $task = Task::get()->where('id', $id);

        $projectid = Task::with('projects')->where('id', $id)->get();
        foreach ($projectid as $item2) {
            $pid = $item2->project_id;
        }

        $project = Project::get()->where('id', $pid);

        $assign = Project::with('users')->where('id', $pid)->get();
        foreach ($assign as $item3) {
            $aid = $item3->users;
        }

        $approve = Task::has('users')->where('parent_id', $id)->get();
        foreach ($approve as $item4) {
            $uid = $item4->users;
        }

        //dd($uid);

        // foreach ($aid as $i) {
        //     $u[] = $i->id;
        // }
        


        //$count = Task::with('parent')->where('parent_id', $tid)->where('assign', $u)->get();
        
        //dd($u);
        //dd(count($count->assign->where('assign', 18982029)));

        if (!empty($uid)) {
            return view('task.index',compact('tasks', 'pid', 'tid', 'aid', 'project', 'task', 'uid'));
        } else {
            return view('task.index',compact('tasks', 'pid', 'tid', 'aid', 'project', 'task'));
        }
        //$a = $aid->where('pivot.project_id', $pid);

        
        

        // $assign = Auth::user()->with('projects')->get();
        // foreach ($assign as $item) {
        //     $aid = $item->projects;
        // }
        // $users = $aid->where('id', $pid);
        // dd($aid);

        return view('task.index',compact('tasks', 'pid', 'tid', 'aid', 'project', 'task', 'uid'));
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
        $task = Task::findOrFail($request->taskid);
        
        if (!empty($request->assign)) {
            
            $task->update($request->all());

            event(new TaskAssigned($task));
            return back();
        }

        if (!empty($request->approve)) {
            $task->update(collect($request)->except('approve')->toArray());
            
            if($request->approve == 1 ) {
                $task->users()->attach(Auth::user()->id);
                event(new TaskApproved($task));
            } 
            elseif ($request->approve == 2 ) {
                $task->users()->detach(Auth::user()->id);
                event(new TaskUnapproved($task));
            }
            return back();
        }

        if (!empty($request->complete)) {
            if ($request->complete == 1 ) {
            
                $task->update($request->all());
                event(new TaskCompleted($task));
            } 
            elseif ($request->complete == 2) {
                $task->update($request->all());
                event(new TaskNotCompleted($task));
                $task->users()->sync(NULL);
            }
            return back();
        }

        if (!empty($request->status)) {
            
            $task->update($request->all());

            event(new TaskStatusChanged($task));
            return back();
        }

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
        $task = Task::findOrFail($request->taskid);

        $task->delete();
        //event
        event(new TaskDeleted($task));
        return back();
    }
}
