<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use LRVM\Domain\User\User;

class UsersTableSeeder extends Seeder {

	public function run() {

        $users = [
            [
                'email'     => 'lareelstv@gmail.com',
                'password' => Hash::make('sexyouzo')
            ]
        ];

		foreach($users as $user)
			User::create($user);
	}

}