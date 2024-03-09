<?php

use App\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'departement_id' => 1,
                'nik'            =>  static::nik(16),
                'name'           => 'Anton',
                'gender'         => 'Laki-laki',
                'phone'          => '0812459875',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 1,
                'nik'            => static::nik(16),
                'name'           => 'Riska',
                'gender'         => 'Perempuan',
                'phone'          => '0812645874512',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 2,
                'nik'            => static::nik(16),
                'name'           => 'Lia',
                'gender'         => 'Perempuan',
                'phone'          => '085289875455',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 3,
                'nik'            => static::nik(16),
                'name'           => 'Sarah',
                'gender'         => 'Perempuan',
                'phone'          => '085245896321',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 4,
                'nik'            => static::nik(16),
                'name'           => 'Salim',
                'gender'         => 'Laki-laki',
                'phone'          => '081245685412',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 4,
                'nik'            => static::nik(16),
                'name'           => 'Gerald',
                'gender'         => 'Laki-laki',
                'phone'          => '0878998246654',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 4,
                'nik'            => static::nik(16),
                'name'           => 'Mario',
                'gender'         => 'Laki-laki',
                'phone'          => '085466558987',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 2,
                'nik'            => static::nik(16),
                'name'           => 'Rahmat',
                'gender'         => 'Laki-laki',
                'phone'          => '081536745689',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 7,
                'nik'            => static::nik(16),
                'name'           => 'Maya',
                'gender'         => 'Perempuan',
                'phone'          => '085423649836',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
            [
                'departement_id' => 7,
                'nik'            => static::nik(16),
                'name'           => 'Ratih',
                'gender'         => 'Perempuan',
                'phone'          => '0813456378746',
                'status'         => 'active',
                'created_by'     => 1,
                'created_at'     => now(),
            ],
        ];

        Employee::insert($employee);
    }

    private function nik($digit)
    {
        $nik = '';
        for ($i = 0; $i <= $digit; $i++) {
            $nik .= mt_rand(0, 9);
        }
        return $nik;
    }
}
