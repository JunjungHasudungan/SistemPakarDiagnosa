<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $open_modal = false;

    public function index()
    {
        return view('guest.diagnosa.index', [
            'open_modal' => $this->open_modal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.diagnosa.create', [
            'gejalas'       => Gejala::all(),
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

    //    $gejala = DB::table('gejalas')->where('id', $request->input('gejala'))->get();

    //    dd($gejala);
       foreach ($request->gejala as  $gejala) {
        dd($gejala);
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosa $diagnosa)
    {
        //
    }
}
