<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\ItemVariantModel;

class Item extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Indopond - Item';
    }

    public function detail($id)
    {
        $id = decode($id);
        $variantModel = new ItemVariantModel();

        $db = db_connect();
        $builder = $db->table('items a');
        $builder->select('a.*, b.name as category_name');
        $builder->join('categories b', 'b.id = a.category_id', 'left');
        $builder->where('a.id', $id);

        $item = $builder->get()->getRow();

        $builder2 = $db->table('items a');
        $builder2->select('a.*, b.name as category_name');
        $builder2->join('categories b', 'b.id = a.category_id', 'left');
        $builder2->where(['a.category_id' => $item->category_id, 'a.id !=' => $id]);
        $builder2->limit(4);

        $this->data['item'] = $item;
        $this->data['other_item'] = $builder2->get()->getResult();
        $this->data['variants'] = $variantModel->where('item_id', $id)->findAll();

        return view('detail_item', $this->data);
    }
}
