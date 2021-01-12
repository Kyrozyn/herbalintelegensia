<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function tes()
    {
        request()->user()->hasRole('admin');
        return view('Dashboard.index',['title' => 'Dashboard']);
    }
}
