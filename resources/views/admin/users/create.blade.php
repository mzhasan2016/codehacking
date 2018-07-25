@extends('layouts.admin')





@section('content')

    <h1>Create User</h1>

    {{--<form method="post" action="/cms/server.php/posts">--}}
    
    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>'true']) !!}
        
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
        {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), 0, ['class'=>'form-control']) !!}
         
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
        
        {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}

        {{--<input type="submit" name="Submit">--}}
        
    </div>

    {{--</form>--}}
    {!! Form::close() !!}

    @include('includes.form_error')
    
@stop