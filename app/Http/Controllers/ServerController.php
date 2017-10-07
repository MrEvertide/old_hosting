<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Server;

class ServerController extends Controller
{
    public function serverList () {
        $servers = Server::all();
        return view('server/index', ['servers' => $servers]);
    }
    
    public function addServer () {
        return view ('server/add');
    }

    public function addServerPost (Request $request) {
        $name = $request->input('server_name');
        $host = $request->input('server_host');
        $api = $request->input('server_key');
	
        $server = new Server;
	$server->name = $name;
	$server->host = $host;
	$server->api_token = $api;
	$server->save();

	return redirect('servers');
    }
}
