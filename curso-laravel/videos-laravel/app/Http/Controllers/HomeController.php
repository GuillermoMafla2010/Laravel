<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos=Video::paginate(3);

        return view('home', array(
                'videos'=>$videos

        ));
    }
}
