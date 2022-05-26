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
        helper(['form', 'url']);

        $rules = [
            'nama' => 'required|min_length[5]|max_length[100]',
            'email' => 'required|valid_email|is_unique[pengguna.email]',
            'nip' => 'required|numeric|min_length[18]|max_length[18]|is_unique[pengguna.nip]',
            'password' => 'required|min_length[5]',
            'verifPassword' => 'required|matches[password]|min_length[5]',
            'no_hp' => 'required|numeric|min_length[11]|max_length[14]'
        ];

        $error = [
            'email' => [
                'valid_email' => "Email tidak valid",
                'is_unique' => "Email sudah terpakai"
            ],
            'nama' => [
                'min_length' => "Nama setidaknya terdiri dari 5 karakter",
                'max_length' => "Nama terlalu panjang",
            ],
            'password' => [
                'min_length' => "Password setidaknya terdiri dari 5 karakter"
            ],
            'verifPassword' => [
                'matches' => "Verifikasi password salah",
                'min_length' => "Verifikasi password setidaknya terdiri dari 5 karakter"
            ],
            'nip' => [
                'min_length' => "NIP harus terdiri dari 18 angka",
                'max_length' => "NIP harus terdiri dari 18 angka",
                'numeric' => "NIP harus berupa angka",
                'is_unique' => "NIP sudah terpakai"
            ],
            'no_hp' => [
                'min_length' => "No HP setidaknya terdiri dari 11 angka",
                'max_length' => "No HP terlalu panjang",
                'numeric' => "No HP harus berupa angka"
            ],
        ];

        $input = $this->validate($rules, $error);
        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('data_pengguna'))->with('error', $msg->listErrors());
        } else {
            $this->pengguna->insert([
                'id_role' => $this->request->getPost('role'),
                'nama' => $this->request->getPost('nama'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nip' => $this->request->getPost('nip'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp')
            ]);

            return redirect()->to(base_url('data_pengguna'))->with('success', 'Data user berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        helper(['form', 'url']);

        $rules = [
            'nama' => 'required|min_length[5]|max_length[100]',
            'email' => "required|valid_email|is_unique[pengguna.email,id_pengguna,$id]",
            'nip' => "required|numeric|min_length[18]|max_length[18]|is_unique[pengguna.nip,id_pengguna,$id]",
            'no_hp' => 'required|numeric|min_length[11]|max_length[14]'
        ];

        $error = [
            'email' => [
                'valid_email' => "Email tidak valid",
                'is_unique' => "Email sudah terpakai"
            ],
            'nama' => [
                'min_length' => "Nama setidaknya terdiri dari 5 karakter",
                'max_length' => "Nama terlalu panjang",
            ],
            'nip' => [
                'min_length' => "NIP harus terdiri dari 18 angka",
                'max_length' => "NIP harus terdiri dari 18 angka",
                'numeric' => "NIP harus berupa angka",
                'is_unique' => "NIP sudah terpakai"
            ],
            'no_hp' => [
                'min_length' => "No HP setidaknya terdiri dari 11 angka",
                'max_length' => "No HP terlalu panjang",
                'numeric' => "No HP harus berupa angka"
            ],
        ];

        $input = $this->validate($rules, $error);
        $input = $this->validate($rules, $error);
        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('data_pengguna'))->with('error_edit', ['error' => $msg->listErrors(), 'id' => $id]);
        } else {
            $this->pengguna->update($id, [
                'id_role' => $this->request->getPost('role'),
                'nama' => $this->request->getPost('nama'),
                'nip' => $this->request->getPost('nip'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp')
            ]);
            return redirect()->to(base_url('data_pengguna'))->with('success', 'Data berhasil diubah');
        }
    }

    public function delete($id)
    {
        $this->pengguna->delete($id);

        return redirect()->to(base_url('data_pengguna'))->with('success', 'Data berhasis dihapus');
    }
}
