<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\{Defect, Ciriciri};
use Illuminate\Http\Request;

class RuleDefectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:rulesdefect-list', ['only' => ['index']]);
        $this->middleware('permission:rulesdefect-edit', ['only' => ['update']]);
    }

    public function index($id)
    {
        $defect = Defect::select('nama', 'id')->get();
        $ciriciri = Ciriciri::all();
        $data_defect = Defect::find($id);
        $ciriciri_defect = $data_defect->ciriciris();
        $ciriciri_id = $ciriciri_defect->pluck('ciriciri_id')->toArray();

        return view('admin.rulesdefect.index', compact('data_defect', 'defect', 'ciriciri', 'ciriciri_defect', 'ciriciri_id'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $defect_list = DB::table('ciriciri_defect')->where(['defect_id' => $id])->get();

        $ciriciri_list = [];
        $enabled = 0;
        $disabled = 0;
        $changed = 0;

        foreach ($input as $key => $value) {
            if (str_contains($key, 'ciriciri')) {
                $ciriciri_id = explode('-', $key)[1];

                $ciriciri_defect = DB::table('ciriciri_defect')
                    ->where(['defect_id' => $id, 'ciriciri_id' => $ciriciri_id]);

                if (count($ciriciri_defect->get()) == 0) {
                    DB::table('ciriciri_defect')
                        ->insert([
                            'defect_id' => $id,
                            'ciriciri_id' => $ciriciri_id,
                            'value_cf' => $value
                        ]);
                } else {
                    if ($ciriciri_defect->first()->value_cf != $value) {
                        $ciriciri_defect->update(['value_cf' => $value]);
                        $changed++;
                    }
                }

                array_push($ciriciri_list, $ciriciri_id);
                $enabled++;
            }
        }


        foreach ($defect_list as $defect) {
            if (!in_array($defect->ciriciri_id, $ciriciri_list)) {
                $data = DB::table('ciriciri_defect')
                    ->where(['defect_id' => $id, 'ciriciri_id' => $defect->ciriciri_id])
                    ->first();

                DB::table('ciriciri_defect')->delete($data->id);
                $disabled++;
            }
        }


        activity()
            ->causedBy(auth()->user())
            ->withProperties([
                'defect' => Defect::find($id)->nama,
                'enabled' => $enabled,
                'disabled' => $disabled,
                'changed' => $changed
            ])
            ->log('Updated basis rules');

        return back()->with('success', 'Rules berhasil diubah');
    }
}
