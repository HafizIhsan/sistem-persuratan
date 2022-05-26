<?php

namespace App\Controllers;

use App\Models\M_Pengguna;
use App\Models\M_SuratKeluar;
use App\Models\M_SuratLainnya;
use App\Models\M_SuratMasuk;

class Home extends BaseController
{
    function __construct()
    {
        $this->pengguna = new M_Pengguna();
        $this->surat_keluar = new M_SuratKeluar();
        $this->surat_masuk = new M_SuratMasuk();
        $this->surat_lainnya = new M_SuratLainnya();
    }

    public function home()
    {
        if (session()->get('id_role') != NULL) {
            if (session()->get('id_role') == 1) {
                return redirect()->to(base_url('admin'));
            } else {
                return redirect()->to(base_url('pegawai'));
            }
        };
        return view('home');
    }

    public function dashboard_admin()
    {
        $surat_m = new M_SuratMasuk();
        $surat_k = new M_SuratKeluar();

        $id = session()->get('id_pengguna');

        $data_sk = $this->surat_keluar->findAll();
        $data_sm = $this->surat_masuk->findAll();
        $data_sl = $this->surat_lainnya->findAll();

        $data['surat_keluar'] = count($data_sk);
        $data['surat_masuk'] = count($data_sm);
        $data['surat_lainnya'] = count($data_sl);
        $data['pengguna'] = $this->pengguna->findAll();
        $data['tugas_saya'] = $surat_m->get_surat_masuk_by_petugas($id, 'Dalam proses');
        $data['surat_keluar_saya'] = $surat_k->getSuratKeluarTanpaDokumentasi($id);

        return view('admin/dashboard_admin', $data);
    }

    public function dashboard_pegawai()
    {
        $surat_k = new M_SuratKeluar();

        $id = session()->get('id_pengguna');

        $data_sk = $this->surat_keluar->get_surat_keluar_by_pengguna($id);

        $data['surat_keluar'] = count($data_sk);
        $data['surat_keluar_saya'] = $surat_k->getSuratKeluarTanpaDokumentasi($id);

        return view('pegawai/dashboard_pegawai', $data);
    }

    public function dokumentasi_surat_keluar()
    {
        return view('admin/dokumentasi_surat_keluar');
    }

    public function dokumentasi_surat_keluar_p()
    {
        return view('pegawai/dokumentasi_surat_keluar_p');
    }

    public function dokumentasi_surat_masuk()
    {
        $id_role = 1;
        $pengguna = $this->pengguna->findAll();
        $data['admin'] = array_filter($pengguna, function ($value) use ($id_role) {

            return ($value["ID_ROLE"] == $id_role);
        });
        return view('admin/dokumentasi_surat_masuk', $data);
    }

    public function data_surat_keluar()
    {
        return view('admin/data_surat_keluar');
    }

    public function profile()
    {
        $id = session()->get('id_pengguna');
        $data['pengguna'] = $this->pengguna->getPengguna($id);
        return view('profile', $data);
    }
}
