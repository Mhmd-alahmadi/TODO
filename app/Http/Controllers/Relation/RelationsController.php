<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class RelationsController extends Controller
{
    public function getTask()
    {
        $users = User::find(auth()->id());

        $tasks = $users->tasks;
        return view('task.task', compact('tasks'));
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


//        $task = $request->all();
//        Task::find($task_id)->update('task');

//        return redirect()->back()->with(['success' => 'deleteed sucesfully']);
        $task = Task::find($request->task_id);
        if (!$task) {
            return redirect()->back()->with(['error' => 'task not updated']);
        }

        //update
        $task->update(['name' => $request->name]);

//        $task ->update($request ->task_name); //way 1 to updaTE ALL
//
        return redirect('/task/user')->with(['success' => 'تم التحديث بنجاح']);
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


}
