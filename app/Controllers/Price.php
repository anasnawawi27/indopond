<?php

namespace App\Controllers;

use App\Models\UnitTypesModel;

class Price extends BaseController
{
    public function __construct(){
        parent::__construct();
        $this->data['title'] = 'Mitsubishi Motor - Daftar Harga';
    }

    public function index(){

        $unitTypesModel = new UnitTypesModel();

        $this->data['unit_types'] = $unitTypesModel->findAll();
        return view('price_list', $this->data);
    }
}
