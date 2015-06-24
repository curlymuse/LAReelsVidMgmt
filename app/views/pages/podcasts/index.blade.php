@extends('layouts.default')

@section('content')

<div style="padding-bottom:25px;">
    <a href="{{ URL::route('podcasts.create') }}">
        <button class="btn btn-lg btn-primary">Add New Podcast</button>
    </a>
</div>

<table class="table table-bordered table-striped">
    <tr>
        <th>Episode #</th>
        <th>Title</th>
        <th>Description</th>
        <th>Filename</th>
        <th>Guest(s)</th>
        <th>Thumbnail</th>
    </tr>
@foreach ($podcasts as $podcast)
    <tr>
        <td>{{ $podcast->episode_number }}</td>
        <td>{{ $podcast->title }}</td>
        <td>{{ $podcast->description }}</td>
        <td>{{ $podcast->filename }}</td>
        <td></td>
        <td></td>
    </tr>
@endforeach
</table>


@stop