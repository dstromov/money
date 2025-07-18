<?php

namespace App\Http\Requests\Currencies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCurrencyRequest extends FormRequest
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
            'full_name' => [
                'required',
                Rule::unique('currencies')->withoutTrashed(),
                'min:3',
                'max:255'
            ],
            'label' => [
                'required',
                Rule::unique('currencies')->withoutTrashed(),
                'alpha:ascii',
                'min:3',
                'max:255'
            ],
            'country' => [
                'required',
                Rule::unique('currencies')->withoutTrashed(),
                'min:3',
                'max:255'
            ],
            'rate' => 'numeric|filled|gt:0',
        ];
    }
}
