<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listTeamMember () {
        return view('admin.listTeamMember');
    }

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

    public function addTeamMemberPost() {
        //temporary
        return redirect(route('admin@listTeamMember'));
    }
}
