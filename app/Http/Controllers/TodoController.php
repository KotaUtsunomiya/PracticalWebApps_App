<?php

namespace App\Http\Controllers;

use App\models\Todo;
use App\models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TodoController extends Controller
{
    protected $todos;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $todos = $request->user()->todos()->get();
        $tags = Tag::all();
        return view('index', compact('user','todos','tags')); 
    }

    public function create(ClientRequest $request)
    {
        $request->user()->todos()->create([
            'text' => $request->text,
            'tag_id' => $request->tag_id,
        ]);
        return redirect()->back();
    }

    public function update(ClientRequest $request, Todo $id)
    {
        $this->authorize('update', $id);
        $id->fill([
            'text' => $request->text,
            'tag_id' => $request->tag_id,
        ])->save();
        return redirect()->back();
    }

    public function destroy(Request $request, Todo $id)
    {
        $this->authorize('destroy', $id);
        $id->delete();
        return redirect()->back();
    }

    public function find(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        return view('find', compact('user','tags')); 
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();
        $todos = DB::table('todos')
            ->where('user_id', $user->id)
            ->where('tag_id', 'LIKE', $request->tag_id)
            ->where('text', 'LIKE', "%{$request->text}%")->get();

        return view('find_result', compact('user','todos','tags')); 
    }


}
