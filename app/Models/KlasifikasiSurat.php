<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiSurat extends Model
{
    protected $table            = 'klasifikasi_surat';
    protected $primaryKey       = 'id_klasifikasi_surat';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kode', 'nomor_klasifikasi', 'keterangan'];
}
