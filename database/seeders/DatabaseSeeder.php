<?php

namespace Database\Seeders;

use App\Models\ComplaintType;
use App\Models\Supllier;
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

        /*Random Customer Factory*/
        \App\Models\Customer::factory(10)->create();

        /*Random Manufacturer Factory*/
        \App\Models\Supplier::factory(10)->create();

        /*Department Seeder*/
        $this->call(DepartmentSeeder::class);

        /*Product Type Seeder*/
        $this->call(ProductTypeSeeder::class);

        /*Products Seeder*/
        $this->call(ProductSeeder::class);

        /*Raw Material Type Seeder*/
        $this->call(RawMaterialTypeSeeder::class);

        /*Machine Type Seeder*/
        $this->call(MachineTypeSeeder::class);

        /*Complaint Type Seeder*/
        $this->call(ComplaintTypeSeeder::class);

        if(App::environment('local')){
            $this->call([

         /*       UserSeeder::class,

                DepartmentSeeder::class,*/

            ]);
        }

    }
}
