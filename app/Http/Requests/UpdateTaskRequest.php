<?php

namespace App\Http\Requests;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title'       => 'string',
            'description' => 'string',
            'priority'    => 'in:' . TaskPriorityEnum::getAllValuesAsString(),
            'due_date'    => 'date',
            'type'        => 'string|in:' . TaskTypeEnum::getAllValuesAsString(),
            'order'       => 'integer',
            'column_id'   => 'integer|exists:columns,id',
            'assignee_id' => 'integer|exists:users,id',
            'label'       => 'prohibited',
        ];
    }
}
