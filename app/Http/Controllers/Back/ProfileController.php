<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
    $user = Auth::guard('cms')->user();
    return view('cms.profile.edit', compact('user'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|max:30',
            'address' => 'required|string'
        ]);
        $user = Auth::guard('cms')->user();

        $user->update([

            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address

        ]);

        flash('Profile updated')->success();

        return redirect()->route('cms.profile.edit');
    }
}
