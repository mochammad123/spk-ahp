<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;


class CriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Criteria::create([
            'criteria' => 'Proses Belajar Mengajar',
            'slug' => 'proses-belajar-mengajar'
        ]);

        Criteria::create([
            'criteria' => 'Lingkungan Sekolah',
            'slug' => 'lingkungan-sekolah'
        ]);

        Criteria::create([
            'criteria' => 'Pendidikan Kejuruan',
            'slug' => 'pendidikan-kejuruan'
        ]);

        Criteria::create([
            'criteria' => 'Akreditasi Sekolah',
            'slug' => 'akreditasi-sekolah'
        ]);

        Criteria::create([
            'criteria' => 'Biaya Sekolah',
            'slug' => 'biaya-sekolah'
        ]);

        Criteria::create([
            'criteria' => 'Lokasi Sekolah',
            'slug' => 'lokasi-sekolah'
        ]);

        Criteria::create([
            'criteria' => 'Fasilitas Sekolah',
            'slug' => 'fasilitas-sekolah'
        ]);
    }
}
