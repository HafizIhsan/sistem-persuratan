<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengguna;
use App\Models\M_Role;

class UserController extends BaseController
{
    function __construct()
    {
        $this->tipe_pengguna = new M_Role();
        $this->pengguna = new M_Pengguna();
    }

    public function login()
    {
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email atau Password salah",
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                return view('home', [
                    "validation" => $this->validator,
                ]);
            } else {
                $model = new M_Pengguna();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                // Stroing session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if ($user['ID_ROLE'] == 1) {

                    return redirect()->to(base_url('admin'));
                } elseif ($user['ID_ROLE'] == 2) {

                    return redirect()->to(base_url('pegawai'));
                }
            }
        }
        return view('home');
    }

    private function setUserSession($user)
    {
        $role = $this->tipe_pengguna->findAll();
        foreach ($role as $role) {
            if ($user['ID_ROLE'] == $role['ID_ROLE']) {
                $tmp = $role['JENIS_PENGGUNA'];
            }
        }

        $data = [
            'id_pengguna' => $user['ID_PENGGUNA'],
            'id_role' => $user['ID_ROLE'],
            'role' => $tmp,
            'nama' => $user['NAMA'],
            'email' => $user['EMAIL'],
            'nip' => $user['NIP'],
            'no_hp' => $user['NO_HP'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('home');
    }

    public function ubah_password($id)
    {
        helper(['form', 'url']);
        $rules = [
            'email' => 'valid_email',
            'password_lama' => 'required|min_length[6]|max_length[255]|validateUser[email,password_lama]',
            'password_baru' => 'required|min_length[6]|max_length[255]',
            'verif_password' => 'required|matches[password_baru]|min_length[6]|max_length[255]',
        ];

        $error = [
            'password_lama' => [
                'validateUser' => "Pasword lama salah",
                'min_length' => "Password lama setidaknya terdiri dari 6 karakter"
            ],
            'password_baru' => [
                'min_length' => "Password baru setidaknya terdiri dari 6 karakter"
            ],
            'verif_password' => [
                'matches' => "Verifikasi password salah",
                'min_length' => "Verifikasi password setidaknya terdiri dari 6 karakter"
            ],
        ];

        $input = $this->validate($rules, $error);

        if (!$input) {
            $msg = $this->validator;
            return redirect()->to(base_url('profile'))->with('error', $msg->listErrors());
        } else {
            $pass = $this->request->getPost('password_baru');
            $this->pengguna->update($id, [
                'password' => password_hash($pass, PASSWORD_DEFAULT)
            ]);

            return redirect()->to(base_url('profile'))->with('success', 'Password berhasil diubah');
        }
    }
}
