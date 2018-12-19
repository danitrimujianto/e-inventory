<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $this->modul = "welcome";
        $this->modulName = "Home";
        $this->theme = array("modul"=>$this->modul, "modulName"=>$this->modulName);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->theme["page"] = "index"; //disetiap class dan function controller harus ada

        return view('home', ["theme" => $this->theme, "data" => ""]);
    }
}
