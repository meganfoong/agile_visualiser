<?php

namespace App\Http\Controllers;

use App\Modal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ModalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $modals = Modal::all()->where('parent_id', null);
        return view('modal.index',compact('modals'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Modal::create($request->all());

        

        return back(); 
        
        //$modal = new Modal;

        //$modal->title = request('title');
        //$modal->description = request('description');
        //$modal->status = request('status');
        //$modal->assign = request('assign');
        //$modal->approve = request('approve');

        //$modal->save();

        //return redirect('modal/test');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function show(Modal $card, $id)
    {
        $card = Modal::with('parent')->where('parent_id', $id)->get();

        return view('modal.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$edit = Modal::all();

        //return view('modal.test', compact('edit'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $modal = Modal::findOrFail($request->modal_id);

        $modal->update($request->all());
       
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $modal = Modal::findOrFail($request->modal_id);

        $modal->delete();
       
        return back();
    }
    
}
