<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_JenisSuratLainnya;

class JenisSuratLainnyaController extends BaseController
{

    protected $jenis_surat_lainnya;

    function __construct()
    {
        if (session()->get('id_role') != 1) {
            echo 'Access denied';
            exit;
        }

        $this->jenis_surat_lainnya = new M_JenisSuratLainnya();
    }

    public function index()
    {
        $data['jenis_surat_lainnya'] = $this->jenis_surat_lainnya->findAll();

        return view('admin/dokumentasi_surat_lainnya', $data);
    }
}
