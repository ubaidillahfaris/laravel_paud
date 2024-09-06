<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostKalenderPendidikanRequest extends FormRequest
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
            'sekolah_id' => ['required','exists:sekolahs,id'],
            'tahun_ajaran_id' => ['required','exists:tahun_pelajarans,id'],
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'start_date' => ['required','date'],
            'end_date' => ['nullable','date'],
        ];
    }

    public function messages()
    {
        return [
            'sekolah_id.required' => 'Id sekolah wajib diisi',
            'sekolah_id.exists' => 'Id sekolah tidak ditemukan',
            'tahun_ajaran_id.required' => 'Id tahun ajaran wajib diisi',
            'tahun_ajaran_id.exists' => 'Id tahun ajaran tidak ditemukan',
            'nama.required' => 'Nama agenda wajib diisi',
            'start_date.required' => 'Tanggal mulai wajib diisi',
            'start_date.date' => 'Format tanggal harus sesuai',
            'end_date.date' => 'Format tanggal harus sesuai',
        ];
    }
}
