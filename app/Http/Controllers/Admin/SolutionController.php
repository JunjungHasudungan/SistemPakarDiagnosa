<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index()
    {
        // $solutions = Solution::with('kecanduan')->get();

        // dd($solutions);

        return view('admin.solusi.index');
    }
}
