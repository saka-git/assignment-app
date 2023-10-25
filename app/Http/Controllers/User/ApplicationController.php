<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use App\Models\Application;
use App\Mail\SendUserMail;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::where('user_id', auth()->id())->with('offer.company')->get();

        return view('user.application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($offer_id)
    {
        $userId = auth()->user()->id;

        // 現在のユーザーが投稿したapplicationで、指定されたoffer_idを持つものがあるか確認
        $alreadyApplied = Application::where('user_id', $userId)
            ->where('offer_id', $offer_id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'すでにこの求人に応募しています。');
        }

        return view('user.application.create', compact('offer_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        // 現在のユーザーが投稿したapplicationで、指定されたoffer_idを持つものがあるか確認
        $alreadyApplied = Application::where('user_id', $userId)
            ->where('offer_id', $request->offer_id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->route('application.index')->with('error', 'すでにこの求人に応募しています。');
        }

        // バリデーション
        $request->validate([
            'offer_id' => 'required|integer|exists:offers,id',
            'address' => 'required',
            'phone' => 'required|regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',
            'motivation' => 'required',
        ]);


        // データの保存
        Application::create([
            'user_id' => auth()->user()->id,
            'offer_id' => $request->offer_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => auth()->user()->email,
            'motivation' => $request->motivation,
        ]);

        // 保存したデータを取得
        $application = Application::where('user_id', auth()->user()->id)
            ->where('offer_id', $request->offer_id)
            ->first();

        // メール送信
        Mail::to(auth()->user()->email)->send(new SendUserMail($application));

        return redirect()->route('application.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $this->authorize('viewAny', $application);

        return view('user.application.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        $this->authorize('viewAny', $application);

        return view('user.application.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $this->authorize('viewAny', $application);

        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'motivation' => 'required',
        ]);

        $application->address = $request->address;
        $application->phone = $request->phone;
        $application->motivation = $request->motivation;
        $application->update();

        return redirect()->route('application.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $this->authorize('viewAny', $application);

        $application->delete();

        return redirect()->route('application.index');
    }
}
