<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Feature;

class OfferController extends Controller
{

    public function index()
    {
        $offers = Offer::where('company_id', Auth::guard('company')->user()->id)->paginate(10);

        return view('company.offer.index', compact('offers'));
    }

    public function create()
    {
        $features = Feature::all();
        return view('company.offer.create', compact('features'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'benefits' => 'required',
        ]);

        $offer = new Offer();
        $offer->name = $request->name;
        $offer->description = $request->description;
        $offer->requirements = $request->requirements;
        $offer->benefits = $request->benefits;
        $offer->company_id = Auth::guard('company')->user()->id;
        $offer->save();
        $offer->features()->sync($request->input('feature'));

        return redirect()->route('company.offer.show', $offer->id)->with('success', '求人を作成しました。');
    }

    public function show(Offer $offer)
    {
        $this->authorize('viewAny', $offer);

        $offer->load('features');

        $applications = $offer->applications()->with('user')->paginate(10);

        return view('company.offer.show', compact('offer', 'applications'));
    }

    public function edit(Offer $offer)
    {
        $features = Feature::all();

        return view('company.offer.edit', compact('offer', 'features'));
    }

    public function update(Request $request, Offer $offer)
    {
        $this->authorize('viewAny', $offer);

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


        return redirect()->route('company.offer.index')->with('success', '求人を更新しました。');
    }

    public function destroy(Offer $offer)
    {
        $this->authorize('viewAny', $offer);

        $offer->delete();
        return redirect()->route('company.offer.index')->with('success', '求人を削除しました。');
    }
}
