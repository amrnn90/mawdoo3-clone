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

        // Category::create([
        //     'name' => 'uncategorized'
        // ]);
        // factory('App\Category', 20)->create();
        
        factory('App\User', 20)->create();

        $category_names = ['الأسرة', 'فن الطهي', 'تغذية', 'الحياة والمجتمع', 'صحة', 'إسلام', 'الحمل والولادة', 'الزواج والحب', 'حول العالم', 'حيوانات ونباتات', 'تسلية وألعاب', 'تعليم', 'رياضة', 'العناية بالذات', 'الأدب', 'حكم وأقوال', 'مال وأعمال', 'علوم الأرض', 'سؤال وجواب', 'وزن ورشاقة', 'تقنية', 'قصص وحكايات', 'فنون'];

        foreach ($category_names as $category) {
            factory('App\Category')->create(['name' => $category]);
        }

        $categories = Category::all();
        for ($i=0; $i<100; $i++) {
            factory('App\Category')->create(['parent_id' => $categories->random()->id]);
        }

        factory('App\Post', 40)->create();
    }
}
