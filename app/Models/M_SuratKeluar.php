<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SuratKeluar extends Model
{
    protected $table            = 'surat_keluar';
    protected $primaryKey       = 'id_surat_keluar';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengguna', 'id_klasifikasi_surat', 'nomor_surat_keluar', 'penerima', 'penandatangan', 'perihal', 'keterangan', 'draft_surat_keluar', 'scan_surat_keluar', 'status', 'lampiran', 'created_at'];

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
