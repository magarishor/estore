<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function edit(){
        return view('cms.password.edit');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request){
        $request->validate([
           'old_password' => 'required|current_password:cms',
           'new_password' => 'required|confirmed'
        ], [
            'old_password.current_password' => 'The old password is incorrect.'
        ]);

        $user = Auth::guard('cms')->user();
        $user->update([
           'password' => $request->new_password,
        ]);

        flash('Password updated')->success();

        return redirect()->route('cms.password.update');
    }
}
