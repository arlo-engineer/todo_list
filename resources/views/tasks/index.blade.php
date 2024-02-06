<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>ToDo List</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('tasks.store') }}">
            <div class="form">
                @csrf
                <input type="text" name="name" class="form-TaskName" value="{{ old('name') }}">
                <button class="form-button">タスクを追加</button>
            </div>

            @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            @endif

            <div class="tasks">
                @foreach ($tasks as $task)
                <div class="task">
                    <div class="task-name">{{ $task->name }}</div>
                    <div class="task-status">
                        <a href="#">
                            @if ($task->status == 0)
                            完了
                            @elseif ($task->status == 1)
                            未完了
                            @endif
                        </a>
                    </div>
                    <div class="task-edit"><a href="{{route('tasks.edit', ['task' => $task->id])}}">編集</a></div>
                    <div class="task-delete"><a href="{{route('tasks.destroy', ['task' => $task->id])}}">削除</a></div>
                </div><!-- /.task -->
                @endforeach
            </div>
        </form>
    </div>
</body>
</html>
