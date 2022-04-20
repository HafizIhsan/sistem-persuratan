<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriKlasifikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 2,
                'unsigned'       => true
            ],
            'kategori' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
        ]);

        $this->forge->addKey('kode', TRUE);

        $this->forge->createTable('kategori_klasifikasi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kategori_klasifikasi');
    }
}
