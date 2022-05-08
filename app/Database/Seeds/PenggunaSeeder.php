<?php

namespace App\Database\Seeds;

use App\Models\M_Pengguna;
use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $pengguna_object = new M_Pengguna();

        $pengguna_object->insertBatch([
            [
                "id_role" => "1",
                "nama" => "Admin1",
                "nip" => "7899654125",
                "email" => "admin1@bps.go.id",
                "no_hp" => "081234567890",
                "password" => password_hash("admin1", PASSWORD_DEFAULT)
            ],
            [
                "id_role" => "2",
                "nama" => "Pegawai1",
                "nip" => "7899654125",
                "email" => "pegawai1@bps.go.id",
                "no_hp" => "081234567890",
                "password" => password_hash("pegawai1", PASSWORD_DEFAULT)
            ]
        ]);
    }
}
