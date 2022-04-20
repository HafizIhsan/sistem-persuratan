<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KlasifikasiSurat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_klasifikasi_surat'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'kode'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '2'
            ],
            'nomor_klasifikasi'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 6,
            ],
            'keterangan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
        ]);

        $this->forge->addKey('id_klasifikasi_surat', TRUE);

        $this->forge->createTable('klasifikasi_surat', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('klasifikasi_surat');
    }
}
