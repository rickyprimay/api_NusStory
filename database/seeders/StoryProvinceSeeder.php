<?php

namespace Database\Seeders;

use App\Models\StoryProvince;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoryProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            [
                'name' => 'Aceh',
                'subtitle' => 'Serambi Mekkah',
                'latitude' => 4.695135,
                'longitude' => 96.749399,
            ],
            [
                'name' => 'Sumatera Utara',
                'subtitle' => 'Tanah Batak',
                'latitude' => 2.115354,
                'longitude' => 99.545097,
            ],
            [
                'name' => 'Sumatera Barat',
                'subtitle' => 'Ranah Minang',
                'latitude' => -0.739939,
                'longitude' => 100.800005,
            ],
            [
                'name' => 'Riau',
                'subtitle' => 'Bumi Lancang Kuning',
                'latitude' => 0.293347,
                'longitude' => 101.706829,
            ],
            [
                'name' => 'Kepulauan Riau',
                'subtitle' => 'Bumi Segantang Lada',
                'latitude' => 0.916667,
                'longitude' => 104.45,
            ],
            [
                'name' => 'Jambi',
                'subtitle' => 'Bumi Sepucuk Jambi Sembilan Lurah',
                'latitude' => -1.609972,
                'longitude' => 103.607254,
            ],
            [
                'name' => 'Sumatera Selatan',
                'subtitle' => 'Bumi Sriwijaya',
                'latitude' => -3.319437,
                'longitude' => 103.914399,
            ],
            [
                'name' => 'Bangka Belitung',
                'subtitle' => 'Bumi Serumpun Sebalai',
                'latitude' => -2.133333,
                'longitude' => 106.133333,
            ],
            [
                'name' => 'Bengkulu',
                'subtitle' => 'Bumi Rafflesia',
                'latitude' => -3.795555,
                'longitude' => 102.259167,
            ],
            [
                'name' => 'Lampung',
                'subtitle' => 'Bumi Ruwa Jurai',
                'latitude' => -5.429666,
                'longitude' => 105.262123,
            ],
            [
                'name' => 'DKI Jakarta',
                'subtitle' => 'Ibu Kota Negara',
                'latitude' => -6.208763,
                'longitude' => 106.845599,
            ],
            [
                'name' => 'Banten',
                'subtitle' => 'Bumi Jawara',
                'latitude' => -6.405817,
                'longitude' => 106.064018,
            ],
            [
                'name' => 'Jawa Barat',
                'subtitle' => 'Tatar Sunda',
                'latitude' => -6.914744,
                'longitude' => 107.609811,
            ],
            [
                'name' => 'Jawa Tengah',
                'subtitle' => 'Jantung Budaya Jawa',
                'latitude' => -6.993214,
                'longitude' => 110.4229,
            ],
            [
                'name' => 'DI Yogyakarta',
                'subtitle' => 'Kota Pelajar',
                'latitude' => -7.795579,
                'longitude' => 110.369489,
            ],
            [
                'name' => 'Jawa Timur',
                'subtitle' => 'Bumi Arek',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
            ],
            [
                'name' => 'Bali',
                'subtitle' => 'Pulau Dewata',
                'latitude' => -8.409518,
                'longitude' => 115.188919,
            ],
            [
                'name' => 'Nusa Tenggara Barat',
                'subtitle' => 'Bumi Gora',
                'latitude' => -8.583333,
                'longitude' => 116.116667,
            ],
            [
                'name' => 'Nusa Tenggara Timur',
                'subtitle' => 'Bumi Flobamora',
                'latitude' => -8.583333,
                'longitude' => 120.95,
            ],
            [
                'name' => 'Kalimantan Barat',
                'subtitle' => 'Bumi Khatulistiwa',
                'latitude' => -0.016667,
                'longitude' => 109.333333,
            ],
            [
                'name' => 'Kalimantan Tengah',
                'subtitle' => 'Bumi Tambun Bungai',
                'latitude' => -2.216667,
                'longitude' => 113.916667,
            ],
            [
                'name' => 'Kalimantan Selatan',
                'subtitle' => 'Bumi Lambung Mangkurat',
                'latitude' => -3.316667,
                'longitude' => 114.583333,
            ],
            [
                'name' => 'Kalimantan Timur',
                'subtitle' => 'Bumi Etam',
                'latitude' => -0.502106,
                'longitude' => 117.153709,
            ],
            [
                'name' => 'Kalimantan Utara',
                'subtitle' => 'Bumi Benuanta',
                'latitude' => 3.316667,
                'longitude' => 117.566667,
            ],
            [
                'name' => 'Sulawesi Utara',
                'subtitle' => 'Bumi Nyiur Melambai',
                'latitude' => 1.493056,
                'longitude' => 124.841261,
            ],
            [
                'name' => 'Gorontalo',
                'subtitle' => 'Bumi Serambi Madinah',
                'latitude' => 0.533333,
                'longitude' => 123.066667,
            ],
            [
                'name' => 'Sulawesi Tengah',
                'subtitle' => 'Bumi Tadulako',
                'latitude' => -0.9,
                'longitude' => 119.783333,
            ],
            [
                'name' => 'Sulawesi Barat',
                'subtitle' => 'Bumi Mandar',
                'latitude' => -2.668611,
                'longitude' => 118.862222,
            ],
            [
                'name' => 'Sulawesi Selatan',
                'subtitle' => 'Bumi Panrita Lopi',
                'latitude' => -5.133333,
                'longitude' => 119.416667,
            ],
            [
                'name' => 'Sulawesi Tenggara',
                'subtitle' => 'Bumi Anoa',
                'latitude' => -3.9675,
                'longitude' => 122.594722,
            ],
            [
                'name' => 'Maluku',
                'subtitle' => 'Bumi Seribu Pulau',
                'latitude' => -3.238462,
                'longitude' => 130.145273,
            ],
            [
                'name' => 'Maluku Utara',
                'subtitle' => 'Bumi Kie Raha',
                'latitude' => 0.783333,
                'longitude' => 127.366667,
            ],
            [
                'name' => 'Papua',
                'subtitle' => 'Bumi Cenderawasih',
                'latitude' => -2.533333,
                'longitude' => 140.716667,
            ],
            [
                'name' => 'Papua Barat',
                'subtitle' => 'Bumi Kasuari',
                'latitude' => -0.866667,
                'longitude' => 134.083333,
            ],
        ];

        foreach ($provinces as $province) {
            $province['slug'] = Str::slug($province['name']);
            StoryProvince::create($province);
        }
    }
} 