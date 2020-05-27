<?php
return [
    'data' => [
        'jurusan' => [
            'Ak' => 'Akuntansi',
            'TKBB' => 'Teknik Konstruksi Batu dan Beton',
            'TKJ' => 'Teknik Komputer Dan Jaringan',
            'TRPL' => 'Teknik Rekayasa Perangkat Lunak',
            'TSM' => 'Teknik Sepeda Motor',
            'TKR' => 'Teknik Kendaraan Ringan',
            'TPM' => 'Teknik Permesinan',
            'TAV' => 'Teknik Audio Video'
        ],
        'biaya' => [
            'Ak' => 100000,
            'TKBB' => 200000,
            'TKJ' => 300000,
            'TRPL' => 400000,
            'TSM' => 500000,
            'TKR' => 600000,
            'TPM' => 700000,
            'TAV' => 800000
        ]
    ],
    'provinsi' => [ ['name' => 'Aceh', 'iso_code' => 'AC', ], ['name' => 'Bali', 'iso_code' => 'BA', ], ['name' => 'Banten', 'iso_code' => 'BT', ], ['name' => 'Bengkulu', 'iso_code' => 'BE', ], ['name' => 'DKI Jakarta', 'iso_code' => 'JK', ], ['name' => 'Gorontalo', 'iso_code' => 'GO', ], ['name' => 'Jambi', 'iso_code' => 'JA', ], ['name' => 'Jawa Barat', 'iso_code' => 'JB', ], ['name' => 'Jawa Tengah', 'iso_code' => 'JT', ], ['name' => 'Jawa Timur', 'iso_code' => 'JI', ], ['name' => 'Kalimantan Barat', 'iso_code' => 'KB', ], ['name' => 'Kalimantan Selatan', 'iso_code' => 'KS', ], ['name' => 'Kalimantan Tengah', 'iso_code' => 'KT', ], ['name' => 'Kalimantan Timur', 'iso_code' => 'KI', ], ['name' => 'Kalimantan Utara', 'iso_code' => 'KU', ], ['name' => 'Kepulauan Bangka Belitung', 'iso_code' => 'BB', ], ['name' => 'Kepulauan Riau', 'iso_code' => 'KR', ], ['name' => 'Lampung', 'iso_code' => 'LA', ], ['name' => 'Maluku', 'iso_code' => 'MA', ], ['name' => 'Maluku Utara', 'iso_code' => 'MU', ], ['name' => 'Nusa Tenggara Barat', 'iso_code' => 'NB', ], ['name' => 'Nusa Tenggara Timur', 'iso_code' => 'NT', ], ['name' => 'Papua', 'iso_code' => 'PA', ], ['name' => 'Papua Barat', 'iso_code' => 'PB', ], ['name' => 'Riau', 'iso_code' => 'RI', ], ['name' => 'Sulawesi Barat', 'iso_code' => 'SR', ], ['name' => 'Sulawesi Selatan', 'iso_code' => 'SN', ], ['name' => 'Sulawesi Tengah', 'iso_code' => 'ST', ], ['name' => 'Sulawesi Tenggara', 'iso_code' => 'SG', ], ['name' => 'Sulawesi Utara', 'iso_code' => 'SA', ], ['name' => 'Sumatera Barat', 'iso_code' => 'SB', ], ['name' => 'Sumatera Selatan', 'iso_code' => 'SS', ], ['name' => 'Sumatera Utara', 'iso_code' => 'SU', ], ['name' => 'Yogyakarta', 'iso_code' => 'YO', ] ],
    'status_pendaftar' => ['kandung', 'tiri'],
    'orangtua_pendaftar' => ['lengkap', 'yatim', 'piatu', 'yatim piatu'],
    'agama_pendaftar' => ['islam', 'kristen protestan', 'kristen katolik', 'buddha', 'hindu', 'lainnya'],
    'bantuan_pendaftar' => ['KPS', 'KIP', 'KKS', 'PKH', 'lainnya', 'tidak'],
    'home_pendaftar' => ['bersama orang tua', 'bersama saudara', 'kontrak', 'kost', 'lainnya'],
    'home_pendaftar' => ['bersama orang tua', 'bersama saudara', 'kontrak', 'kost', 'lainnya'],
    'pekerjaan_orangtua' => ['petani', 'pedagang', 'wiraswasta', 'buruh', 'PNS', 'TNI / POLRI', 'Pegawai BUMN'],
    'pendidikan_orangtua' => ['Tidak Mempunyai Riwayat Pendidikan', 'SD / Sederajat', 'SLTP / Sederajat', 'SLTA / Sederajat', 'Diploma I/II', 'Akademi / Diploma III / S. Muda', 'Diploma IV / Strata I (S1)', 'Strata II (S2)', 'Strata III (S3)'],
    'bank_payment' => ['Bank Danamon',  'Bank BCA', 'Bank BNI', 'Bank BNI Syariah', 'Bank BRI', 'Bank BTN', 'Bank Muamlat', 'Bank Mandiri', 'Bank Mandiri Syariah', 'Bank Sumut', 'Bank Sumut Syariah', 'Lainnya'],
    'html' => [
        'color' => [
            'tervalidasi' => 'green',
            'pending' => 'gray',
            'menunggu' => 'yellow',
            'gagal' => 'red'
        ]
    ],
    'upload_path' => 'public/files/',
    'images_path' => 'public/images/'
];
