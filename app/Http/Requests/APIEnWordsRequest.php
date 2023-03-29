<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class APIEnWordsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'offset' => ['required', 'integer'],
            'limit' => ['required','integer'],
            'order' => ['required', Rule::in(['word'])],
            'sort' => ['required', Rule::in(['asc', 'desc'])],
        ];
    }
}
