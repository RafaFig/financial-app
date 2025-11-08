<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        self::users()->each(fn($user) => User::store($user));
    }

    private static function users(): Collection
    {
        return collect([
            [
                'name' => 'Rafael Figueiredo de Faria',
                'email' => 'rafael.figueiredo4935@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'Bárbara da Silva Campos',
                'email' => 'silvabarbara750@gmail.com',
                'password' => Hash::make('12345678')
            ]
        ]);
    }
}
