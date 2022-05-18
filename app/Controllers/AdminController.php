<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengguna;
use App\Models\M_SuratKeluar;
use App\Models\M_SuratLainnya;
use App\Models\M_SuratMasuk;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('id_role') != 1) {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        $this->pengguna = new M_Pengguna();
        $this->surat_keluar = new M_SuratKeluar();
        $this->surat_masuk = new M_SuratMasuk();
        $this->surat_lainnya = new M_SuratLainnya();

        $id = session()->get('id_pengguna');

        $data_sk = $this->surat_keluar->findAll();
        $data_sm = $this->surat_masuk->findAll();
        $data_sl = $this->surat_lainnya->findAll();

        $data['surat_keluar'] = count($data_sk);
        $data['surat_masuk'] = count($data_sm);
        $data['surat_lainnya'] = count($data_sl);
        $data['pengguna'] = $this->pengguna->findAll();
        $data['tugas_saya'] = $this->surat_masuk->get_surat_masuk_by_petugas($id);
        $data['surat_keluar_saya'] = $this->surat_keluar->getSuratKeluarTanpaDokumentasi();

        return view("admin/dashboard_admin", $data);
    }
}
