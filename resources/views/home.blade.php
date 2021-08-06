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
            <td>выполнено</td>
            <td>редактировать </td>
        </tr>
        @foreach($Tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->email }}</td>
                <td>{{ $task->task }}</td>
                <td><input type="checkbox" class="change" data-id="{{ $task->id }}"  @if($task->done) checked @endif>
                    <input type="hidden" class="token" value="{{ @csrf_token() }}">
                </td>
                <td>
                    <form action="/change" method="post">
                        @method('PUT')
                        @csrf
                        <input type="text" name="text">
                        <input type="hidden" name="id" value="{{$task->id}}">
                        <button class="btn btn-success" type="submit">редактировать</button>
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
