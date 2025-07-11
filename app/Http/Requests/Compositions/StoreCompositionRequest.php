<?php

namespace App\Http\Requests\Compositions;

use Illuminate\Foundation\Http\FormRequest;


class StoreCompositionRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'denomination_id' => 'required|integer|filled|gt:0',
            'value' => 'required|numeric|filled|gt:0',
        ];
    }
}
