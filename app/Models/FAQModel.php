<?php

namespace App\Models;

use CodeIgniter\Model;

class FAQModel extends Model
{
    protected $table            = 'faq';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'question',
        'answer'
    ];
}
