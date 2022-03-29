<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function all($user_id)
    {
        $users = User::find($user_id);
        $tasks = $users->tasks;
        return view('task.task', compact('tasks'));
    }


    public function delete($task_id)
    {
     $task = Task::find($task_id);
        if(!$task){
            return redirect()-> back()-> with(['error' =>'task not found']);
        }
       $task -> delete();

        return redirect()->route('task.delete',$task_id)->with(['success'=> ' deleteed sucesfully']);

    }

}
