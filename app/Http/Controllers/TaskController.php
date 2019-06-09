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
        $projects = Task::with('users')->get();
        dd($projects);
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
        
        //dd($request->approve);
        
        $task = Task::findOrFail($request->taskid);

        if (!empty($request->approve)) {
            
            $task->update(collect($request)->except('approve')->toArray());
            //dd($request);
            if($request->approve == 1 ) {
                $task->users()->attach(Auth::user()->id);
            } 
            elseif ($request->approve == 2 ) {
                $task->users()->detach(Auth::user()->id);
            }
        }

        if (!empty($request->complete)) {
            if ($request->complete == 1 ) {
            
                $task->update($request->all());
            } 
            elseif ($request->complete == 2) {
                $task->update($request->all());

                $task->users()->sync(NULL);
            }
        }

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
