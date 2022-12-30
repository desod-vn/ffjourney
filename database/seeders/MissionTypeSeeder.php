<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MissionType;
use Carbon\Carbon;

class MissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            'Quan trọng',
            'Công việc',
            'Yêu thích',
            'Kế hoạch'
        ];
        $samples = array_map(function ($value) {
            return [
                'name' => $value,
                'is_default' => true,
            ];
        }, $list);
        MissionType::insert($samples);
    }
}
