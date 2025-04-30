<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreDataSekolahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role == User::ROLE_SISWA;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kode_jurusan' => ['required'],
            'jurusan_diambil' => ['required'],
            'sekolah_asal' => ['required'],
            'nisn_sekolah_asal' => ['required'],
            'disable_input_sekolah' => ['present'],
            'no_peserta_un' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nomor_ijazah' => ['required_if:disable_input_sekolah,"pending_document"'],
            'tanggal_ijazah' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nomor_skhun' => ['required_if:disable_input_sekolah,"pending_document"'],
            'tanggal_skhun' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nilai_mtk' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nilai_bindo' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nilai_binggris' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nilai_ipa' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nilai_total' => ['required_if:disable_input_sekolah,"pending_document"'],
            'nilai_ratarata' => ['required_if:disable_input_sekolah,"pending_document"'],
            'file_ijazah' => ['nullable', 'required_if:disable_input_sekolah,"pending_document"', 'file', 'mimes:pdf'],
            'file_skhun' => ['nullable', 'required_if:disable_input_sekolah,"pending_document"', 'file', 'mimes:pdf'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute harus diisi.',
            'mimes' => 'Kolom :attribute harus berupa gambar dengan format: :values.',
            'file' => 'Kolom :attribute harus berupa gambar dengan format: PDF.',
            'required_if' => 'Kolom :attribute harus diisi.',
        ];
    }
}
