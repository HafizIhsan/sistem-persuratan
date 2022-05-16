<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratLainnya extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_lainnya' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_pengguna' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_jenis_surat_lainnya' => [
                'type'           => 'TINYINT',
                'constraint'     => 2
            ],
            'nomor_surat' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'pihak_1' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'pihak_2' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'tentang' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'scan_surat' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id_surat_lainnya', TRUE);

        $this->forge->createTable('surat_lainnya', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('surat_lainnya');
    }
}
