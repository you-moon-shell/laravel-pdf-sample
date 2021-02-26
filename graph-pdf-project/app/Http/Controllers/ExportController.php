<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export()
    {
        $message = "Hello, Laravel!!";
        return view('export', ['message' => $message]);
    }
}
