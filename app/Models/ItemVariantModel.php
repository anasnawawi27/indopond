<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemVariantModel extends Model
{
    protected $table            = 'item_variants';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'item_id',
        'variant',
        'price'
    ];
}
