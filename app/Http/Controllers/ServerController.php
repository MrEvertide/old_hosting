<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Server;

class ServerController extends Controller
{
    public function serverList () {
        return view('server/index');
    }
}
