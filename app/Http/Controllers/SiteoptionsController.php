<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\SiteoptionsInterface;
use Illuminate\Http\Request;

class SiteoptionsController extends Controller
{
    protected $siteoptions;

    function __construct(SiteoptionsInterface $siteoptions)
    {
        $this->site=$siteoptions;
        $this->middleware('auth:admin')->except('logout');
    }
}
