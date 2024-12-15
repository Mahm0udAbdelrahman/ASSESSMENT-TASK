<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Models\Category;
use App\Services\TaskService;


class TaskController extends Controller
{
    public function __construct(public TaskService $taskService){}
        public function index()
        {

          $tasks = $this->taskService->index();
          return view('admin.dashboard.tasks.index' , compact('tasks'));
        }


        public function create()
        {
            $categories = Category::all();
            return view('admin.dashboard.tasks.create' , compact('categories'));
        }


        public function store(TaskRequest $request)
        {
         $this->taskService->store($request->validated());
          return redirect()->route('task.index');

        }


        public function show(string $id)
        {
            $task =  $this->taskService->show($id);
            return view('admin.dashboard.tasks.show',compact('task'));
        }


        public function edit(string $id)
        {
            $task =  $this->taskService->show($id);
            $categories = Category::all();
            return view('admin.dashboard.tasks.edit',compact('task','categories'));
        }

        public function update(TaskRequest $request, string $id)
        {
            $task =  $this->taskService->update($id ,$request->validated());
            return redirect()->route('task.index');
        }


        public function destroy($id)
        {
          $this->taskService->destroy($id);
            return redirect()->route('task.index');
        }
        public function restore($id)
        {
              $this->taskService->restore($id);
            return redirect()->route('task.index');
        }

        public function forceDelete($id)
        {
            $this->taskService->forceDelete($id);
            return redirect()->route('task.index');
        }
}
