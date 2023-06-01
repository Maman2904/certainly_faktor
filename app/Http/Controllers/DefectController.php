<?php

namespace App\Http\Controllers;

use App\Models\Defect;
use Illuminate\Http\Request;

class DefectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:defect-list', ['only' => ['index']]);
        $this->middleware('permission:defect-create', ['only' => ['store']]);
        $this->middleware('permission:defect-edit', ['only' => ['update', 'json']]);
        $this->middleware('permission:defect-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $defect = Defect::all();

        // dd($defect);

        return view('admin.defect.index', compact('defect'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'penyebab' => 'required',
            'solusi' => 'required'
        ]);

        $data = $request->all();

        Defect::create($data);

        return back()->with('success', 'Data defect berhasil disimpan');
    }

    public function json()
    {
        $data = Defect::find(request('id'));

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'penyebab' => 'required',
            'solusi' => 'required'
        ]);

        $data = $request->all();

        Defect::find($request->id)->update($data);

        return back()->with('success', 'Data defect berhasil diubah');
    }

    public function destroy(Defect $defect)
    {
        $defect->delete();
        return back()->with('success', 'Data defect berhasil dihapus');
    }
}
