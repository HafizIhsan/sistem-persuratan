<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KategoriKlasifikasi extends Model
{
    protected $table            = 'kategori_klasifikasi';
    protected $primaryKey       = 'kode';
    protected $allowedFields    = ['kode', 'kategori'];
}
