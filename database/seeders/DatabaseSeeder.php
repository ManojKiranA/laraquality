<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Admin Seeder*/
        $this->call(UserSeeder::class);
        /*Random User Factory*/
        \App\Models\User::factory(30)->create();
        /*Department Seeder*/
        $this->call(DepartmentSeeder::class);
        /*Product Type Seeder*/
        $this->call(ProductTypeSeeder::class);


        if(App::environment('local')){
            $this->call([

         /*       UserSeeder::class,

                DepartmentSeeder::class,*/

            ]);
        }

    }
}
