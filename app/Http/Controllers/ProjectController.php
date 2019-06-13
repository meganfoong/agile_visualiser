<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use App\Comment;
use App\User;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //To create comments
        if ($request->store == 1) {
            $comment = Comment::create(collect($request)->except('store')->toArray());
            return back();
        }

        //To create a project
        $project = Project::create($request->all());

        //To add to the pivot table project_user to form a relationship between project and students
        $project->users()->sync($request->student);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $projects, Task $tasks, $id)
    {

        //To display tasks of current project
        $tasks = Task::with('projects')->where('project_id', $id)->where('parent_id', null)->get();

        //To get information of current project
        $projects = Project::get()->where('id', $id);

        //To get specific items about the current project to be used in forms
        $projectid = Project::with('comments', 'users')->where('id', $id)->get();
        foreach ($projectid as $item1) {
            $pid = $item1->id;
            $uid = $item1->users;
            $pname = $item1->title;
        }

        //To get information of activities for current project
        $activities = Activity::with('projects')->where('project_id', $id)->orderBy('created_at', 'desc')->get();
        
        //To get information of comments for current project
        $comments = Comment::with('projects', 'users')->where('project_id', $pid)->get();

        //Stops an error from occuring when comments or activities are empty
        if (!empty($comments) && !empty($activities)) {
            return view('project.index', compact('tasks', 'pid', 'activities', 'comments', 'projects', 'uid'));
        } elseif (!empty($comments) && empty($activities)) {
            return view('project.index', compact('tasks', 'pid', 'comments', 'projects', 'uid'));
        } elseif (!empty($activities) && empty($comments)) {
            return view('project.index', compact('tasks', 'pid', 'activities', 'projects', 'uid'));
        } else {
            return view('project.index', compact('tasks', 'pid', 'projects', 'uid'));
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
        //Updates project retrieved from form
        $project = Project::findOrFail($request->projectid);

        $project->update($request->all());

        $project->users()->sync($request->student);

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
        //Deletes project retrieved from form
        $project = Project::findOrFail($request->projectid);

        $project->delete();

        return back();
    }
}
