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
        #body {
            font-size: 10pt;
        }
        #body table, div, p, ol {
            margin-bottom: 20px;

        }

        #body ol {
            list-style-position: inside;
            margin-left: 20px;
        }

        #footer > div{
            margin-left: 9.5cm;
            margin-top: 20pt;
            text-align: center;
        }
        #footer p {
            margin-bottom: 40px;
        }
        .page-break {
            page-break-after: always;
        }
        .page2 table {
            width: 100%;
            border: 2px solid #000;
            border-collapse: collapse;
        }
        .page2 table thead {
            background-color: #eee;
        }

        .page2 table td, .page2 table th {
            padding: 8px 12px;
        }
    </style>
</head>
<body>
    <div class="page page1">
        <div id="header">
            <h4>Yayasan Perguruan Teruna Indonesia</h4>
            <h2>SMK SWASTA TERUNA PADANGSIDIMPUAN</h2>
            <p>Jl. Sutan Soripada Mulia Gg. Masjid Padangsidimpuan</p>
        </div>

        <div id="body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.</p>

            <table>
                <tr>
                    <td style="width: 120px">No. Pendaftaran</td>
                    <td>: <b>{{ $registration_id }}</b></td>
                </tr>
                <tr>
                    <td>Peserta Didik</td>
                    <td>: {{ $student->name_student }}</td>
                </tr>
                <tr>
                    <td>Minat Jurusan</td>
                    <td>: {{ $jurusan }}</td>
                </tr>
            </table>
            <p>
                Dengan ini telah melakukan pendaftaran pada Portal Penerimaan Peserta Didik Baru (PPDB) SMK Swasta Teruna Padangsidimpuan pada {{ $tanggal }}, dan telah
            </p>
            <ol>
                <li>Memahami dan bersedia mematuhi aturan dan tata tertib yang berlaku Di SMK Swasta Teruna Padangsidimpuan</li>
                <li>Melakukan pengisian formulir pendaftaran dengan sebenar benarnya</li>
                <li>Melakukan pembayaran biaya administrasi sekolah ditandai dengan telah melampirkan tanda bukti transfer berupa foto atau scan.</li>
            </ol>
            <div>
                Demikian Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et
            </div>
        </div>

        <div id="footer">
            <div>
                <p>Padangsidimpuan, {{ $tanggal }}</p>
                <p>dto</p>
                <p>Panitia Pendaftaran</p>
            </div>
        </div>
    </div>
    <div class="page-break"></div>
    <div class="page page2">
        <div id="header">
            <h4>Yayasan Perguruaan Teruna Indonesia</h4>
            <h2>SMK SWASTA TERUNA PADANGSIDIMPUAN</h2>
            <p>Jl. Sutan Soripada Mulia Gg. Masjid Padangsidimpuan</p>
        </div>

        <div id="body">
            <table border="2">
                <thead>
                    <tr>
                        <th>No. Pendaftaran</th>
                        <th>No. Rekening</th>
                        <th>Nama Pengirim</th>
                        <th>Nominal Pembayaran</th>
                        <th>Ket.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $registration_id }}</td>
                        <td>{{ $payment->number_payment }}</td>
                        <td>{{ $payment->name_payment }}</td>
                        <td>RP. {{ number_format($biaya, 0, ".", ".") }}</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
