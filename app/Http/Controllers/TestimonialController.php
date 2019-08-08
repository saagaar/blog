<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController; 
use App\Repository\TestimonialInterface;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Support\Facades\File;
use App;

class TestimonialController extends AdminController
{
     protected $testimony;

    function __construct(TestimonialInterface $testimony)
    {
         parent::__construct();
         $this->testimony=$testimony;
    }
}
