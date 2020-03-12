<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use App\User;
use Auth;

class AdminController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1' ])) {
                //Session::put('admin_session', $data['email']);
                return redirect('/admin/dashboard');
            } else {
                return redirect('/admin')->with('flash_message_error', 'Email or password is invalid!');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard()
    {
        // if(Session::has('admin_session')) {
        //     //
        // } else {
        //     return redirect('admin')->with('flash_message_error', 'Please login to gain access!');
        // }
        return view('admin.dashboard');
    }

    public function settings()
    {
        return view('admin.admin_settings');
    }

    // Call from Jquery ----- 
    public function checkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_password'];
        $user_details = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password, $user_details->password)) {
            return "true";
        } else { 
            return "false";
        }        
    }

    public function updatePassword(Request $request)
    {
        if($request->isMethod('post')) {
            $settings_data = $request->all();
            $user_details = User::where('email', Auth::user()->email)->first();
            $current_password = $settings_data['current_password'];
            if(Hash::check($current_password, $user_details->password)) {
                $new_password = bcrypt($settings_data['new_password']);
                User::where('id', '1')->update(['password'=>$new_password]);
                return redirect('/admin/settings')->with('flash_message_success', 'Password Updated Succesfully!!!');
            } else {
                return redirect('/admin/settings')->with('flash_message_error', 'Password Mismatched');
            }
        }
    }


    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logout was successfully!');
    }
}
