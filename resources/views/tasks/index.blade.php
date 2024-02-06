<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @vite('resources/js/app.js')
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
                <div class="task @if($task->status == 1)is-completion @endif">
                    <div class="task-name">{{ $task->name }}</div>
                    <div class="task-status @if($task->status == 1)is-completion @endif">
                        <a href="{{route('tasks.completion', ['task' => $task->id])}}">
                            @if ($task->status == 0)
                            完了
                            @elseif ($task->status == 1)
                            未完了
                            @endif
                        </a>
                    </div>
                    <div class="task-edit @if($task->status == 1)is-completion @endif"><a href="{{route('tasks.edit', ['task' => $task->id])}}">編集</a></div>
                    <div class="task-delete @if($task->status == 1)is-completion @endif"><a href="{{route('tasks.destroy', ['task' => $task->id])}}">削除</a></div>
                </div><!-- /.task -->
                @endforeach
            </div>
        </form>
    </div>

    {{-- js 使用しない場合は削除OK --}}
    <script type="module" src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
