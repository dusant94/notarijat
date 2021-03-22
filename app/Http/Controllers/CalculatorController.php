<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    //
    public function showcalculator(){
        return view('proracuni.kalkulator-tarifa');
    }
}
