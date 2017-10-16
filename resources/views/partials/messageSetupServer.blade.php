@if(Auth::user()->isTeamAdmin())
<p>You have not configured a server yet, click
    <a href="{{route('admin@addServer')}}">here</a>
    to setup your first server!
</p>
@else
<p>Your team administrator have not configured a server yet.</p>
@endif
