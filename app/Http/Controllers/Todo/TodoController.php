<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $model = Todo::paginate();

        return response()->json($model);
    }

    public function store(Request $request)
    {
        $model = Todo::create($request->only(['title' , 'description']));

        return response()->json($model, 201);
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        if (!$todo)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }

        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);

        if (!$todo)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $todo->update($request->all());

        return response()->json($todo, 200);
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (!$todo)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $todo->delete();

        return response()->json(['Todo Deleted'], 204);
    }

    public function doneTodo(Request $request,$id)
    {
        $todo = Todo::find($id);

        if (!$todo)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        if ($todo['done'] == 0)
        {
            $todo->done();
        }else{
            $todo->undone();
        }

        return response()->json($todo);
    }


}
