<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataPenggunaController extends BaseController
{
    public function data_admin()
    {
        return view('admin/data_admin');
    }

    public function data_pegawai()
    {
        return view('admin/data_pegawai');
    }
}
