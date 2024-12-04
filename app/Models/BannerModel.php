<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table            = 'banners';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'image',
        'title',
        'text'
    ];
}
