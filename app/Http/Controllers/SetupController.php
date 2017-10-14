<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class SetupController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View - Form to setup the user's Team.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createTeam() {
        if (Auth::user()->teams()->first()) {
            return redirect(route("home"));
        }
        return view('setup.createTeam');
    }

    /**
     * Process the user's request to create his Team.
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createTeamPost(Request $request) {
        $validation = Validator::make($request->all(), [
            'team_name' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect(route('setup@createTeam'))->withErrors($validation)->withInput();
        }

        $team = new Team;
        $team->name = $request->input('team_name');
        $user = Auth::user();
        $user->teams()->save($team, ['is_admin' => true]);

        return redirect(route('home'));
    }

}
