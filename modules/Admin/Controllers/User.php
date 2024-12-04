<?php

namespace Modules\Admin\Controllers;

use \App\Controllers\BaseController;
use \App\Models\UsersModel;
use \App\Libraries\FormBuilder;
use Cloudinary\Api\Upload\UploadApi;

class User extends BaseController
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new UsersModel();
        $this->data['module'] = 'user';
        $this->data['menu'] = $this->data['module'];
        $this->data['module_url'] = route_to('user');
    }

    public function index()
    {
        $breadcrumb = $this->_setDefaultBreadcrumb();

        $data = $this->model->find(50);

        $form = [
            [
                'id'                    => 'id',
                'type'                  => 'hidden',
                'value'                 => ($data) ? $data->id : '',
            ],
            [
                'id'                    => 'fullname',
                'value'                 => ($data) ? $data->fullname : '',
                'label'                 => lang('Users.fullname'),
                'required'              => 'required',
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'                    => 'phone',
                'value'                 => ($data) ? $data->phone : '',
                'label'                 => lang('Users.phone'),
                'required'              => 'required',
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'                    => 'email',
                'value'                 => ($data) ? $data->email : '',
                'label'                 => lang('Users.email'),
                'required'              => 'required',
                'form_control_class'    => 'col-md-5 mb-3'
            ],
            [
                'id'                    => 'image',
                'value'                 => ($data) ? $data->image : '',
                'label'                 => lang('Users.image'),
                'type'                  => 'image',
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'                    => 'username',
                'value'                 => ($data) ? $data->username : '',
                'label'                 => lang('Users.username'),
                'required'              => 'required',
                'form_control_class' => 'col-md-5 mb-3'
            ],

            [
                'id'                    => 'password',
                'value'                 => '',
                'label'                 => lang('Users.password'),
                'type'                  => 'password',
                'form_control_class' => 'col-md-5 mb-4'
            ],
            [
                'type'                  => 'submit',
                'label'                 => lang('Common.btn.save_w_icon'),
                'form_control_class'    => 'col-md-5',
                'back_url'              => $this->data['module_url'],
                'back_label'            => lang('Common.cancel'),
                'input_container_class' => 'form-group row text-right'
            ]
        ];

        $form_builder = new FormBuilder();
        $this->data['form'] = [
            'action' => route_to('user_save'),
            'build'  => $form_builder->build_form_horizontal($form),
        ];

        $this->data['breadcrumb'] = $breadcrumb->render();
        $this->data['data'] = $data;
        $this->data['title'] = lang('Users.edit_heading');
        $this->data['heading'] = $this->data['title'];
        return view('form_default', $this->data);
    }


    public function save()
    {
        $this->request->isAJAX() or exit();

        $rules = [
            'fullname'      => [
                'label' => lang('Users.fullname'),
                'rules' => 'required'
            ],
            'phone'      => [
                'label' => lang('Users.phone'),
                'rules' => 'required'
            ],
            'email'      => [
                'label' => lang('Users.email'),
                'rules' => 'required'
            ],
            'username' => [
                'label' => lang('Users.username'),
                'rules' => 'required',
            ],
        ];
        $return['status'] = 'error';

        do {

            $postData = $this->request->getPost();

            if (!$postData['id']) {
                $rules['password'] = [
                    'label' => lang('Users.password'),
                    'rules' => 'required|strong_password|min_length[8]'
                ];
                $sameData = $this->model->where('username', $postData['username'])->find();
                if ($sameData) {
                    $rules['username']['label'] = lang('Users.username');
                    $rules['username']['rules'] = 'is_unique[users.username]';
                }
            } else {
                $data = $this->model->find($postData['id']);
                $rules['username']['rules'] = 'is_unique[users.username,username,' . $data->username . ']';
            }

            if (!$this->validate($rules)) {
                $return['message'] = $this->validator->listErrors('default');
                break;
            }

            if ($postData['password']) {
                $postData['password_hash'] = $this->_set_password($postData['password']);
            }

            // image upload
            $image = $this->request->getFile('upload_image');
            $cld = new UploadApi();
            if ($image) {
                if ($image->isValid()) {
                    $upload = $cld->upload($image->getRealPath(), ['folder' => 'mitsubishi-sales/profile']);
                    $postData['image'] = $upload['public_id'];
                }
            } else {
                if (isset($postData['id'])) {
                    $exist = $this->model->find(50);
                    if ($exist = $this->model->find($postData['id'])) {
                        $postData['image'] = $exist->image;
                        if ($exist->image) {
                            if (isset($postData['delete_image']) && $postData['delete_image'] == '1') {
                                $postData['image'] = NULL;
                                $cld->destroy($exist->image);
                            }
                        }
                    }
                }
            }

            $this->model->update($postData['id'], $postData);

            $return = [
                'message'  => sprintf(lang('Common.saved.success'), lang('Common.user') . ' ' . $postData['fullname']),
                'status'   => 'success',
                'redirect' => route_to('users')
            ];
        } while (0);
        if (isset($return['redirect'])) {
            $this->session->setFlashdata('form_response_status', $return['status']);
            $this->session->setFlashdata('form_response_message', $return['message']);
        }
        echo json_encode($return);
    }

    private function _set_password(string $password)
    {
        $config = config('Auth');
        $hashOptions = [
            'cost' => $config->hashCost,
        ];
        $setPasswordUser = password_hash(
            base64_encode(
                hash('sha384', $password, true)
            ),
            $config->hashAlgorithm,
            $hashOptions
        );
        return $setPasswordUser;
    }

    private function _setDefaultBreadcrumb()
    {
        $breadcrumb = new \App\Libraries\Breadcrumb();
        $breadcrumb->add(lang('Common.home'), site_url());
        $breadcrumb->add(lang('Users.edit_heading'), route_to('user'));

        return $breadcrumb;
    }
}
