<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('admin.expenses.index', compact('expenses'));
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
            'description' => 'required',
            'amount' => 'required',
            // 'image' => 'required'
        ]);
        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->amount);
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check expense directory if it exists
            if(!Storage::disk('public')->exists('expense'))
            {
                Storage::disk('public')->makeDirectory('expense');
            }
            // resize image for Expense upload
            $expense = Image::make($image)->resize(700,700)->stream();
            Storage::disk('public')->put('expense/'.$imageName,$expense);
        }else{
            $imageName = "default.png";
        }
        $expense = new Expense();
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->image = $imageName;
    
        if($expense->save()){
            $response = [
                'status' =>true,
                'message'=>'Expense Successfully Submited',
            ];
        }else{
            $response = [
                'status' =>false,
                'message'=>'Expense not submitted',
            ];
        }
        // echo json_encode($response); exit; 
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
    public function destroy(Expense $expense)
    {
        if (Storage::disk('public')->exists('expense/'.$expense->image))
        {
            Storage::disk('public')->delete('expense/'.$expense->image);
        }
        $expense->delete();

        // if($expense->delete()){
        //     $response = [
        //         'status' =>true,
        //         'message'=>'Expense Successfully Deleted',
        //     ];
        // }else{
        //     $response = [
        //         'status' =>false,
        //         'message'=>'Expense not Deleted',
        //     ];
        // }
        // // echo json_encode($response); exit; 
        // Toastr::success('Expense Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
