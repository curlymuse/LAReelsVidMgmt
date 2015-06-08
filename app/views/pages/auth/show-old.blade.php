@extends('layouts.default')

@section('content')

    <h1>Login Here</h1>

    {{ Form::open(['route' => 'login.submit', 'method' => 'post']) }}

    <table>
        <tr>
            <td>
                {{ Form::label('email', 'Email') }}
            </td>
            <td>
                {{ Form::text('email') }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label('password', 'Password') }}
            </td>
            <td>
                {{ Form::password('password') }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {{ Form::submit('Submit') }}
            </td>
        </tr>

    </table>

    {{ Form::close() }}

@stop