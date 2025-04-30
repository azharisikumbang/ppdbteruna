<?php

namespace Tests\Feature\Formulir;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\File;
use App\Models\Registration;
use App\Models\Student;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SimpanDataSekolahTest extends TestCase
{

    use RefreshDatabase, WithFaker, DatabaseMigrations;

    public function testSeeFormSekolahPage()
    {
        $this->withoutExceptionHandling();

        $siswa = User::create([
            'email' => $this->faker->email(),
            'password' => Hash::make('12345678'),
            'role' => User::ROLE_SISWA
        ]);

        $registration = Registration::create([
            'registration_status' => 'pending',
            'registration_current_step' => Registration::STEP_DATA_SEKOLAH,
            'current_user_id' => $siswa->id,
            'registration_code' => '001'
        ]);

        $this
            ->actingAs($siswa)
            ->get('/siswa/sekolah')
            ->assertOk()
            ->assertSessionDoesntHaveErrors();
    }

    public function testStoreValidDataToFormSekolah()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware(VerifyCsrfToken::class);

        Storage::fake('local');

        // data
        $siswa = User::create([
            'email' => $this->faker->email(),
            'password' => Hash::make('12345678'),
            'role' => User::ROLE_SISWA
        ]);

        $registration = Registration::create([
            'registration_status' => 'pending',
            'registration_current_step' => Registration::STEP_DATA_SEKOLAH,
            'current_user_id' => $siswa->id,
            'registration_code' => '001'
        ]);

        $student = Student::create([
            "nama_lengkap" => 'Alex G',
            "nik" => '123456',
            "jenis_kelamin" => 'L',
            "tempat_lahir" => 'Padangisidimpuan',
            "tanggal_lahir" => '1999-09-08',
            "status_orangtua" => 'Kandung',
            "status_anak" => 'Kandung',
            "urutan_dalam_keluarga" => 1,
            "jumlah_bersaudara" => 2,
            "agama" => 'Islam',
            "golongan_darah" => 'A',
            "nomor_handphone" => '08282828282',
            "alamat" => 'Jl. Ada ada aja',
            "rt" => '002',
            "rw" => '001',
            "desa" => 'Desa Mawar',
            "kecamatan" => 'Padangsidimpuan Utara',
            "kota" => 'Padangsidimpuan',
            "provinsi" => 'Sumatra Utara',
            "kode_pos" => 2024,
            "transportasi" => 'test',
            "jarak_rumah_sekolah" => 1.00,
            "jenis_bantuan_pemerintah" => null,
            "kepemilikan_rumah" => 'Bersama Orang Tua',
            "registration_id" => $registration->id,
        ]);

        $data = [
            'kode_jurusan' => 'Ak',
            'jurusan_diambil' => 'Akuntansi',
            'sekolah_asal' => 'SMPN 2 Padangsidimpuan',
            'nisn_sekolah_asal' => "123456",
            'disable_input_sekolah' => "pending_document",
            'no_peserta_un' => "1234567890",
            'nomor_ijazah' => "ABC-123",
            'tanggal_ijazah' => "2020-02-01",
            'nomor_skhun' => "QWERTY-123",
            'tanggal_skhun' => "2020-02-01",
            'nilai_mtk' => "7.00",
            'nilai_bindo' => "8.00",
            'nilai_binggris' => "9.00",
            'nilai_ipa' => "7.66",
            'nilai_total' => "36.00",
            'nilai_ratarata' => "8.78",
            'file_ijazah' => UploadedFile::fake()->create('ijazah.pdf', 512),
            'file_skhun' => UploadedFile::fake()->create('skhun.pdf', 512)
        ];

        $response = $this
            ->actingAs($siswa)
            ->post('siswa/sekolah', $data);


        $this->assertDatabaseCount('registrations', 1);
        $this->assertDatabaseCount('previous_schools', 1);
        $this->assertDatabaseHas('registrations', [
            'kode_jurusan_diambil' => $data['kode_jurusan'],
            'nama_jurusan_diambil' => $data['jurusan_diambil'],
            'registration_current_step' => 3, // Registration::STEP_DATA_ORANGTUA,
            'current_user_id' => $siswa->id,
            'registration_code' => '001',
            'id' => 1
        ]);
        $this->assertDatabaseHas('previous_schools', [
            'school_name' => 'SMPN 2 Padangsidimpuan',
            'student_id' => 1,
            'certificate_number' => "ABC-123",
            'certificate_date' => "2020-02-01",
            'skhun_number' => "QWERTY-123",
        ]);

        $this->assertDatabaseHas('files', [
            'id' => 1,
            'filetype' => File::IJAZAH,
        ]);

        $this->assertDatabaseHas('files', [
            'id' => 2,
            'filetype' => File::SKHUN,
        ]);

        // cek apakah file terupload
        $ijazah = File::where('id', 1)->first();
        Storage::disk('local')->assertExists('uploaded/ijazah/' . $ijazah->filename);


        $skhun = File::where('id', 2)->first();
        Storage::disk('local')->assertExists('uploaded/skhun/' . $skhun->filename);


        // assert response
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();

    }
}
