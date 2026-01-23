<?php


namespace Modules\MagangPustekinfo\App\Http\Controllers\Auth;

use Modules\MagangPustekinfo\App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('magangpustekinfo::auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login = Auth::guard('magangpustekinfo')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);
        
        if ($login) {
            $user = Auth::guard('magangpustekinfo')->user();
            session(['name' => $user->name]);
            session(['email' => $user->email]);
            return redirect()->route('magangpustekinfo.admin.dashboard.index');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }
}
