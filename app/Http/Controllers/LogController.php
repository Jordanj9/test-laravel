<?php

namespace App\Http\Controllers;

use App\Mail\LogsNotification;
use App\Models\Log;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
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
    public function create($id) {
        $task = Task::findOrFail($id);
        $this->authorize('create', [Log::class, $task]);
        $logs = $task->logs;
        return view('log.create', compact('task', 'logs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validate = Validator::make($request->all(), [
            'comment' => 'required|string|max:255',
            'task_id' => 'required|numeric',
            'date' => 'required|date'
        ]);
        if ($validate->fails())
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());

        $log = new Log($request->all());
        $log->date = date("Y-m-d H:i:s", strtotime($request->date));
        if ($log->save()) {
            $msg = 'successfully created logs. ';
            $msg .= $this->sendEmail($log);
            return redirect()->route('log.new', $request->task_id)->with('success', $msg);
        } else {
            return redirect()->back()->withInput($request->all())->with('danger', 'The logs could not be created.');
        }
    }

    private function sendEmail($log) {
        try {
            $user = Auth::user();
            Mail::to('jordan_j9@hotmail.com')->send(new LogsNotification($user, $log));
            return 'Email sent';
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Log $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Log $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Log $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Log $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log) {
        if ($log->delete()) {
            return redirect()->route('log.new', $log->task_id)->with('success', 'The record was successfully deleted.');
        } else {
            return redirect()->back()->with('danger', 'The record could not be deleted.');
        }
    }
}
