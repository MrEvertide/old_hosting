@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">Create a user</h4>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    <?php
                    echo Form::open(['url' => route('admin@addTeamMemberPost'), 'method' => "POST"]);

                    echo Form::label('name', 'Name');
                    echo Form::text('name', $value = old('name'),['class' => 'form-control']);

                    echo Form::label('email', 'E-Mail Address');
                    echo Form::text('email', $value = old('email'),['class' => 'form-control']);

                    echo Form::label('password', 'Password');
                    echo Form::text('password', $value = old('password'),['class' => 'form-control']);

                    echo Form::label('password_confirmation', 'Confirm password');
                    echo Form::password('password_confirmation',$attributes = ['class' => 'form-control']);
                    echo '<br>';

                    echo Form::submit('Create user',['class' => 'form-control btn btn-primary']);
                    echo Form::close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
