<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiSurat extends Model
{
    protected $table            = 'klasifikasi_surat';
    protected $primaryKey       = 'id_klasifikasi_surat';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kode', 'nomor_klasifikasi', 'keterangan'];

    // Dates
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
