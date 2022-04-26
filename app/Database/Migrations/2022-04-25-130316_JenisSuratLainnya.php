<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisSuratLainnya extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jenis_surat_lainnya' => [
                'type'           => 'TINYINT',
                'constraint'     => 2,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'jenis_surat' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20
            ],
        ]);

        $this->forge->addKey('id_jenis_surat_lainnya', TRUE);

        $this->forge->createTable('jenis_surat_lainnya', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_surat_lainnya');
    }
}
