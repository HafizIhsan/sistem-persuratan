<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SuratKeluar extends Model
{
    protected $table            = 'surat_keluar';
    protected $primaryKey       = 'id_surat_keluar';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengguna', 'id_klasifikasi_surat', 'no_urut', 'sub_no_urut', 'tanggal_surat', 'nomor_surat_keluar', 'penerima', 'ttd', 'perihal', 'keterangan', 'draft_surat_keluar', 'scan_surat_keluar', 'status', 'created_at'];

    public function getMaxNoUrut()
    {
        $db = \Config\Database::connect();
        $year = date('Y');

        $max_no_urut = $db->query("SELECT max(NO_URUT) as NO_URUT FROM surat_keluar WHERE TANGGAL_SURAT LIKE '$year%'")->getResultArray();

        return reset($max_no_urut);
    }

    function get_nomor_surat_keluar($nomor_surat_keluar)
    {
        $sql = "SELECT * FROM surat_keluar WHERE NOMOR_SURAT_KELUAR = ? LIMIT 1";
        $query = $this->db->query($sql, [$nomor_surat_keluar]);

        $row = $query->getRow();

        if ($row) {
            return true;
        }

        return false;
    }

    public function getSuratKeluar($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['nomor_surat_keluar' => $id])->getResultArray();
        }
    }

    public function getSuratKeluarTanpaDokumentasi()
    {
        return $this->getWhere(['SCAN_SURAT_KELUAR' => NULL])->getResultArray();
    }

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
