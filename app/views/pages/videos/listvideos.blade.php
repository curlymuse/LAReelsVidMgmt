@extends('layouts.default')

@section('content')

    <h1>Vimeo Videos List</h1>

    <p>
        <a class="btn btn-primary" href="{{ URL::route('videos.create') }}" role="button">Add New Video</a>
    </p>

    <div>
        {{ $videos->links() }}
    </div>

    <table class="table table-bordered table-striped">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Link</th>
            <th>Tags</th>
            <th>Thumbnail</th>
        </tr>
    @foreach ($videos as $video)
        <tr>
            <td>{{ $video->id }}.</td>
            <td>{{ $video->title }}</td>
            <td>{{ link_to($video->getLink(), $video->getLink()) }}</td>
            <td class="cat-set" id="v_{{ $video->id}}" data-video-id="{{ $video->id }}" data-orig-cats='{{ json_encode($video->categories()->lists('category_id')) }}'>
            @foreach ($categories as $cat)
                <button type="button" class="btn cat-button" data-toggle="button" aria-pressed="false" autocomplete="off" data-category-id="{{ $cat->id }}">
                    {{ $cat->title }}
                </button>
            @endforeach
                <br/>
                <p class="pull-right">
                    <button type="button" class="btn btn-xs btn-success statusButton" aria-pressed="false" disabled="disabled" data-video-id="{{ $video->id }}">Synced</button>
                </p>
            </td>
            <td><img class="img-rounded" src="{{ $video->thumbnail_url }}" /></td>
        </tr>
    @endforeach
    </table>

    <div>
        {{ $videos->links() }}
    </div>

    <script type="text/javascript" src="js/VideoList.class.js"></script>
    <script>
        $(document).ready(function(){
            new VideoList({
                'url_category_update': '{{ URL::route('categories.update') }}'
            });
        });
    </script>

@stop