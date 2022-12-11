<?php

namespace App\Http\Requests\Game;

use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class RegisterGamePlayerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => ['required', 'string', 'min:3', 'max:42', 'unique:game_players'],
            'phone' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[+]?[0-9]{7,20}$/', 'unique:game_players'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => str_filter_phone($this->phone),
        ]);
    }
}
