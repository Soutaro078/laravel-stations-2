<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sheet;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 15個のデータを Factory で作成
        Sheet::factory()->count(15)->create();
    }

    // public function run()
    // {
    //     $this->call([
    //         // ここに Seeder を追加する
    //     ]);
    // }
}
