<?php

namespace App\Validation;

use App\Models\M_Pengguna;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new M_Pengguna();
        $user = $model->where('email', $data['email'])
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['PASSWORD']);
    }
}
