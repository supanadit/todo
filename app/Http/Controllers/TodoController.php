<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function viewHome()
    {
        return view('home');
    }

    public function todoList(Request $request)
    {
        return \App\Todo::where('user_id', $request->session()->get('user'))->get();
    }

    public function todoManipulate(Request $request, $id)
    {
        $todo = new \App\Todo();
        if ($id != null) {
            $todo = \App\Todo::find($id);
        }
        $todo['name'] = $request->input('name');
        $todo['description'] = $request->input('description');
        $todo['user_id'] = $request->session()->get('user');
        if ($todo->save()) {
            return response()->json(array(
                "message" => "Success " . ($id != null ? "edit" : "create") . " todo"
            ), 200);
        } else {
            return response()->json(array(
                "message" => "Failed create todo"
            ), 500);
        }
    }

    public function todoCreate(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);
        return $this->todoManipulate($request, null);
    }

    public function todoEdit(Request $request)
    {
        $request->validate([
            "name" => "required",
            "id" => "required"
        ]);
        return $this->todoManipulate($request, $request->input('id'));
    }

    public function todoView(Request $request, $id)
    {
        $model = \App\Todo::find($id);
        if ($model == null) {
            return response()->json(array(
                "message" => "There's no todo with id $id"
            ), 400);
        } else {
            return $model->with('todo_items');
        }
    }

    public function todoDelete(Request $request, $id)
    {
        $model = \App\Todo::find($id);
        if ($model == null) {
            return response()->json(array(
                "message" => "There's no todo with id $id"
            ), 400);
        } else {
            if ($model->delete()) {
                return response()->json(array(
                    "message" => "Success delete todo"
                ), 200);
            } else {
                return response()->json(array(
                    "message" => "Failed delete todo"
                ), 500);
            }
        }
    }
}
