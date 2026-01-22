<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      'Novel',
      'Komik',
      'Sastra',
      'Fiksi',
      'Non-Fiksi',
      'Pendidikan',
      'Sejarah',
      'Biografi',
      'Filosofi',
      'Psikologi',
    ];

    foreach ($categories as $category) {
      Category::create([
        'name' => $category,
      ]);
    }
  }
}
