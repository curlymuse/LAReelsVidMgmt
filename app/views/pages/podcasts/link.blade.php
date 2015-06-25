@extends('layouts.default')

@section('content')

    {{ Form::open(['route' => ['podcasts.upload', $podcast->id], 'method' => 'post', 'files' => true]) }}

    <div class="form-group">
        {{ Form::label('episode_number', 'Episode Number') }}
        {{ Form::text('episode_number', $podcast->episode_number, ['class' => 'form-control', 'disabled' => true]) }}
    </div>
    <div class="form-group">
        {{ Form::label('title', 'Podcast Title') }}
        {{ Form::text('title', $podcast->title, ['class' => 'form-control', 'disabled' => true]) }}
    </div>
    <div class="form-group">
        {{ Form::label('filename', 'File to Upload') }}
        {{ Form::file('filename', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Upload New Podcast') }}
    </div>

    {{ Form::close() }}

@stop