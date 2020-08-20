<?php

namespace App\Http\Controllers\Admin;

use App\Loan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::latest()->where('is_paid', false)->get();
        return view('admin.loans.index', compact('loans'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'id_number' => 'required',
            'phone_no' => 'required',
            'email' => 'email',
            'amount' => 'required',
            // 'image' => 'required'
        ]);
        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->id_number);
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check loan directory if it exists
            if(!Storage::disk('public')->exists('loan'))
            {
                Storage::disk('public')->makeDirectory('loan');
            }
            // resize image for loan upload
            $loan = Image::make($image)->resize(700,700)->stream();
            Storage::disk('public')->put('loan/'.$imageName,$loan);
        }else{
            $imageName = "default.png";
        }
        $loan = new Loan();
        $loan->first_name = $request->first_name;
        $loan->last_name = $request->last_name;
        $loan->id_number = $request->id_number;
        $loan->phone_no = $request->phone_no;
        $loan->email = $request->email;
        $loan->amount = $request->amount;
        $loan->image = $imageName;
    
        if($loan->save()){
            $response = [
                'status' =>true,
                'message'=>'Loan Request Successfully Submited',
            ];
        }else{
            $response = [
                'status' =>false,
                'message'=>'Loan Request not submitted',
            ];
        }
        // echo json_encode($response); exit;  
        // Toastr::success('Loan Request Successfully Submited','Success');
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return view('admin.loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $loan = Loan::findOrFail($id);
       return $loan;
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
        // $this->validate($request,[
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'id_number' => 'required',
        //     'phone_no' => 'required',
        //     'email' => 'email',
        //     'amount' => 'required',
        //     // 'image' => 'required'
        // ]);
        // //get form image
        // $image = $request->file('image');
        // $slug = str_slug($request->id_number);
        // if(isset($image))
        // {
        //     // make unique name for image
        //     $currentDate = Carbon::now()->toDateString();
        //     $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        //     // check loan directory if it exists
        //     if(!Storage::disk('public')->exists('loan'))
        //     {
        //         Storage::disk('public')->makeDirectory('loan');
        //     }
        //     // resize image for loan upload
        //     $loan = Image::make($image)->resize(500,500)->stream();
        //     Storage::disk('public')->put('loan/'.$imageName,$loan);
        // }else{
        //     $imageName = "default.png";
        // }
        
        // $loan->first_name = $request->first_name;
        // $loan->last_name = $request->last_name;
        // $loan->id_number = $request->id_number;
        // $loan->phone_no = $request->phone_no;
        // $loan->email = $request->email;
        // $loan->amount = $request->amount;
        // $loan->image = $imageName;
        // $loan->save();
        // Toastr::success('Loan Request Updated Successfully','Success');
        // return redirect()->back();
    }

       public function pay($id)
        {
            $loan = Loan::findOrFail($id);
            if ($loan->is_paid == false || 2)
            {
                $loan->is_paid = true;
                $loan->save();
                // Toastr::success('Loan Successfully paid', 'Success');
            } else {
                // Toastr::info('Loan is already paid', 'Info');
            }
            return redirect()->back();

            // return response()->json(['message' => 'Loan status updated successfully.']);
       }

       public function default($id)
        {
            $loan = Loan::findOrFail($id);
            if ($loan->is_paid == false || true)
            {
                $loan->is_paid = 2;
                $loan->save();
                // Toastr::success('Loan is defaulted', 'Success');
            } else {
                // Toastr::info('Loan is already on the defaulted list', 'Info');
            }
            return redirect()->back();

            // return response()->json(['message' => 'Project status updated successfully.']);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        if (Storage::disk('public')->exists('loan/'.$loan->image))
        {
            Storage::disk('public')->delete('loan/'.$loan->image);
        }
        $loan->delete();

        // if($loan->delete()){
        //     $response = [
        //         'status' =>true,
        //         'message'=>'Loan Successfully Deleted',
        //     ];
        // }else{
        //     $response = [
        //         'status' =>false,
        //         'message'=>'Loan not Deleted',
        //     ];
        // }
        // // echo json_encode($response); exit; 
        // Toastr::success('Loan Successfully Deleted', 'Success');
        return redirect()->back();
    }

    public function paid()
    {
        $loans = Loan::where('is_paid', true)->get();
        return view('admin.loans.paid', compact('loans'));
    }

    public function defaulted()
    {
        $loans = Loan::where('is_paid', 2)->get();
        return view('admin.loans.defaulted', compact('loans'));
    }
}
