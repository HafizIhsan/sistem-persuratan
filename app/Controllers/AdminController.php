<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('id_role') != 1) {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        return view("admin/dashboard_admin");
    }
}
