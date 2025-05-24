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
                'subtitle' => 'Provinsi paling barat Indonesia dengan kekayaan budaya Islam yang kuat dan keindahan alam yang memukau',
                'latitude' => 4.695135,
                'longitude' => 96.749399,
                'slug' => 'aceh-serambi-mekkah'
            ],
            [
                'name' => 'Sumatera Utara',
                'subtitle' => 'Rumah bagi suku Batak dengan Danau Toba sebagai destinasi wisata utama dan kekayaan budaya yang beragam',
                'latitude' => 2.115354,
                'longitude' => 99.545097,
                'slug' => 'sumatera-utara-tanah-batak'
            ],
            [
                'name' => 'Sumatera Barat',
                'subtitle' => 'Pusat budaya Minangkabau dengan rumah gadang, rendang, dan keindahan alam yang memukau',
                'latitude' => -0.739939,
                'longitude' => 100.800005,
                'slug' => 'sumatera-barat-ranah-minang'
            ],
            [
                'name' => 'Riau',
                'subtitle' => 'Pusat industri minyak dan perkebunan kelapa sawit dengan kekayaan budaya Melayu yang kaya',
                'latitude' => 0.293347,
                'longitude' => 101.706829,
                'slug' => 'riau-bumi-lancang-kuning'
            ],
            [
                'name' => 'Kepulauan Riau',
                'subtitle' => 'Gugusan pulau indah dengan potensi wisata bahari dan perdagangan internasional',
                'latitude' => 0.916667,
                'longitude' => 104.45,
                'slug' => 'kepulauan-riau-bumi-segantang-lada'
            ],
            [
                'name' => 'Jambi',
                'subtitle' => 'Pusat peradaban Melayu kuno dengan kekayaan alam dan budaya yang beragam',
                'latitude' => -1.609972,
                'longitude' => 103.607254,
                'slug' => 'jambi-bumi-sepucuk-jambi'
            ],
            [
                'name' => 'Sumatera Selatan',
                'subtitle' => 'Pusat Kerajaan Sriwijaya dengan kekayaan budaya dan kuliner yang khas',
                'latitude' => -3.319437,
                'longitude' => 103.914399,
                'slug' => 'sumatera-selatan-bumi-sriwijaya'
            ],
            [
                'name' => 'Bangka Belitung',
                'subtitle' => 'Gugusan pulau dengan pantai-pantai indah dan tambang timah yang melimpah',
                'latitude' => -2.133333,
                'longitude' => 106.133333,
                'slug' => 'bangka-belitung-bumi-serumpun-sebalai'
            ],
            [
                'name' => 'Bengkulu',
                'subtitle' => 'Rumah bagi bunga Rafflesia arnoldii dan kekayaan alam yang melimpah',
                'latitude' => -3.795555,
                'longitude' => 102.259167,
                'slug' => 'bengkulu-bumi-rafflesia'
            ],
            [
                'name' => 'Lampung',
                'subtitle' => 'Pintu gerbang Sumatera dengan kekayaan budaya dan alam yang beragam',
                'latitude' => -5.429666,
                'longitude' => 105.262123,
                'slug' => 'lampung-bumi-ruwa-jurai'
            ],
            [
                'name' => 'DKI Jakarta',
                'subtitle' => 'Ibu kota Indonesia dengan pusat pemerintahan, bisnis, dan budaya yang dinamis',
                'latitude' => -6.208763,
                'longitude' => 106.845599,
                'slug' => 'dki-jakarta-ibu-kota-negara'
            ],
            [
                'name' => 'Banten',
                'subtitle' => 'Pintu gerbang barat Jawa dengan kekayaan sejarah dan budaya yang kaya',
                'latitude' => -6.405817,
                'longitude' => 106.064018,
                'slug' => 'banten-bumi-jawara'
            ],
            [
                'name' => 'Jawa Barat',
                'subtitle' => 'Pusat budaya Sunda dengan keindahan alam dan kekayaan budaya yang beragam',
                'latitude' => -6.914744,
                'longitude' => 107.609811,
                'slug' => 'jawa-barat-tatar-sunda'
            ],
            [
                'name' => 'Jawa Tengah',
                'subtitle' => 'Jantung budaya Jawa dengan warisan sejarah dan budaya yang kaya',
                'latitude' => -6.993214,
                'longitude' => 110.4229,
                'slug' => 'jawa-tengah-jantung-budaya-jawa'
            ],
            [
                'name' => 'DI Yogyakarta',
                'subtitle' => 'Pusat budaya dan pendidikan dengan warisan kerajaan yang kaya',
                'latitude' => -7.795579,
                'longitude' => 110.369489,
                'slug' => 'di-yogyakarta-kota-pelajar'
            ],
            [
                'name' => 'Jawa Timur',
                'subtitle' => 'Pusat industri dan budaya dengan kekayaan alam dan sejarah yang beragam',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
                'slug' => 'jawa-timur-bumi-arek'
            ],
            [
                'name' => 'Bali',
                'subtitle' => 'Pulau dengan budaya Hindu yang kaya dan destinasi wisata internasional',
                'latitude' => -8.409518,
                'longitude' => 115.188919,
                'slug' => 'bali-pulau-dewata'
            ],
            [
                'name' => 'Nusa Tenggara Barat',
                'subtitle' => 'Rumah bagi suku Sasak dengan keindahan alam dan budaya yang unik',
                'latitude' => -8.583333,
                'longitude' => 116.116667,
                'slug' => 'nusa-tenggara-barat-bumi-gora'
            ],
            [
                'name' => 'Nusa Tenggara Timur',
                'subtitle' => 'Gugusan pulau dengan keanekaragaman budaya dan keindahan alam yang memukau',
                'latitude' => -8.583333,
                'longitude' => 120.95,
                'slug' => 'nusa-tenggara-timur-bumi-flobamora'
            ],
            [
                'name' => 'Kalimantan Barat',
                'subtitle' => 'Pusat budaya Dayak dengan kekayaan alam dan hutan yang melimpah',
                'latitude' => -0.016667,
                'longitude' => 109.333333,
                'slug' => 'kalimantan-barat-bumi-khatulistiwa'
            ],
            [
                'name' => 'Kalimantan Tengah',
                'subtitle' => 'Rumah bagi suku Dayak dengan hutan tropis dan kekayaan alam yang berlimpah',
                'latitude' => -2.216667,
                'longitude' => 113.916667,
                'slug' => 'kalimantan-tengah-bumi-tambun-bungai'
            ],
            [
                'name' => 'Kalimantan Selatan',
                'subtitle' => 'Pusat budaya Banjar dengan kekayaan alam dan sejarah yang kaya',
                'latitude' => -3.316667,
                'longitude' => 114.583333,
                'slug' => 'kalimantan-selatan-bumi-lambung-mangkurat'
            ],
            [
                'name' => 'Kalimantan Timur',
                'subtitle' => 'Pusat industri migas dan pertambangan dengan kekayaan alam yang melimpah',
                'latitude' => -0.502106,
                'longitude' => 117.153709,
                'slug' => 'kalimantan-timur-bumi-etam'
            ],
            [
                'name' => 'Kalimantan Utara',
                'subtitle' => 'Provinsi termuda di Kalimantan dengan potensi sumber daya alam yang besar',
                'latitude' => 3.316667,
                'longitude' => 117.566667,
                'slug' => 'kalimantan-utara-bumi-benuanta'
            ],
            [
                'name' => 'Sulawesi Utara',
                'subtitle' => 'Pusat budaya Minahasa dengan keindahan alam dan kuliner yang khas',
                'latitude' => 1.493056,
                'longitude' => 124.841261,
                'slug' => 'sulawesi-utara-bumi-nyiur-melambai'
            ],
            [
                'name' => 'Gorontalo',
                'subtitle' => 'Pusat budaya Gorontalo dengan kekayaan alam dan budaya yang unik',
                'latitude' => 0.533333,
                'longitude' => 123.066667,
                'slug' => 'gorontalo-bumi-serambi-madinah'
            ],
            [
                'name' => 'Sulawesi Tengah',
                'subtitle' => 'Rumah bagi suku Kaili dengan keindahan alam dan budaya yang beragam',
                'latitude' => -0.9,
                'longitude' => 119.783333,
                'slug' => 'sulawesi-tengah-bumi-tadulako'
            ],
            [
                'name' => 'Sulawesi Barat',
                'subtitle' => 'Pusat budaya Mandar dengan keindahan alam dan budaya yang kaya',
                'latitude' => -2.668611,
                'longitude' => 118.862222,
                'slug' => 'sulawesi-barat-bumi-mandar'
            ],
            [
                'name' => 'Sulawesi Selatan',
                'subtitle' => 'Pusat budaya Bugis-Makassar dengan kekayaan maritim dan budaya yang kuat',
                'latitude' => -5.133333,
                'longitude' => 119.416667,
                'slug' => 'sulawesi-selatan-bumi-panrita-lopi'
            ],
            [
                'name' => 'Sulawesi Tenggara',
                'subtitle' => 'Pusat budaya Buton dengan keindahan alam dan budaya yang beragam',
                'latitude' => -3.9675,
                'longitude' => 122.594722,
                'slug' => 'sulawesi-tenggara-bumi-anoa'
            ],
            [
                'name' => 'Maluku',
                'subtitle' => 'Gugusan pulau rempah dengan kekayaan budaya dan sejarah yang kaya',
                'latitude' => -3.238462,
                'longitude' => 130.145273,
                'slug' => 'maluku-bumi-seribu-pulau'
            ],
            [
                'name' => 'Maluku Utara',
                'subtitle' => 'Pusat perdagangan rempah dengan kekayaan budaya dan sejarah yang unik',
                'latitude' => 0.783333,
                'longitude' => 127.366667,
                'slug' => 'maluku-utara-bumi-kie-raha'
            ],
            [
                'name' => 'Papua',
                'subtitle' => 'Pulau terbesar kedua di Indonesia dengan keanekaragaman budaya dan alam yang luar biasa',
                'latitude' => -2.533333,
                'longitude' => 140.716667,
                'slug' => 'papua-bumi-cenderawasih'
            ],
            [
                'name' => 'Papua Barat',
                'subtitle' => 'Rumah bagi suku Arfak dengan kekayaan alam dan budaya yang unik',
                'latitude' => -0.866667,
                'longitude' => 134.083333,
                'slug' => 'papua-barat-bumi-kasuari'
            ],
            [
                'name' => 'Papua Tengah',
                'subtitle' => 'Provinsi baru di jantung Papua dengan kekayaan alam dan budaya yang beragam',
                'latitude' => -2.533333,
                'longitude' => 138.716667,
                'slug' => 'papua-tengah-bumi-mulia'
            ],
            [
                'name' => 'Papua Pegunungan',
                'subtitle' => 'Rumah bagi suku Dani dengan keindahan alam pegunungan yang memukau',
                'latitude' => -4.083333,
                'longitude' => 138.083333,
                'slug' => 'papua-pegunungan-bumi-ugem'
            ],
            [
                'name' => 'Papua Selatan',
                'subtitle' => 'Provinsi dengan kekayaan alam dan budaya yang unik di selatan Papua',
                'latitude' => -5.466667,
                'longitude' => 140.333333,
                'slug' => 'papua-selatan-bumi-sagu'
            ],
        ];

        foreach ($provinces as $province) {
            StoryProvince::create($province);
        }
    }
} 