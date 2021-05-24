<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
			'position' => ['required', 'string', 'max:255'],
			'department_id' => ['required', 'integer', 'exists:departments,id'],
            'phone' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\d()+-]+$/',
            ]
        ];
    }
}
