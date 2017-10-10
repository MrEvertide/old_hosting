@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Add a server</h4>
                </div>
                
                <div class="panel-body">
                    <form action="{{ route('post_serverAdd') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="server_name">Name</label>
                            <input type="text" name="server_name" id="server_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="server_host">Host</label>
                            <input type="text" name="server_host" id="server_host" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="server_port">WHM Port</label>
                            <input type="text" name="server_port" id="server_port" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="server_key">API token</label>
                            <input type="text" name="server_key" id="server_key" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="server_user">WHM User</label>
                            <input type="text" name="server_user" id="server_user" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="server_https">HTTPS</label>
                            <input type="checkbox" name="server_https" id="server_https" class="checkbox">
                        </div>
                        <button type="submit" class="form-control btn btn-primary">Add server</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
