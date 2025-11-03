<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Religions, Ranks, Echelons, Positions};

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        Model::unsetEventDispatcher();

        $religions = [
            ['name' => 'Islam'],
            ['name' => 'Kristen'],
            ['name' => 'Katolik'],
            ['name' => 'Hindu'],
            ['name' => 'Budha'],
            ['name' => 'Konghucu'],
        ];
        foreach ($religions as $religion) {
            Religions::create($religion);
        }

        $ranks = [
            ['code' => 'III/a', 'name' => 'Penata Muda'],
            ['code' => 'III/b', 'name' => 'Penata Muda Tk. I'],
            ['code' => 'IV/a', 'name' => 'Pembina'],
            ['code' => 'IV/e', 'name' => 'Pembina Utama'],
        ];
        foreach ($ranks as $rank) {
            Ranks::create($rank);
        }

        $echelons = [
            ['code' => 'I', 'name' => 'Eselon I'],
            ['code' => 'II', 'name' => 'Eselon II'],
            ['code' => 'III', 'name' => 'Eselon III'],
            ['code' => 'IV', 'name' => 'Eselon IV'],
        ];
        foreach ($echelons as $echelon) {
            Echelons::create($echelon);
        }

        $positions = [
            ['name' => 'Kepala Sekretariat Utama'],
            ['name' => 'Surveyor Pemetaan Muda'],
            ['name' => 'Analis Data Survei'],
            ['name' => 'Perancang Peraturan'],
        ];
        foreach ($positions as $position) {
            Positions::create($position);
        }
    }
}
