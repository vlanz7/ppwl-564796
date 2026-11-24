<?php

namespace App\Http\Controllers;

use App\Models\Program;

class PageController extends Controller
{
    public function home(){
        $programs = Program::all();
        return view('home', compact('programs'));
    }
}
