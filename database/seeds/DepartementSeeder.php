<?php

use App\Departement;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departement = [
            [
                'name' => 'Marketing',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Merchandising',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Sample',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Fabric',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Aksesoris & Trim',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'CAD',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Cutting',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Sewing',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Mekanik',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Finishing',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Packing',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
        ];

        Departement::insert($departement);
    }
}
