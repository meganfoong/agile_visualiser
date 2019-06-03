<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()

    {
        if(auth()->user()->is_supervisor == 1)
        {
            //do this if u dont want the specific route name
            //return view ('supervisor');
            //do this if u want the specific route name
            return redirect  ('supervisor');

        }
        //do this if u dont want the specific route name
       // return view ('home');
        //do this if u want the specific route name
         return redirect  ( 'project');


    }


}
