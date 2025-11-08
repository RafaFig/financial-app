<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        self::accounts()->each(fn(string $name) => Account::create([
            'name' => $name,
        ]));
    }

    private static function accounts(): Collection
    {
        return collect([
            'Rafael',
            'Bárbara'
        ]);
    }
}
