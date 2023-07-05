<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClownRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'rating' =>  'required|between:1,10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Der Name ist ein Pflichtfeld',
            'email.required' => 'Die Email ist ein Pflichtfeld',
            'email.email' => 'Das Email muss eine gültige adresse sein',
            'description.description' => '^Das Feld Description muss ausgefüllt werden',
            'rating.between' => 'Das Rating muss eine Zahl zwischen 1 und 10 sein',
        ];
    }
}
