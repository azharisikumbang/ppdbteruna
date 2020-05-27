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

class EditController extends Controller
{
    /*
    editDataDiri
    editDataAyah
    editDataIbu
    editDataWali
    editDataSekolah
    */

    public function editDataDiri(Request $request)
    {
        $data = Registration::with(['student'])
            ->where('id_registration', $request->regid)
            ->first();

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'data' => $data,
            'code_user' => $request->session()->get('code_user'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('admin.edit.biodata', $data);

    }

    public function editDataAyah(Request $request)
    {
        $result = ParentStudent::where('registration_id', $request->regid)
            ->first([
                'registration_id',
                'nama_ayah',
                'tempat_lahir_ayah',
                'tanggal_lahir_ayah',
                'alamat_ayah',
                'penghasilan_ayah',
                'pekerjaan_ayah',
                'agama_ayah',
                'phone_ayah',
                'pendidikan_ayah'
            ]);

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'data' => $result,
            'code_user' => $request->session()->get('code_user'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('admin.edit.ayah', $data);

    }


    public function editDataIbu(Request $request)
    {
        $result = ParentStudent::where('registration_id', $request->regid)
            ->first([
                'registration_id',
                'nama_ibu',
                'tempat_lahir_ibu',
                'tanggal_lahir_ibu',
                'alamat_ibu',
                'penghasilan_ibu',
                'pekerjaan_ibu',
                'agama_ibu',
                'phone_ibu',
                'pendidikan_ibu'
            ]);

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'data' => $result,
            'code_user' => $request->session()->get('code_user'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('admin.edit.ibu', $data);

    }

    public function editDataWali(Request $request)
    {
        $result = ParentStudent::where('registration_id', $request->regid)
            ->first([
                'registration_id',
                'nama_wali',
                'tempat_lahir_wali',
                'tanggal_lahir_wali',
                'alamat_wali',
                'penghasilan_wali',
                'pekerjaan_wali',
                'agama_wali',
                'phone_wali',
                'pendidikan_wali'
            ]);

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'data' => $result,
            'code_user' => $request->session()->get('code_user'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('admin.edit.wali', $data);

    }

    public function editDataSekolah(Request $request)
    {
        $result = Registration::with([
                'student' => function($query) {
                    $query->select(['registration_id', 'majoring_student']);
                },
                 'score'
            ])
            ->where('id_registration', $request->regid)
            ->first();

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'data' => $result,
            'code_user' => $request->session()->get('code_user'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('admin.edit.sekolah', $data);

    }

    public function editDataFile(Request $request)
    {
        switch ($request->type) {
            case 'photo':
                $file_type = 'photo';
                break;
            case 'ijazah':
                $file_type = 'ijazah';
                break;
            case 'skhun':
                $file_type = 'skhun';
                break;

            default:
                return abort(404);
                break;
        }

        $result = File::where([
                'registration_id' => $request->regid,
                'type_file' => $file_type
            ])
            ->first();

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'data' => $result,
            'code_user' => $request->session()->get('code_user'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('admin.edit.file', $data);

    }
}

