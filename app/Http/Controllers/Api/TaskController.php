<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Traits\HttpResponse;
 

class TaskController extends Controller
{
    use HttpResponse;
    public function __construct(public TaskService $taskService){}

    public function index()
    {
        /**
         * status
         *  1 => pending,
         *  2 => completed,
         */
        $status = request()->input('status');
        if ($status) {
            $data = $this->taskService->searchByStatus($status);
            return $this->okResponse(TaskResource::collection($data));
        }

        $data = $this->taskService->index();
        return $this->paginatedResponse($data, TaskResource::class);
    }


    public function store(TaskRequest $request)
    {
        $data = $this->taskService->store($request->validated());

        return $this->okResponse(new TaskResource($data));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->taskService->show($id);

        return $this->okResponse(new TaskResource($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $data = $this->taskService->update($id, $request->validated());

        return $this->okResponse(new TaskResource($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->taskService->destroy($id);

        return $this->okResponse(message: 'deleted Done');
    }

    public function restore($id)
    {
        $this->taskService->restore($id);
        return $this->okResponse(message: 'restore Done');
    }

    public function forceDelete($id)
    {
        $this->taskService->forceDelete($id);
        return $this->okResponse(message: 'forceDelete Done');
    }
}
