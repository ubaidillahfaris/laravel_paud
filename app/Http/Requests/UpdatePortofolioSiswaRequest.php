<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePortofolioSiswaRequest extends FormRequest
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
            'kelas_id' => ['required','exists:kelas,id'],
            'tahun_ajaran_id' => ['required','exists:tahun_pelajarans,id'],
            'judul' => ['required'],
            'foto' => ['required','mimes:jpg,jpeg,png,bmp,tiff'],
            'deskripsi' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'siswa.required' => 'Data siswa wajib diisi',
            'siswa.exists' => 'Data siswa tidak ditemukan',
            'kelas.required' => 'Data kelas wajib diisi',
            'kelas.exists' => 'Data kelas tidak ditemukan',
            'tahun_ajaran_id.required' => 'Data tahun ajaran wajib diisi',
            'tahun_ajaran_id.exists' => 'Data tahun ajaran tidak ditemukan',
            'judul.required' => 'Judul wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'foto.mimes' => 'Foto harus memiliki format jpg, jpeg, png, bmp, tiff',
        ];
    }
}
