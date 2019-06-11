<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Comment;
use App\Project;
use App\Activity;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $projects = Auth::user()->projects;
        $students = User::where('parent_id', Auth::user()->id)->get();

        return view('supervisor.index', compact('projects', 'students'));
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
        if (!empty($request->projectid)) {
            $projects = Auth::user()->projects;
            $students = User::where('parent_id', Auth::user()->id)->get();
            $project = Project::with('comments', 'users')->where('id', $request->projectid)->get();

            foreach ($project as $item1) {
                $title = $item1->title;
                $pid = $item1->id;
                $uid = $item1->users;
            }
            $activities = Activity::with('projects')->where('project_id', $pid)->orderBy('created_at', 'desc')->get();

            $comments = Comment::with('projects', 'users')->where('project_id', $pid)->get();

            if (!empty($comments) && !empty($activities)) {
                return view('supervisor.index', compact('activities', 'comments', 'uid', 'pid', 'projects', 'students', 'title'));
            } elseif (!empty($comments) && empty($activities)) {
                return view('supervisor.index', compact('comments', 'uid', 'pid', 'projects', 'students', 'title'));
            } elseif (!empty($activities) && empty($comments)) {
                return view('supervisor.index', compact('activities', 'uid', 'pid', 'projects', 'students',  'title'));
            }
        }




        if ($request->input('submit') != null) {

            $file = $request->file('file');

            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert user to MySQL database
                    $password = Hash::make('password1');
                    $id = Auth::user()->id; // the currently logged in user
                    foreach ($importData_arr as $importData) {

                        $insertData = array(

                            "id" => (int)$importData[0],
                            "parent_id" => $id,
                            "first_name" => $importData[1],
                            "last_name" => $importData[2],
                            "is_supervisor" => 0,
                            "email" => "$importData[0]@student.westernsydney.edu.au",
                            "email_verified_at" => now(),
                            "password" => $password,
                            "created_at" => now(),
                            "updated_at" => now()
                        );
                        User::insertData($insertData);
                    }

                    Session::flash('message', 'Student data import successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 2MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension.');
            }
            return back();
        }

        // Redirect to index
        //return redirect()->action('CsvController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    { }

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
