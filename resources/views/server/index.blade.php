@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
		    <h4 class="pull-left">Server List</h4>
			<a class="btn btn-primary pull-right" href="{{route('serverAdd')}}">Add a server</a>
		    <div class="clearfix"></div>
		</div>

                <div class="panel-body">
		    <table class="table">
		    <tr>
			<th>Name</th>
			<th>Host</th>
		    </tr>      
                    @foreach ($servers as $server)
		    <tr>
			<td>{{$server['name']}}</td>
			<td>{{$server['host']}}</td>
		    </tr>
		    @endforeach
		    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
