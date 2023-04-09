<?php

namespace App\Http\Requests;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string',
            'description' => 'string',
            'priority'    => 'required|string|in:' . TaskPriorityEnum::getAllValuesAsString(),
            'due_date'    => 'nullable|date',
            'type'        => 'required|string|in:' . TaskTypeEnum::getAllValuesAsString(),
            'order'       => 'nullable|integer',
            'column_id'   => 'required|integer|exists:columns,id',
            'assignee_id' => 'nullable|integer|exists:users,id',
            'label'       => 'prohibited',
        ];
    }
}
