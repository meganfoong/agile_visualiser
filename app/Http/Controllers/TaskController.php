<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use Illuminate\Support\Facades\Auth;


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
        Task::create($request->all());

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
        //$a = $aid->where('pivot.project_id', $pid);
        

        // $assign = Auth::user()->with('projects')->get();
        // foreach ($assign as $item) {
        //     $aid = $item->projects;
        // }
        // $users = $aid->where('id', $pid);
        // dd($users);

        return view('task.index',compact('tasks', 'pid', 'tid', 'aid', 'project', 'task'));
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
        
        $task->update($request->all());
  
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
       
        return back();
    }
}
