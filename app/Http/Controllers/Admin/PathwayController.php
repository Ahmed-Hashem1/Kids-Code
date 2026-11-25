<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Pathway;

class PathwayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pathway $pathway)
    {
    $pathway->delete();
    return back()->with('success', 'تم نقل العنصر إلى الأرشيف');
    }

    public function trash()
    {
    $pathways = Pathway::onlyTrashed()->latest()->paginate(10);
    return view('cms.pathways.trash', compact('pathways'));
    
    }

    public function restore($id)
    {
    Pathway::withTrashed()->findOrFail($id)->restore();
    return back()->with('success', 'تمت استعادة المسار');
    }

    public function forceDelete($id)
    {
        Pathway::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'تم حذف المسار نهائيًا');
    }
}
