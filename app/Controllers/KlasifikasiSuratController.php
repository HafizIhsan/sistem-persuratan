<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KlasifikasiSurat;
use App\Models\KategoriKlasifikasi;

class KlasifikasiSuratController extends BaseController
{
    protected $klasifikasi_surat;

    function __construct()
    {
        $this->klasifikasi_surat = new KlasifikasiSurat();
        $this->kategori_klasifikasi = new KategoriKlasifikasi();
    }

    public function index()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();

        return view('data_klasifikasi_surat', $data);
    }

    public function kelola_klasifikasi()
    {
        $data['klasifikasi_surat'] = $this->klasifikasi_surat->findAll();
        $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();
        return view('kelola_klasifikasi_surat', $data);
    }

    public function form_tambah_klasifikasi()
    {
        $data['kategori_klasifikasi'] = $this->kategori_klasifikasi->findAll();

        $kategori  = array_column($data['kategori_klasifikasi'], 'KATEGORI');
        array_multisort($kategori, SORT_ASC, $data['kategori_klasifikasi']);

        return view('tambah_klasifikasi', $data);
    }
}
