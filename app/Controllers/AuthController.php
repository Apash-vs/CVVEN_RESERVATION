<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth_view'); // Pas besoin de helper ici
    }

    public function logout()
    {
    session()->destroy();
    return redirect()->to('/login');
    }

    public function login()
{
    helper(['form']);

    $model = new \App\Models\UserModel();

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        $session = session();
        $session->set([
            'username' => $user['username'],
            'email'    => $user['email'],
            'isLoggedIn' => true
        ]);
        return redirect()->to('/dashboard');
    } else {
        // Erreur de connexion
        return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
    }
}

}
