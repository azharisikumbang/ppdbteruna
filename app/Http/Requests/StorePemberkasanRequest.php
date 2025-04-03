<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePemberkasanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role == 'student';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nama_lengkap" => ['required'],
            "nik" => ['required'],
            "jenis_kelamin" => ['required', Rule::in(['L', 'P'])],
            "tempat_lahir" => ['required'],
            "tanggal_lahir" => ['required', 'date', 'date_format:Y-m-d'],
            "status_orangtua" => ['required'],
            "status_anak" => ['required'],
            "urutan_dalam_keluarga" => ['required', 'integer', 'min:1'],
            "jumlah_bersaudara" => ['required', 'integer', 'min:0'],
            "agama" => ['required'],
            "golongan_darah" => ['nullable'],
            "nomor_handphone" => ['required'],
            "alamat" => ['required'],
            "rt" => ['required'],
            "rw" => ['required'],
            "desa" => ['required'],
            "kecamatan" => ['required'],
            "kota" => ['required'],
            "provinsi" => ['required'],
            "kode_pos" => ['required'],
            "transportasi" => ['required'],
            "jarak_rumah_sekolah" => ['required', 'integer', 'min:0'],
            "jenis_bantuan_pemerintah" => ['required'],
            "kepemilikan_rumah" => ['required'],
            "photo" => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute harus diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'in' => 'Kolom :attribute hanya bisa diisi: :values .',
            'date' => 'Kolom :attribute harus berformat tanggal.',
            'date_format' => 'Kolom :attribute harus berformat tanggal (Y-m-d).',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'mimes' => 'Kolom :attribute harus berupa gambar dengan format: :values.',
            'photo.max' => 'Kolom :attribute harus berukuran maksimal 2 MB.',
            'photo.uploaded' => 'Kolom :attribute harus berukuran maksimal 2 MB.',
        ];
    }
}
