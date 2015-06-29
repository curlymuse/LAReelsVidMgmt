<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>The Great Hollywood Adventure</title>
        <link>http://www.lareels.com</link>
        <description>
            The Great Hollywood Adventure features career advice and life hacks for actors, performers, and entrepreneurs from established industry guests. Join our hosts Brett Newton and Noah Edward from LA REELS as they take you an adventure like no other! To Hollywood and beyond!
            This is a free show where we interview casting directors, filmmakers, working actors, agents, managers, successful entrepreneurs and authors and share insights in the business of acting, filmmaking and entertaining as well as tips and tricks to lead a bigger, badder, better life.
        </description>
        <language>en-us</language>
        <copyright>LA REELS Copyright 2015</copyright>
        <atom:link href="{{ URL::route('podcasts.feed') }}" rel="self" type="application/rss+xml" />
        <itunes:author>LA REELS</itunes:author>
        <itunes:summary>
            The Great Hollywood Adventure features career advice and life hacks for actors, performers, and entrepreneurs from established industry guests. Join our hosts Brett Newton and Noah Edward from LA REELS as they take you an adventure like no other! To Hollywood and beyond!
            This is a free show where we interview casting directors, filmmakers, working actors, agents, managers, successful entrepreneurs and authors and share insights in the business of acting, filmmaking and entertaining as well as tips and tricks to lead a bigger, badder, better life.
        </itunes:summary>
        <itunes:owner>
            <itunes:name>LA REELS</itunes:name>
            <itunes:email>info@lareels.com</itunes:email>
        </itunes:owner>
        <itunes:explicit>Yes</itunes:explicit>
        <itunes:image href="{{ asset('img/podcast_logo.png') }}"/>
        <itunes:category text="TV &amp; Film">
        </itunes:category>
    @foreach ($podcasts as $podcast)
        <item>
            <title>{{ sprintf('%02d', $podcast->episode_number) }}: {{ $podcast->title }}</title>
            <link>{{ $podcast->getLinkToFile() }}</link>
            <pubDate>{{ $podcast->created_at->format('D, d M Y H:i:s') }} PST</pubDate>
            <enclosure url="{{ $podcast->getLinkToFile() }}" length="{{ $podcast->getLength() }}" type="audio/mpeg"/>
            <itunes:summary>{{ $podcast->description }}</itunes:summary>
            <itunes:duration>{{ $podcast->duration }}</itunes:duration>
            <itunes:subtitle>{{ $podcast->description }}</itunes:subtitle>
            <itunes:image href="{{ asset('img/podcast_logo.png') }}" />
        </item>
    @endforeach
    </channel>
</rss>