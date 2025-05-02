<?php namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';
    protected $allowedFields = [
        'date_reservation',
        'id_logement',
        'id_periode',
        'id_adherent'
    ];
    protected $useTimestamps = false;
    protected $returnType = 'array'; // pour éviter d’avoir un objet si tu préfères travailler en array
}
