<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Offer;
use App\Http\Controllers\Controller;

class CompanyApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query();

        $query->whereHas('offer', function ($q) {
            $q->where('company_id', auth('company')->user()->company->id);
        });

        // 応募者名による絞り込み
        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->input('name')}%");
            });
        }

        // 求人名による絞り込み
        if ($request->filled('offer')) {
            $selectedOffer = $request->input('offer');
            $query->where('offer_id', $selectedOffer);
        }


        $applications = $query->paginate(10);

        // 応募がある求人のみ取得
        $companyId = auth('company')->user()->company->id;
        $offers = Offer::where('company_id', $companyId)
            ->whereHas('applications')
            ->get();

        return view('company.application.index', compact('applications', 'offers'));
    }

    public function show(Application $application)
    {
        // $this->authorize('company', $application);

        return view('company.application.show', compact('application'));
    }
}