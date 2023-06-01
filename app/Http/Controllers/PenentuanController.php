<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\{Ciriciri, Defect, Rule, Hasil};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Svg\Tag\Circle;

class PenentuanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:penentuan', ['only' => ['index']]);
        $this->middleware('permission:penentuan-create', ['only' => ['penentuan']]);
    }

    public function index()
    {
        $ciriciri = Ciriciri::all();

        return view('admin.penentuan', compact('ciriciri'));
    }

    public function tingkat_keyakinan($keyakinan)
    {
        switch ($keyakinan) {
            case -0.8:
                return 'Hampir pasti tidak';
                break;
            case -1:
                return 'Pasti tidak';
                break;
            case -0.6:
                return 'Kemungkinan besar tidak';
                break;
            case -0.4:
                return 'Mungkin tidak';
                break;
            case 0.4:
                return 'Mungkin';
                break;
            case 0.6:
                return 'Sangat Mungkin';
                break;
            case 0.8:
                return 'Hampir pasti';
                break;
            case 1:
                return 'Pasti';
                break;
        }
    }

    public function kalkulasi_cf($data)
    {
        $data_defect = [];
        $ciriciri_terpilih = [];
        foreach ($data['penentuan'] as $input) {
            if (!empty($input)) {
                $opts = explode('+', $input);
                $ciriciri = Ciriciri::with('defects')->find($opts[0]);


                foreach ($ciriciri->defects as $defect) {
                    if (empty($data_defect[$defect->id])) {
                        $data_defect[$defect->id] = [$defect, [$ciriciri, $opts[1], $defect->pivot->value_cf]];
                    } else {
                        array_push($data_defect[$defect->id], [$ciriciri, $opts[1], $defect->pivot->value_cf]);
                    }

                    if (empty($ciriciri_terpilih[$ciriciri->id])) {
                        $ciriciri_terpilih[$ciriciri->id] = [
                            'nama' => $ciriciri->nama,
                            'kode' => $ciriciri->kode,
                            'cf_user' => $opts[1],
                            'keyakinan' => $this->tingkat_keyakinan($opts[1])
                        ];
                    }
                }
            }
        }

        $hasil_penentuan = [];
        $cf_max = null;
        foreach ($data_defect as $final) {
            if (count($final) < 3) {
                continue;
            }

            $cf1 = null;
            $cf2 = null;
            $cf_combine = 0;
            $hasil_cf = null;
            foreach ($final as $key => $value) {
                if ($key == 0) {
                    continue;
                }

                if ($key == 1) {
                    $cf1 = $final[$key][2] * $final[$key][1];
                } else {
                    if ($cf_combine != 0) {
                        $cf1 = $cf_combine;
                        $cf2 = $final[$key][2] * $final[$key][1];

                        if ($cf1 < 0 || $cf2 < 0) {
                            $cf_combine = ($cf1 + $cf2) / (1 - min($cf1, $cf2));
                        } else {
                            $cf_combine = $cf1 + ($cf2 * (1 - $cf1));
                        }

                        $hasil_cf = $cf_combine;
                    } else {
                        $cf2 = $final[$key][2] * $final[$key][1];

                        if ($cf1 < 0 || $cf2 < 0) {
                            $cf_combine = ($cf1 + $cf2) / (1 - min($cf1, $cf2));
                        } else {
                            $cf_combine = $cf1 + ($cf2 * (1 - $cf1));
                        }

                        $hasil_cf = $cf_combine;
                    }
                }


                if (count($final) - 1 == $key) {
                    if ($cf_max == null) {
                        $cf_max = [$hasil_cf, "{$final[0]->nama} ({$final[0]->kode})", "{$final[0]->penyebab}", "{$final[0]->solusi}"];
                    } else {
                        $cf_max = ($hasil_cf > $cf_max[0])
                            ? [$hasil_cf, "{$final[0]->nama} ({$final[0]->kode})", "{$final[0]->penyebab}", "{$final[0]->solusi}"]
                            : $cf_max;
                    }

                    $hasil_penentuan[$final[0]->id]['hasil_cf'] = $hasil_cf;

                    $cf1 = null;
                    $cf2 = null;
                    $cf_combine = 0;
                    $hasil_cf = null;
                }



                if (empty($hasil_penentuan[$final[0]->id])) {
                    $hasil_penentuan[$final[0]->id] = [
                        'nama_defect' => $final[0]->nama,
                        'kode_defect' => $final[0]->kode,
                        'penyebab' => $final[0]->penyebab,
                        'solusi' => $final[0]->solusi,
                        'ciriciri' => [
                            [
                                'nama' => $final[$key][0]->nama,
                                'kode' => $final[$key][0]->kode,
                                'cf_user' => $final[$key][1],
                                'cf_role' => $final[$key][2],
                                'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                            ]
                        ]
                    ];
                } else {

                    array_push($hasil_penentuan[$final[0]->id]['ciriciri'], [
                        'nama' => $final[$key][0]->nama,
                        'kode' => $final[$key][0]->kode,
                        'cf_user' => $final[$key][1],
                        'cf_role' => $final[$key][2],
                        'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                    ]);
                }
            }
        }

        // dd($hasil_penentuan);

        return [
            'hasil_penentuan' => $hasil_penentuan,
            'ciriciri_terpilih' => $ciriciri_terpilih,
            'cf_max' => $cf_max
        ];
    }

    public function penentuan(Request $request)
    {
        $name = auth()->user()->name;

        if (auth()->user()->hasRole('Admin')) {
            $request->validate(['nama' => 'required|string|max:100']);
            $name = $request->nama;
        }

        $data = $request->all();

        $result = $this->kalkulasi_cf($data);

        if ($result['cf_max'] == null) {
            return back()->with('error', 'Terjadi sebuah kesalahan');
        }



        $hasil = Hasil::create([
            'nama' => $name,
            'hasil_penentuan' => serialize($result['hasil_penentuan']),
            'cf_max' => serialize($result['cf_max']),
            'ciriciri_terpilih' => serialize($result['ciriciri_terpilih']),
            'user_id' => auth()->id()
        ]);

        $path = public_path('storage/downloads');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $file_pdf = 'Penentuaan-' . $name . '-' . time() . '.pdf';


        PDF::loadView('pdf.hasil', ['id' => $hasil->id])
            ->save($path . "/" . $file_pdf);

        $hasil->update(['file_pdf' => $file_pdf]);

        return redirect()->to(route('admin.hasil', $hasil->id));
    }
}
