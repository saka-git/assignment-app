<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Feature;
use App\Models\Industry;

class AdminOfferController extends Controller
{

    public function index(Request $request)
    {

        $query = Offer::query();

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

        return view('admin.offer.index', compact('offers', 'features', 'industries'));
    }



    public function show(Offer $offer)
    {
        return view('admin.offer.show', compact('offer'));
    }

    public function edit(Offer $offer)
    {
        $features = Feature::all();

        return view('admin.offer.edit', compact('offer', 'features'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'benefits' => 'required',
        ]);

        $offer->name = $request->name;
        $offer->description = $request->description;
        $offer->requirements = $request->requirements;
        $offer->benefits = $request->benefits;
        $offer->update();
        $offer->features()->sync($request->input('feature'));

        return redirect()->route('admin.offer.index')->with('success', '求人を更新しました。');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('admin.offer.index')->with('success', '求人を削除しました。');
    }
}
