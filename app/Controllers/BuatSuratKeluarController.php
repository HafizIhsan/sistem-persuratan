<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_KlasifikasiSurat;
use App\Models\M_SuratKeluar;

class BuatSuratKeluarController extends BaseController
{
    protected $surat_keluar;

    function __construct()
    {
        $this->surat_keluar = new M_SuratKeluar();
        $this->klasifikasi_surat = new M_KlasifikasiSurat();
    }

    public function index()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        return view('admin/buat_surat_keluar', $data);
    }

    public function index_p()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        return view('pegawai/buat_surat_keluar_p', $data);
    }
}
