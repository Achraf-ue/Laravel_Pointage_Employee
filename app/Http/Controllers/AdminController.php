<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function Logout()
    {
        //Auth::logout();
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
    public function Profile_User()
    {
        $Id = Auth::user()->id;
        $User =  DB::table('users')->where('id',$Id)->first();
        return view('admin.Profile',compact('User'));
    }
    public function Update_User(Request $request)
    {
        $Id = Auth::user()->id;
        $user_image = $request->file('user_image');
        $name_gen = hexdec(uniqid());
        $img_ext  = strtolower($user_image->getClientOriginalExtension()); 
        $img_name = $name_gen.'.'.$img_ext;
        $Up_Location = 'Images/User_Profile/';
        $Last_image = $Up_Location.$img_name;
        $user_image->move($Up_Location,$img_name);
        $Data['profile_photo_path'] = $Last_image;
        DB::table('users')->where('id',$Id)->update($Data);
        $User =  DB::table('users')->where('id',$Id)->first();
        return view('admin.Profile',compact('User'));
    }
}
