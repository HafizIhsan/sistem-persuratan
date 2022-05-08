<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengguna' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_role' => [
                'type'           => 'TINYINT',
                'constraint'     => 2
            ],
            'nama' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'nip' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'no_hp' => [
                'type'           => 'VARCHAR',
                'constraint'     => 15
            ],
        ]);

        $this->forge->addKey('id_pengguna', TRUE);

        $this->forge->createTable('pengguna', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('pengguna');
    }
}
