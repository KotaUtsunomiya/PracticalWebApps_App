<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
    <link rel="stylesheet" href="{{ asset('css/reset-stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <p class="title">Todo List</p>
            
            <!-- エラーメッセージエリア -->
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <!-- Todo入力フォーム -->
            <dis class="todo">
                <form action="{{ route('todo.create') }}" method="post" class="flex">
                    @csrf
                    <input type="text" class="todo-add" name="text">
                    <input type="submit" class="btn-add" value="追加">
                </form>
            </dis>

            <!-- Todo表示テーブル -->
            <table>
                <thead>
                    <tr>
                        <th>作成日</th>
                        <th>タスク名</th>
                        <th>更新</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($todos)
                    @foreach($todos as $r)
                    <tr>
                        <!-- 作成日 -->
                        <td>{{ $r->created_at }}</td>

                        <!-- タスク名 -->
                        <td>
                            <form action="{{ route('todo.update', ['id'=>$r->id]) }}" method="post" id="{{ $r->id }}">
                                @csrf
                                <input type="text" class="todo-content" value="{{ $r->text }}" name="text">
                            </form>
                        </td>

                        <!-- 更新ボタン -->
                        <td>
                            <button type="submit" class="btn-update" form="{{ $r->id }}">更新</button>
                        </td>

                        <!-- 削除ボタン -->
                        <td>  
                            <form action="{{ route('todo.destroy', ['id'=>$r->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn-delete">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>