<?php

namespace Database\Seeders;

use App\Models\Subcriteria;
use Illuminate\Database\Seeder;

class SubcriteriacomparisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcriteria::create([
            'criteria_id' => '1',
            'subcriteria' => 'Lebih dari 4 tahun',
            'description' => 'Sangat Baik',
            'slug' => 'lebih-dari-4-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '1',
            'subcriteria' => '3 sampai 4 tahun',
            'description' => 'Baik',
            'slug' => '3-sampai-4-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '1',
            'subcriteria' => '2 sampai 3 tahun',
            'description' => 'Cukup',
            'slug' => '2-sampai-3-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '1',
            'subcriteria' => '1 sampai 2 tahun',
            'description' => 'Kurang',
            'slug' => '1-sampai-2-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '1',
            'subcriteria' => 'Kurang dari 1 tahun',
            'description' => 'Sangat Kurang',
            'slug' => 'kurang-dari-1-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '2',
            'subcriteria' => 'Lebih dari 4 prestasi',
            'description' => 'Sangat Baik',
            'slug' => 'lebih-dari-4-prestasi'
        ]);

        Subcriteria::create([
            'criteria_id' => '2',
            'subcriteria' => '3 sampai 4 prestasi',
            'description' => 'Baik',
            'slug' => '3-sampai-4-prestasi'
        ]);

        Subcriteria::create([
            'criteria_id' => '2',
            'subcriteria' => '2 sampai 3 prestasi',
            'description' => 'Cukup',
            'slug' => '2-sampai-3-prestasi'
        ]);

        Subcriteria::create([
            'criteria_id' => '2',
            'subcriteria' => '1 sampai 2 prestasi',
            'description' => 'Kurang',
            'slug' => '1-sampai-2-prestasi'
        ]);

        Subcriteria::create([
            'criteria_id' => '2',
            'subcriteria' => 'Kurang dari 1 prestasi',
            'description' => 'Sangat Kurang',
            'slug' => 'kurang-dari-1-prestasi'
        ]);

        Subcriteria::create([
            'criteria_id' => '3',
            'subcriteria' => 'Lebih dari 4 tahun',
            'description' => 'Sangat Baik',
            'slug' => 'lebih-dari-4-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '3',
            'subcriteria' => '3 sampai 4 tahun',
            'description' => 'Baik',
            'slug' => '3-sampai-4-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '3',
            'subcriteria' => '2 sampai 3 tahun',
            'description' => 'Cukup',
            'slug' => '2-sampai-3-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '3',
            'subcriteria' => '1 sampai 2 tahun',
            'description' => 'Kurang',
            'slug' => '1-sampai-2-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '3',
            'subcriteria' => 'Kurang dari 1 tahun',
            'description' => 'Sangat Kurang',
            'slug' => 'kurang-dari-1-tahun'
        ]);

        Subcriteria::create([
            'criteria_id' => '4',
            'subcriteria' => 'Lebih dari 4 gelar',
            'description' => 'Sangat Baik',
            'slug' => 'lebih-dari-4-gelar'
        ]);

        Subcriteria::create([
            'criteria_id' => '4',
            'subcriteria' => '3 sampai 4 gelar',
            'description' => 'Baik',
            'slug' => '3-sampai-4-gelar'
        ]);

        Subcriteria::create([
            'criteria_id' => '4',
            'subcriteria' => '2 sampai 3 gelar',
            'description' => 'Cukup',
            'slug' => '2-sampai-3-gelar'
        ]);

        Subcriteria::create([
            'criteria_id' => '4',
            'subcriteria' => '1 sampai 2 gelar',
            'description' => 'Kurang',
            'slug' => '1-sampai-2-gelar'
        ]);

        Subcriteria::create([
            'criteria_id' => '4',
            'subcriteria' => 'Kurang dari 1 gelar',
            'description' => 'Sangat Kurang',
            'slug' => 'kurang-dari-1-gelar'
        ]);
    }
}
