<?php

namespace Database\Seeders;

use App\Models\Payer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::payers()->each(fn(string $payer) => Payer::create(['name' => $payer]));
    }

    private static function payers(): Collection
    {
        return collect([
            'Rafael',
            'Bárbara',
            'Maria do Carmo',
            'Deusdará',
            'Ronilda'
        ]);
    }
}
