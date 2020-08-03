<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Contribution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ContributionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $contributions = Contribution::all();
        return view('admin.contributions.index', compact('users', 'contributions'));
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
        $this->validate($request,[
            'amount' => 'required',
            'date' => 'required',
            'users' => 'required'
        ]);
        $contribution = new Contribution();
        $contribution->amount = $request->amount;
        $contribution->date = $request->date;
        // dd($request->all());
        // dd($contribution);
        $contribution->save();
        
        $contribution->users()->attach($request->users);
        

        Toastr::success('Contribution Added Successfully','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, Contribution $contribution)
    {
        $this->validate($request,[
            'amount' => 'required',
            'date' => 'required',
            'users' => 'required'
        ]);

        $contribution->amount = $request->amount;
        $contribution->date = $request->date;
        $contribution->save();
        
        $contribution->users()->sync($request->users);
        

        Toastr::success('Contribution Successfully Updated','Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contributions = Contribution::findOrFail($id);
        $contributions->users()->detach();
        
        $contributions->delete();

        Toastr::success('Contribution Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
