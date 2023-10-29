<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Offer;
use App\Models\Feature;
use App\Models\Industry;

class UserOfferController extends Controller
{

    public function index(Request $request)
    {

        $query = Offer::query();

        $query->with('company');

        // 名前による検索
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->input('name')}%");
        }

        // 企業名による検索
        if ($request->filled('company_name')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->input('company_name')}%");
            });
        }

        // 業界による絞り込み
        if ($request->filled('industries')) {
            $selectedIndustries = $request->input('industries');
            $query->whereHas('company.industries', function ($q) use ($selectedIndustries) {
                $q->whereIn('industries.id', $selectedIndustries);
            });
        }

        // 特徴による絞り込み
        if ($request->filled('features')) {
            $selectedFeatures = $request->input('features');
            $query->whereHas('features', function ($q) use ($selectedFeatures) {
                $q->whereIn('features.id', $selectedFeatures);
            });
        }

        $offers = $query->paginate(10);

        $features = Feature::all();

        $industries = Industry::all();

        $applications = Application::where('user_id', auth()->user()->id)->get();

        return view('user.offer.index', compact('offers', 'features', 'industries', 'applications'));
    }

    public function show(Offer $offer)
    {
        return view('user.offer.show', compact('offer'));
    }
}
