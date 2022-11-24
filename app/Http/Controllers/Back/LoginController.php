<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('cms.dashboard.index');
        $this->middleware('guest:cms')->except('logout');
    }

    public function showLoginForm()
    {
        return view('cms.login.show');
    }

    protected function guard()
    {
        return Auth::guard('cms');
    }
}
