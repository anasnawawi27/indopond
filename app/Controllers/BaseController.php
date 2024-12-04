<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = ['html'];
    protected $session;

    public $data;

    public function __construct()
    {
        $this->helpers = array_merge($this->helpers, ['common']);
        $this->session = service('session');
        helper('auth');

        date_default_timezone_set('Asia/Jakarta');
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $settingModel = new \App\Models\SettingModel();
        $userModel = new \App\Models\UsersModel();
        $categoryModel = new \App\Models\CategoryModel();
        $paymentModel = new \App\Models\PaymentModel();
        $itemModel = new \App\Models\ItemModel();

        $db = db_connect();
        $builder = $db->table('categories');
        $builder->select('*');
        $builder->where("EXISTS (SELECT id FROM items WHERE items.category_id = categories.id)", null, false);

        $categories = $builder->get()->getResult();
        $categoriesNav = [];

        foreach ($categories as $category) {
            $data = $itemModel->where('category_id', $category->id)->limit(3)->find();
            $categoriesNav[] = [
                'category' => $category,
                'data' => $data
            ];
        }
        $this->data['categories_nav'] = $categoriesNav;

        if (logged_in()) {
            $this->data['user'] = $userModel->select('*')->find(user_id());
        }
        $this->data['setting'] = $settingModel->findAll();
        $this->data['profile'] = $userModel->select('*')->find(50);
        $this->data['category_list'] = $categoryModel->findAll();
        $this->data['payments'] = $paymentModel->findAll();
    }
}
