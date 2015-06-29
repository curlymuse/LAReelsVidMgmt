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
        <th>Duration</th>
        <th>Linked?</th>
        <th></th>
        <th></th>
    </tr>
@foreach ($podcasts as $podcast)
    <tr>
        <td>{{ sprintf('%02d', $podcast->episode_number) }}</td>
        <td>
            <a href="{{ URL::route('podcasts.show', $podcast->id) }}">{{ $podcast->title }}</a></td>
        <td>{{ $podcast->description }}</td>
        <td>{{ $podcast->duration }}</td>
        <td>
            @if ($podcast->filename)
                {{ $podcast->filename }}
            @else
                <a href="{{ URL::route('podcasts.link', $podcast->id) }}"><button class="btn btn-xs btn-primary">Link</button></a>
            @endif
        </td>
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