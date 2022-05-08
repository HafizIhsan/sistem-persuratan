<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengguna;

class UserController extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email atau Password didn't match",
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
        $data = [
            'id_pengguna' => $user['ID_PENGGUNA'],
            'id_role' => $user['ID_ROLE'],
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
}
