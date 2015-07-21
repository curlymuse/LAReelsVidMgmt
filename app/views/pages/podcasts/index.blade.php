@extends('layouts.default')

@section('content')

    <div class="pull-right" style="padding-top:15px;">
        RSS Feed:
        @if ($validFeed)
            <button class="btn btn-success btn-xs" disabled="disabled">All Good</button>
        @else
            <button class="btn btn-danger btn-xs" disabled="disabled">Error</button>
        @endif
    </div>

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
        <th>Image</th>
        <th>Duration</th>
        <th>Linked?</th>
        <th>Hits</th>
        <th></th>
        <th></th>
    </tr>
@foreach ($podcasts as $podcast)
    <tr>
        <td>{{ sprintf('%02d', $podcast->episode_number) }}</td>
        <td>
            <a href="{{ $podcast->getLinkToFile() }}">{{ $podcast->title }}</a></td>
        <td>{{ $podcast->description }}</td>
        <td>
        @if ($podcast->episode_image)
            <img class="img-rounded" style="width:40px;" src="{{ $podcast->episode_image }}" />
        @endif
        </td>
        <td>{{ $podcast->duration }}</td>
        <td>
            @if ($podcast->filename)
                {{ $podcast->filename }}
            @else
                <a href="{{ URL::route('podcasts.link', $podcast->id) }}"><button class="btn btn-xs btn-primary">Link</button></a>
            @endif
        </td>
        <td>{{ $podcast->getUniqueHits() }}</td>
        <td style="text-align:center;"><a href="{{ URL::route('podcasts.edit', $podcast->id) }}">Edit</a></td>
        <td style="text-align:center;">
            <button type="button" class="btn btn-xs btn-{{ ($podcast->is_published) ? 'success' : 'danger' }} publish-button" aria-pressed="false" data-podcast-id="{{ $podcast->id }}" id="pub_{{ $podcast->id }}">
                {{ $podcast->getPublishedStatus() }}
            </button>
        </td>
    </tr>
@endforeach
</table>
<script type="text/javascript" src="js/PodcastManage.class.js"></script>
<script>
    $(document).ready(function(){
        new PodcastManage({
            'url_toggle_publish': '{{ URL::route('podcasts.togglePublish') }}',
        });
    });
</script>


@stop