<?php

namespace App\Http\Controllers;
use App\Models\tasks;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(tasks $tasks)
    {
        $Tasks = $tasks::all();
        return view('home',['Tasks'=>$Tasks]);
    }
}
