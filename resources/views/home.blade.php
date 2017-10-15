@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">Dashboard</h4>
                    <a class="btn btn-primary pull-right" href="{{route('refreshList')}}"><i class="fa fa-refresh"></i></a>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($servers) > 0)
                        @foreach ($servers as $server)
                            <h3>{{$server->name}}</h3>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Domain</th>
                                    <th>Plan</th>
                                    <th>Disk Usage</th>
                                    <th>Is Suspended</th>
                                </tr>
                                @foreach ($server->accounts as $account)
                                    <tr>
                                        <td>{{$account['name']}}</td>
                                        <td>{{$account['domain']}}</td>
                                        <td>{{$account['plan']}}</td>
                                        @if( $account['disk_limit'] == 'unlimited' )
                                            <td>{{$account['disk_usage']}} / &infin;</td>
                                        @else
                                            <td>{{$account['disk_usage']}} / {{$account['disk_limit']}}</td>
                                        @endif
                                        @if ($account['is_suspended'])
                                            <td>Yes</td>
                                        @else
                                            <td>No</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                        @endforeach
                    @else
                        @include('partials.messageSetupServer')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
