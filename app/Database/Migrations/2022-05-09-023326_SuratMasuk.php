<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_masuk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_pengguna' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'nomor_surat_masuk' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'tanggal_terima' => [
                'type'           => 'DATE'
            ],
            'instansi_pengirim' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'perihal' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'scan_surat_masuk' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'uraian_penugasan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'Petugas' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'tenggat_penugasan' => [
                'type'           => 'TIMESTAMP'
            ],
            'created_at' => [
                'type'           => 'TIMESTAMP'
            ]
        ]);

        $this->forge->addKey('id_surat_masuk', TRUE);

        $this->forge->createTable('surat_masuk', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('surat_masuk');
    }
}
