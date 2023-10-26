<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Industry;

class AdminCompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::query();

        // 企業名による検索
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->input('name')}%");
        }

        // 業界による絞り込み
        if ($request->filled('industries')) {
            $selectedIndustries = $request->input('industries');
            $query->whereHas('industries', function ($q) use ($selectedIndustries) {
                $q->whereIn('industries.id', $selectedIndustries);
            });
        }

        $companies = $query->paginate(10);

        $industries = Industry::all();

        return view('admin.company.index', compact('companies', 'industries'));
    }

    public function show(Company $company)
    {
        $company->load('industries');

        return view('admin.company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        $industries = Industry::all();

        $company->load('industries');


        return view('admin.company.edit', compact('company', 'industries'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company->name = $request->name;
        $company->update();
        $company->industries()->sync($request->input('industry'));

        return redirect()->route('admin.company.index')->with('success', '企業を更新しました。');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('admin.company.index')->with('success', '企業を削除しました。');
    }
}
