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
        //dd($request);
        if ($request->store == 1) {
            $comment = Comment::create(collect($request)->except('store')->toArray());
            return back();
        }

        $project = Project::create($request->all());

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

        $tasks = Task::with('projects')->where('project_id', $id)->where('parent_id', null)->get();

        $projects = Project::get()->where('id', $id);

        $projectid = Project::with('comments', 'users')->where('id', $id)->get();
        foreach ($projectid as $item1) {
            $pid = $item1->id;
            $uid = $item1->users;
            $pname = $item1->title;
        }

        $activities = Activity::with('projects')->where('project_id', $id)->orderBy('created_at', 'desc')->get();

        $comments = Comment::with('projects', 'users')->where('project_id', $pid)->get();

        $userCounts = Task::where('project_id', $pid)->whereNotNull('parent_id')->wherenotNUll('assign')->get();

        $members = User::has('projects')->join('tasks', 'users.id', 'tasks.assign')->select('users.first_name')->distinct()->get();

        foreach ($userCounts as $user) {
            $alluserCountdata[] = $user->assign;
        }

        if (!empty($alluserCountdata)) {
            $alltasks = array_count_values($alluserCountdata);


            foreach ($alltasks as $alltask) {
                $alltaskF[] = $alltask;
            }

            foreach ($members as $member) {
                $allmemberF[] = $member->first_name;
            }
        }
        if (!empty($comments) && !empty($activities) && !empty($alltasks)) {
            return view('project.index', compact('tasks', 'pid', 'activities', 'comments', 'projects', 'uid', 'alltaskF', 'allmemberF', 'pname'));
        } elseif (!empty($comments) && empty($activities) && empty($alltasks)) {
            return view('project.index', compact('tasks', 'pid', 'comments', 'projects', 'uid'));
        } elseif (!empty($activities) && empty($comments) && empty($alltasks)) {
            return view('project.index', compact('tasks', 'pid', 'activities', 'projects', 'uid'));
        } elseif (!empty($comments) && empty($activities) && !empty($alltasks)) {
            return view('project.index', compact('tasks', 'pid', 'comments', 'projects', 'uid', 'alltaskF', 'allmemberF', 'pname'));
        } elseif (!empty($activities) && empty($comments) && !empty($alltasks)) {
            return view('project.index', compact('tasks', 'pid', 'activities', 'projects', 'uid', 'alltaskF', 'allmemberF', 'pname'));
        } elseif (empty($comments) && empty($activities) && !empty($alltasks)) {
            return view('project.index', compact('tasks', 'pid', 'uid', 'alltaskF', 'allmemberF', 'pname')); 
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
        $project = Project::findOrFail($request->projectid);

        $project->delete();

        return back();
    }
}
