<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Anggota;

class UpdateAnggotaRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $anggota = $this->route('anggota');
        $anggotaId = $anggota instanceof Anggota ? $anggota->id : $anggota;

        return [
            'kode_anggota'   => 'required|string|max:20|unique:anggota,kode_anggota,' . $anggotaId,
            'nama'           => 'required|string|max:100',
            'email'          => 'required|email|max:100|unique:anggota,email,' . $anggotaId,
            'telepon'        => 'required|string|max:15',
            'alamat'         => 'required|string',
            'tanggal_lahir'  => 'required|date|before:today',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'pekerjaan'      => 'nullable|string|max:50',
            'tanggal_daftar' => 'required|date',
            'status'         => 'required|in:Aktif,Nonaktif',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'kode_anggota.required'   => 'Kode anggota wajib diisi.',
            'kode_anggota.unique'     => 'Kode anggota sudah terdaftar.',
            'kode_anggota.max'        => 'Kode anggota maksimal 20 karakter.',
            'nama.required'           => 'Nama lengkap wajib diisi.',
            'nama.max'                => 'Nama lengkap maksimal 100 karakter.',
            'email.required'          => 'Alamat email wajib diisi.',
            'email.email'             => 'Format alamat email tidak valid.',
            'email.unique'            => 'Alamat email sudah terdaftar.',
            'telepon.required'        => 'Nomor telepon wajib diisi.',
            'telepon.max'             => 'Nomor telepon maksimal 15 karakter.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'tanggal_lahir.required'  => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'      => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before'    => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'        => 'Jenis kelamin tidak valid.',
            'tanggal_daftar.required' => 'Tanggal daftar wajib diisi.',
            'status.required'         => 'Status wajib dipilih.',
            'status.in'               => 'Status tidak valid.',
        ];
    }
}
