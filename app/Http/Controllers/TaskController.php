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
    public function index(tasks $tasks,Request $request,$page=1,$sort='id',$how = 'asc',$message = NULL)
    {
        $allTasks = $tasks::orderBy($sort, $how)->paginate(3,'*','',$page);
        $totalpages =  $allTasks->lastPage();
        return view("welcome",['Tasks'=>$allTasks,"totalPages"=>$totalpages,'message'=>$message]);
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
        return $this->index($tasks, $request,1, 'id', 'asc', $mesagge = "Task Added");
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
    public function edit(tasks $tasks)
    {
        //
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
        $done = '';
        if($request->input("done") == 'on'){
            $done = true;
        }else{
            $done = false;
        }
        $tasks::where('id', $request->input("id"))
        ->update(['task' => $request->input("text"),'changed' => true,'done'=>$done]);
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
