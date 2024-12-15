<?php

namespace App\Http\Requests\Task;

use App\Enums\StatusTask;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     public function rules()
     {
          $isUpdate = $this->isMethod('post');

          $hasId = $this->route('id');

         return [
             'title' =>  $isUpdate && $hasId ? 'sometimes|string|max:255' : 'required|string|max:255',
             'description' =>  $isUpdate && $hasId ? 'sometimes|string|max:255' : 'required|string|max:255',
             'status' => $isUpdate && $hasId ? ['sometimes', 'in:' . implode(',', StatusTask::availableTypes())] : ['required', 'in:' . implode(',', StatusTask::availableTypes())],
             'category_id' =>  $isUpdate && $hasId ? 'sometimes' : 'required',
             'due_date' => $isUpdate && $hasId ? 'sometimes|date|after_or_equal:' . \Carbon\Carbon::today()->toDateString() : 'required|date|after_or_equal:' . \Carbon\Carbon::today()->toDateString(),
            ];
     }


}
