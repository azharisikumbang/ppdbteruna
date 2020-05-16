<!DOCTYPE html>
<html>
<head>
    <title>Tanda Integrasi Peserta Didik Baru SMKS Teruna Padangsidimpuan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        * {
            margin:0;
            padding:0;
        }
        .page {
            margin: 1.5cm;
        }
        #header {
            border-bottom: 4px solid #000;
            text-align: center;
            padding: 0 0 20px 0;
        }

        body {
            font-size: 10pt;
            line-height: 12pt;
        }

        body table tr td * {
            font-size: 9pt !important;
            padding-bottom: 3pt;
        }

        #body ol {
            list-style-position: inside;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="page page1">
        <p>
            <span style="font-family: Arial, Helvetica, sans-serif;"><img src="{{ base_path(config('custom.images_path') . 'header.png') }}" style="width: 100%;">
            </span>
        </p>
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td colspan="2" style=" vertical-align: top;">
                        <div style="text-align: center;"><span style="font-family: Arial, Helvetica, sans-serif;"><strong><span style="font-size: 18pt;">&ldquo;FORMULIR PENDAFTARAN PESERTA DIDIK BARU&rdquo;</span></strong><span style="font-size: 16px;"><strong><br></strong></span><strong><span style="font-size: 16px;">TAHUN PELAJARAN : {{ date("Y", strtotime($data->created_at)) }} / {{ date("Y", strtotime($data->created_at)) + 1 }}</span></strong></span>
                        </div>
                    </td>
                    <td rowspan="2" style="text-align: right; vertical-align: top;">
                        <span style="font-family: Arial, Helvetica, sans-serif;">
                            @if(isset($data['file'][0]) && $data['file'][0]->name_file != Null)
                                <img src="{{ base_path(config('custom.upload_path') . 'photo/' . $data['file'][0]->name_file) }}" style="width: 3cm; height: 4cm">
                            @else
                                <img src="{{ base_path(config('custom.images_path') . 'pasphoto.png') }}" style="width: 3cm; height: 4cm">
                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 45.03%; vertical-align: top;">
                        <div style="text-align: left;">
                            <span style="font-family: Arial, Helvetica, sans-serif;">
                                <span style="font-size: 12px;">
                                    <strong>Nomor Pendaftaran: {{ $data->id_registration }}</strong>
                                </span>
                                <br>
                                <span style="font-size: 12px;">
                                    <strong>Status : {{ setStatusByFile($data['file']) }}</strong>
                                </span>
                            </span>
                        </div>
                    </td>
                    <td style="width: 54.3969%; vertical-align: top;">
                        <div style="text-align: right; padding-right: 20px"><strong><span style="font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 12px;"><strong>Hari /Tgl. Pendaftaran : {{ date("d / m / Y", strtotime($data->created_at)) }}</strong></span><br></span></strong></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <p><span style="font-family: Arial, Helvetica, sans-serif;"><img src="{{ base_path(config('custom.images_path') . 'jurusan.png') }}" style="width: 100%; margin-top: 10pt"></span></p>
        <table style="width: 100%; margin-top: 10pt">
            <tbody>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">a) Nama Lengkap Calon Siswa/i (sesuai ijazah)</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ strtoupper($data['student']->name_student) }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">b) Jenis Kelamin</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ gender($data['student']->gender_student) }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">c) Nomor Induk Siswa Nasional (NISN)</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['score']->nisn_score }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">d) No. Induk Kependudukan</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->nik_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">e) Tempat / Tanggal Lahir</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->birthplace_student . ', ' . tanggal($data['student']->birthdate_student) }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">f) Agama</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ ucwords($data['student']->agama_student) }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">g) Alamat / Tempat Tinggal Lengkap</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->address_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 40px;">Desa / Kelurahan</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->desa_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 40px;">Kecamatan</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->kecamatan_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 40px;">Kabupaten / Kota</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->kota_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 40px;">RT / RW / Kode Pos</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: <?php
                            $rt_rw = explode('/', $data['student']->rt_rw_student);
                        ?>
                        {{ 'RT ' . rt_rw($rt_rw[0]) . ' / RW ' . rt_rw($rt_rw[1]) . ' / Pos ' . $data['student']->pos_student }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 40px;">Provinsi</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->provinsi_student }} </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 40px;">No. Telp / Handphone</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->phone_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">h) Alat Transfortasi Ke Sekolah</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->transport_student }} KM</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">i) Jarak Tempuh Rumah Ke Sekolah</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ curr($data['student']->distance_student) }} KM</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">j) Jenis Tempat Tinggal</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ ucwords($data['student']->home_student) }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">l) Apakah Penerima KPS/KIP/KKS/PKH</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ ucwords($data['student']->accommodation_student) }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">m) Gologan Darah</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->blood_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">n) Asal Sekolah</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['score']->school_score }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">o) Jumlah Saudara Kandung</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->siblings_student }} Bersaudara</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">p) Anak Ke</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ $data['student']->child_order_student }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%;">
                        <div data-empty="true" style="margin-left: 20px;">q) Yatim / Piatu / Yatim Piatu / Anak Angkat</div>
                    </td>
                    <td style="width: 50.7657%;">
                        <div data-empty="true">: {{ ucfirst($data['student']->parent_student) }}</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="page-break"></div>
    <div class="page page2">
        <p><img src="{{ base_path(config('custom.images_path') . 'datadiri-title.png') }}" style="width: 100%; margin-top: 10pt"></p>
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td colspan="2">
                        <div data-empty="true" style="margin-left: 20px;"><strong>1. Identitas Ayah</strong></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">a) Nama Ayah</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->nama_ayah }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">b) Tempat / Tanggal Lahir Ayah</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->tempat_lahir_ayah . ', ' . tanggal($data['parent']->tanggal_lahir_ayah) }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">c) Alamat Orang Tua</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->alamat_ayah }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">d) No. Telp / Hp. Orang Tua</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->phone_ayah }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">e) Pekerjaan Ayah</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->pekerjaan_ayah }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">f) Penghasilan Ayah Perbulan</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ curr($data['parent']->penghasilan_ayah, 0, 'Rp. ') }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">g) Pendidikan</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->pendidikan_ayah }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;"><br></div>
                    </td>
                    <td style="width: 50.7657%;"><br></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div data-empty="true" style="margin-left: 20px;"><strong>2. Identitas Ibu</strong></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">a) Nama Ibu</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->nama_ibu }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">b) Tempat / Tanggal Lahir Ibu</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->tempat_lahir_ibu . ', ' . tanggal($data['parent']->tanggal_lahir_ibu) }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">c) Alamat Orang Tua</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->alamat_ibu }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">d) No. Telp / Hp. Orang Tua</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->phone_ibu }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">e) Pekerjaan Ibu</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->pekerjaan_ibu }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">f) Penghasilan Ibu Perbulan</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ curr($data['parent']->penghasilan_ibu, 0, 'Rp. ') }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">g) Pendidikan</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['parent']->pendidikan_ibu }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%"><br></td>
                    <td style="width: 50.7657%;"><br></td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;"><strong>Jika Tinggal Kost / Bersama Wali (WAJIB ISI)</strong></div>
                    </td>
                    <td style="width: 50.7657%;"><br></td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">a) Nama Lengkap Wali</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ ($data['parent']->nama_wali != '') ? $data['parent']->nama_wali : '-' }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">b) Tempat / Tanggal Lahir Wali</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ ($data['parent']->nama_wali != '') ? $data['parent']->tempat_lahir_wali . ', ' . tanggal($data['parent']->tanggal_lahir_wali) : '-' }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">c) Alamat Wali</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ ($data['parent']->alamat_wali != '') ? $data['parent']->alamat_wali : '-' }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">d) Pekerjaan Wali</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ ($data['parent']->nama_wali != '') ? $data['parent']->pekerjaan_wali : '-' }}</td>
                </tr>

                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">f) Penghasilan Wali Perbulan</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ ($data['parent']->penghasilan_wali != '') ? curr($data['parent']->penghasilan_wali, 0, 'Rp. ') : '-' }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 40px;">g) Pendidikan</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ ($data['parent']->nama_wali != '') ? $data['parent']->pendidikan_wali : '-' }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%"><br></td>
                    <td style="width: 50.7657%;"><br></td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;">Asal SMP / MTS Sederajat</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['score']->school_score }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;">No. Peserta UN SMP / MTS</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ $data['score']->no_peserta_un }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;">Tanggal / Nomor Ijazah SMP</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ tanggal($data['score']->tanggal_ijazah) }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;">Tanggal / Nomor SKHUN SMP</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ tanggal($data['score']->tanggal_skhun) }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;">Jumlah Nilai SKHUN</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ curr($data['score']->total_score) }}</td>
                </tr>
                <tr>
                    <td style="width: 49.1592%">
                        <div data-empty="true" style="margin-left: 20px;">Rata Rata SKHUN</div>
                    </td>
                    <td style="width: 50.7657%;">: {{ curr($data['score']->rata_rata_score) }}</td>
                </tr>
            </tbody>
        </table>
        <p dir="ltr" style="line-height:1.2;text-align: justify;margin-top:10pt;margin-bottom:0pt;"><span style="font-size:9pt">Setelah mencatatkan diri, dan memenuhi persyaratan sebagai siswa/ i &nbsp;berjanji akan memenuhi semua peraturan dan tata tertib sekolah dan bersedia menerima sanksi apabila melakukan pelanggaran, yang menyangkut dengan peraturan dan tata tertib sekolah.</span></p>
        <table style="width: 100%; margin-top: 30pt">
            <tbody>
                <tr>
                    <td style="width: 49.1256%;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Diketahui / Disetujui :<br><strong>Orang Tua / Wali Calon Siswa / i</strong><br><br><br><br><br>( _____________________________)<br>&nbsp; &nbsp; &nbsp; &nbsp;Nama dan Tanda Tangan Jelas</td>
                    <td style="width: 50.7154%; vertical-align: top;">
                        <div data-empty="true" style="text-align: right;">Padangsidimpuan, ____, ____________, {{ date("Y", strtotime($data->created_at)) }}<br><strong>Calon Peserta Didik &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong><br><br></div>
                        <div data-empty="true" style="text-align: right;"><br></div>
                        <div data-empty="true" style="text-align: right;"><br><br>( _____________________________)<br>Nama dan Tanda Tangan Jelas&nbsp; &nbsp; &nbsp; </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
