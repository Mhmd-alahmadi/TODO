<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class TaskController extends Controller
{


    public function __construct()
    {

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
        return redirect()->back()->with(['success' => __('task.messages.success')]);
    }
}
