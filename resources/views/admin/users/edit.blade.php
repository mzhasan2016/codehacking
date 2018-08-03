@extends('layouts.admin')





@section('content')

    <h1>Update User</h1>
    
    <div class="row">
    
        <div class="col-sm-3">

            <img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400*400'}}" alt="" class="img-responsive img-rounded">

        </div>

        <div class="col-sm-9">

            {{--<form method="post" action="/cms/server.php/posts">--}}

            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>'true']) !!}

            <div class="form-group">

                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}

            </div>
            <div class="form-group">

                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}

            </div>
            <div class="form-group">

                {!! Form::label('role_id', 'Role:') !!}
                {!! Form::select('role_id', [''=>'Choose Option'] + $roles, null, ['class'=>'form-control']) !!}

            </div>
            <div class="form-group">

                {!! Form::label('is_active', 'Status:') !!}
                {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), null, ['class'=>'form-control']) !!}

            </div>

                {{--<input type="text" name="title" placeholder="Enter title">--}}
                {{--csrf_field()--}}

            <div class="form-group">

                {!! Form::label('file', 'File:') !!}
                {!! Form::file('file', null, ['class'=>'form-control']) !!}

            </div>     
            <div class="form-group">

                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}

            </div>


            <div class="form-group">

                {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-6']) !!}

                {{--<input type="submit" name="Submit">--}}

            </div>

            {{--</form>--}}
            {!! Form::close() !!}
            
            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id], 'class'=>'pull-right']) !!}

            <div class="form-group">

                {!! Form::submit('Delete User', ['class'=>'btn btn-danger']) !!}

            </div>
            
            {!! Form::close() !!}

        </div>
        
    </div>
    
    <div class="row">

        @include('includes.form_error')
    
    </div>
    
@stop