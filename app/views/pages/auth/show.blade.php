@extends('layouts.login')
@section('content')

{{ Form::open(['route' => 'login.submit', 'method' => 'post', 'class' => 'form-signin']) }}

    <h2 class="form-signin-heading">LA Reels Login</h2>

    {{ Form::text('email', NULL, ['placeholder' => 'Email address', 'class' => 'input-block-level']) }}<br/>
    {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'input-block-level']) }}<br/>
    <button class="btn btn-large btn-primary" type="submit">Sign in</button>

{{ Form::close() }}

@stop
