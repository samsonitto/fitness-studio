<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;


class UserController extends Controller
{
    public function list_all()
    {
        $users = User::All();
        return view('users')->with('users', $users);
    }

    public function show_settings()
    {
        $users = User::All();
        return view('settings');
    }

    public function list_json()
    {
        $users = User::All();
        return $users;
    }

    public function coursejson()
    {
        $classes = Course::All();
        return $classes;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->to('/users')->with('success', 'User ' . $user->name . " has been deleted, don't be so happy about it...");
    }

    public function ban($id)
    {
        $user = User::find($id);
        $user->status = 'BANNED';
        $user->save();
        return redirect()->to('/users')->with('success', 'User ' . $user->name . " has been banned, don't be so happy about it...");
    }

    public function unban($id)
    {
        $user = User::find($id);
        $user->status = null;
        $user->save();
        return redirect()->to('/users')->with('success', 'User ' . $user->name . " has been unbanned, time to celebrate!");
    }

    public function make_master($id)
    {
        $user = User::find($id);
        $user->group = 'master';
        $user->save();
        return redirect()->to('/users')->with('success', 'User ' . $user->name . " has been made master, all hail the King!");
    }

    public function make_admin($id)
    {
        $user = User::find($id);
        $user->group = 'admin';
        $user->save();
        return redirect()->to('/users')->with('success', 'User ' . $user->name . " has been made admin, might need to start paying one more person...");
    }

    public function unmaster($id)
    {
        $user = User::find($id);
        $user->group = null;
        $user->save();
        return redirect()->to('/users')->with('success', 'User ' . $user->name . " has been downgraded to mortal, sad day...");
    }

    public function unadmin($id)
    {
        $user = User::find($id);
        $user->group = null;
        $user->save();
        return redirect()->to('/users')->with('success', 'User ' . $user->name . " has been downgraded to regular person, payroll is getting smaller!");
    }
}