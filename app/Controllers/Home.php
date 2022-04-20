<?php

namespace App\Controllers;

class Home extends BaseController
{
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

    public function dokumentasi_nota_kesepahaman()
    {
        return view('dokumentasi_nota_kesepahaman');
    }

    public function dokumentasi_berita_acara()
    {
        return view('dokumentasi_berita_acara');
    }

    public function dokumentasi_perjanjian_kerjasama()
    {
        return view('dokumentasi_perjanjian_kerjasama');
    }

    public function data_surat_keluar()
    {
        return view('data_surat_keluar');
    }
}
