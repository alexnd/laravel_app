<?php
// php artisan db:seed --class=UsersSeeder ( --force)

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\UserRolesEnum;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('users')->delete();
        $users = [
            [
                'email' => 'admin@localhost',
                'name' => 'Admin',
                'password' => Hash::make('admin'),
                'remember_token' => Str::random(24),
                'role_id' => UserRolesEnum::ADMIN,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'customer@example.com',
                'name' => 'Customer',
                'password' => Hash::make('test'),
                'remember_token' => Str::random(24),
                'role_id' => UserRolesEnum::USER,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('users')->insert($users);
    }
}
