<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login() {
            if(Auth::check()) {
                return redirect('admin/dashboard');

            }elseif(Auth::guard('employee')->check()) {
                return redirect('employee/dashboard');
            }

        return view('backend.auth.login');
    }

    
    public function authLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:20',
        ]);

        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('admin/dashboard');

        }else if(Auth::guard("employee")->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('employee/dashboard');

        }else {
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }

        
    }

    public function logout() {
        if(Auth::check()) {
            Auth::logout();
            return redirect(url('/'));

        }elseif(Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
            return redirect(url('/'));
        }
     
    }
}
