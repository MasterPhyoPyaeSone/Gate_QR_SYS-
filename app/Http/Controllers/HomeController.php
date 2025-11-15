<?php

namespace App\Http\Controllers;

use App\Models\Entry_Data;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('index',[
            'entryData' => Entry_Data::with('student', 'teacher')
                ->latest()->paginate(5)->withQueryString(),
        ]);
    }
}
