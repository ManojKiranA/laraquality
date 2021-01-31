<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Jetstream\CreateTeam;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;



class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Admin*/
        tap(User::create([
            'name' => 'Super Admin',
            'email' => 'admin@laraquality.dev',
            'password' => bcrypt('admin'),
            'collar_type'=>0,
            'manager_id'=>null,
            'citizen_id'=>'999987654320',
            'status'=>1,
            'starting_date'=>'2017-02-14 09:36:46',
            'birthday_date'=>'1987-09-03 23:45:00',
            'blood_group' => 2,
        ]), function (User $user) {
            (new CreateNewUser())->createTeam($user);
        });

    }
}
