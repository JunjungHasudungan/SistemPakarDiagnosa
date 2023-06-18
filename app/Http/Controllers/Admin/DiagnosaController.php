<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        return view('admin.diagnosa.index');
    }
}
