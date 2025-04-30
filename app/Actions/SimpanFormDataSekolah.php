<?php

namespace App\Actions;

use App\Http\Requests\StoreDataSekolahRequest;
use App\Models\File;
use App\Models\PreviousSchool;
use App\Models\Registration;
use DB;
use Illuminate\Http\UploadedFile;

class SimpanFormDataSekolah
{

    public function handle(
        Registration $registration,
        StoreDataSekolahRequest $request
    ) {

        return DB::transaction(function () use ($request, $registration) {
            $data = $request->validated();
            $this->simpanFile($registration, $request->file('file_ijazah'), File::IJAZAH);
            $this->simpanFile($registration, $request->file('file_skhun'), File::SKHUN);

            PreviousSchool::create([
                'school_name' => $data['sekolah_asal'],
                'certificate_number' => $data['nomor_ijazah'],
                'certificate_date' => $data['tanggal_ijazah'],
                'skhun_number' => $data['nomor_skhun'],
                'student_id' => $registration->student->id
            ]);

            $registration->registration_current_step = Registration::STEP_DATA_ORANGTUA;
            $registration->kode_jurusan_diambil = $data['kode_jurusan'];
            $registration->nama_jurusan_diambil = $data['jurusan_diambil'];
            $registration->save();

            return $registration;
        });

    }


    private function simpanFile(
        Registration $registration,
        UploadedFile $uploadedFile,
        string $type
    ): File {
        $uploadPath = config('custom.upload_path') . $type;
        $filename = $this->generateFileName($uploadedFile, $type);

        $file = File::create([
            'filename' => $filename,
            'filetype' => $type,
            'filepath' => $uploadPath,
            'registration_id' => $registration->id
        ]);

        $uploadedFile->storeAs($uploadPath, $file->filename, ['disk' => 'local']);

        return $file;
    }

    private function generateFileName(UploadedFile $file, string $type): string
    {
        return sprintf(
            "%s-%s.%s",
            $type,
            md5(time()),
            $file->getClientOriginalExtension()
        );
    }
}