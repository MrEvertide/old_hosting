<?php

namespace App\Http\Controllers;

use \App\Server;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['servers' => Server::all()]);
    }

    /**
     * Redirect method - refresh the account list.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function refreshDashboard() {
        //Call the ServerController updateAccountList method to refresh the data.
        \App::call('App\Http\Controllers\ServerController@updateAccountList');

        return redirect('home')->with('success', true)->with('message', 'Account data synchronized.');
    }
}
