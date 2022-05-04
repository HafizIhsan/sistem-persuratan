<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function buat_surat_keluar()
    {
        return view('buat_surat_keluar');
    }

    public function dokumentasi_surat_keluar()
    {
        return view('dokumentasi_surat_keluar');
    }

    public function dokumentasi_surat_masuk()
    {
        return view('dokumentasi_surat_masuk');
    }

    public function data_surat_keluar()
    {
        return view('data_surat_keluar');
    }

    public function data_surat_masuk()
    {
        return view('data_surat_masuk');
    }
}
