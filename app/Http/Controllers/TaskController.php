<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = User::all()->pluck('name', 'id');
        return view('task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validate = Validator::make($request->all(), [
            'description' => 'required|max:255',
            'maximum_execution_date' => 'required|date',
            'user_id' => 'required|numeric'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $task = new Task($request->all());
        $task->maximum_execution_date = date("Y-m-d H:i:s", strtotime($request->maximum_execution_date));
        if ($task->save()) {
            return redirect()->route('home')->with('success', 'successfully created task.');
        } else {
            return redirect()->back()->withInput($request->all())->with('danger', 'The task could not be created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task) {
        $this->authorize('delete', [Task::class, $task]);
        if ($task->delete()) {
            return redirect()->route('home')->with('success', 'Task removed successfully.');
        } else {
            return redirect()->route('home')->with('success', 'Task not deleted correctly.');
        }
    }
}
