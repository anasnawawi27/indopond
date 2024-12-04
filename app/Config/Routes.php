<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('item/(:any)', 'Item::detail/$1', ['as' => 'detail_item']);
$routes->get('contact', 'Home::contact', ['as' => 'contact']);
$routes->get('faq', 'Home::faq', ['as' => 'faq']);
$routes->get('search', 'Home::search', ['as' => 'search']);
$routes->get('about', 'Home::about', ['as' => 'about']);

// $routes->group('', function ($routes) {
//     helper('filesystem');
//     $modules = directory_map(ROOTPATH . 'modules', 1);

//     foreach ($modules as $module) {
//         $module = rtrim($module, '/');

//         // Muat routes.php untuk setiap module
//         if (file_exists(ROOTPATH . 'modules/' . $module . '/config/routes.php')) {
//             require ROOTPATH . 'modules/' . $module . '/config/routes.php';
//         }
//     }
// });

if (is_dir(ROOTPATH . 'modules')) {
    $modulesPath = ROOTPATH . 'modules/';
    $modules = scandir($modulesPath);

    foreach ($modules as $module) {
        if ($module === '.' || $module === '..') {
            continue;
        }

        $moduleRoutesPath = $modulesPath . $module . '/Config/Routes.php';

        if (file_exists($moduleRoutesPath)) {
            require $moduleRoutesPath;
        }
    }
}
