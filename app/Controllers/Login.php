<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        // Si l'utilisateur est déjà connecté, on le redirige
        if (session()->get('id_users')) {
            return redirect()->to('/dashboard');
        }

        return view('auth_view'); // vue de connexion
    }

    public function authenticate()
    {
        helper(['form']);

        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set([
                'id_users'   => $user['id'],
                'username'   => $user['username'],
                'email'      => $user['email'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
