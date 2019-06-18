<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpCategoryController extends Controller
{
    public function create()
    {
       return view('help.createhelpcat');
    }
}
