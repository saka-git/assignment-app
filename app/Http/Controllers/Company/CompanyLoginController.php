<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CompanyLoginController extends Controller
{
    // ログイン画面呼び出し
    public function showLoginPage(): View
    {
        return view('company.auth.login');
    }

    // ログイン実行
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('company')->attempt($credentials)) {
            return redirect()->route('company.dashboard')->with([
                'login_msg' => 'ログインしました。',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    // ログアウト
    public function logout(): RedirectResponse
    {
        Auth::guard('company')->logout();

        return redirect()->route('company.login')->with([
            'logout_msg' => 'ログアウトしました。',
        ]);
    }
}
