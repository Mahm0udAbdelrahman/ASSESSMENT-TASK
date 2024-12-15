<?php

namespace App\Services;

 use App\Models\Task;

class TaskService
{

    public function __construct(public Task $model){}

        public function searchByStatus($status)
        {
            return $this->model->where('status', 'like', "%$status%")->get();
        }

        public function index()
        {
            return $this->model->withTrashed()->paginate();
        }


    public function store(array $data)
    {
        $task = $this->model->create($data);
        return $task;
    }

    public function show($id)
    {
        $task = $this->model->findOrFail($id);
        return $task;
    }

    public function update($id , array $data)
    {

        $task = $this->show($id);
        $task->update($data);
        return $task;
    }

    public function destroy(string $id)
    {
        $task = $this->model->withTrashed()->findOrFail($id);
        $task->delete();

    }
    public function restore($id)
    {
        $task = $this->model->withTrashed()->findOrFail($id);
        $task->restore();

    }
    public function forceDelete($id)
    {
        $task = $this->model->withTrashed()->findOrFail($id);
        $task->forceDelete();
    }


}
