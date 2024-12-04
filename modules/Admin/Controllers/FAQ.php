<?php

namespace Modules\Admin\Controllers;

use \App\Controllers\BaseController;
use App\Models\FAQModel;
use Cloudinary\Api\Upload\UploadApi;

class FAQ extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'faq';
        $this->data['module'] = $this->data['menu'];
        $this->data['module_url'] = route_to('faqs');
        $this->data['filter_name'] = 'table_filter_faq';
        $this->model = new FAQModel();
    }

    public function index()
    {
        $this->data['table'] = [
            'columns' => [
                [
                    'title'         => lang('FAQ.question'),
                    'field'         => 'question',
                    'sortable'      => 'true',
                    'switchable'    => 'true',
                ]
            ],
            'url'       => route_to('faq_list'),
            'cookie_id' => 'table-faq'
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
        $this->data['title'] = lang('FAQ.heading');
        $this->data['heading'] = lang('FAQ.heading');
        $this->data['left_toolbar'] = sprintf(lang('Common.btn.add'), route_to('faq_form', 0), lang('FAQ.add_heading'));
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
                'id'                    => 'question',
                'value'                 => ($data) ? $data->question : '',
                'label'                 => lang('FAQ.question'),
                'required'  => 'required',
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'       => 'answer',
                'value'    => ($data) ? $data->answer : '',
                'label'    => lang('FAQ.answer'),
                'type'     => 'textarea',
                'form_control_class' => 'col-md-8 mb-3',
                'class'    => 'editor',
                'required' => 'required',
                'rows'     => 3,
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
            'action'    => route_to('faq_save'),
            'build'     => $form_builder->build_form_horizontal($form),
        ];
        $this->data['breadcrumb'] = $breadcrumb->render();
        $this->data['data'] = $data;

        $this->data['title'] = ($data ? lang('Common.edit') : lang('Common.add')) . ' ' . lang('FAQ.heading');
        $this->data['heading'] = $this->data['title'];
        return view('form_default', $this->data);
    }

    public function get_list()
    {
        $this->request->isAJAX() or exit();
        $getData = $this->request->getGet();

        $filter['question'] = $getData['search'];
        $table = new \App\Models\TableModel('faq', false);
        if (isset($getData['sort'])) {
            $table->setOrder([
                'sort'  => $getData['sort'],
                'order' => $getData['order']
            ]);
        }
        $table->setLimit($getData['offset'], $getData['limit']);
        $table->setFilter($filter);
        $table->setSelect("a.id, a.question, '" . route_to('faq_form', 'ID') . "' AS `edit`, '" . route_to('faq_delete', 'ID') . "' AS `delete`");
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
            if (!$postData['id']) {
                $this->model->insert($postData);
            } else {
                $this->model->update($postData['id'], $postData);
            }

            $return = [
                'message'  => sprintf(lang('Common.saved.success'), lang('FAQ.heading')),
                'status'   => 'success',
                'redirect' => route_to('faqs')
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
            $return = ['message' => sprintf(lang('Common.deleted.success'), lang('FAQ.heading')), 'status' => 'success'];
        } else {
            $return = ['message' => lang('Common.not_found'), 'status' => 'error'];
        }
        echo json_encode($return);
    }

    private function _setDefaultBreadcrumb()
    {
        $breadcrumb = new \App\Libraries\Breadcrumb;
        $breadcrumb->add(lang('Common.home'), site_url());
        $breadcrumb->add(lang('FAQ.heading'), route_to('faqs'));

        return $breadcrumb;
    }
}
