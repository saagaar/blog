<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Blogs;
class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home.index');
    }
    public function test()
    {
        // Blogs::all()->latest();
        return view('frontend.home.test');
    }
    public function blog()
    {
        $blog = Blogs::all()->latest();
        return response($blog->jsonSerialize(), Response::HTTP_OK);
    }
}
