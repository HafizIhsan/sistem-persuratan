<?php

namespace App\Controllers;

use App\Models\M_Pengguna;

class Home extends BaseController
{
    function __construct()
    {
        $this->pengguna = new M_Pengguna();
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
        return view('admin/dashboard_admin');
    }

    public function dashboard_pegawai()
    {
        return view('pegawai/dashboard_pegawai');
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
}
