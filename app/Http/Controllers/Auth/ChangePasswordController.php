<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('auth.passwords.change');
    }

    public function email()
    {
        return view('auth.email');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'password' =>'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('successMsg', 'Password is changed succesfully!');
        } else {
            return redirect()->back()->with('errorMsg', "Current password is invalid!");
        }
    }

    public function changeEmail(Request $request)
    {
        $this->validate($request, [
            'password' =>'required'
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->password,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->email = $request->email;
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('successMsg', 'Email is changed succesfully!');
        } else {
            return redirect()->back()->with('errorMsg', "Password is invalid!");
        }
    }
}
