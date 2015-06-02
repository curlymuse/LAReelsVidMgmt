@extends('layouts.default')

@section('content')

    {{ Form::open(['route' => 'videos.store', 'method' => 'post']) }}

    <table>
        <tr>
            <td>
                {{ Form::label('link', 'Vimeo Link') }}
            </td>
            <td>
                {{ Form::text('link') }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label('title', 'Video Title') }}
            </td>
            <td>
                {{ Form::text('title') }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label('description', 'Video Description') }}
            </td>
            <td>
                {{ Form::textarea('description') }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {{ Form::submit('Submit New Video') }}
            </td>
        </tr>

    </table>

    {{ Form::close() }}

@stop