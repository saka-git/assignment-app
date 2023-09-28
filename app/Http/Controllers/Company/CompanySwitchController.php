<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;



class CompanySwitchController extends Controller
{
    // 登録画面呼び出し
    public function create(): View
    {
        return view('company.auth.switch');
    }

    public function link(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $company = Company::where('email', $request->email)->first();
        $currentCompany = Auth::guard('company')->user();

        // リンクしようとしているアカウントが自分のアカウントだった場合
        if ($company->id === $currentCompany->id) {
            return redirect()->back()->with('error', '自分のアカウントはリンクできません。');
        }

        // 既にリンクされているアカウントかどうかを確認
        if ($currentCompany->linkedCompanies->contains($company)) {
            return redirect()->back()->with('error', 'このアカウントはすでにリンクされています。');
        }

        if ($company && Hash::check($request->password, $company->password)) {

            // 現在のアカウントがリンクしている他のアカウントもリンクする
            foreach ($currentCompany->linkedCompanies as $linkedCompany) {
                if (!$linkedCompany->linkedCompanies->contains($company->id)) {
                    $linkedCompany->linkedCompanies()->attach($company->id);
                    if (!$company->linkedCompanies->contains($linkedCompany->id)) {
                        $company->linkedCompanies()->attach($linkedCompany->id);
                    }
                }
            }

            // 新しいアカウントがリンクしている他のアカウントもリンクする
            foreach ($company->linkedCompanies as $linkedCompany) {
                if (!$linkedCompany->linkedCompanies->contains($currentCompany->id)) {
                    $linkedCompany->linkedCompanies()->attach($currentCompany->id);
                    if (!$currentCompany->linkedCompanies->contains($linkedCompany->id)) {
                        $currentCompany->linkedCompanies()->attach($linkedCompany->id);
                    }
                }
            }

            // 既存のアカウントと新しいアカウントをリンクする
            $currentCompany->linkedCompanies()->attach($company->id);
            $company->linkedCompanies()->attach($currentCompany->id);

            return redirect()->back()->with('success', 'アカウントをリンクしました。');
        }

        return redirect()->back()->with('error', '入力された情報が間違っているか、アカウントが存在しません。');
    }

    public function switch($companyId)
    {
        // 現在のcompanyとリンクしているcompanyを確認
        if (auth('company')->user()->linkedCompanies->contains($companyId)) {
            auth('company')->loginUsingId($companyId);
            return redirect()->route('company.dashboard');
        }

        return redirect()->back()->with('error', 'アカウントの切り替えに失敗しました。');
    }

    // public function linkAccount(Request $request)
    // {
    //     $email = $request->input('email');
    //     $password = $request->input('password');

    //     if (Auth::guard('company')->attempt(['email' => $email, 'password' => $password])) {
    //         $newCompany = auth()->user();

    //         // 現在のアカウントと新しいアカウントをリンク
    //         $currentCompany->linkedCompanies()->attach($newCompany->id);
    //         $newCompany->linkedCompanies()->attach($currentCompany->id);

    //         // 新しいアカウントがリンクしている他のアカウントもリンク
    //         foreach ($newCompany->linkedCompanies as $linkedCompany) {
    //             $currentCompany->linkedCompanies()->attach($linkedCompany->id);
    //             $linkedCompany->linkedCompanies()->attach($currentCompany->id);
    //         }

    //         return redirect()->back()->with('success', 'アカウントをリンクしました。');
    //     }

    //     return redirect()->back()->with('error', 'メールアドレスまたはパスワードが正しくありません。');
    // }

    // public function linkAccount(Request $request)
    // {
    //     $email = $request->input('email');
    //     $password = $request->input('password');

    //     if (Auth::guard('company')->attempt(['email' => $email, 'password' => $password])) {
    //         $newCompany = auth()->user();

    //         // 現在のアカウントと新しいアカウントをリンク
    //         $currentCompany->linkedCompanies()->attach($newCompany->id);
    //         $newCompany->linkedCompanies()->attach($currentCompany->id);

    //         // 現在のアカウントがリンクしている他のアカウントと新しいアカウントをリンク
    //         foreach ($currentCompany->linkedCompanies as $linkedCompany) {
    //             if (!$linkedCompany->linkedCompanies->contains($newCompany->id)) {
    //                 $linkedCompany->linkedCompanies()->attach($newCompany->id);
    //                 $newCompany->linkedCompanies()->attach($linkedCompany->id);
    //             }
    //         }

    //         // 新しいアカウントがリンクしている他のアカウントと現在のアカウントをリンク
    //         foreach ($newCompany->linkedCompanies as $linkedCompany) {
    //             if (!$linkedCompany->linkedCompanies->contains($currentCompany->id)) {
    //                 $linkedCompany->linkedCompanies()->attach($currentCompany->id);
    //                 $currentCompany->linkedCompanies()->attach($linkedCompany->id);
    //             }
    //         }

    //         return redirect()->back()->with('success', 'アカウントをリンクしました。');
    //     }

    //     return redirect()->back()->with('error', 'メールアドレスまたはパスワードが正しくありません。');
    // }
}
