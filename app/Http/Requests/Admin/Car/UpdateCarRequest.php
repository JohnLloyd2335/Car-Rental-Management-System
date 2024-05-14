<?php

namespace App\Http\Requests\Admin\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
            'category' => ['required'],
            'brand' => ['required'],
            'model' => ['required', 'max:255'],
            'year' => ['required', 'digits:4', 'max:4'],
            'price_per_day' => ['required'],
            'plate_number' => ['required', 'max:255'],
            'description' => ['required', 'max:255']
        ];
    }
}
