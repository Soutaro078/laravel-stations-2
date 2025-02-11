<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sheet;

class SheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sheet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        static $seatNumber = 0;
        $rows = ['a', 'b', 'c']; // インデックス 0,1,2 のみ
        $seatIndex = $seatNumber % 5 + 1; // 1,2,3,4,5 のループ
        $rowIndex = intdiv($seatNumber, 5) % count($rows); //範囲外アクセス防止

        $seatNumber++;

        return [
            'column' => $seatIndex,
            'row' => $rows[$rowIndex], // 正しい範囲でアクセス
        ];



        // $rows = ['A', 'B', 'C'];
        // $columns = range(1, 5);

        // return [
        //     'row' => $this->faker->randomElement($rows),
        //     'column' => $this->faker->randomElement($columns),
        // ];
    }
}

