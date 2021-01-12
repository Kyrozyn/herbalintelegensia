<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $cred = $request->only('username','password');
        if(Auth::attempt($cred)){
            $request->session()->regenerate();
            return redirect('dashboard');
        }
        else{
            return back()->withErrors([
                'usernamepassword' => 'Username / Password yang anda masukkan salah'
            ]);
        }
    }

    public function loginpage()
    {
        if(Auth::check()){
            return redirect('/dashboard');
        }
        else{
            return view('User/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
