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
                'slug' => 'aceh-serambi-mekkah'
            ],
            [
                'name' => 'Sumatera Utara',
                'subtitle' => 'Tanah Batak',
                'latitude' => 2.115354,
                'longitude' => 99.545097,
                'slug' => 'sumatera-utara-tanah-batak'
            ],
            [
                'name' => 'Sumatera Barat',
                'subtitle' => 'Ranah Minang',
                'latitude' => -0.739939,
                'longitude' => 100.800005,
                'slug' => 'sumatera-barat-ranah-minang'
            ],
            [
                'name' => 'Riau',
                'subtitle' => 'Bumi Lancang Kuning',
                'latitude' => 0.293347,
                'longitude' => 101.706829,
                'slug' => 'riau-bumi-lancang-kuning'
            ],
            [
                'name' => 'Kepulauan Riau',
                'subtitle' => 'Bumi Segantang Lada',
                'latitude' => 0.916667,
                'longitude' => 104.45,
                'slug' => 'kepulauan-riau-bumi-segantang-lada'
            ],
            [
                'name' => 'Jambi',
                'subtitle' => 'Bumi Sepucuk Jambi Sembilan Lurah',
                'latitude' => -1.609972,
                'longitude' => 103.607254,
                'slug' => 'jambi-bumi-sepucuk-jambi'
            ],
            [
                'name' => 'Sumatera Selatan',
                'subtitle' => 'Bumi Sriwijaya',
                'latitude' => -3.319437,
                'longitude' => 103.914399,
                'slug' => 'sumatera-selatan-bumi-sriwijaya'
            ],
            [
                'name' => 'Bangka Belitung',
                'subtitle' => 'Bumi Serumpun Sebalai',
                'latitude' => -2.133333,
                'longitude' => 106.133333,
                'slug' => 'bangka-belitung-bumi-serumpun-sebalai'
            ],
            [
                'name' => 'Bengkulu',
                'subtitle' => 'Bumi Rafflesia',
                'latitude' => -3.795555,
                'longitude' => 102.259167,
                'slug' => 'bengkulu-bumi-rafflesia'
            ],
            [
                'name' => 'Lampung',
                'subtitle' => 'Bumi Ruwa Jurai',
                'latitude' => -5.429666,
                'longitude' => 105.262123,
                'slug' => 'lampung-bumi-ruwa-jurai'
            ],
            [
                'name' => 'DKI Jakarta',
                'subtitle' => 'Ibu Kota Negara',
                'latitude' => -6.208763,
                'longitude' => 106.845599,
                'slug' => 'dki-jakarta-ibu-kota-negara'
            ],
            [
                'name' => 'Banten',
                'subtitle' => 'Bumi Jawara',
                'latitude' => -6.405817,
                'longitude' => 106.064018,
                'slug' => 'banten-bumi-jawara'
            ],
            [
                'name' => 'Jawa Barat',
                'subtitle' => 'Tatar Sunda',
                'latitude' => -6.914744,
                'longitude' => 107.609811,
                'slug' => 'jawa-barat-tatar-sunda'
            ],
            [
                'name' => 'Jawa Tengah',
                'subtitle' => 'Jantung Budaya Jawa',
                'latitude' => -6.993214,
                'longitude' => 110.4229,
                'slug' => 'jawa-tengah-jantung-budaya-jawa'
            ],
            [
                'name' => 'DI Yogyakarta',
                'subtitle' => 'Kota Pelajar',
                'latitude' => -7.795579,
                'longitude' => 110.369489,
                'slug' => 'di-yogyakarta-kota-pelajar'
            ],
            [
                'name' => 'Jawa Timur',
                'subtitle' => 'Bumi Arek',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
                'slug' => 'jawa-timur-bumi-arek'
            ],
            [
                'name' => 'Bali',
                'subtitle' => 'Pulau Dewata',
                'latitude' => -8.409518,
                'longitude' => 115.188919,
                'slug' => 'bali-pulau-dewata'
            ],
            [
                'name' => 'Nusa Tenggara Barat',
                'subtitle' => 'Bumi Gora',
                'latitude' => -8.583333,
                'longitude' => 116.116667,
                'slug' => 'nusa-tenggara-barat-bumi-gora'
            ],
            [
                'name' => 'Nusa Tenggara Timur',
                'subtitle' => 'Bumi Flobamora',
                'latitude' => -8.583333,
                'longitude' => 120.95,
                'slug' => 'nusa-tenggara-timur-bumi-flobamora'
            ],
            [
                'name' => 'Kalimantan Barat',
                'subtitle' => 'Bumi Khatulistiwa',
                'latitude' => -0.016667,
                'longitude' => 109.333333,
                'slug' => 'kalimantan-barat-bumi-khatulistiwa'
            ],
            [
                'name' => 'Kalimantan Tengah',
                'subtitle' => 'Bumi Tambun Bungai',
                'latitude' => -2.216667,
                'longitude' => 113.916667,
                'slug' => 'kalimantan-tengah-bumi-tambun-bungai'
            ],
            [
                'name' => 'Kalimantan Selatan',
                'subtitle' => 'Bumi Lambung Mangkurat',
                'latitude' => -3.316667,
                'longitude' => 114.583333,
                'slug' => 'kalimantan-selatan-bumi-lambung-mangkurat'
            ],
            [
                'name' => 'Kalimantan Timur',
                'subtitle' => 'Bumi Etam',
                'latitude' => -0.502106,
                'longitude' => 117.153709,
                'slug' => 'kalimantan-timur-bumi-etam'
            ],
            [
                'name' => 'Kalimantan Utara',
                'subtitle' => 'Bumi Benuanta',
                'latitude' => 3.316667,
                'longitude' => 117.566667,
                'slug' => 'kalimantan-utara-bumi-benuanta'
            ],
            [
                'name' => 'Sulawesi Utara',
                'subtitle' => 'Bumi Nyiur Melambai',
                'latitude' => 1.493056,
                'longitude' => 124.841261,
                'slug' => 'sulawesi-utara-bumi-nyiur-melambai'
            ],
            [
                'name' => 'Gorontalo',
                'subtitle' => 'Bumi Serambi Madinah',
                'latitude' => 0.533333,
                'longitude' => 123.066667,
                'slug' => 'gorontalo-bumi-serambi-madinah'
            ],
            [
                'name' => 'Sulawesi Tengah',
                'subtitle' => 'Bumi Tadulako',
                'latitude' => -0.9,
                'longitude' => 119.783333,
                'slug' => 'sulawesi-tengah-bumi-tadulako'
            ],
            [
                'name' => 'Sulawesi Barat',
                'subtitle' => 'Bumi Mandar',
                'latitude' => -2.668611,
                'longitude' => 118.862222,
                'slug' => 'sulawesi-barat-bumi-mandar'
            ],
            [
                'name' => 'Sulawesi Selatan',
                'subtitle' => 'Bumi Panrita Lopi',
                'latitude' => -5.133333,
                'longitude' => 119.416667,
                'slug' => 'sulawesi-selatan-bumi-panrita-lopi'
            ],
            [
                'name' => 'Sulawesi Tenggara',
                'subtitle' => 'Bumi Anoa',
                'latitude' => -3.9675,
                'longitude' => 122.594722,
                'slug' => 'sulawesi-tenggara-bumi-anoa'
            ],
            [
                'name' => 'Maluku',
                'subtitle' => 'Bumi Seribu Pulau',
                'latitude' => -3.238462,
                'longitude' => 130.145273,
                'slug' => 'maluku-bumi-seribu-pulau'
            ],
            [
                'name' => 'Maluku Utara',
                'subtitle' => 'Bumi Kie Raha',
                'latitude' => 0.783333,
                'longitude' => 127.366667,
                'slug' => 'maluku-utara-bumi-kie-raha'
            ],
            [
                'name' => 'Papua',
                'subtitle' => 'Bumi Cenderawasih',
                'latitude' => -2.533333,
                'longitude' => 140.716667,
                'slug' => 'papua-bumi-cenderawasih'
            ],
            [
                'name' => 'Papua Barat',
                'subtitle' => 'Bumi Kasuari',
                'latitude' => -0.866667,
                'longitude' => 134.083333,
                'slug' => 'papua-barat-bumi-kasuari'
            ],
        ];

        foreach ($provinces as $province) {
            StoryProvince::create($province);
        }
    }
} 