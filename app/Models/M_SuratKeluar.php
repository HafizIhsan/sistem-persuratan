<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SuratKeluar extends Model
{
    protected $table            = 'surat_keluar';
    protected $primaryKey       = 'id_surat_keluar';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengguna', 'id_klasifikasi_surat', 'no_urut', 'sub_no_urut', 'tanggal_surat', 'nomor_surat_keluar', 'penerima', 'ttd', 'perihal', 'draft_surat_keluar', 'scan_surat_keluar', 'status', 'keterangan', 'created_at'];

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

    public function getSuratKeluarTanpaDokumentasi($id)
    {
        return $this->getWhere(['SCAN_SURAT_KELUAR' => NULL, 'ID_PENGGUNA' => $id])->getResultArray();
    }

    public function get_surat_keluar_by_pengguna($id)
    {
        if ($id != NULL) {
            return $this->getWhere(['ID_PENGGUNA' => $id])->getResultArray();
        }

        return false;
    }

    function get_tanggal_surat_keluar($tanggal_surat)
    {
        $sql = "SELECT * FROM surat_keluar WHERE TANGGAL_SURAT = ?";
        $query = $this->db->query($sql, [$tanggal_surat]);

        $row = $query->getRow();

        if ($row) {
            return true;
        }

        return false;
    }

    public function get_no_urut_akhir($tanggal_surat)
    {
        $sql = "SELECT * FROM surat_keluar WHERE TANGGAL_SURAT = ?";
        $query = $this->db->query($sql, [$tanggal_surat]);
        $row = $query->getResultArray();

        $now = date('Y-m-d');
        $yearNow = date('Y');
        $tgl = date('Y-m-d', strtotime($tanggal_surat));

        if ($tgl == $now) {
            $tmp = $this->db->query("SELECT max(NO_URUT) as max_no_urut, SUB_NO_URUT as max_sub_no_urut FROM surat_keluar WHERE TANGGAL_SURAT LIKE '$yearNow%'")->getResultArray();
            $data = end($tmp);
            if (count($data) == 0) {
                $data['max_no_urut'] = 1;
                $data['max_sub_no_urut'] = NULL;
            }
            return $data;
        } else if ($tgl != $now) {
            if (count($row) != 0) {
                $last_row = end($row);
                $data['max_no_urut'] = $last_row['NO_URUT'];
                $data['max_sub_no_urut'] = $last_row['SUB_NO_URUT'];
            } else {
                $tmp1 = end($this->db->query("SELECT max(NO_URUT) as max_no_urut FROM surat_keluar WHERE TANGGAL_SURAT < '$tgl'")->getResultArray());
                $data['max_no_urut'] = $tmp1['max_no_urut'];
                $q = "SELECT max(SUB_NO_URUT) as max_sub_no_urut FROM surat_keluar WHERE NO_URUT = ? ";
                $tmp2 = end($this->db->query($q, [$data['max_no_urut']])->getResultArray());
                $data['max_sub_no_urut'] = $tmp2['max_sub_no_urut'];
            }
            return $data;
        }

        return false;
    }

    public function get_surat_keluar_by_tahun($tahun = false)
    {
        if ($tahun === false) {
            return $this->findAll();
        } else {
            $sql = "SELECT * FROM surat_keluar WHERE TANGGAL_SURAT LIKE '$tahun%'";
            $query = $this->db->query($sql);
            $row = $query->getResultArray();
            return $row;
        }
    }

    public function getSuratKeluarbyID($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_surat_keluar' => $id])->getResultArray();
        }
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
