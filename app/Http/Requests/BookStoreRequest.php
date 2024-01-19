<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
        if(request()->isMethod('post')){
            return [
                'titulo' => 'required|string|max:100',
                'autor' => 'required|string|max:100',
                'editorial' => 'required|string|max:100',
                'genero' => 'required|string|max:100',
                'fecha' => 'required|string|max:100',
                'foto' => 'required|string|max:100',
                'pdf' => 'required|string|max:100',
            ];
        }else{
            return [
                'titulo' => 'required|string|max:100',
                'autor' => 'required|string|max:100',
                'editorial' => 'required|string|max:100',
                'genero' => 'required|string|max:100',
                'fecha' => 'required|string|max:100',
                'foto' => 'required|string|max:100',
                'pdf' => 'required|string|max:100',
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     */

    public function messages(): array
    {
        if(request()->isMethod('post')) {
            return [
                'titulo.required' => 'El titulo es requerido',
                'titulo.string' => 'El titulo debe ser una cadena de caracteres',
                'titulo.max' => 'El titulo debe tener un maximo de 100 caracteres',
                'autor.required' => 'El autor es requerido',
                'autor.string' => 'El autor debe ser una cadena de caracteres',
                'autor.max' => 'El autor debe tener un maximo de 100 caracteres',
                'editorial.required' => 'La editorial es requerida',
                'editorial.string' => 'La editorial debe ser una cadena de caracteres',
                'editorial.max' => 'La editorial debe tener un maximo de 100 caracteres',
                'genero.required' => 'El genero es requerido',
                'genero.string' => 'El genero debe ser una cadena de caracteres',
                'genero.max' => 'El genero debe tener un maximo de 100 caracteres',
                'fecha.required' => 'La fecha es requerida',
                'fecha.string' => 'La fecha debe ser una cadena de caracteres',
                'fecha.max' => 'La fecha debe tener un maximo de 100 caracteres',
                'foto.required' => 'La foto es requerida',
                'foto.string' => 'La foto debe ser una cadena de caracteres',
                'foto.max' => 'La foto debe tener un maximo de 100 caracteres',
                'pdf.required' => 'El pdf es requerido',
                'pdf.string' => 'El pdf debe ser una cadena de caracteres',
                'pdf.max' => 'El pdf debe tener un maximo de 100 caracteres',
            ];
            
        } else {
            return [
                'titulo.required' => 'El titulo es requerido',
                'titulo.string' => 'El titulo debe ser una cadena de caracteres',
                'titulo.max' => 'El titulo debe tener un maximo de 100 caracteres',
                'autor.required' => 'El autor es requerido',
                'autor.string' => 'El autor debe ser una cadena de caracteres',
                'autor.max' => 'El autor debe tener un maximo de 100 caracteres',
                'editorial.required' => 'La editorial es requerida',
                'editorial.string' => 'La editorial debe ser una cadena de caracteres',
                'editorial.max' => 'La editorial debe tener un maximo de 100 caracteres',
                'genero.required' => 'El genero es requerido',
                'genero.string' => 'El genero debe ser una cadena de caracteres',
                'genero.max' => 'El genero debe tener un maximo de 100 caracteres',
                'fecha.required' => 'La fecha es requerida',
                'fecha.string' => 'La fecha debe ser una cadena de caracteres',
                'fecha.max' => 'La fecha debe tener un maximo de 100 caracteres',
                'foto.required' => 'La foto es requerida',
                'foto.string' => 'La foto debe ser una cadena de caracteres',
                'foto.max' => 'La foto debe tener un maximo de 100 caracteres',
                'pdf.required' => 'El pdf es requerido',
                'pdf.string' => 'El pdf debe ser una cadena de caracteres',
                'pdf.max' => 'El pdf debe tener un maximo de 100 caracteres',
            ];
        
        }
    }
}
