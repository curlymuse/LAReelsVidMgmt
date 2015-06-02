@extends('layouts.default')

@section('content')

    <h1>hello world</h1>

    <table>
        <tr>
            <th>Title</th>
            <th>Link</th>
            <th>Description</th>
        </tr>
    @foreach ($videos as $video)
        <tr>
            <td>{{ $video->title }}</td>
            <td>{{ $video->link }}</td>
            <td>{{ $video->description }}</td>
        </tr>
    @endforeach
    </table>

@stop