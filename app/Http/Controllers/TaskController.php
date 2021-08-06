<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,tasks $tasks,$message = NULL)
    {
        $order_by ='id';
        $how = 'asc';
        if ($request->input("order_by")){
            $order_by = $request->input("order_by");
        }

        if($request->input("how")){
            $how = $request->input("how");
        }

        $allTasks = $tasks::orderBy($order_by,$how)->paginate(3);
        $allTasks->withPath("/?order_by={$order_by}&&how={$how}");
        return view("welcome",['Tasks'=>$allTasks,'message'=>$message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,tasks $tasks)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email',],
            'task' =>[ 'required'],
        ]);
        $tasks->name = $request->input("name");
        $tasks->email = $request->input("email");
        $tasks->task = $request->input("task");
        $tasks->save();
        $message = "Task Added";
        return $this->index( $request,$tasks,$message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,tasks $tasks)
    {
        $done = '';
        if ($request->input("done") == 'on') {
            $done = true;
        } else {
            $done = false;
        }
        $tasks::where('id', $request->input("id"))
            ->update(['done'=>$done]);
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tasks $tasks)
    {
        $request->validate([
            'text' => ['required']
        ]);

        $tasks::where('id', $request->input("id"))
        ->update(['task' => $request->input("text"),'changed' => true]);
        return redirect("/home");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(tasks $tasks)
    {
        //
    }
}
