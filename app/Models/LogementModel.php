<?php

namespace App\Models;

use CodeIgniter\Model;

class LogementModel extends Model
{
    protected $table = 'logements';
    protected $primaryKey = 'id_logement';
    protected $allowedFields = ['nom', 'description', 'capacite', 'type', 'localisation', 'id_centre'];
}
