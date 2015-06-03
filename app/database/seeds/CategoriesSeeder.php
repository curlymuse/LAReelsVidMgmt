<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use LRVM\Domain\Category\Category;

class CategoriesTableSeeder extends Seeder {

    public function run() {

        //$faker = Faker::create();

        $cats = [
            'Adult', 'Comedy', 'Demo', 'Drama', 'Intense',
            'Arts & Culture', 'Audition Tape', 'Character Reel',
            'Food & Health', 'Short Film', 'Feature'
        ];

        foreach ($cats as $cat)
            Category::create(['title' => $cat]);

    }

}