<?php

namespace Modules\Admin\Controllers;

use \App\Controllers\BaseController;
use App\Models\SettingModel;

class Setting extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'setting';
        $this->data['module'] = $this->data['menu'];
        $this->data['module_url'] = route_to('setting');
        $this->model = new SettingModel();
    }

    public function index()
    {
        $breadcrumb = $this->_setDefaultBreadcrumb();
        $keys = $this->model->findAll();

        $form = [];
        foreach ($keys as $data) {
            if ($data->key == 'company_address' || $data->key == 'motivational_text') {
                $form[] = [
                    'id'       => $data->key,
                    'value'    => ($data) ? $data->value : '',
                    'label'    => lang('Setting.' . $data->key),
                    'type'     => 'textarea',
                    'form_control_class' => 'col-md-5 mb-3',
                    'required' => 'required',
                    'rows'     => 5,
                ];
            } else if ($data->key == 'about_us') {
                $form[] =  [
                    'id'       => $data->key,
                    'value'    => ($data) ? $data->value : '',
                    'label'    => lang('Setting.' . $data->key),
                    'type'     => 'textarea',
                    'form_control_class' => 'col-md-8 mb-3',
                    'class'    => 'editor',
                    'required' => 'required',
                    'rows'     => 3,
                ];
            } else {
                $form[] = [
                    'id'        => $data->key,
                    'value'     => ($data) ? $data->value : '',
                    'label'     => lang('Setting.' . $data->key),
                    'required'  => 'required',
                    'form_control_class' => 'col-md-5 mb-3'
                ];

                if ($data->key == 'tokopedia' || $data->key == 'shopee') {
                    $form[] = [
                        'id'        => $data->key . '_other_value',
                        'value'     => ($data) ? $data->other_value : '',
                        'label'     => '',
                        'required'  => 'required',
                        'form_control_class' => 'col-md-5 mb-3'
                    ];
                }
            }
        }

        $form[] = [

            'type'                  => 'submit',
            'label'                 => lang('Common.btn.save_w_icon'),
            'back_url'              => $this->data['module_url'],
            'back_label'            => lang('Common.cancel'),
            'input_container_class' => 'form-group row text-right mt-1'
        ];

        $form_builder = new \App\Libraries\FormBuilder();
        $this->data['form'] = [
            'action'    => route_to('setting_save'),
            'build'     => $form_builder->build_form_horizontal($form),
        ];

        $this->data['breadcrumb'] = $breadcrumb->render();
        $this->data['title'] = lang('Setting.heading');
        $this->data['heading'] = $this->data['title'];
        return view('form_default', $this->data);
    }

    public function save()
    {
        $this->request->isAJAX() or exit();

        $keys = $this->model->findAll();
        $rules = [];
        foreach ($keys as $data) {
            $rules[$data->key] = [
                'label' => lang('Setting.' . $data->key),
                'rules' => 'required',
                'errors' => [
                    'required' => str_replace('_', ' ', ucwords($data->key)) . ' wajib diisi'
                ]
            ];
        }

        $return['status'] = 'error';

        do {
            if (!$this->validate($rules)) {
                $return['message'] = $this->validator->listErrors('bootstrap_list');
                break;
            }
            $postData = input_filter($this->request->getPost());

            foreach ($keys as $data) {
                if ($data->key === 'tokopedia_other_value' || $data->key === 'shopee_other_value') {
                    $this->model->where('key', str_replace("_other_value", "",  $data->key))->set(['value' => $postData[$data->key]])->update();
                } else {
                    $this->model->where('key', $data->key)->set(['value' => $postData[$data->key]])->update();
                }
            }

            $return = [
                'message'  => sprintf(lang('Common.saved.success'), lang('Common.settings')),
                'status'   => 'success'
            ];
        } while (0);
        if (isset($return['redirect'])) {
            $this->session->setFlashdata('form_response_status', $return['status']);
            $this->session->setFlashdata('form_response_message', $return['message']);
        }
        echo json_encode($return);
    }

    private function _setDefaultBreadcrumb()
    {
        $breadcrumb = new \App\Libraries\Breadcrumb;
        $breadcrumb->add(lang('Common.home'), site_url());
        $breadcrumb->add(lang('Setting.heading'), route_to('setting'));

        return $breadcrumb;
    }
}
