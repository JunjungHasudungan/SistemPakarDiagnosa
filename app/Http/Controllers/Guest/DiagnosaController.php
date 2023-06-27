<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guest.diagnosa.index');
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
