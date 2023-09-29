<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            'リモートワーク可',       // Remote Work Allowed
            'フルフレックス制',       // Full Flextime System
            'コアタイムなし',         // No Core Time
            '週休三日制',             // Three-Day Weekend
            '時短勤務あり',           // Shortened Work Hours
            '無限有給休暇',           // Unlimited Paid Leave
            'ドレスコードフリー',     // No Dress Code
            'フリーアドレス',         // Free Address (no assigned seats)
            '交通費全額支給',         // Full Commutation Allowance
            '昼寝可',                 // Napping Allowed
            '健康診断定期実施',       // Regular Health Check-ups
            '育休・産休制度あり',     // Maternity/Paternity Leave Available
            '研修・教育制度充実',     // Extensive Training and Education System
            '社内カフェあり',         // In-house Cafe Available
            '自社製品・サービス割引', // Discounts on Company Products/Services
            '社員旅行あり',           // Company Trips
            'ジョブローテーション制度', // Job Rotation System
            '社宅・住宅手当あり',     // Company Housing or Housing Allowance Available
            '持ち帰り業務禁止',         // No Take-home Work
            '成果主義評価'            // Performance-based Evaluation
        ];

        foreach ($features as $feature) {
            Feature::create([
                'name' => $feature,
            ]);
        }
    }
}
