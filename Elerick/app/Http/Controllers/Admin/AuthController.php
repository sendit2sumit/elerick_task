<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:8|max:16'
        ]);
        $rememberMe = $request->remember ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $rememberMe)) {

            if (!empty($request->next)) {
                return redirect($request->next);
            }

            if (Auth::user()->isAdmin()) {
                Session::flash('message', 'Welcome To Elerick  ⚡️', 'Log in Successfully');
                return redirect()->route('admin.blogs.index');
            }else{
                Auth::logout();
                session()->flush();
                Session::flash('message', 'Invalid credentials');
                return redirect()->back();
            }

        }
        Session::flash('message', 'Invalid credentials');
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    public function changePassword(Request $request)
    {
        $data = ['tab' => base64_encode('password')];
        $validator = Validator::make($request->all(), [
            'old_password'          => 'required|min:8|max:16',
            'password'              => 'required','min:8','max:16',
            'password_confirmation' => 'required|min:8|max:16',
        ]);
        if ($validator->fails()) {
            return back()->with($data)->withErrors($validator);
        }
        try {
            $user = Auth::user();

            if (Hash::check($request->old_password, $user->password)) {
                $newPassword = Hash::make($request->password);
                $user->update(['password' => $newPassword]);
                Auth::logoutOtherDevices($request->password);
                Session::flash('message', 'Password changed successfully');
                return back()->with($data);
            } else {
                Session::flash('message', 'Old password is incorrect');
                return back()->with($data);
            }
        } catch (\Exception $error) {
                Session::flash('message', 'Somthing went Wrong');
                return back()->with($data);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            session()->flush();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Session::flash('message', 'Logged out successfully');
            return redirect()->route('admin.login.form');
        }
        Session::flash('message', 'Something went wrong');
        return back();
    }
}
