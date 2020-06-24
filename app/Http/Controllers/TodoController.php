<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function viewHome()
    {
        return view('home');
    }

    // Todo
    public function todoList(Request $request)
    {
        $search = $request->query('search');
        $model = \App\Todo::with('todoItems')->where('user_id', $request->session()->get('user'));
        if ($search != null && $search != "") {
            $model = $model->where("name", "like", "%$search%")->orWhere("description", "like", "%$search%");
        }
        return $model->get();
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
        $model = \App\Todo::with('todoItems')->find($id);
        if ($model == null) {
            return response()->json(array(
                "message" => "There's no todo with id $id"
            ), 400);
        } else {
            return $model;
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
    // End Todo

    // Todo Items
    public function todoItemList(Request $request, $todo_id)
    {
        $search = $request->query('search');
        $model = \App\TodoItem::where('todo_id', $todo_id);
        if ($search != null && $search != "") {
            $model = $model->where("name", "like", "%$search%");
        }
        return $model->get();
    }

    public function todoItemManipulate(Request $request, $id)
    {
        $todo = new \App\TodoItem();
        if ($id != null) {
            $todo = \App\TodoItem::find($id);
        }
        $todo['name'] = $request->input('name');
        $todo['complete'] = ($request->input('complete') != null) ? $request->input('complete') : false;
        $todo['todo_id'] = $request->input('todo_id');
        if ($todo->save()) {
            return response()->json(array(
                "message" => "Success " . ($id != null ? "edit" : "create") . " todo item"
            ), 200);
        } else {
            return response()->json(array(
                "message" => "Failed create todo item"
            ), 500);
        }
    }

    public function todoItemCreate(Request $request)
    {
        $request->validate([
            "name" => "required",
            "todo_id" => "required",
        ]);
        return $this->todoItemManipulate($request, null);
    }

    public function todoItemEdit(Request $request)
    {
        $request->validate([
            "name" => "required",
            "id" => "required",
            "todo_id" => "required",
        ]);
        return $this->todoItemManipulate($request, $request->input('id'));
    }

    public function todoItemView(Request $request, $id)
    {
        $model = \App\TodoItem::find($id);
        if ($model == null) {
            return response()->json(array(
                "message" => "There's no todo item with id $id"
            ), 400);
        } else {
            return $model;
        }
    }

    public function todoItemDelete(Request $request, $id)
    {
        $model = \App\TodoItem::find($id);
        if ($model == null) {
            return response()->json(array(
                "message" => "There's no todo item with id $id"
            ), 400);
        } else {
            if ($model->delete()) {
                return response()->json(array(
                    "message" => "Success delete todo item"
                ), 200);
            } else {
                return response()->json(array(
                    "message" => "Failed delete todo item"
                ), 500);
            }
        }
    }

    public function todoItemMark(Request $request, $id, $complete = true)
    {
        $todo = \App\TodoItem::find($id);
        $todo['complete'] = $complete;
        if ($todo->save()) {
            return response()->json(array(
                "message" => "Success mark " . ($complete ? "complete" : "not complete")
            ), 200);
        } else {
            return response()->json(array(
                "message" => "Failed mark todo item"
            ), 500);
        }
    }

    public function todoItemMarkComplete(Request $request, $id)
    {
        return $this->todoItemMark($request, $id, true);
    }

    public function todoItemMarkNotComplete(Request $request, $id)
    {
        return $this->todoItemMark($request, $id, false);
    }
    // End Todo Items
}
