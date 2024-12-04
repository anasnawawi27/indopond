<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'items';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name',
        'thumbnail',
        'image_slides',
        'embed_video_youtube',
        'description',
        'with_variant',
        'display_price',
        'category_id'
    ];

    public function getWithCategory($wheres = [])
    {
        $select = $this->select('items.*, categories.name as category_name')
            ->join('categories', 'categories.id = items.category_id', 'left');
        foreach ($wheres as $key => $val) {
            if ($key === 'name') $select->like('items.' . $key, $val);
            if ($key === 'categories') $select->whereIn('items.category_id', explode(',', $val));
        }

        return $select;
    }
}
