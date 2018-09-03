<?php

use App\Floor;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buildings = App\Models\Building::all();

        $floors = [
                '1' => [
                    ['name' => 'Kelder -1', 'viewbox' => '0 0 1280 650'],
                    ['name' => 'Gelijksvloers 0', 'viewbox' => '-150 -25 1600 1100'],
                    ['name' => 'Verdieping +1', 'viewbox' => '0 -150 1450 700'],
                    ['name' => 'Verdieping 2', 'viewbox' => '0 -150 1450 700'],
                    ['name' => 'Verdieping +3', 'viewbox' => '0 -150 1450 700'],
                ],
                '2' => [
                    ['name' => 'Gelijkvloers 0', 'viewbox' => '0 0 1225 780'],
                    ['name' => 'Verdieping +1', 'viewbox' => '0 0 1200 800'],
                    ['name' => 'Verdieping +2', 'viewbox' => '0 0 1200 550'],
                ],
                '3' => [
                    ['name' => 'Gelijkvloers 0', 'viewbox' => '-150 30 1025 715'],
                    ['name' => 'Verdieping +1', 'viewbox' => '-150 30 1025 715'],
                    ['name' => 'Verdieping +2', 'viewbox' => '-150 30 1025 715'],
                    ['name' => 'Verdieping +3', 'viewbox' => '-150 30 1025 715'],
                ],
                '4' => [],
                '5' => [],
            ];

        $buildings->each(function ($building) use ($floors) {
            foreach($floors[$building->id] as $floor) {
                $building->floors()->create($floor);
            }
        });
    }
}
