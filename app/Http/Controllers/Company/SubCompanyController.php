<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;



class SubCompanyController extends Controller
{
    public function index(): View
    {
        return view('company.sub.index');
    }
    // 登録画面呼び出し
    public function create(): View
    {
        return view('company.sub.create');
    }

    // 登録実行
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Company::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        if (Auth::guard('company')->user()->parent_company_id) {
            $parent_company_id = Auth::guard('company')->user()->parent_company_id;
        } else {
            $parent_company_id = Auth::guard('company')->user()->id;
        }

        $company = Company::create([
            'parent_company_id' => $parent_company_id, // 追加
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($company));


        return redirect()->route('company.sub.index')->with([
            'success' => '登録しました。',
        ]);
    }
}
