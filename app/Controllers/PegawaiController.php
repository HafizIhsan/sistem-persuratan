<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PegawaiController extends BaseController
{
    public function __construct()
    {
        if (session()->get('id_role') != 2) {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        return view("pegawai/dashboard_pegawai");
    }
}
