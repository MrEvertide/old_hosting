@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">Team Members</h4>
                    <a class="btn btn-primary pull-right" href="{{route('admin@addTeamMember')}}">Create user</a>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    <h3>Administrators</h3>
                    <div class="row">
                        @foreach($users as $user)
                            @if ($user->pivot->is_admin)
                                <div class="col-sm-3 col-xs-12 team-member center-block text-center">
                                    <div class="panel panel-default">
                                        <div class="team-member-name">{{$user->name}}</div>
                                        <div class="team-member-email">{{$user->email}}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <h3>Users</h3>
                    <div class="row">
                        @foreach($users as $user)
                            @if (!$user->pivot->is_admin)
                                <div class="col-sm-3 col-xs-12 team-member center-block text-center">
                                    <div class="panel panel-default">
                                        <div class="team-member-name">{{$user->name}}</div>
                                        <div class="team-member-email">{{$user->email}}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
