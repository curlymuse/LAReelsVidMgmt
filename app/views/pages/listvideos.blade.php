@extends('layouts.default')

@section('content')

    <h1>hello world</h1>

    <p>
        <a href="{{ URL::route('videos.create') }}">Create New</a>
    </p>

    <table>
        <tr>
            <th>Title</th>
            <th>Link</th>
            <th>Description</th>
        </tr>
    @foreach ($videos as $video)
        <tr>
            <td>{{ $video->title }}</td>
            <td>{{ link_to($video->getLink(), $video->getLink()) }}</td>
            <td>{{ $video->description }}</td>
        </tr>
    @endforeach
    </table>

@stop