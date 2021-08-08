<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tasks $tasks)
    {
        $sorts = ['id'=>'id','name'=>'имени пользователя','email'=>'email','task'=>'текст задачи','done'=>'выполнено','changed'=>'отредактировано администратором'];
        $order_by = 'id';
        $how = 'asc';
        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }

        if ($request->input('how')) {
            $how = $request->input('how');
        }

        $allTasks = $tasks::orderBy($order_by, $how)->paginate(3);
        $allTasks->withPath("/?order_by={$order_by}&&how={$how}");
        return view('welcome', ['tasks' => $allTasks,'sorts'=>$sorts]);
    }

    public function getOne(Request $request, $id)
    {
        $task = Tasks::find($id);
        return view('change', ['task' => $task]);
    }

    public function changetekst(Request $request)
    {
        $request->validate([
            'task' => ['required']
        ]);
        $task = Tasks::find($request->input('id'));
        $task->task = $request->input('task');
        $task->changed = true;
        $task->save();
        Session::flash('message', 'Task Cahnged');
        return redirect('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Tasks $tasks)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email',],
            'task' => ['required'],
        ]);
        $tasks->name = $request->input('name');
        $tasks->email = $request->input('email');
        $tasks->task = $request->input('task');
        $tasks->save();
        Session::flash('message', 'Task Added');
        return redirect('mainpage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\tasks $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\tasks $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tasks $tasks)
    {
        $done = '';
        if ($request->input("done") == 'on') {
            $done = true;
        } else {
            $done = false;
        }

        $task = tasks::find($request->input('id'));
        $task->done = $done;
        $task->save();
        return true;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\tasks $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $tasks)
    {
        $request->validate([
            'text' => ['required']
        ]);

        $tasks->task = $request->input('text');
        $tasks->changed = true;
        $tasks->save();
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\tasks $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
