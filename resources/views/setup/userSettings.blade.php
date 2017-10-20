@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Settings</h4>
                </div>
                
                <div class="panel-body">
                    <?php
                    echo Form::open(['url' => route('userSettingsPost'), 'method' => "POST", 'files' => true]);

                    echo Form::label('user_picture', 'Profile picture');
                    echo '<p>Max size: 2048x2048</p>';
                    echo Form::file('user_picture', $value = old('user_picture'),['class' => 'form-control']);
                    echo '<br>';

                    echo Form::submit('Save',['class' => 'form-control btn btn-primary']);
                    echo Form::close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
