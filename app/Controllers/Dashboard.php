<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use Config\Database;

class Dashboard extends Controller
{
    public function index()
    {
        $userId = session()->get('id_users');
        if (!$userId) {
            return redirect()->to('/login');
        }

        // 1. Récupération des infos utilisateur
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        // 2. Connexion à la DB pour les réservations
        $db = Database::connect();
        $builder = $db->table('reservations')
            ->select('reservations.*, logements.nom AS logement_nom, periodes.date_debut, periodes.date_fin')
            ->join('logements', 'reservations.id_logement = logements.id_logement')
            ->join('periodes', 'reservations.id_periode = periodes.id_periode')
            ->where('reservations.id_users', $userId);

        // 3. Gestion du tri dynamique
        $sort = $this->request->getGet('sort') ?? 'date_reservation';
        $order = $this->request->getGet('order') ?? 'asc';
        $allowedSorts = ['logement_nom', 'date_reservation', 'date_debut', 'date_fin'];
        
        if (in_array($sort, $allowedSorts)) {
            $builder->orderBy($sort, $order);
        }
        

        $reservations = $builder->get()->getResultArray();

        // 4. Envoi à la vue
        return view('dashboard', [
            'user' => $user,
            'reservations' => $reservations
        ]);
    }
}
