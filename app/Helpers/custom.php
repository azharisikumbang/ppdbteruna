<?php
if (!function_exists('bulanIndo')) {
    function bulanIndo($date)
    {
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return $bulan[$date - 1];

    }
}

if (!function_exists('curr')) {
    function curr($string, $comma = 2, $prefix = null)
    {
        return $prefix . number_format($string, $comma, ',', '.');
    }
}

if (!function_exists('gender')) {
    function gender($string = 'L')
    {
        return (strtoupper($string) == 'L') ? 'Laki - Laki' : 'Perempuan';
    }
}

if (!function_exists('rt_rw')) {
    function rt_rw($string)
    {

        return substr("00" . $string, -3, 3);
    }
}


if (!function_exists('tanggal')) {
    function tanggal($date, $time = false)
    {
        if ($date == null) {
            return "-";
        }

        $format = "d @ Y";
        $bulan = bulanIndo(date("m", strtotime($date)));
        if ($time) {
            $format = "d @ Y H:i:s";
        }
        $tanggal = date($format, strtotime($date));
        return str_replace("@", $bulan, $tanggal);

    }
}

if (!function_exists('getErrorMessage')) {
    function getErrorMessage($message, $bg = 'red')
    {
        return '<div class="flex items-center bg-' . $bg . '-500 mb-2 rounded text-white text-sm font-bold px-4 py-3" role="alert"><svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg><p>'. $message .'</p></div>';

    }
}

// if (!function_exists('setStatusByFile')) {
//     function setStatusByFile($file)
//     {
//         $found = false;
//         $message = "Dokumen ";
//         $max = (count($file) > 3) ? 3 : count($file);

//         for ($i=0; $i < $max; $i++) {
//             if ($file[$i]->name_file === null || !isset($file[$i])) {
//                 $found = true;
//                 $message .= ($i + 1 == $max) ? ' dan ' : "";
//                 $message .= $file[$i]->type_file;
//                 $message .= ($i + 3 <= $max) ? ', ' : '';
//             }
//         }

//         if($found) {
//             return ucwords($message . " belum dilampirkan");
//         } else {
//             return;
//         }

//     }
// }



