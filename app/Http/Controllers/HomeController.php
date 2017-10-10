<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Server;
use \App\Http\Controllers\ServerController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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
        return view('home', ['servers' => Server::all()]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function refreshDashboard() {
        $test = new ServerController();
        $test->updateAccountList();

        return redirect('home');
    }
}
