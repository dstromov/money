<?php

namespace App\Http\Requests\Currencies;

use Illuminate\Foundation\Http\FormRequest;

class RenameCurrencyRequest extends FormRequest
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
            'full_name' => 'filled|string|unique:currencies|min:3|max:255',
            'label' => 'filled|string|unique:currencies|alpha:ascii|min:3|max:255',
            'country' => 'filled|string|unique:currencies|min:3|max:255',
        ];
    }
}
