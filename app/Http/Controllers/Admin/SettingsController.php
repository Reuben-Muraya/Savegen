<?php

namespace App\Http\Controllers\admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required',
            'id_number' => 'required',
            'email' => 'required|email',
            'image' => 'image'
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->first_name);
        $user = User::findOrFail(Auth::id());
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }
            // Delete old image from profile folder
            if (Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }
            $profile = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$profile);
        }else{
            $imageName = $user->image;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_no = $request->phone_no;
        $user->id_number = $request->id_number;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->image = $imageName;
        $user->save();

        if($user->save()){
            $response = [
                'status' =>true,
                'message'=>'Profile Successfully Updated',
            ];
        }else{
            $response = [
                'status' =>false,
                'message'=>'Profile not Updated',
            ];
        }
        // echo json_encode($response); exit;
        // Toastr::success('Profile Successfully Updated','Success');
        // return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword))
        {
            if(!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                // $user->save();
                if($user->save()){
                    $response = [
                        'status' =>true,
                        'message'=>'Password Successfully Updated',
                    ];
                }else{
                    $response = [
                        'status' =>false,
                        'message'=>'Password not Updated',
                    ];
                }
                // Toastr::success('Password Successfully Changed','Success');
                // Auth::logout();
                // return redirect()->back();
            }else{
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Current password does not match.','Error');
            return redirect()->back();
        }

    }
}
