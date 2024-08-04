<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostAsesmenFotoBerseriRequest extends FormRequest
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
            'siswa_id' => ['required','exists:siswas,id'],
            'rpph_id' => ['required','exists:rpphs,id'],
            'tahun_ajaran_id' => ['required','exists:tahun_pelajarans,id'],
            'nilai_agama_budi_pekerti' => ['required'],
            'jati_diri' => ['required'],
            'literasi_steam' => ['required'],
            'foto' => ['required','array','min:3'],
            'foto.*.foto' => ['required','mimes:jpeg,jpg,png,gif'],
            'foto.*.deskripsi' => ['nullable'],

        ];
    }
}
