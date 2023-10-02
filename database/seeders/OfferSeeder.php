<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 25) as $_) {
            Offer::create([
                'name' => 'Offer Name ' . str::random(5),
                'company_id' => rand(1, 3),
                'description' => 'Description ' . str::random(50),
                'requirements' => 'Requirements ' . str::random(50),
                'benefits' => 'Benefits ' . str::random(50),
            ]);
        }

        $featureCount = DB::table('features')->count();

        foreach (range(1, 25) as $offerId) {
            $featuresToAttach = rand(1, $featureCount);
            $features = [];

            foreach (range(1, $featuresToAttach) as $_) {
                $features[] = rand(1, $featureCount);
            }

            DB::table('feature_offer')->insert([
                'offer_id' => $offerId,
                'feature_id' => array_rand(array_flip($features), 1),
            ]);
        }
    }
}