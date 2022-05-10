<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SuratMasuk extends Model
{
    protected $table            = 'surat_masuk';
    protected $primaryKey       = 'id_surat_masuk';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengguna', 'nomor_surat_masuk', 'tanggal_terima', 'instansi_pengirim', 'perihal', 'scan_surat_masuk', 'uraian_penugasan', 'petugas', 'status', 'tenggat_penugasan', 'created_at'];

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
