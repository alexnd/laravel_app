<?php
// php artisan db:seed --class=GamePlayersSeeder ( --force)

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GamePlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //DB::table('game_players')->delete();
        $users = [
            [
                'phone' => '0123456789',
                'username' => 'tester',
                'uri' => gen_uuid(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('game_players')->insert($users);
    }
}
