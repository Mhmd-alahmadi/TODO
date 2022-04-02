<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class RelationsController extends Controller
{
    public function getTask()
    {
        $users = User::find(auth()->id());

        $tasks = $users->tasks;
        return view('home', compact('tasks'));
    }

    public function postIndex($task_id)
    {
        $task = Task::find($task_id);

        $task->update([
            'type' => $task->type == 0 ? 1 : 0
        ]);
        return redirect()->back();
    }


    public function editTask($task_id)
    {
        $task = Task::find($task_id);
        if (!$task) {
            return redirect()->back();
        }

        $task = Task::select('id', 'name')->find($task_id);

        return view('task.edit', compact('task'));

//    Task::findOrFail($task_id);

    }


    // function to update

    public function updateTask(Request $request, $task_id)
    {


        $task = Task::find($request->task_id);
        if (!$task) {
            return redirect()->back()->with(['error' => 'task not updated']);
        }
        //update
        $task->update(['name' => $request->name]);

        return redirect('/home')->with(['success' => 'تم التحديث بنجاح']);
    }

    public function delete($task_id)
    {
        $task = Task::find($task_id);
        if (!$task) {
            return redirect()->back()->with(['error' => 'task not found']);
        }
        $task->delete();

        return redirect()->back()->with(['success' => 'deleteed sucesfully']);

    }
    public function get(Request  $request) {

        return view('task.view');
    }

    public function create(Request  $request)
    {

        return view('task.create');
    }

    public function store(TaskRequest $request)
    {

        Task::create([
            'name' => $request->name,
            'user_id' => auth()->id()
        ]);
//        return redirect()->back()->with(['success' => __('task.messages.success')]);
        return redirect('home')->with(['success' => 'تم الاضافة بنجاح']);
    }

}
