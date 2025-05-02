<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function index()
    {
        return view('auth_view');
    }

    public function submit()
{
    helper(['form']);

    $rules = [
        'username'      => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
        'email'         => 'required|valid_email|is_unique[users.email]',
        'password'      => 'required|min_length[6]',
        'pays_origine'  => 'required'
    ];

    if ($this->validate($rules)) {
        $model = new UserModel();
        $data = [
            'username'     => $this->request->getPost('username'),
            'email'        => $this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'pays_origine' => $this->request->getPost('pays_origine')
        ];
        $model->insert($data);

        return redirect()->to('/login')->with('success', 'Compte créé avec succès.');
    } else {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}
}