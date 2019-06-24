<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;   
use Illuminate\Http\Request;
use App\Models\HelpCategorys;
class HelpController extends AdminController
{
    public function create()
    {
        $this->user = auth()->user();
       
        $data=$this->admin->getById($this->user->id);
        $categories =  HelpCategorys::all();
       return view('help.createhelp',compact('data','categories'));
    }
}
