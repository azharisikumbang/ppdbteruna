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
            font-size: 10pt !important;
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
            <img src="{{ base_path(config('custom.images_path') . 'header.png') }}" style="width: 100%;">
        </p>
        <div style="text-align: center; margin-top: 10pt">
            <span style="font-family: Arial, Helvetica, sans-serif;">
                <strong>
                    <span style="font-size: 12pt;">
                    &ldquo;FAKTA INTEGRITAS (SURAT PERNYATAAN) SISWA BARU&rdquo;
                </span>
                </strong>
                <br>
                <strong>
                    <span style="font-size: 11px;">TAHUN PELAJARAN : {{ date("Y", strtotime($data->created_at)) }} / {{ date("Y", strtotime($data->created_at)) + 1 }}
                    </span>
                </strong>
            </span>
         </div>
        <div style="margin-top: 10pt;">
            Yang bertanda tangan dibawah ini:
        </div>
        <table style="width: 100%; margin-top: 10pt; ">
            <tbody>
                <tr>
                    <td style="width: 39.1592%">
                        <div data-empty="true" style="margin-left: 40px;">Nama</div>
                    </td>
                    <td style="width: 60.7657%;">: {{ strtoupper($data['student']->name_student) }}</td>
                </tr>
                <tr>
                    <td style="width: 39.1592%">
                        <div data-empty="true" style="margin-left: 40px;">Tempat Tanggal Lahir</div>
                    </td>
                    <td style="width: 60.7657%;">: {{ $data['student']->birthplace_student . ', ' . tanggal($data['student']->birthdate_student) }}</td>
                </tr>
                <tr>
                    <td style="width: 39.1592%">
                        <div data-empty="true" style="margin-left: 40px;">Agama</div>
                    </td>
                    <td style="width: 60.7657%;">: {{ ucwords($data['student']->agama_student) }}</td>
                </tr>
                <tr>
                    <td style="width: 39.1592%">
                        <div data-empty="true" style="margin-left: 40px;">Orang Tua</div>
                    </td>
                    <td style="width: 60.7657%;">: {{ $data['parent']->nama_ayah }}</td>
                </tr>
                <tr>
                    <td style="width: 39.1592%">
                        <div data-empty="true" style="margin-left: 40px;">No. HP</div>
                    </td>
                    <td style="width: 60.7657%;">:
                        <?php
                            if ($data['parent']->phone_ayah != '') {
                                $phone = $data['parent']->phone_ayah;
                            } elseif($data['parent']->phone_ayah == '' && $data['parent']->phone_ibu != '') {
                                $phone = $data['parent']->phone_ibu;
                            } else {
                                $phone = $data['parent']->phone_wali;
                            }
                        ?>
                        {{ $data['student']->phone_student . ' / ' . $phone  }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 39.1592%">
                        <div data-empty="true" style="margin-left: 40px;">Alamat</div>
                    </td>
                    <td style="width: 60.7657%;">: {{
                        $data['student']->address_student . ', ' .
                        $data['student']->desa_student . ', ' .
                        $data['student']->kecamatan_student . ', ' .
                        $data['student']->kota_student . ', ' .
                        $data['student']->provinsi_student . ', ' .
                        $data['student']->pos_student
                    }}</td>
                </tr>
            </tbody>
        </table>
        <p dir="ltr" style="line-height:1.2;text-align: justify;margin-top:10pt;margin-bottom:0pt;">
            <span style="font-size:10pt">Setelah diterima di kelas <i><u> X </u> (<u>  sepuluh  </u>) - {{ config("custom.data.jurusan." . $data['student']->majoring_student) }} ( {{ $data['student']->majoring_student }} )</i>  berjanji dengan sungguh-sungguh untuk:
            </span>
        </p>
        <div style="line-height:1.2;text-align: justify;margin-top:10pt;margin-bottom:0pt;font-size:10pt !important;">
            <ol style="margin-left: 40px;">
                <li>Mengikuti segala peraturan yang sudah ditetap di sekolah SMK Swasta Teruna Padangsidimpuan</li>
                <li>Hormat dan patuh terhadap orang tua, guru dan staff baik di sekolah dan diluar sekolah</li>
                <li>Melaksankan tugas dengan sebaik baiknya sebagai seorang siswa seperti dalam peraturan yang ditetapkan sekolah.</li>
                <li>Mematuhi tata tertib siswa dan semua peraturan yang berlaku</li>
                <li>Sanggup diberikan sanksi atas pelanggaran yang kami perbuat berupa:
                    <ol type="a" style="list-style-position: inside;">
                        <li>Teguran</li>
                        <li>Peringatan</li>
                        <li>Mengundurkan diri secara sukarela dari sekolah</li>
                        <li>Dikembalikan kepada pihak keluarga, setelah melalui proses penegakan disiplin sekolah tanpa ada unsur paksaan dan tuntutan kepada pihak.</li>
                    </ol>
                </li>
            </ol>
        </div>
        <p dir="ltr" style="line-height:1.2;text-align: justify;margin-top:10pt;margin-bottom:0pt;"><span style="font-size:10pt">Demikian surat pernyataan ini, saya perbuat dengan sebenar benarnya.</span></p>
        <table style="width: 100%; margin-top: 30pt;">
            <tbody>
                <tr>
                    <td style="width: 49.1256%;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Diketahui / Disetujui :<br><strong>Orang Tua / Wali Calon Siswa / i</strong><br><br><br><br><br>( _____________________________)<br>&nbsp; &nbsp; &nbsp; &nbsp;Nama dan Tanda Tangan Jelas<br><br><br></td>
                    <td style="width: 50.7154%; vertical-align: top;">
                        <div data-empty="true" style="text-align: right;">Padangsidimpuan, ____, _______________ {{ date("Y", strtotime($data->created_at)) }}<br><strong>Calon Peserta Didik &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong><br><br></div>
                        <div data-empty="true" style="text-align: right;"><br></div>
                        <div data-empty="true" style="text-align: right;"><br><br>( _____________________________)<br>Nama dan Tanda Tangan Jelas&nbsp; &nbsp; &nbsp; <br><br><span style="font-size: 8pt !important">*dokumen disertai materai</span></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
