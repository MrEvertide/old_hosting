<div class="col-sm-3 col-xs-12 team-member center-block text-center">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="team-member-name">{{$user->name}}</div>
            <div class="team-member-email">{{$user->email}}</div>
        </div>
        <img style="height: 200px; border-radius: 250px; margin: 10px 0;" src="{{url('images/profile/'.$user->picture)}}">
        <div class="panel-footer">
            <a href="{{route("admin@viewTeamMember", [$user->id])}}" class="btn btn-primary">View details</a>
        </div>
    </div>
</div>