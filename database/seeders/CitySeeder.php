<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Vilnius',
            'description' => 'Vilnius – miestas, Lietuvos sostinė. Vilniaus apskrities, Vilniaus rajono savivaldybės ir Vilniaus miesto savivaldybės centras, yra 20 seniūnijų. Arkivyskupijos centras, nuo 1579 m. – universitetinis miestas. Sostinėje veikia aukščiausios valdžios institucijos – Lietuvos Respublikos prezidentūra, Lietuvos Seimas, Lietuvos Vyriausybė, ministerijos, Lietuvos Aukščiausiasis ir Konstitucinis teismai, užsienio valstybių ambasados ir atstovybės, diplomatinės misijos, tarptautinių organizacijų atstovybės.',
            'image_1' => 'vilnius1.jpg',
            'image_2' => 'vilnius2.jpg',
            'image_3' => 'vilnius3.jpg',
        ]);

        City::create([
            'name' => 'Kaunas',
            'description' => 'Kaunas – antrasis pagal dydį Lietuvos miestas šalies centrinėje dalyje, Nemuno ir Neries santakoje. Svarbus pramonės, transporto, mokslo ir kultūros centras, Laikinoji sostinė. Kauno miesto savivaldybė, Kauno rajono savivaldybės centras, katalikų arkivyskupijos centras. Yra 11 seniūnijų.',
            'image_1' => 'kaunas1.jpg',
            'image_2' => 'kaunas2.jpg',
            'image_3' => 'kaunas3.jpg',
        ]);

        City::create([
            'name' => 'Klaipėda',
            'description' => 'Klaipėda – trečias pagal gyventojų skaičių ir plotą Lietuvos miestas, įsikūręs Vakarų Lietuvoje, Pajūrio žemumoje, ties Kuršių marių ir Baltijos jūros santakos vieta. Klaipėdos miesto savivaldybė, miestas yra Klaipėdos apskrities administracinis centras. Svarbiausias Vakarų Lietuvos pramonės centras, kelių, geležinkelių ir jūrų transporto mazgas. 2019 m. pab. sudarytame savivaldybių gerovės indekso reitinge Klaipėdos miestui teko trečia vieta.',
            'image_1' => 'klaipeda1.jpg',
            'image_2' => 'klaipeda2.jpg',
            'image_3' => 'klaipeda3.jpg',
        ]);

        City::create([
            'name' => 'Šiauliai',
            'description' => 'Šiauliai – miestas šiaurės Lietuvoje, ketvirtasis pagal gyventojų skaičių šalies miestas. Šiaulių apskrities ir Šiaulių rajono savivaldybės administracinis centras, Šiaulių miesto savivaldybė. Šiauliai yra svarbus ekonominis ir susisiekimo centras, jame veikia Vilniaus universiteto Šiaulių akademija, miestas yra katalikiškos vyskupystės centras.',
            'image_1' => 'siauliai1.jpg',
            'image_2' => 'siauliai2.jpg',
            'image_3' => 'siauliai3.jpg',
        ]);

        City::create([
            'name' => 'Panevėžys',
            'description' => 'Panevėžys – šiaurės Lietuvos miestas, išsidėstęs abipus Nevėžio, Vidurio Lietuvos žemumoje, 136 km į šiaurės vakarus nuo Vilniaus. Penktasis pagal dydį Lietuvos miestas, Panevėžio rajono savivaldybės ir Panevėžio seniūnijos centras. Galinė Panevėžio–Rubikių siauruko stotis (Panevėžio geležinkelio stotis). Yra Panevėžio vyskupija, įvairių tikėjimų bažnyčių, cerkvių, veikia 7 pašto skyriai (centrinis LT-35001).',
            'image_1' => 'panevezys1.jpg',
            'image_2' => 'panevezys2.jpg',
            'image_3' => 'panevezys3.jpg',
        ]);
    }
}
