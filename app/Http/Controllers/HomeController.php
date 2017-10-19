<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
     * View - Show the home dashboard to the user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('home', ['servers' => Auth::user()->team()->servers()->get()]);
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
