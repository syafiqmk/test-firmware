<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    // Home Page
    public function home() {
        return view('welcome');
    }
}
