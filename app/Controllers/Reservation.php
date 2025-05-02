<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LogementModel;

class Reservation extends Controller
{
    public function index()
    {
        helper(['form']);

        $logementModel = new LogementModel();
        $data['logements'] = $logementModel->findAll();

        return view('reservation', $data);
    }

    public function recherche()
    {
        helper(['form']);

        $date_debut = $this->request->getPost('date_debut');
        $date_fin = $this->request->getPost('date_fin');
        $capacite_min = $this->request->getPost('capacite_min');
        $type = $this->request->getPost('type_logement');
        $today = date('Y-m-d');

        if ($date_debut < $today || $date_fin < $today) {
            return redirect()->back()->with('error', "Les dates doivent être à partir d'aujourd'hui.");
        }

        if ($date_debut > $date_fin) {
            return redirect()->back()->with('error', "La date d'arrivée ne peut pas être après la date de départ.");
        }

        $db = \Config\Database::connect();
        $builder = $db->table('logements')->select('logements.*');

        $builder->whereNotIn('logements.id_logement', function($subquery) use ($date_debut, $date_fin) {
            $subquery->select('reservations.id_logement')
                     ->from('reservations')
                     ->join('periodes', 'reservations.id_periode = periodes.id_periode')
                     ->where('periodes.date_debut <=', $date_fin)
                     ->where('periodes.date_fin >=', $date_debut);
        });

        if (!empty($capacite_min)) {
            $builder->where('logements.capacite >=', $capacite_min);
        }

        if (!empty($type)) {
            $builder->like('logements.type', $type);
        }

        $logements_disponibles = $builder->get()->getResultArray();

        return view('reservation', [
            'logements_disponibles' => $logements_disponibles,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'capacite_min' => $capacite_min,
            'type_logement' => $type
        ]);
    }

    public function confirmer()
    {
        helper(['form']);

        $id_logement = $this->request->getPost('id_logement');
        $date_debut = $this->request->getPost('date_debut');
        $date_fin = $this->request->getPost('date_fin');
        $user_id = session()->get('id_users');

        if (!$id_logement || !$date_debut || !$date_fin || !$user_id) {
            return redirect()->to('/reservation')->with('error', 'Données manquantes.');
        }

        $logementModel = new LogementModel();
        $logement = $logementModel->find($id_logement);

        if (!$logement) {
            return redirect()->to('/reservation')->with('error', 'Logement introuvable.');
        }

        // Page intermédiaire de confirmation (vue à créer)
        return view('reservation_confirm', [
            'logement' => $logement,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
    }

    public function validerReservation()
    {
        $id_logement = $this->request->getPost('id_logement');
        $date_debut = $this->request->getPost('date_debut');
        $date_fin = $this->request->getPost('date_fin');
        $user_id = session()->get('id_users');

        if (!$id_logement || !$date_debut || !$date_fin || !$user_id) {
            return redirect()->to('/reservation')->with('error', 'Données manquantes lors de la validation.');
        }

        $db = \Config\Database::connect();

        $db->table('periodes')->insert([
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
        $id_periode = $db->insertID();

        $db->table('reservations')->insert([
            'date_reservation' => date('Y-m-d'),
            'id_users' => $user_id,
            'id_logement' => $id_logement,
            'id_periode' => $id_periode
        ]);

        $logementModel = new LogementModel();
        $logement = $logementModel->find($id_logement);

        session()->setFlashdata('logement', $logement);
        session()->setFlashdata('date_debut', $date_debut);
        session()->setFlashdata('date_fin', $date_fin);

        return redirect()->to('/reservation/confirmation');
    }

    public function confirmationView()
    {
        return view('reservation_submit', [
            'logement' => session()->getFlashdata('logement'),
            'date_debut' => session()->getFlashdata('date_debut'),
            'date_fin' => session()->getFlashdata('date_fin'),
        ]);
    }

    public function annuler($id_reservation)
    {
        $db = \Config\Database::connect();
        $reservation = $db->table('reservations')->where('id_reservation', $id_reservation)->get()->getRow();

        if (!$reservation) {
            return redirect()->to('/dashboard')->with('error', 'Réservation introuvable.');
        }

        $db->table('reservations')->delete(['id_reservation' => $id_reservation]);

        $count = $db->table('reservations')->where('id_periode', $reservation->id_periode)->countAllResults();
        if ($count === 0) {
            $db->table('periodes')->delete(['id_periode' => $reservation->id_periode]);
        }

        return redirect()->to('/dashboard')->with('success', 'Réservation annulée avec succès.');
    }
}
