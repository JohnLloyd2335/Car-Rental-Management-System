<?php

namespace App\Http\Requests\Admin\Car;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'accessories' => ['required'],
            'plate_number' => ['required', 'max:255'],
            'image_1' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_2' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_3' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_4' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_5' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'description' => ['required', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'image_1.required' => 'The image field is required',
            'image_2.required' => 'The image field is required',
            'image_3.required' => 'The image field is required',
            'image_4.required' => 'The image field is required',
            'image_5.required' => 'The image field is required',
        ];
    }
}
