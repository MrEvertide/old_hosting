@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Add a server</h4>
                </div>
                
                <div class="panel-body">
                    <?php
                    echo Form::open(['url' => route('post_serverAdd'), 'method' => "POST"]);

                    echo Form::label('server_name', 'Name');
                    echo Form::text('server_name', $value = old('server_name'),['class' => 'form-control']);

                    echo Form::label('server_host', 'Host');
                    echo Form::text('server_host', $value = old('server_host'),['class' => 'form-control']);

                    echo Form::label('server_port', 'WHM Port');
                    echo Form::text('server_port', $value = old('server_port'),['class' => 'form-control']);

                    echo Form::label('server_key', 'AIP Token');
                    echo Form::text('server_key', $value = old('server_key'),['class' => 'form-control']);

                    echo Form::label('server_user', 'WHM User');
                    echo Form::text('server_user', $value = old('server_user'),['class' => 'form-control']);

                    echo Form::label('server_https', 'HTTPS');
                    echo Form::checkbox('server_https', '1', old('server_https'), ['class' => 'checkbox']);
                    echo '<br>';

                    echo Form::submit('Add server',['class' => 'form-control btn btn-primary']);
                    echo Form::close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
