@extends('layouts.default')

@section('content')

    {{ Form::open(['route' => 'podcasts.store', 'method' => 'post', 'files' => true]) }}

    <div class="form-group">
        {{ Form::label('episode_number', 'Episode Number') }}
        {{ Form::text('episode_number', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('title', 'Podcast Title') }}
        {{ Form::text('title', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('duration', 'Duration (HH:MM:SS)') }}
        {{ Form::text('duration', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Podcast Description') }}
        {{ Form::textarea('description', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Upload New Podcast') }}
    </div>

    {{ Form::close() }}

@stop