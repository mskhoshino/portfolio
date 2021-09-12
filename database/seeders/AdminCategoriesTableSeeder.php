<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdminCategory;
use Carbon\Carbon;

class AdminCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admincategory::truncate();
        Admincategory::create([
            'category_id' => 1,
            'category_name' => '日常会話'
        ]);

        Admincategory::create([
            'category_id' => 2,
            'category_name' => 'ビジネス'
        ]);

        Admincategory::create([
            'category_id' => 3,
            'category_name' => '旅行'
        ]);

        Admincategory::create([
            'category_id' => 4,
            'category_name' => 'その他'
        ]);
    }
}
