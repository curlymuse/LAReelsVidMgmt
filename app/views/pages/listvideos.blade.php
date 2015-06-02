@extends('layouts.default')

@section('content')

    <h1>Vimeo Videos List</h1>

    <p>
        <a class="btn btn-primary" href="{{ URL::route('videos.create') }}" role="button">Add New Video</a>
    </p>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Title</th>
            <th>Link</th>
            <th>Thumbnail</th>
        </tr>
    @foreach ($videos as $video)
        <tr>
            <td>{{ $video->title }}</td>
            <td>{{ link_to($video->getLink(), $video->getLink()) }}</td>
            <td><img class="img-rounded" src="{{ $video->thumbnail_url }}" /></td>
        </tr>
    @endforeach
    </table>

@stop