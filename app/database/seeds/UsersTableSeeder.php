<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use LRVM\Domain\User\User;

class UsersTableSeeder extends Seeder {

	public function run() {

        $users = [
            [
                'email'     => 'test@test.com',
                'password' => Hash::make('123')
            ]
        ];

		foreach($users as $user)
			User::create($user);
	}

}