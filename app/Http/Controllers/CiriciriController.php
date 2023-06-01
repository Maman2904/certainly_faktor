<?php

namespace App\Http\Controllers;

use App\Models\Ciriciri;
use Illuminate\Http\Request;

class CiriciriController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ciriciri-list', ['only' => ['index']]);
        $this->middleware('permission:ciriciri-create', ['only' => ['store']]);
        $this->middleware('permission:ciriciri-edit', ['only' => ['update', 'json']]);
        $this->middleware('permission:ciriciri-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $ciriciri = Ciriciri::paginate(10);

        return view('admin.ciriciri.index', compact('ciriciri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required'
        ]);

        $data = $request->all();

        Ciriciri::create($data);

        return back()->with('success', 'Data ciriciri berhasil disimpan');
    }

    public function json()
    {
        $data = Ciriciri::find(request('id'));

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required'
        ]);

        $data = $request->all();

        Ciriciri::find($request->id)->update($data);

        return back()->with('success', 'Data ciriciri berhasil diubah');
    }

    public function destroy(Ciriciri $ciriciri)
    {
        $ciriciri->delete();
        return back()->with('success', 'Data ciriciri berhasil dihapus');
    }
}
