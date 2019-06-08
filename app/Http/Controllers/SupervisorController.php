<?php

namespace App\Http\Controllers;


use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        //$projects = Project::with('users')->where('user_id', $id)->get();
        //$users = User::all();
        //$projects = Project::all();
        //return view('supervisor.index',compact('users'));

        $users = User::all();
        $comments = Auth::user()->comments;
        $projects = Auth::user()->projects;
        $students = DB::table('users')->where('is_supervisor', 0)->get();
        return view('supervisor.index',compact('projects', 'comments', 'users', 'students'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
