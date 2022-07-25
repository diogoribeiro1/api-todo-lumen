<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $model = Todo::all();

        return response()->json([$model], 200);
    }

    public function store(Request $request)
    {
        $model = Todo::create($request->only(['title' , 'description']));

        return response()->json([$model], 201);
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);

        $todo->update($request->all());

        return response()->json($todo, 200);
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json(['Todo Deleted'], 204);
    }


}
