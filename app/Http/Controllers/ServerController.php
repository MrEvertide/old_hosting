<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Server;
use Validator;

class ServerController extends Controller
{
    /**
     * View - List existing servers in a list.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function serverList () {
        $servers = Server::all();
        return view('server/index', ['servers' => $servers]);
    }

    /**
     * View - Form to add a server.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addServer () {
        return view ('server/add');
    }

    /**
     * Post Method - Validate and process the form submit to create a server.
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addServerPost (Request $request) {
        $validation = Validator::make($request->all(),
            ['server_name' => 'required', 'server_host' => 'required', 'server_key' => 'required']
        );

        if ($validation->fails()) {
            return redirect(route('serverAdd'))->withErrors($validation)->withInput();
        }

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

    /**
     * Method - Action to delete a server from the list.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteServer ($id) {
        $server = Server::find($id);

        if ($server) {
            $server->delete();
        }
        return redirect('servers');
    }
}
