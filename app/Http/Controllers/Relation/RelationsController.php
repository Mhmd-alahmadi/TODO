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
        return view('task.task',compact('tasks'));
    }

    public function postIndex($task_id){
        $task =Task::find($task_id);

            $task->update([
               'type' => $task->type == 0 ? 1 : 0
            ]);
        return redirect()->back();
}
}
