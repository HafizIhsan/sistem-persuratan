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
}
