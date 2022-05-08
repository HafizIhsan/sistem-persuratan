<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function home()
    {
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
        return view('admin/dokumentasi_surat_masuk');
    }

    public function data_surat_keluar()
    {
        return view('admin/data_surat_keluar');
    }

    public function data_surat_masuk()
    {
        return view('admin/data_surat_masuk');
    }
}
