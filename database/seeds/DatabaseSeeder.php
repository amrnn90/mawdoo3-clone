<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'Amr Noman',
            'email' => 'amr@test.com',
            'password' => bcrypt('123123'),
        ]);

        Category::create([
            'name' => 'uncategorized'
        ]);
    }
}
