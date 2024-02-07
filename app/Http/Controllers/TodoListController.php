<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = task::select('id', 'name', 'status')->get();

        // tasks連想配列の全statusが1であることを確認するための条件
        $i = 0;
        $statusCount = 0;
        while ($i < count($tasks)) {
            if ($tasks[$i]->status == 1) {
                $statusCount++;
            }
            $i++;
        }

        return view('tasks.index', compact('tasks', 'i', 'statusCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tasks',
        ],
        [
            'name.required' => 'タスクを入力してください',
            'name.unique' => 'そのタスクはすでに登録されています',
        ]);

        task::create([
            'name' => $request->name,
        ]);

        return to_route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editTask = task::find($id);
        $tasks = task::select('id', 'name', 'status')->get();

        return view('tasks.edit', compact('editTask', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:tasks',
        ],
        [
            'name.required' => 'タスクを入力してください',
            'name.unique' => 'そのタスクはすでに登録されています',
        ]);

        $editTask = task::find($id);

        $editTask->name = $request->name;
        $editTask->save();

        return to_route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editTask = task::find($id);
        $editTask->delete();

        return to_route('tasks.index');
    }

    /**
     * 完了->未完了, 未完了->完了ボタン
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completion($id)
    {
        $task = task::find($id);
        if ($task->status == 0) {
            $task->status = 1;
        } elseif ($task->status == 1) {
            $task->status = 0;
        }
        $task->save();

        return to_route('tasks.index');
    }
}
