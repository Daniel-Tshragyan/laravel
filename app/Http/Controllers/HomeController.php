<?php

namespace App\Http\Controllers;

use App\Models\Tasks;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function index(Request $request, Tasks $tasks)
    {
        $sorts = ['id' => 'id', 'name' => 'имени пользователя', 'email' => 'email', 'task' => 'текст задачи', 'done' => 'выполнено', 'changed' => 'отредактировано администратором'];
        $order_by = 'id';
        $how = 'asc';
        if ($request->input('order_by')) {
            $order_by = $request->input('order_by');
        }

        if ($request->input('how')) {
            $how = $request->input('how');
        }

        $allTasks = $tasks::orderBy($order_by, $how)->paginate(3);
        $allTasks->withPath("/home?order_by={$order_by}&&how={$how}");
        return view('home', ['tasks' => $allTasks, 'sorts' => $sorts]);
    }

    public function create(Request $request, Tasks $tasks)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'task' => ['required'],
        ]);
        $tasks->name = $request->input('name');
        $tasks->email = $request->input('email');
        $tasks->task = $request->input('task');
        $tasks->save();
        Session::flash('message', 'Task Added');
        return $this->index($request, $tasks);
    }
}
