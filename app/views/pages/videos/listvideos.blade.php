@extends('layouts.default')

@section('content')

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
            <td>
                {{ $video->title }}<br/><br/>
                <button type="button" class="btn btn-xs btn-{{ ($video->is_public) ? 'success' : 'danger' }} public-button" aria-pressed="false" data-video-id="{{ $video->id }}" id="pub_{{ $video->id }}">
                    {{ $video->getPublicStatus() }}
                </button>
            </td>
            <td>
                <a href="{{ $video->getLink() }}" target="_blank">{{ $video->getLink() }}</a><br/><br/>
            @if ($video->uploaded_at)
                (uploaded on {{ $video->uploaded_at->format('M d, Y') }})
            @endif
            </td>
            </td>
            <td class="cat-set" id="v_{{ $video->id}}" data-video-id="{{ $video->id }}" data-orig-cats='{{ json_encode($video->categories()->lists('category_id')) }}'>
            @foreach ($primary as $cat)
                <button type="button" class="btn btn-sm cat-button" data-toggle="button" aria-pressed="false" autocomplete="off" data-category-id="{{ $cat->id }}">
                    {{ $cat->title }}
                </button>
            @endforeach
                <hr/>
            @foreach ($genres as $cat)
                <button type="button" class="btn btn-sm cat-button" data-toggle="button" aria-pressed="false" autocomplete="off" data-category-id="{{ $cat->id }}">
                    {{ $cat->title }}
                </button>
            @endforeach
                <br/><br/>
                <p class="pull-right">
                    <button type="button" class="btn btn-xs btn-success statusButton" aria-pressed="false" disabled="disabled" data-video-id="{{ $video->id }}">Saved</button>
                </p>
            </td>
            <td>
                <img class="img-rounded" src="{{ $video->thumbnail_url }}" /><br/><br/>
                @if (!$video->wordpress_post_id)
                    <button type="button" class="btn btn-xs btn-primary" aria-pressed="false" disabled="disabled">New!</button>
                @endif
            </td>
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
                'url_category_update': '{{ URL::route('categories.update') }}',
                'url_public_update': '{{ URL::route('videos.updatePublic') }}'
            });
        });
    </script>

@stop