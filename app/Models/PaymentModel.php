<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'image',
        'note'
    ];
}
