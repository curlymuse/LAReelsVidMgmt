<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use LRVM\Domain\Category\Category;

class CategoriesTableSeeder extends Seeder {

    public function run() {

        //$faker = Faker::create();

        //  Genres
        $cats = [
            'Comedy', 'Drama', 'Intense',
            'Action','Thriller','Spy','Nerd','School',
            'Military','Post-Apacolyptic','Kids ', 'Office',
            'Romance','Sci-Fi','Fantasy','Musical', 'Horror',
            'Suspense','Procedural','Lawyer', 'Political',
            'Cop','Villain','Family','Gritty','Hospital',
            'Dramedy','Comedy','Boyfriend/ Girlfriend',
            'Criminal','Bad Girl','Sitcom','Hero'
        ];
        foreach ($cats as $cat)
            Category::create(['title' => $cat]);

        $cats = [
            'Demo Reel', 'Short Film', 'Music Video'
        ];
        foreach ($cats as $cat)
            Category::create(['title' => $cat, 'is_primary' => true]);

    }

}