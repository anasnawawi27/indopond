<?php

$routes->group('admin', ['namespace' => '\Modules\Admin\Controllers'], function ($routes) {

    $routes->group('item', function ($routes) {
        $routes->add('/', 'Item::index', ['as' => 'items']);
        $routes->add('get_list', 'Item::get_list', ['as' => 'item_list']);
        $routes->add('form/(:any)', 'Item::form/$1', ['as' => 'item_form']);
        $routes->add('save', 'Item::save', ['as' => 'item_save']);
        $routes->add('delete/(:any)', 'Item::delete/$1', ['as' => 'item_delete']);
    });

    $routes->group('category', function ($routes) {
        $routes->add('/', 'Category::index', ['as' => 'category']);
        $routes->add('get_list', 'Category::get_list', ['as' => 'category_list']);
        $routes->add('form/(:any)', 'Category::form/$1', ['as' => 'category_form']);
        $routes->add('save', 'Category::save', ['as' => 'category_save']);
        $routes->add('delete/(:any)', 'Category::delete/$1', ['as' => 'category_delete']);
    });

    $routes->group('setting', function ($routes) {
        $routes->add('/', 'Setting::index', ['as' => 'setting']);
        $routes->add('save', 'Setting::save', ['as' => 'setting_save']);
    });

    $routes->group('user', function ($routes) {
        $routes->add('/', 'User::index', ['as' => 'user']);
        $routes->add('save', 'User::save', ['as' => 'user_save']);
    });

    $routes->group('customer', function ($routes) {
        $routes->add('/', 'Customer::index', ['as' => 'customer']);
        $routes->add('get_list', 'Customer::get_list', ['as' => 'customer_list']);
        $routes->add('form/(:any)', 'Customer::form/$1', ['as' => 'customer_form']);
        $routes->add('save', 'Customer::save', ['as' => 'customer_save']);
        $routes->add('delete/(:any)', 'Customer::delete/$1', ['as' => 'customer_delete']);
    });

    $routes->group('payment', function ($routes) {
        $routes->add('/', 'Payment::index', ['as' => 'payments']);
        $routes->add('get_list', 'Payment::get_list', ['as' => 'payment_list']);
        $routes->add('form/(:any)', 'Payment::form/$1', ['as' => 'payment_form']);
        $routes->add('save', 'Payment::save', ['as' => 'payment_save']);
        $routes->add('delete/(:any)', 'Payment::delete/$1', ['as' => 'payment_delete']);
    });

    $routes->group('banner', function ($routes) {
        $routes->add('/', 'Banner::index', ['as' => 'banners']);
        $routes->add('get_list', 'Banner::get_list', ['as' => 'banner_list']);
        $routes->add('form/(:any)', 'Banner::form/$1', ['as' => 'banner_form']);
        $routes->add('save', 'Banner::save', ['as' => 'banner_save']);
        $routes->add('delete/(:any)', 'Banner::delete/$1', ['as' => 'banner_delete']);
    });

    $routes->group('faq', function ($routes) {
        $routes->add('/', 'FAQ::index', ['as' => 'faqs']);
        $routes->add('get_list', 'FAQ::get_list', ['as' => 'faq_list']);
        $routes->add('form/(:any)', 'FAQ::form/$1', ['as' => 'faq_form']);
        $routes->add('save', 'FAQ::save', ['as' => 'faq_save']);
        $routes->add('delete/(:any)', 'FAQ::delete/$1', ['as' => 'faq_delete']);
    });
});
