<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'message' => ['required','string','max:4000'],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Type your question.',
            'message.max'      => 'Keep it under 4000 characters, please.',
        ];
    }
}
