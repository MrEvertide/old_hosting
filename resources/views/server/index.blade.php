@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">Server List</h4>
                    <a class="btn btn-primary pull-right" href="{{route('serverAdd')}}">Add a server</a>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    @if (count($servers) > 0)
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Host</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($servers as $server)
                        <tr>
                            <td>{{$server['name']}}</td>
                            <td>{{$server['host']}}</td>
                            <td>
                                <a href="{{ route('serverView', $server['id']) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        @include('partials.messageSetupServer')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
