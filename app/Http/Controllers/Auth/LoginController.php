<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated()
    {
        $user = Auth::user();
        
        if ($user->role->name === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role->name === 'agent') {
            return redirect()->route('personal.index');
        }

        return redirect('/home');
    }
}