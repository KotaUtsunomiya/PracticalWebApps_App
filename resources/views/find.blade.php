<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
    <link rel="stylesheet" href="{{ asset('css/reset-stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @if (Auth::check())
    <div class="container">
        <div class="card">
            <div class="card__header">
                <p class="title">タスク検索</p>
                <div class="auth">
                    <p class="user__info">「{{$user->name}}」でログイン中</p>
                    <form action="{{ route('logout') }}" id="logout" method="post">
                        @csrf
                        <button class="btn btn-logout">ログアウト</button>
                    </form>
                </div>
            </div>
            <div class="todo">
                <form action="{{ route('todo.search')}}" method="get" class="flex">
                    @csrf
                    <input type="text" class="todo-add" name="text">
                    <select name="tag_id" class="tag">
                        <option disabled="" selected="" value=""></option>
                        @foreach($tags as $t)
                            <option value="{{$t->id}}">{{ $t->tag }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-find">検索</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>作成日</th>
                        <th>タスク名</th>
                        <th>タグ</th>
                        <th>更新</th>
                        <th>削除</th>
                    </tr>
                </thead>
            </table>
            <form action="{{ route('todo.index') }}" method="get" >
                @csrf
                <button type="submit" class="btn btn-back">戻る</button>
            </form>
        </div>
    </div>
    @endif
</body>
</html>