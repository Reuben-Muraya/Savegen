<?php

namespace App\Http\Controllers\admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
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
            'username' => 'required',
            'email' => 'required|email',
            'image' => 'image'
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->username);
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
        $user->username = $request->username;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->image = $imageName;
        $user->save();
        Toastr::success('Profile Successfully Updated','Success');
        return redirect()->back();
    }
}
