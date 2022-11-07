<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор неизвестен',
                'email' => 'author_unknown@g.g',
                'password' => bcrypt(Str::random()),
            ],
            [
                'name' => 'Автор',
                'email' => 'author_1@g.g',
                'password' => bcrypt('123456'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
