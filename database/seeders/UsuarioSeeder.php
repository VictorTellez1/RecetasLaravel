<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name'=>'Victor',
            'email'=>'victor-pumas69@live.com.mx',
            'password'=>Hash::make('12345678'),
            'url'=>'http://google.com',
        ]);

        $user=User::create([
            'name'=>'Pepe',
            'email'=>'pepe@gmail.com',
            'password'=>Hash::make('12345678'),
            'url'=>'http://google.com',
        ]);

    }
}
