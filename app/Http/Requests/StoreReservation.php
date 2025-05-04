<?php

namespace App\Http\Requests;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservation extends FormRequest
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
            'room_id' => ['required', 'exists:rooms,id'],
            'name' => ['required', 'string', 'min:3', "regex:/^\s*\S+(?:\s+\S+)+\s*$/"],
            'email' => ['required', 'email', 'max:50'],
            'phone' => ['required', 'digits_between:7,15'],
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate' => ['required', 'date', 'after:startDate'],
            'note' => ['nullable'],
            'g-recaptcha-response' => [new ReCaptcha],
        ];
    }

    public function messages(): array
    {
        return [
            'regex' => 'The name must include both first and last name.',
        ];
    }
}
