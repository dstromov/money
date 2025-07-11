<?php

namespace App\Http\Requests\Denominations;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDenominationRequest extends FormRequest
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
            // привязку к currency менять нельзя, только через удаление и заведение новых сущностей
            'id' => 'required|integer|filled|gt:0',
            'name' => 'filled|string|min:3|max:255',
            'type' => 'filled|string|in:Купюра,Монета',
            'ratio' => 'numeric|filled|gt:0',
        ];
    }
}
