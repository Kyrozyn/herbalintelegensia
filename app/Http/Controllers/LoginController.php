<?php


namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\User;
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

    public function index()
    {
        $users = User::all();
        return view('Dashboard.User.index',['title' => 'Pengolahan User','users' => $users]);
    }

    public function usertambahform()
    {
        $roles = Role::all();
        return view('Dashboard.User.tambah',['title' => 'Tambah User','roles'=> $roles]);
    }

    public function usertambahaction(Request $request)
    {
        $data = $request->except('_token');
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->password = \Hash::make($data['password']);
        $user->save();
        $user->roles()->attach($data['role']);
        return redirect('/user')->with('pesan','User berhasil ditambahkan!');
    }

    public function usereditform($id)
    {
        $user = User::whereId($id)->first();
        $roles = Role::all();
        return view('Dashboard.User.edit', ['title' => 'Edit User', 'user' => $user,'roles' => $roles]);
    }

    public function usereditaction(Request $request)
    {
        $data = $request->except('_token');
        $user = User::whereId($request['id'])->first();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->save();
        $user->roles()->detach($user->roles()->first()->id);
        $user->roles()->attach($data['role']);
        return redirect('/user')->with('pesan','User berhasil diedit!');
    }

    public function hapusaction($id)
    {
        \App\Models\user::destroy($id);
        return redirect('/user')->with('pesan','Data berhasil dihapus!');
    }

}
