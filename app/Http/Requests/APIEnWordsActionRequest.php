<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class APIEnWordsActionRequest extends FormRequest
{
    // available status name in App\Models\Status
    private array $availableActions = [
        'learn',
        'learned',
        'known',
    ];
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
            'idWord' => ['required', 'integer'],
            'action' => ['required', Rule::in($this->availableActions)],
        ];
    }
}
