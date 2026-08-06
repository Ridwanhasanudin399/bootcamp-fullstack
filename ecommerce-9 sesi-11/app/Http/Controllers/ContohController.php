<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function index()
    {
        $name = 'Ridwan';
        $html = '<p>Nama saya adalah ' . $name . '</p>';
        $fruits = ['Apel', 'Jeruk', 'Mangga', 'Pisang'];
        return view('contoh', compact('name','html','fruits'));
    }
}
