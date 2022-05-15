<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_role' => [
                'type'           => 'TINYINT',
                'constraint'     => 2,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'jenis_pengguna' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20
            ],
        ]);

        $this->forge->addKey('id_role', TRUE);

        $this->forge->createTable('role', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('role');
    }
}
