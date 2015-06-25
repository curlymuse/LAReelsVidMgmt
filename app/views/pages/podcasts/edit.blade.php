@extends('layouts.default')

@section('content')

    {{ Form::open(['route' => ['podcasts.update', $podcast->id], 'method' => 'post', 'files' => true]) }}

    <div class="form-group">
        {{ Form::label('episode_number', 'Episode Number') }}
        {{ Form::text('episode_number', $podcast->id, ['disabled' => true, 'class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('title', 'Podcast Title') }}
        {{ Form::text('title', $podcast->title, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Podcast Description') }}
        {{ Form::textarea('description', $podcast->description, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('fileanme', 'Choose File Name') }}
        {{ Form::text('filename', $podcast->filename, ['disabled' => true, 'class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Update Podcast Information') }}
    </div>

    {{ Form::close() }}

@stop