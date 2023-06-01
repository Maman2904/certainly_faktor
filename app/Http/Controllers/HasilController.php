<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hasil-list', ['only' => ['index']]);
        $this->middleware('permission:hasil-show', ['only' => ['show']]);
    }

    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {


            $hasil = Hasil::with('defect')
                ->latest()
                ->paginate(10);
            // dd($hasil->file_pdf);
        } else {
            // dd("user");
            $hasil = auth()->user()
                ->hasils()
                ->with('defect')
                ->latest()
                ->paginate(10);
        }

        return view('admin.hasil.index', compact('hasil'));
    }

    public function show(Hasil $hasil)
    {
        // dd($hasil);
        $this->authorize('show', $hasil);
        return view('admin.hasil.show', compact('hasil'));
    }
}
