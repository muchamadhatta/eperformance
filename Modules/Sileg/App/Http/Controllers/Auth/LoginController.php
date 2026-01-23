<?php

namespace Modules\Sileg\App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Sileg\Siap\Pegawai;



use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // $password = '123';
        // $hashedPassword = password_`hash($password, PASSWORD_BCRYPT);
        // echo $hashedPassword;
        // return view('auth.login');
        return view('sileg::auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $username = $request->username;
        $password = $request->password;

        $res = Http::post(
            'https://portal.dpr.go.id/login/sinting',
            [
                "token" => "cutidaring",
                "pengguna" => $username,
                "sandi" => $password
            ]
        );

        $response = $res->body();


        if ($response == 'OK') {
            $akunLogin = Pegawai::select('pegawai.id', 'nama', 'nip', 'golongan', 'id_satker','informal_photo_name', 'b.nama_satker')->where('pengguna', $username)
                ->first();

            if ($akunLogin->id) {
                $loginAttempt = Auth::loginUsingId($akunLogin->id);
                if ($loginAttempt) {
                    session(['pengguna' => $akunLogin->pengguna]);
                    session(['nama' => $akunLogin->nama]);
                    session(['nip' => $akunLogin->nip]);
                    session(['golongan' => $akunLogin->golongan]);
                    session(['id_satker' => $akunLogin->id_satker]);
                    session(['informal_photo_name' => $akunLogin->informal_photo_name]);
                    session(['satker' => $akunLogin->nama_satker]);
                    return redirect()->route('index');
                } else {
                    // Jika login gagal
                    // dd('Login failed');
                    return back()->withErrors([
                        'username' => 'Failed to login using provided credentials.',
                    ])->onlyInput('username');
                }
            }
        } else {
            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ])->onlyInput('username');
        }


    }
}
