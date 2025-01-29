<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CategoryRequestValidation extends FormRequest
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
        // return [
        //     'name' => ['required','max:100'],
        //     'description' => ['required','max:250'],
        // ];
        $id = $this->route('id'); // Ambil ID dari route jika ada

    return [
        'name' => 'required|string|unique:categories_blogs,name,' . $id,
        'description' => 'nullable|string',
    ];
    }

    protected function failedValidation(Validator $validator)
        {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
            ], 400));
        }

}
