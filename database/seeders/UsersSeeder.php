<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'phone'     => '081999295392',
            'password'  => bcrypt('cobadiuji'),
        ]);
        $admin->assignRole('admin');
    }
}
