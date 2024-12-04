<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'key',
        'value',
        'other_value'
    ];
}
