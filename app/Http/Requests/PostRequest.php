<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'txt' => 'required|string',
            'reading_time' => 'integer|min:1|max:60',
            'path_image' => 'image|mimes:png,jpg|max:5120',
        ];
    }

    /**
     * Commento prima dei metodi con due ** prima del metodo
     *  @return array<string; string>
     */
    public function messages()
    {
        return [
            // Messaggi per il campo 'title'
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo non può superare i 255 caratteri',

            // Messaggi per il campo 'txt'
            'txt.required' => 'Il contenuto del post è obbligatorio',
            'txt.string' => 'Il contenuto del post deve essere una stringa',

            // Messaggi per il campo 'reading_time'
            'reading_time.integer' => 'Il tempo di lettura deve essere un numero intero',
            'reading_time.min' => 'Il tempo di lettura deve essere di almeno 1 minuto',
            'reading_time.max' => 'Il tempo di lettura non può superare i 60 minuti',

            //img
            'path_image.required' => 'Il campo immagine è obbligatorio.',
            'path_image.image' => 'Il file caricato deve essere un\'immagine.',
            'path_image.mimes' => 'L\'immagine deve essere un file di tipo: png, jpg.',
            'path_image.max' => 'L\'immagine non può superare i 5 MB di dimensione.',

        ];
    }
}
