<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\{
    Diagnosa,
    Gejala,
    Kecanduan,
    TempDiagnosa
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosaController extends Controller
{

    public function index()
    {
        $temp_diagnosa = TempDiagnosa::where('user_id', auth()->user()->id)->get();

        if (count($temp_diagnosa) > 0) {
            foreach ($temp_diagnosa as $item) {
               $id_kecanduan = $item->kecanduan_id;
               $created_at = $item->created_at;
            }

            $kecanduan = Kecanduan::with(['solusiKecanduan', 'gejalaKecanduan'])->where('id', $id_kecanduan)->get();

        } else {
            $kecanduan = [];
        }

        return view('guest.diagnosa.index', [
            'hasil_diagnosa'        => $kecanduan,
            'waktu_diagnosa'        => $created_at ?? null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.diagnosa.create', [
            'gejalas'       => Gejala::all(),
            'user_id'  => DB::table('temp_gejala')->get()
        ]);
    }

    public function store(Request $request)
    {
       $this->validate($request, [
            'gejala'    => 'required|min:2'
       ],
       [
        'gejala.required'   => 'gejala wajib diisi..',
        'gejala.min'        => 'Gejala yang dipilih min 2'
       ]);

       $gejala = DB::table('gejalas')->where('id', $request->input('gejala'))->get();

       $kecanduan = Kecanduan::orderBy('id', 'asc')->get();
       $count_kecanduan = $kecanduan->count();

       $count_hubungan_kecanduan = DB::table('gejala_kecanduan')->groupBy('kecanduan_id')->get('kecanduan_id')->count();

    //    $request->
      if($count_kecanduan != $count_hubungan_kecanduan){
        dd('data tidak sesuai dengan sistem');
      }

      $bimbingan_id = $request->user_id;

      foreach ($request->gejala as $id_gejala) {
       $gejala = Gejala::find($id_gejala);
            foreach ($gejala->KecanduanGejala as $kecanduan) {
               $temp_diagnosa = TempDiagnosa::where('user_id', $bimbingan_id)->where('kecanduan_id', $kecanduan->id);
               $temp_diag = $temp_diagnosa->first();
               if(!$temp_diag) {
                    $temp_diag = new TempDiagnosa();
                    $temp_diag->user_id = auth()->user()->id;
                    $temp_diag->kecanduan_id = $kecanduan->id;
                    // $temp_diag->gejala = 1;
                    $temp_diag->gejala_terpenuhi = 1;
                    $temp_diag->save();
                }
            }
        }
        return redirect('guest/diagnosa');
    }
}
