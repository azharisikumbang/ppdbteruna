<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Student;
use App\Models\File;
use App\Models\ParentStudent;
use App\Models\Score;

class UpdateController extends Controller
{

    public function updateDataDiri(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nik_siswa' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'orangtua' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'pos' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'handphone' => 'required'
        ], [
            'required' => 'Kolom :attribute masih kosong!'
        ]);

        if (!$validate->fails()) {

            $update = Student::where('registration_id', $request->regid)->update([
                'name_student' => $request->nama_depan,
                'birthplace_student' => $request->tempat_lahir,
                'birthdate_student' => $request->tanggal_lahir,
                'address_student' => $request->alamat,
                'phone_student' => $request->handphone,
                'status_student' => $request->status,
                'parent_student' => $request->orangtua,
                'agama_student' => $request->agama,
                'gender_student' => $request->jenis_kelamin,
                'nik_student' => substr($request->nik_siswa, 0, 16),
                'desa_student' => $request->desa,
                'kecamatan_student' => $request->kecamatan,
                'kota_student' => $request->kota,
                'provinsi_student' => $request->provinsi,
                'pos_student' => $request->pos,
                'child_order_student' => $request->child_order,
                'siblings_student' => $request->siblings,
                'blood_student' => $request->blood,
                'transport_student' => $request->transport,
                'distance_student' => $request->distance,
                'accommodation_student' => $request->accommodation,
                'home_student' => $request->home,
                'rt_rw_student' => $request->rt . "/" . $request->rw,
            ]);

            if ($update) {
                return redirect('admin/detail/' . $request->regid);
            }

        }

        return redirect('admin/perbaharui/biodata/' . $request->regid);
    }

    public function updateDataAyah(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_ayah' => 'required',
            'tempat_lahir_ayah' => 'required',
            'tanggal_lahir_ayah' => 'required',
            'alamat_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'agama_ayah' => 'required',
            'phone_ayah' => 'required',
            'pendidikan_ayah' => 'required',
        ], [
            'required' => 'Kolom :attribute masih kosong!'
        ]);

        if (!$validate->fails()) {

            $update = ParentStudent::where('registration_id', $request->regid)->update([
                'nama_ayah' => $request->nama_ayah,
                'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
                'alamat_ayah' => $request->alamat_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'agama_ayah' => $request->agama_ayah,
                'phone_ayah' => $request->phone_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
            ]);

            if ($update) {
                return redirect('admin/detail/' . $request->regid);
            }

        }

        return redirect('admin/perbaharui/ayah/' . $request->regid);
    }

    public function updateDataIbu(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_ibu' => 'required',
            'tempat_lahir_ibu' => 'required',
            'tanggal_lahir_ibu' => 'required',
            'alamat_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'agama_ibu' => 'required',
            'phone_ibu' => 'required',
            'pendidikan_ibu' => 'required',
        ], [
            'required' => 'Kolom :attribute masih kosong!'
        ]);

        if (!$validate->fails()) {

            $update = ParentStudent::where('registration_id', $request->regid)->update([
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
                'alamat_ibu' => $request->alamat_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'agama_ibu' => $request->agama_ibu,
                'phone_ibu' => $request->phone_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
            ]);

            if ($update) {
                return redirect('admin/detail/' . $request->regid);
            }

        }

        return redirect('admin/perbaharui/ibu/' . $request->regid);
    }

    public function updateDataWali(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_wali' => 'required',
            'tempat_lahir_wali' => 'required',
            'tanggal_lahir_wali' => 'required',
            'alamat_wali' => 'required',
            'penghasilan_wali' => 'required',
            'pekerjaan_wali' => 'required',
            'agama_wali' => 'required',
            'phone_wali' => 'required',
            'pendidikan_wali' => 'required',
        ], [
            'required' => 'Kolom :attribute masih kosong!'
        ]);

        if (!$validate->fails()) {

            $update = ParentStudent::where('registration_id', $request->regid)->update([
                'nama_wali' => $request->nama_wali,
                'tempat_lahir_wali' => $request->tempat_lahir_wali,
                'tanggal_lahir_wali' => $request->tanggal_lahir_wali,
                'alamat_wali' => $request->alamat_wali,
                'penghasilan_wali' => $request->penghasilan_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'agama_wali' => $request->agama_wali,
                'phone_wali' => $request->phone_wali,
                'pendidikan_wali' => $request->pendidikan_wali,
            ]);

            if ($update) {
                return redirect('admin/detail/' . $request->regid);
            }

        }

        return redirect('admin/perbaharui/wali/' . $request->regid);
    }

    public function updateDataSekolah(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'jurusan' => 'required',
            'nisn' => 'required',
            'sekolah_asal' => 'required',
            'no_peserta_un' => 'required',
            'nomor_ijazah' => 'required',
            'tanggal_ijazah' => 'required',
            'nomor_skhun' => 'required',
            'tanggal_skhun' => 'required',
            'nilai_mtk' => 'required|numeric|between:0,100.00',
            'nilai_bindo' => 'required|numeric|between:0,100.00',
            'nilai_binggris' => 'required|numeric|between:0,100.00',
            'nilai_ipa' => 'required|numeric|between:0,100.00',
            'nilai_total' => 'required|numeric|between:0,400.00',
            'nilai_ratarata' => 'required|numeric|between:0,100.00',
        ], [
            'required' => 'Kolom :attribute masih kosong!'
        ]);

        if (!$validate->fails()) {

            $update = Score::where('registration_id', $request->regid)->update([
                'school_score' => $request->sekolah_asal,
                'nisn_score' => substr($request->nisn, 0, 10),
                'mtk_score' => $request->nilai_mtk ?? 0,
                'indo_score' => $request->nilai_bindo ?? 0,
                'inggris_score' => $request->nilai_binggris ?? 0,
                'ipa_score' => $request->nilai_ipa ?? 0,
                'no_peserta_un' => substr($request->no_peserta_un, 0, 16),
                'nomor_ijazah' => $request->nomor_ijazah ?? "-",
                'tanggal_ijazah' => $request->tanggal_ijazah ?? null,
                'nomor_skhun' => $request->nomor_skhun ?? "-",
                'tanggal_skhun' => $request->tanggal_skhun ?? null,
                'rata_rata_score' => $request->nilai_ratarata ?? 0,
                'total_score' => $request->nilai_total ?? 0
            ]);

            if ($update) {
                Student::where('registration_id', $request->regid)
                    ->update(['majoring_student' => $request->jurusan]);
                return redirect('admin/detail/' . $request->regid);
            }

        }

        return redirect('admin/perbaharui/wali/' . $request->regid);
    }

    public function updateDataFile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,gif,webp|max:2048'
        ], [
            'required' => 'Kolom :attribute masih kosong!'
        ]);

        if (!$validate->fails()) {

            switch ($request->type) {
                case 'photo':
                    $prefix = 'F';
                    break;
                case 'ijazah':
                    $prefix = 'IJ';
                    break;
                case 'skhun':
                    $prefix = 'SK';
                    break;

                default:
                    return abort(404);
                    break;
            }

            if ($request->file('file')->isValid()) {
                $filename = $prefix . $request->regid . "_" . time() . "." . $request->file('file')->getClientOriginalExtension();

                $request->file('file')->move(base_path(config('custom.upload_path') . $request->type), $filename);

                File::where([
                    'registration_id' => $request->regid,
                    'type_file' => $request->type
                ])
                ->update([
                    'name_file' => $filename,
                ]);

                return redirect('admin/detail/' . $request->regid);
            }

        }

        return redirect('admin/perbaharui/file/' . $request->type . '/' . $request->regid);
    }
}
