<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use LRVM\Domain\Video\Video;

class VideosTableSeeder extends Seeder {

    protected static $_description = 'Here is the description.';

	public function run() {

		//$faker = Faker::create();

        $videos = [
            [
                'vimeo_id'  => '128435490',
                'title'     => 'LA REELS - Student - Character Reel',
                'description' => static::$_description
            ],
            [
                'vimeo_id'  => '128337234',
                'title'     => 'WEB ATLAS - "Maple & Elm" - Season 1 Ep.64',
                'description' => static::$_description
            ]
        ];

		foreach($videos as $video)
			Video::create($video);
	}

}