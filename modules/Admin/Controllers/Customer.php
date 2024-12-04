<?php

namespace Modules\Admin\Controllers;

use \App\Controllers\BaseController;
use \App\Models\BannerModel;
use App\Models\CustomerModel;
use Cloudinary\Api\Upload\UploadApi;

class Customer extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'customer';
        $this->data['module'] = $this->data['menu'];
        $this->data['module_url'] = route_to('customer');
        $this->data['filter_name'] = 'table_filter_customer';
        $this->model = new CustomerModel();
    }

    public function index()
    {
        $this->data['table'] = [
            'columns' => [
                [
                    'title'         => lang('Customer.logo'),
                    'field'         => 'image',
                    'sortable'      => 'false',
                    'switchable'    => 'false',
                    'formatter'     => 'imageFormatterDefault',
                ],
                [
                    'title'         => lang('Customer.name'),
                    'field'         => 'name',
                    'sortable'      => 'true',
                    'switchable'    => 'true',
                ]
            ],
            'url'       => route_to('customer_list'),
            'cookie_id' => 'table-customer'
        ];
        $this->data['table']['columns'][] = [
            'field'      => 'action',
            'class'      => 'w-100px nowrap',
            'align'      => 'center',
            'switchable' => 'false',
            'formatter'  => 'actionFormatterDefault',
            'events'     => 'actionEventDefault'
        ];

        $breadcrumb = $this->_setDefaultBreadcrumb();
        $this->data['breadcrumb'] = $breadcrumb->render();
        $this->data['title'] = lang('Customer.heading');
        $this->data['heading'] = lang('Customer.heading');
        $this->data['left_toolbar'] = sprintf(lang('Common.btn.add'), route_to('customer_form', 0), lang('Customer.add_heading'));
        $this->data['toolbar'] = view('table-toolbar/default', $this->data);

        return view('list_default', $this->data);
    }

    public function form($id)
    {
        $data = NULL;
        $breadcrumb = $this->_setDefaultBreadcrumb();
        if ($id) {
            $data = $this->model->find($id);
            if (!$data) {
                throw \Codeigniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $breadcrumb->add(lang('Common.edit'), current_url());
        } else {
            $breadcrumb->add(lang('Common.add'), current_url());
        }

        $form = [
            [
                'id'                    => 'id',
                'type'                  => 'hidden',
                'value'                 => ($data) ? $data->id : '',
            ],
            [
                'id'                    => 'name',
                'value'                 => ($data) ? $data->name : '',
                'label'                 => lang('Customer.name'),
                'required'  => 'required',
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'                    => 'image',
                'value'                 => ($data) ? $data->image : '',
                'label'                 => lang('Customer.logo'),
                'type'                  => 'image',
                'form_control_class' => 'col-md-5 mb-4'
            ],
            [
                'type'                  => 'submit',
                'label'                 => lang('Common.btn.save_w_icon'),
                'back_url'              => $this->data['module_url'],
                'back_label'            => lang('Common.btn.cancel_w_icon'),
                'input_container_class' => 'form-group row text-right'
            ],
        ];

        $form_builder = new \App\Libraries\FormBuilder();
        $this->data['form'] = [
            'action'    => route_to('customer_save'),
            'build'     => $form_builder->build_form_horizontal($form),
        ];
        $this->data['breadcrumb'] = $breadcrumb->render();
        $this->data['data'] = $data;

        $this->data['title'] = ($data ? lang('Common.edit') : lang('Common.add')) . ' ' . lang('Customer.heading');
        $this->data['heading'] = $this->data['title'];
        return view('form_default', $this->data);
    }

    public function get_list()
    {
        $this->request->isAJAX() or exit();
        $getData = $this->request->getGet();

        $filter['name'] = $getData['search'];
        $table = new \App\Models\TableModel('customers');
        if (isset($getData['sort'])) {
            $table->setOrder([
                'sort'  => $getData['sort'],
                'order' => $getData['order']
            ]);
        }
        $table->setLimit($getData['offset'], $getData['limit']);
        $table->setFilter($filter);
        $table->setSelect("a.id, a.name, a.image, '" . route_to('customer_form', 'ID') . "' AS `edit`, '" . route_to('customer_delete', 'ID') . "' AS `delete`");
        $output['rows'] = $table->getAll();
        $output['total'] = $table->countAll();
        $table->setFilter();
        $output['totalNotFiltered'] = $table->countAll();
        echo json_encode($output);
    }

    public function save()
    {
        $this->request->isAJAX() or exit();

        $return['status'] = 'error';

        do {
            $postData = input_filter($this->request->getPost());
            $image = $this->request->getFile('upload_image');
            if (!$postData['id'] && (!$image || (isset($postData['delete_image']) && $postData['delete_image'] === '1'))) {
                $return['message'] = 'Gambar wajib diisi!';
                break;
            }
            $cld = new UploadApi();
            if ($image) {
                if ($image->isValid()) {
                    $upload = $cld->upload($image->getRealPath(), ['folder' => 'indopond/customers']);
                    $postData['image'] = $upload['public_id'];
                }
            } else {
                if (isset($postData['id'])) {
                    if ($image = $this->model->find($postData['id'])) {
                        $postData['image'] = $image->image;
                        if ($image->image) {
                            if (isset($postData['delete_image']) && $postData['delete_image'] === '1') {
                                $postData['image'] = NULL;
                            }
                        }
                    }
                }
            }

            if (!$postData['id']) {
                $this->model->insert($postData);
            } else {
                $this->model->update($postData['id'], $postData);
            }

            $return = [
                'message'  => sprintf(lang('Common.saved.success'), lang('Customer.heading')),
                'status'   => 'success',
                'redirect' => route_to('customer')
            ];
        } while (0);
        if (isset($return['redirect'])) {
            $this->session->setFlashdata('form_response_status', $return['status']);
            $this->session->setFlashdata('form_response_message', $return['message']);
        }
        echo json_encode($return);
    }

    public function delete($id)
    {
        $this->request->isAJAX() or exit();
        $data = $this->model->find($id);
        if ($data) {
            $this->model->delete($id);
            $return = ['message' => sprintf(lang('Common.deleted.success'), lang('Customer.heading')), 'status' => 'success'];
        } else {
            $return = ['message' => lang('Common.not_found'), 'status' => 'error'];
        }
        echo json_encode($return);
    }

    private function _setDefaultBreadcrumb()
    {
        $breadcrumb = new \App\Libraries\Breadcrumb;
        $breadcrumb->add(lang('Common.home'), site_url());
        $breadcrumb->add(lang('Customer.heading'), route_to('customer'));

        return $breadcrumb;
    }
}
