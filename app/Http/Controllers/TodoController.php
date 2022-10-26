<?php

namespace App\Http\Controllers;

use App\models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;


class TodoController extends Controller
{
    public function __construct()
    {
        $this->todo = new Todo();
    }

    // トップ画面
    public function index()
    {
        // モデルで定義したfindAllTodosにより、全データの取り出し
        $todos = $this->todo->findAllTodos(); 

        // view(index.blade.php)にデータを渡す
        return view('index', compact('todos')); 
    }

    // 登録処理
    public function create(ClientRequest $request)
    {
        // モデルで定義したinsertTodoにより、リクエストデータを登録
        $registerTodo = $this->todo->insertTodo($request);

        // todo.indexへリダイレクト
        return redirect()->route('todo.index');
    }

    // 更新処理
    public function update(ClientRequest $request, $id)
    {
        // 指定されたidのレコードを取得
        $todo = Todo::find($id);

        // モデルで定義したupdateTodoにより、指定のレコードのtodoをリクエストデータに更新
        $updateTodo = $this->todo->updateTodo($request, $todo);

        // todo.indexにリダイレクト
        return redirect()->route('todo.index');
    }

    // 削除処理
    public function destroy($id)
    {
        //モデルで定義したdeleteTodoByidにより、指定されたidのレコードを削除
        $deleteTodo = $this->todo->deleteTodoById($id); 

        // todo.indexにリダイレクト
        return redirect()->route('todo.index'); 
    }
}
