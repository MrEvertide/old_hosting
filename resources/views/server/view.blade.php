@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                                <th>Port</th>
                                <th>API Token</th>
                                <th>WHM User</th>
                                <th>Is HTTPS</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>{{$server['name']}}</td>
                                <td>{{$server['host']}}</td>
                                <td>{{$server['port']}}</td>
                                <td>{{$server['api_token']}}</td>
                                <td>{{$server['whm_user']}}</td>
                                @if($server['is_https'])
                                    <td>Yes</td>
                                @else
                                    <td>No</td>
                                @endif
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
