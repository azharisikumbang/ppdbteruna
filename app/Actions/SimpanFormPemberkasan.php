<?php

namespace App\Actions;

use App\Http\Requests\StorePemberkasanRequest;
use App\Models\File;
use App\Models\Registration;
use App\Models\Student;
use DB;
use Illuminate\Http\UploadedFile;

class SimpanFormPemberkasan
{

    public function handle(
        Registration $registration,
        StorePemberkasanRequest $request
    ) {

        return DB::transaction(function () use ($request, $registration) {
            $data = $request->validated();
            $this->simpanPasPhoto($registration, $request->file('photo'));
            $student = Student::make($data);
            $student->registration()->associate($registration);
            $student->save();

            return $registration;
        });

    }


    private function simpanPasPhoto(
        Registration $registration,
        UploadedFile $photo
    ): File {
        $uploadPath = config('custom.upload_path') . File::PAS_PHOTO;
        $filename = $this->generatePasPhotoFileName($photo);

        $file = File::create([
            'filename' => $filename,
            'filetype' => File::PAS_PHOTO,
            'filepath' => $uploadPath,
            'registration_id' => $registration->id
        ]);

        $photo->move($uploadPath, $file->filename);

        return $file;
    }

    private function generatePasPhotoFileName(UploadedFile $photo): string
    {
        return sprintf(
            "%s-%s.%s",
            File::PAS_PHOTO,
            md5(time()),
            $photo->getClientOriginalExtension()
        );
    }
}