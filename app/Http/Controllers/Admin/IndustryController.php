<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Industry;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industries = Industry::all();

        return view('admin.industry.index', compact('industries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.industry.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Industry::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.industry.index')->with('success', '業界を作成しました。');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $industry = Industry::find($id);

        return view('admin.industry.edit', compact('industry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $industry = Industry::find($id);
        $industry->name = $request->name;
        $industry->update();

        return redirect()->route('admin.industry.index')->with('success', '業界を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $industry = Industry::find($id);
        $industry->delete();

        return redirect()->route('admin.industry.index')->with('success', '業界を削除しました。');
    }
}
