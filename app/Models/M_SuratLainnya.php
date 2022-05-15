<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SuratLainnya extends Model
{
    protected $table            = 'surat_lainnya';
    protected $primaryKey       = 'id_surat_lainnya';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengguna', 'id_jenis_surat_lainnya', 'nomor_surat', 'pihak_1', 'pihak_2', 'tentang', 'scan_surat', 'created_at'];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
