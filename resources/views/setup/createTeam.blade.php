@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Create your team</h4>
                </div>
                
                <div class="panel-body">
                    <form action="{{ route('post_createTeam') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="team_name">Name your Team</label>
                            <input type="text" name="team_name" id="team_name" class="form-control">
                        </div>
                        <button type="submit" class="form-control btn btn-primary">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
