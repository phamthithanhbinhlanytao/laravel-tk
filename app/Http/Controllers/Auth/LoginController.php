<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRoleEnums;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $login = [
            'email' => $request->log_email,
            'password' => $request->log_password,
        ];

        if(Auth::attempt($login))
        {
            if(auth()->user()->role == UserRoleEnums::User)
            {
                return redirect()->route('shop.index.index');
            }
        }
        else
        {
            return redirect()->back()->with('messagelogin', trans('messages.auth.login_fail'))->withInput();
        }
    }
}
