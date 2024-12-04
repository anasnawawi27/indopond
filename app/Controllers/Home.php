<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CustomerModel;
use App\Models\FAQModel;
use App\Models\ItemModel;

class Home extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Indopond - Home';
    }

    public function index()
    {

        $itemModel = new ItemModel();
        $customerModel = new CustomerModel();
        $bannerModel = new \App\Models\BannerModel();

        $db = db_connect();
        $builder = $db->table('categories');
        $builder->select('*');
        $builder->where("EXISTS (SELECT id FROM items WHERE items.category_id = categories.id)", null, false);

        $categories = $builder->get()->getResult();
        $items = [];

        foreach ($categories as $category) {
            $data = $itemModel->where('category_id', $category->id)->limit(12)->find();
            $items[] = [
                'category' => $category,
                'data' => $data
            ];
        }
        $this->data['items'] = $items;
        $this->data['banners'] = $bannerModel->findAll();
        $this->data['customers'] = $customerModel->select('image')->findAll();
        return view('home', $this->data);
    }

    public function contact()
    {
        $this->data['title'] = 'Indopond - Contact';
        return view('contact', $this->data);
    }

    public function faq()
    {
        $faqModel = new FAQModel();

        $this->data['title'] = 'Indopond - FAQ';
        $this->data['faqs'] = $faqModel->findAll();
        return view('faq', $this->data);
    }

    public function about()
    {

        $this->data['title'] = 'Indopond - About';
        return view('about', $this->data);
    }

    public function search()
    {
        $categoryModel = new CategoryModel();

        $this->data['title'] = 'Indopond - Search Result';
        $this->data['categories'] = $categoryModel->findAll();

        $itemModel = new ItemModel();
        $categoryModel = new CategoryModel();

        $perPage = 12;
        $currentPage = $this->request->getVar('page_items') ?? 1;

        $where = [];

        $name = $this->request->getVar('name');
        $categories = $this->request->getVar('categories');

        if ($name) $where['name'] = $name;
        if ($categories) $where['categories'] = $categories;

        $this->data['search'] = $name;
        $this->data['category_selected'] = explode(',', $categories);
        $this->data['category_filter'] = $categoryModel->whereIn('id', explode(',', $categories))->findAll();

        $this->data['items'] = $itemModel->getWithCategory($where)->paginate($perPage, 'items');
        $this->data['pager'] = $itemModel->pager;
        $this->data['totalResults'] = $itemModel->pager->getTotal('items');

        return view('search', $this->data);
    }
}
