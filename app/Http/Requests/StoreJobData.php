<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobData extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'company_logo' => 'required|string',
            'category' => 'required|string',
            'benefits' => 'required|string',
            'location' => 'required|string',
            'work_condition' => 'required|string',
            'salary' => 'required|string',
            'type' => 'required|string',
        ];
    }
}
