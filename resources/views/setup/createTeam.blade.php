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
                    <?php
                    echo Form::open(['url' => route('post_createTeam'), 'method' => "POST"]);

                    echo Form::label('team_name', 'Team name');
                    echo Form::text('team_name', $value = old('team_name'),['class' => 'form-control']);
                    echo '<br>';

                    echo Form::submit('Next',['class' => 'form-control btn btn-primary']);
                    echo Form::close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
