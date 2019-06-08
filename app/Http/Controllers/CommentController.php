<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect('/supervisor');
    }

    /**
     * Show a list of all of the user's comments.
     *
     * @return Response
     */
    public function index()
    {
        $comments = DB::table('comments')
                     ->select(DB::raw('user_id, body, created_at'))
                     //->where('status', '<>', 1)
                     ->groupBy('created_at')
                     ->get();

        return view('supervisor', ['comments' => $comments]);
    }
}
