@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="pull-left">Server Details</h4>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Host</th>
                                <th>API Token</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>{{$server['name']}}</td>
                                <td>{{$server['host']}}</td>
                                <td>{{$server['api_token']}}</td>
                                <td>
                                    <a href="{{ route('serverDelete', $server['id']) }}" class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
