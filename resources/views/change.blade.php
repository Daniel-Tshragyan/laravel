<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<h2 align="center">Change Task</h2>
<form action="{{ route('changetekst') }}" method="post" class="col col-lg-12">
    @csrf
    <input type="hidden" name="id" value="{{ $task->id }}">
    <label for="exampleInputPassword1">текст задачи</label>
    <textarea name="task" id="exampleInputPassword1" rows="4" class="form-control" cols="50">
            {{ $task->task }}
        </textarea>
    @if ($errors->has('task'))
        <p class="text-danger">{{ $errors->first('task') }}</p>
    @endif
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>
