<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisSuratLainnya extends Model
{
    protected $table            = 'jenis_surat_lainnya';
    protected $primaryKey       = 'id_jenis_surat_lainnya';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_jenis_surat_lainnya', 'jenis_surat'];
}
