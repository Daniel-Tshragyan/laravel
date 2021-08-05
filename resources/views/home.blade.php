@extends('layouts.app')

@section('content')
<div class="container">
    @if($Tasks)

    <table class="table table-colaps">
        <tr>
            <td>id</td>
            <td>имени пользователя</td>
            <td>email</td>
            <td>текста задачи</td>
            <td>редактировать/выполнено</td>
        </tr>
        @foreach($Tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->email }}</td>
                <td>{{ $task->task }}</td>
                <td>
                    <form action="/change" method="post">
                        @method('PUT')
                        @csrf
                        выполнено    <input type="checkbox" name="done"  @if($task->done) checked @endif>
                        <input type="text" name="text">
                        <input type="hidden" name="id" value="{{$task->id}}">
                        <button class="change btn btn-success" type="submit">редактировать</button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>
    @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <h1>{{ $error }}</h1>
            @endforeach
        @endif
</div>
@endsection
