<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use \App\Server;
use \App\Utility;
use Illuminate\Support\Facades\Auth;
use Validator;

class ServerController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View - List existing servers in a list.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function serverList () {
        $servers = Auth::user()->teams()->first()->servers()->get();
        return view('server/index', ['servers' => $servers]);
    }

    /**
     * View - Form to add a server.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addServer () {
        if (Auth::user()->teams()->first()->pivot->is_admin) {
            return view ('server/add');
        } else {
            return redirect('home');
        }
    }

    /**
     * Post Method - Validate and process the form submit to create a server.
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addServerPost (Request $request) {
        $validation = Validator::make($request->all(), [
            'server_name' => 'required',
            'server_host' => 'required',
            'server_port' => 'required',
            'server_key' => 'required',
            'server_user' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect(route('serverAdd'))->withErrors($validation)->withInput();
        }

        $name = $request->input('server_name');
        $host = $request->input('server_host');
        $port = $request->input('server_port');
        $api = $request->input('server_key');
        $whm_user = $request->input('server_user');

        if ($request->input('server_https')) {
            $is_https = true;
        } else {
            $is_https = false;
        }
        $user = Auth::user();

        $server = new Server;
        $server->name = $name;
        $server->host = $host;
        $server->port = $port;
        $server->api_token = $api;
        $server->whm_user = $whm_user;
        $server->is_https = $is_https;

        $user->teams()->first()->servers()->save($server);

        return redirect('servers');
    }

    /**
     * Method - Action to delete a server from the list.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteServer ($id) {
        $server = Server::find($id);
        $user = Auth::user();

        if ($user->teams()->first()->servers()->find($server->id)) {
            $server->delete();
        }
        return redirect('servers');
    }

    /**
     * View - Detail page for the server configurations.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function viewServer($id) {
        $server = Server::find($id);
        $user = Auth::user();

        if ($user->teams()->first()->servers()->find($server->id)) {
            return view('server/view', ['server' => $server]);
        } else {
            return redirect('servers');
        }
    }

    /**
     * Method used to cycle all servers and update accounts' details.
     */
    public function updateAccountList() {
        $servers = Server::all();

        foreach ($servers as $server) {
            $this->getAllServerAccounts($server);
        }
    }

    /**
     * This method gets account details for each accounts on a WHM server and then save it.
     * @param $server
     * @return bool
     */
    private function getAllServerAccounts($server) {
        $user = $server->whm_user;
        $url = Utility::buildUrl($server->is_https, $server->host, $server->port);
        $query = $url."/json-api/listaccts?api.version=1";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $header[0] = "Authorization: whm $user:$server->api_token";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $query);

        $result = curl_exec($curl);

        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status != 200) {
            //$info = curl_getinfo($curl);
            //TODO IMPLEMENT ERROR LOGGING FOR ACCOUNT DATA SYNC WHEN IT FAILS
            curl_close($curl);
            return false;
        } else {
            $json = json_decode($result);

            foreach ($json->{'data'}->{'acct'} as $userdetails) {
                //Try to find an existing account in the specified server to update details.
                $account = $server->accounts->where('name', $userdetails->{'user'})->first();

                //Create a new account with received details.
                if (!$account) {
                    $account = new Account;
                }

                $account->name = $userdetails->{'user'};
                $account->server_id = $server->id;
                $account->domain = $userdetails->{'domain'};
                $account->plan= $userdetails->{'plan'};
                $account->disk_usage = $userdetails->{'diskused'};
                $account->disk_limit = $userdetails->{'disklimit'};
                $account->is_suspended = $userdetails->{'suspended'};

                $account->save();
            }
            curl_close($curl);
            return true;
        }
    }
}
