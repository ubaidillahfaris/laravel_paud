<?php

namespace App\Http\Requests;

use App\Models\Presensi;
use Illuminate\Foundation\Http\FormRequest;

class PresensiStoreRequest extends FormRequest
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
            'tanggal' => ['required','date'],
            'status' => ['required','in:hadir,tidak hadir,ijin,sakit'],
            'siswa_id' => [
                'required',
                'exists:siswas,id',
                function ($attribute, $value, $fail) {
                    $exists = Presensi::where('siswa_id', $value)
                        ->where('kelas_id', $this->kelas_id)
                        ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
                        ->exists();
                    if ($exists) {
                        $fail('Data presensi dengan kombinasi siswa_id, kelas_id, dan tahun ajaran ini sudah ada.');
                    }
                }
            ],
        ];
    }

    public function messages()
    {
        return [
            'siswa_id.required' => 'ID siswa wajib diisi.',
            'siswa_id.exists' => 'Siswa tidak ditemukan.',
            'kelas_id.required' => 'ID kelas wajib diisi.',
            'kelas_id.exists' => 'Kelas tidak ditemukan.',
            'tahun_ajaran_id.required' => 'ID tahun ajaran wajib diisi.',
            'tahun_ajaran_id.exists' => 'Tahun ajaran tidak ditemukan',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal harus valid.',
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status harus berupa salah satu dari: hadir, tidak hadir, ijin, atau sakit.',
        ];
    }
}
