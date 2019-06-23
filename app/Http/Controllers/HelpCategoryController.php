<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;   

use Illuminate\Http\Request;

class HelpCategoryController extends AdminController
{
    public function create()
    {
        $this->user = auth()->user();
       
        $data=$this->admin->getById($this->user->id);

       return view('help.createhelpcat',compact('data'));
    }
}
