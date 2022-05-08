<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengguna;
use App\Models\M_Role;

class DataPenggunaController extends BaseController
{
    protected $pengguna;

    function __construct()
    {
        $this->pengguna = new M_Pengguna();
        $this->role = new M_Role();
    }

    public function index()
    {
        $data['pengguna'] = $this->pengguna->findAll();
        $data['role'] = $this->role->findAll();
        return view('admin/data_pengguna', $data);
    }

    public function create()
    {
        $pass = $this->request->getPost('password');
        $verifPass = $this->request->getPost('verifPassword');

        if ($verifPass === $pass) {
            $this->pengguna->insert([
                'id_role' => $this->request->getPost('role'),
                'nama' => $this->request->getPost('nama'),
                'password' => password_hash($pass, PASSWORD_DEFAULT),
                'nip' => $this->request->getPost('nip'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp')
            ]);
        } else {
            return redirect()->to(base_url('data_pengguna'))->with('error', 'Verifikasi password salah');
        }

        return redirect()->to(base_url('data_pengguna'))->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {

        $this->pengguna->update($id, [
            'id_role' => $this->request->getPost('role'),
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp')
        ]);

        return redirect()->to(base_url('data_pengguna'))->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->pengguna->delete($id);

        return redirect()->to(base_url('data_pengguna'))->with('success', 'Data berhasis dihapus');
    }
}
