<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TeamController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View - List the existing team members
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listTeamMember () {
        return view('admin.listTeamMember', ['users' => Auth::user()->team()->users()->get()]);
    }

    /**
     * View - Form to create a new team member.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addTeamMember() {
        return view('admin.addTeamMember');
    }

    public function viewTeamMember() {
        //temporary
        return redirect(route('admin@listTeamMember'));
    }

    public function deleteTeamMember() {
        //temporary
        return redirect(route('admin@listTeamMember'));
    }

    /**
     * Process the POST request to create a new user.
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function addTeamMemberPost(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->teams()->save($request->user()->team(), ['is_admin' => false]);
        return redirect(route('admin@listTeamMember'))->with('success', true)->with('message', 'Your team member has been created.');
    }
}
