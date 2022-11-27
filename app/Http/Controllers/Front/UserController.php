<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('front.user.index', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $validated = $request->validate([
           'name' => 'required|string',
           'phone' => 'required|max:30',
           'address' => 'required|string'
        ]);

        $user = Auth::user();
        $user->update($validated);
        flash('Profile Updated.')->success();
        return redirect()->route('front.user.index');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed'
        ], [
            'old_password.current_password' => 'The old password is incorrect.'
        ]);

        $user = Auth::user();
        $user->update(['password' => $request->new_password]);
        flash('Password changed.')->success();
        return redirect()->route('front.user.index');

    }
}
