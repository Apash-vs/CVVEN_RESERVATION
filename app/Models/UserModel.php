<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';         // 🔥 Ton nom de table
    protected $primaryKey = 'id';        // 🔥 Ta clé primaire
    protected $allowedFields = ['username', 'email', 'password', 'pays_origine'];
    protected $useTimestamps = true;     // 🔥 Si tu veux que created_at / updated_at soient gérés
}
