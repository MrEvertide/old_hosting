<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Validation\Rule;
use Image;
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

        return redirect(route('home'))->with('success', true)->with('message', 'Your team has been created.');
    }

    /**
     * View - Form to change user's settings.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userSettings() {
        return view('setup.userSettings');
    }

    /**
     * Process the user's setting request to update his settings.
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function userSettingsPost(Request $request) {
        $validation = Validator::make($request->all(), [
            'user_picture' => [
                Rule::dimensions()->maxWidth(2048)->maxHeight(2048),
                'mimes:jpeg,jpg,png'
            ],
        ]);

        if ($validation->fails()) {
            return redirect(route('userSettings'))->withErrors($validation)->withInput();
        }

        $avatar = $request->file('user_picture');
        $filename = uniqid () . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(500, 500)->save(public_path('images/profile/'. $filename));
        $user = Auth::user();
        $user->picture = $filename;
        $user->save();

        return redirect()->back()->with('success', true)->with('message', 'Your user has been updated.');
    }

}
