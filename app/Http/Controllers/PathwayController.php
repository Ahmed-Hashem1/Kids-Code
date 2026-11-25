<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Pathway;

class PathwayController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pathways = Pathway::all();
        // $pathways= Pathway::orderBy('id' , 'desc')->paginate(2);
        // $pathways= Pathway::orderBy('created_id' , 'desc')->paginate(2);
        $pathways= Pathway::paginate(4);
        return response()->view('cms.pathways.index' , compact('pathways'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $pathways = Pathway::all();
        $pathways= Pathway::paginate(4);

        return response()->view('cms.pathways.create', compact('pathways'));

    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        // توليد slug تلقائي إذا لم يُدخل أو تنظيفه
        $request->merge([
            'slug' => Str::slug($request->input('slug') ?: $request->input('title')),
        ]);

        $validated = $request->validate([
            'age_group' => ['required', 'in:7-9,10-12,13-15'],
            'title'     => ['required', 'string', 'max:255'],
            'slug'      => ['required', 'string', 'max:255', 'unique:pathways,slug'],
        ]);

        Pathway::create($validated);

        return redirect()
            ->route('pathways.index') // عدّل الاسم إذا كان اسم الـ route لديك pathways.index
            ->with('success', 'تم إنشاء المسار بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pathway $pathway)
    {
        // $pathway= Pathway::paginate(4);
        // return response()->view('cms.pathways.show', compact('pathway'));
        return view('cms.pathways.show', compact('pathway'));
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
    // public function destroy(Pathway $pathway)
    // {
    // $pathway->delete();
    // return back()->with('success', 'تم نقل العنصر إلى الأرشيف');
    // }

    // public function trash()
    // {
    // $pathways = Pathway::onlyTrashed()->latest()->paginate(10);
    // return view('admin.pathways.trash', compact('pathways'));
    // }

    // public function restore($id)
    // {
    // Pathway::withTrashed()->findOrFail($id)->restore();
    // return back()->with('success', 'تمت استعادة المسار');
    // }

    // public function forceDelete($id)
    // {
    //     Pathway::withTrashed()->findOrFail($id)->forceDelete();
    //     return back()->with('success', 'تم حذف المسار نهائيًا');
    // }
}
