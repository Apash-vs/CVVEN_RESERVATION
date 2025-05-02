<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    protected $table = 'periodes';
    protected $primaryKey = 'id_periode';
    protected $allowedFields = [
        'date_debut',
        'date_fin'
    ];
    protected $useTimestamps = false;

}
