@extends('layouts.app')

@section('content')

    <div class="row justify-content-center flex-wrap" style="width:100%">


        @if (isset($tasks))
            <div>
                <table class="table table-colaps">
                    <tr>
                    @foreach($sorts as $key => $val)
                        <td>
                            <a href=
                               @if (Request::get('how') &&  Request::get('how')=='asc' ||  !Request::get('how'))
                                   "{{ route('mainpage',['order_by' => $key, 'how' => 'desc'])  }}"
                            @elseif (Request::get('how') &&  Request::get('how')=='desc')
                                "{{ route('mainpage',['order_by' => $key, 'how' => 'asc'])  }}"
                            @endif
                            >{{$val}}
                            </a>
                        </td>
                        @endforeach()
                        <td>редактировать</td>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->email }}</td>
                            <td>{{ $task->task }}</td>
                            <td><input type="checkbox" class="change" data-id="{{ $task->id }}"
                                       @if($task->done) checked @endif>
                                <input type="hidden" class="token" value="{{ @csrf_token() }}">
                            </td>
                            <td>@if ($task->changed)отредактировано администратором@endif</td>
                            <td>

                                <button class="btn btn-success"><a href="{{ route('changetask', ['id'=>$task->id]) }}">редактировать</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $tasks->links() }}
                @endif
            </div>

            <h2 align="center">Add Task</h2>
            <form action="{{ route("addtaskhome") }}" method="post" class="col col-lg-12">
                @csrf
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
                <label for="exampleInputPassword1">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
                <label for="exampleInputPassword1">Task</label>
                <input type="text" name="task" class="form-control" id="exampleInputPassword1" placeholder="Task">
                @if ($errors->has('task'))
                    <p class="text-danger">{{ $errors->first('task') }}</p>
                @endif
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @if (Session::has('message'))
                <p class="text-success">{{ Session::get('message') }}</p>
            @endif

    </div>
@endsection
