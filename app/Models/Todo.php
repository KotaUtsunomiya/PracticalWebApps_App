<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'todos';

    // テーブルに関連付けるPrimary Key
    protected $primaryKey = 'id';

    // 操作可能なカラムの指定
    protected $fillable = ['text']; 

    // トップ画面表示用にtodosテーブルから全てのデータを取得
    public function findAllTodos()
    {
        return Todo::all();
    }

    // 登録処理
    public function insertTodo($request)
    {
        // リクエストデータを基にテーブルへ登録
        return $this->create([
            'text' => $request->text,
        ]);
    }    

    // 更新処理
    public function updateTodo($request, $todo)
    {
        $result = $todo->fill([
            'text' => $request->text,
        ])->save();

        return $result;
    }

    // 削除処理
    public function deleteTodoById($id)
    {
        return $this->destroy($id);
    }
}
