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

    /**
     * View - Show team member details.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function viewTeamMember($id) {
        //Check if the user exist.
        if (!User::find($id)) {
            return redirect()->back()->with('error', true)->with('message', 'The specified user does not exist.');
        }

        $user = User::find($id);

        //Check if the user is part of the admin's team.
        $members = $user->team()->users()->get();
        if (!$members->find($user)) {
            return redirect()->back()->with('error', true)->with('message', 'You do not have access to this user.');
        }

        return view('admin.viewTeamMember', ['user' => User::find($id)]);
    }

    /**
     * Method - Action to delete a user from the team and system.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTeamMember($id) {
        //Check if the user exist.
        if (!User::find($id)) {
            return redirect()->back()->with('error', true)->with('message', 'The specified user does not exist.');
        }

        $user = User::find($id);

        if ($user == Auth::user()) {
            return redirect()->back()->with('error', true)->with('message', 'You cannot delete yourself.');
        }

        if ($user->team()->pivot->is_admin) {
            return redirect()->back()->with('error', true)->with('message', 'You cannot delete an administrator.');
        }

        //Check if the user is part of the admin's team.
        $members = $user->team()->users()->get();
        if (!$members->find($user)) {
            return redirect()->back()->with('error', true)->with('message', 'You do not have access to delete this user.');
        }

        //Remove the user from the team then delete it.
        $user->teams()->detach();
        $user->delete();
        return redirect(route('admin@listTeamMember'))->with('success', true)->with('message', 'The user has been deleted.');
    }

    /**
     * Method - Action to add a user as a team administrator.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setTeamAdmin ($id) {
        //Check if the user exist.
        if (!User::find($id)) {
            return redirect()->back()->with('error', true)->with('message', 'The specified user does not exist.');
        }

        $user = User::find($id);

        if ($user == Auth::user()) {
            return redirect()->back()->with('error', true)->with('message', 'You are already an administrator.');
        }

        if ($user->team()->pivot->is_admin) {
            return redirect()->back()->with('error', true)->with('message', 'The user is already an administrator.');
        }

        $user->teams()->updateExistingPivot($user->team()->id , ['is_admin' => true]);
        return redirect(route('admin@listTeamMember'))->with('success', true)->with('message', 'The user is now an administrator.');
    }

    /**
     * Post Method - Process the POST request to create a new user.
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
