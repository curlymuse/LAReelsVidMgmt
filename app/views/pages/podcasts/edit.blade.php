@extends('layouts.default')

@section('content')

    <div class="col-lg-3"></div>
    <div class="container col-lg-7">
        {{ Form::open(['route' => ['podcasts.update', $podcast->id], 'method' => 'post', 'files' => true]) }}

        <div class="form-group">
            {{ Form::label('episode_number', 'Episode Number') }}
            {{ Form::text('episode_number', sprintf('%02d', $podcast->episode_number), ['disabled' => true, 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('title', 'Podcast Title') }}
            {{ Form::text('title', $podcast->title, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('duration', 'Duration (HH:MM:SS)') }}
            {{ Form::text('duration', $podcast->duration, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Podcast Description') }}
            {{ Form::textarea('description', $podcast->description, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('filename_placeholder', 'Choose File Name') }}
            {{ Form::text('filename_placeholder', $podcast->filename, ['disabled' => true, 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('episode_image', 'Choose Episode Image') }}
            {{ Form::file('episode_image', $podcast->episode_image, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Update Podcast Information') }}
        </div>

        {{ Form::close() }}
    </div>

@stop