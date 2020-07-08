<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Registration;

class RedirectorController extends Controller
{
    public function getter(Request $request)
    {
        if (isset($request->to) && isset($request->current)) {

            if (in_array(strtolower($request->to), config('custom.status')) && in_array(strtolower($request->current), config('custom.status'))) {

                $regid = $request->session()->get('registration_id');

                $data = Registration::where('id_registration', $regid)
                    ->first(['id_registration', 'current_registration']);

                if ($data) {

                    if ((strtolower($data->current_registration) == strtolower($request->current)) && (strtolower($request->to) !== 'selesai')) {

                        $update = Registration::where('id_registration', $regid)
                            ->update(['current_registration' => $request->to]);

                        if ($update) {
                            return redirect('siswa/' . $request->to . '?from=' . $request->current);
                        }

                    }
                }

            }

        }

        return abort(404);
    }

    private function redirect()
    {

    }

}
