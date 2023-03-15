<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    
    public function test() {
        logger("PdfController");
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::Write(0, 'Hello World');
        PDF::Write(32, 'Hello Again');
        PDF::Output('hello_world.pdf');
    }
}
