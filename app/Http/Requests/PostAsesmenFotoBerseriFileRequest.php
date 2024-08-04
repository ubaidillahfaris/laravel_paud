<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostAsesmenFotoBerseriFileRequest extends FormRequest
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
            'asesmen_foto_id' => ['required','exists:asesmen_foto_berseris,id'],
            'foto' => ['required','image'],
            'deskripsi' => ['nullable'],
        ];
    }
}
