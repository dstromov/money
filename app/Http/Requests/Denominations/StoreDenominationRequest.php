<?php

namespace App\Http\Requests\Denominations;

use Illuminate\Foundation\Http\FormRequest;

class StoreDenominationRequest extends FormRequest
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
            'name' => 'required|filled|string|min:3|max:255',            
            'type' => 'required|filled|string|in:Купюра,Монета',
            'ratio' => 'required|filled|gt:0',
        ];
    }
}
