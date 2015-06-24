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
        <th></th>
    </tr>
@foreach ($podcasts as $podcast)
    <tr>
        <td>{{ $podcast->episode_number }}</td>
        <td>{{ $podcast->title }}</td>
        <td>{{ $podcast->description }}</td>
        <td>{{ $podcast->filename }}</td>
        <td></td>
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