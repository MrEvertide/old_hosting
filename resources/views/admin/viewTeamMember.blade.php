@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">User details</h4>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Administrator</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['email']}}</td>
                            @if($user->team()->pivot->is_admin)
                                <td>Yes</td>
                                <td></td>
                            @else
                                <td>No</td>
                                <td>
                                    <a href="{{ route('admin@deleteTeamMember', $user['id']) }}" class="btn btn-danger">Delete</a>
                                </td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
