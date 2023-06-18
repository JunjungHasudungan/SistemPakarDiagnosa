<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPakarController extends Controller
{
    public function index()
    {
        return view('admin.data_pakar.index');
    }
}
