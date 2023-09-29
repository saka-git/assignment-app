<?php

namespace App\Http\Controllers\Company;

use App\Models\Industry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyIndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::all();
        $registered_industries = Auth::guard('company')->user()->industries;

        return view('company.industry', compact('industries'));
    }

    public function store(Request $request)
    {

        // ログイン中の会社を取得
        $company = Auth::guard('company')->user();

        // リクエストから業界のIDの配列を取得
        $industryIds = $request->input('industry');

        // 会社と業界の関係を保存
        $company->industries()->sync($industryIds);

        // 保存が完了したら、適切なページにリダイレクト
        return redirect()->route('company.industry')->with('success', '業界が正常に登録されました。');
    }
}
