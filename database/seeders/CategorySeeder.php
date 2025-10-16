<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::categories()->each(fn(array $category) => Category::create([
            'name' => Arr::get($category, 'name'),
            'type' => Arr::get($category, 'type'),
        ]));
    }

    private static function categories(): Collection
    {
        return collect([
            [
                'name' => 'Financiamento',
                'type' => 'expense'
            ],
            [
                'name' => 'Salário',
                'type' => 'income'
            ],
        ]);
    }
}
