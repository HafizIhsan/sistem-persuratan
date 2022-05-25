<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_SuratKeluar;

class PegawaiController extends BaseController
{
    public function __construct()
    {
        if (session()->get('id_role') != 2) {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        $surat_k = new M_SuratKeluar();

        $id = session()->get('id_pengguna');

        $data_sk = $surat_k->get_surat_keluar_by_pengguna($id);

        $data['surat_keluar'] = count($data_sk);
        $data['surat_keluar_saya'] = $surat_k->getSuratKeluarTanpaDokumentasi($id);

        return view('pegawai/dashboard_pegawai', $data);
    }
}
