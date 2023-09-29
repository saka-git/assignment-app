<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Industry;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = ['メーカー', '小売', 'サービス', 'IT', '金融', '不動産', '建設', '運輸', '医療', '教育', '公務員', 'その他'];

        foreach ($industries as $industry) {
            Industry::create([
                'name' => $industry,
            ]);
        }
    }
}
