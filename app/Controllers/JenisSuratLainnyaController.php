<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisSuratLainnya;

class JenisSuratLainnyaController extends BaseController
{

    protected $jenis_surat_lainnya;

    function __construct()
    {
        $this->jenis_surat_lainnya = new JenisSuratLainnya();
    }

    public function index()
    {
        $data['jenis_surat_lainnya'] = $this->jenis_surat_lainnya->findAll();

        return view('dokumentasi_surat_lainnya', $data);
    }
}
