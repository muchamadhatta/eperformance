<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siap\Pegawai;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;



    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectPath()
    {
        return route('eperformance');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        $startTime = microtime(true);
        Log::info('LoginController::showLoginForm started at: ' . $startTime);
        
        $ivenc = ($_COOKIE["mehong1"] ?? '');
        $encrypted_strenc = ($_COOKIE["mehong2"] ?? '');

        $appname = "eperformance";
        if (isset($_COOKIE["mehong1"]) && isset($_COOKIE["mehong2"])) {
            
            $decryptStartTime = microtime(true);
            Log::info('Starting cookie decryption at: ' . $decryptStartTime);

            $iv = base64_decode($ivenc);
            $enc = base64_decode($encrypted_strenc);
            $key = 'in1,k0nci g3rbang kenikm4tan! *5';
            $cipher = 'aes-256-cbc';

            $strenc = openssl_decrypt($enc, $cipher, $key, 0, $iv);
            $strenc = gzuncompress($strenc);

            $decryptEndTime = microtime(true);
            $decryptDuration = ($decryptEndTime - $decryptStartTime) * 1000;
            Log::info('Cookie decryption completed in: ' . $decryptDuration . 'ms');

            $obj = json_decode($strenc);

            $obj->peran = (array) $obj->peran;

            if (isset($obj->pengguna)) {
                if (!isset($obj->peran[$appname]) || $obj->peran[$appname] == "") {
                    $provider_auth_uri = 'http://portal.dpr.go.id/login?service=' . $appname . '&t=' . time();
                    $redirectTime = microtime(true);
                    $totalDuration = ($redirectTime - $startTime) * 1000;
                    Log::info('Redirecting to portal in: ' . $totalDuration . 'ms');
                    return redirect($provider_auth_uri);
                }

                $sessionStartTime = microtime(true);
                session()->put('portal_data', $obj);
                $sessionEndTime = microtime(true);
                $sessionDuration = ($sessionEndTime - $sessionStartTime) * 1000;
                Log::info('Session storage completed in: ' . $sessionDuration . 'ms');
                
                $endTime = microtime(true);
                $totalDuration = ($endTime - $startTime) * 1000;
                Log::info('LoginController::showLoginForm completed in: ' . $totalDuration . 'ms');
                return redirect()->route('eperformance');
            }
        } else {
            session()->forget('portal_data');
            $provider_auth_uri = 'http://portal.dpr.go.id/login?service=' . $appname . '&t=' . time();
            $endTime = microtime(true);
            $totalDuration = ($endTime - $startTime) * 1000;
            Log::info('No cookies - redirecting to portal in: ' . $totalDuration . 'ms');
            return redirect($provider_auth_uri);
        }
    }




    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function logout(Request $request)
    // {

    //     setcookie('mehong1', '', time() - 28800, '/', 'dpr.go.id');
    //     setcookie('mehong2', '', time() - 28800, '/', 'dpr.go.id');

    //     unset($_COOKIE["mehong1"]);
    //     unset($_COOKIE["mehong2"]);

    //     $request->session()->forget('portal_data');

    //     return view('index');
    // }

    public function logout(Request $request)
    {
        // Clear the cookies set during login or elsewhere in your app
        setcookie('mehong1', '', time() - 3600, '/', 'dpr.go.id');
        setcookie('mehong2', '', time() - 3600, '/', 'dpr.go.id');

        // Clearing the session data
        $request->session()->forget('portal_data');

        // Perform the logout operation
        Auth::logout();

        // Redirect to the homepage or any other page
        return redirect('/');
    }


}
