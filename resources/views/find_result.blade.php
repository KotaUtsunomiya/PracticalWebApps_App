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
                <p class="title">Todo List</p>
                <div class="auth">
                    <p class="user__info">「{{$user->name}}」でログイン中</p>
                    <form action="{{ route('logout') }}" id="logout" method="post">
                        @csrf
                        <button class="btn btn-logout">ログアウト</button>
                    </form>
                </div>
            </div>
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <dis class="todo">
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
            </dis>
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
                <tbody>
                    @isset($todos)
                    @foreach($todos as $r)
                    <form method="post" action="?">
                        @csrf
                        <tr>
                            <td>{{ $r->created_at }}</td>
                            <td>
                                <input type="text" class="todo-content" value="{{ $r->text }}" name="text">
                            </td>
                            <td>
                                <select name="tag_id" class="tag">
                                    @foreach($tags as $t)
                                        @if($r->tag_id == $t->id)
                                            <option value="{{ $t->id }}" selected>{{ $t->tag }}</option>
                                        @elseif($r->tag_id != $t->id)
                                            <option value="{{ $t->id }}">{{ $t->tag }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" name="_method" value="post" class="btn btn-update" formaction="{{ route('todo.update', ['id'=>$r->id]) }}">更新</button>

                            </td>
                            <td>
                                <button type="submit" name="_method" value="delete" class="btn btn-delete" formaction="{{ route('todo.destroy', ['id'=>$r->id]) }}">削除</button>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                    @endisset
                </tbody>
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