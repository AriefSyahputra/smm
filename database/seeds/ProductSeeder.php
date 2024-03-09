<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'sku'        => 'ATK-00001',
                'slug'       => 'ATK-00001',
                'name'       => 'Amplop A Coklat Jaya',
                'lokasi'     => 'L1-R1A',
                'satuan'     => 'pak',
                'status'     => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'sku'        => 'ATK-00002',
                'slug'       => 'ATK-00002',
                'name'       => 'Amplop B Hijau Jaya',
                'satuan'     => 'pak',
                'lokasi'     => 'L1-R1A',
                'status'     => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'sku'        => 'ATK-00003',
                'slug'       => 'ATK-00003',
                'name'       => 'Amplop C Merah Jaya',
                'satuan'     => 'pak',
                'lokasi'     => 'L1-R1A',
                'status'     => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'sku'        => 'ATK-00004',
                'slug'       => 'ATK-00004',
                'name'       => 'Amplop D Kuning Jaya',
                'satuan'     => 'pak',
                'lokasi'     => 'L1-R1A',
                'status'     => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'sku'        => 'ATK-00005',
                'slug'       => 'ATK-00005',
                'name'       => 'Amplop E Putih Jaya',
                'satuan'     => 'pak',
                'lokasi'     => 'L1-R1A',
                'status'     => 'active',
                'created_by' => 1,
                'created_at' => now(),
            ],
        ];

        Product::insert($product);
    }
}
