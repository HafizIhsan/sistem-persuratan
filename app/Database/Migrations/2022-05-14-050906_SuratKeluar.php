<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_keluar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_pengguna' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_klasifikasi_surat' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'no_urut' => [
                'type'           => 'INT',
                'constraint'     => 4
            ],
            'sub_no_urut' => [
                'type'           => 'INT',
                'constraint'     => 4
            ],
            'tanggal_surat' => [
                'type'           => 'DATE'
            ],
            'nomor_surat_keluar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'penerima' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'ttd' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'perihal' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'keterangan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'draft_surat_keluar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'scan_surat_keluar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id_surat_keluar', TRUE);

        $this->forge->createTable('surat_keluar', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('surat_keluar');
    }
}
