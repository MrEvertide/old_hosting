<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Success!</strong> {{ Session::get('message', '') }}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger form-fields-error">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Error! </strong><span>We found the following
                        @if (count($errors) > 1)
                            errors
                        @else
                            error
                        @endif
                        in your request.</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-error">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error!</strong> {{ Session::get('message', '') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>