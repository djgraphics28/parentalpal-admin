<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MonthRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monthRanges = [
            ['month_range' => '0 - 2 Months'],
            ['month_range' => '2 - 4 Months'],
            ['month_range' => '4 - 6 Months'],
            ['month_range' => '6 - 9 Months'],
            ['month_range' => '9 - 12 Months'],
            ['month_range' => '12 - 15 Months'],
            ['month_range' => '15- 18 Months'],
            ['month_range' => '18mon - 2 Years'],
            ['month_range' => '2yrs - 2yrs 6mon'],
            ['month_range' => '2yrs 6mon - 3 Years'],
            ['month_range' => '3 Years  - 4 Years'],
            ['month_range' => '4 Years - 5 Years']
        ];

        // Insert the month ranges into the database
        DB::table('month_ranges')->insert($monthRanges);
    }
}
