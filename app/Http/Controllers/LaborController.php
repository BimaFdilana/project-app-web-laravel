<?php

namespace App\Http\Controllers;

use App\Models\Labor;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    public function index()
    {
        $labors = Labor::latest()->paginate(10); // Ambil data terbaru, 10 per halaman
        return view('labors.index', compact('labors'));
    }

    public function show(Labor $labor)
    {
        return view('labors.show', compact('labor'));
    }
}