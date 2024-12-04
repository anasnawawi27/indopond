<?php

namespace Modules\Admin\Controllers;

use \App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ItemModel;
use \App\Models\UnitTypesModel;
use Cloudinary\Api\Upload\UploadApi;

class Item extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->data['menu'] = 'item';
        $this->data['module'] = $this->data['menu'];
        $this->data['module_url'] = route_to('items');
        $this->data['filter_name'] = 'table_filter_item';
        $this->model = new ItemModel();
    }

    public function index()
    {
        $this->data['table'] = [
            'columns' => [
                [
                    'title'         => lang('Item.thumbnail'),
                    'field'         => 'thumbnail',
                    'sortable'      => 'false',
                    'switchable'    => 'false',
                    'formatter'     => 'imageFormatterDefault',
                ],
                [
                    'title'         => lang('Item.name'),
                    'field'         => 'name',
                    'sortable'      => 'true',
                    'switchable'    => 'true',
                ],
                [
                    'title'         => lang('Item.display_price'),
                    'field'         => 'display_price',
                    'sortable'      => 'true',
                    'switchable'    => 'true',
                    'formatter'     => 'currencyFormatterDefault'
                ],
            ],
            'url'       => route_to('item_list'),
            'cookie_id' => 'table-unit-item'
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
        $this->data['title'] = lang('Item.heading');
        $this->data['heading'] = lang('Item.heading');
        $this->data['left_toolbar'] = sprintf(lang('Common.btn.add'), route_to('item_form', 0), lang('Item.add_heading'));
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
                'id'        => 'id',
                'type'      => 'hidden',
                'value'     => ($data) ? $data->id : '',
            ],
            [
                'id'        => 'name',
                'value'     => ($data) ? $data->name : '',
                'label'     => lang('Item.name'),
                'required'  => 'required',
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'                    => 'category_id',
                'value'                 => ($data) ? $data->category_id : '',
                'label'                 => lang('Item.category'),
                'type'                  => 'dropdown',
                'class'                 => 'select2',
                'options'               => $this->_dropdownCategories(),
                'required'              => 'required',
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'       => 'description',
                'value'    => ($data) ? $data->description : '',
                'label'    => lang('Item.description'),
                'type'     => 'textarea',
                'form_control_class' => 'col-md-8 mb-3',
                'class'    => 'editor',
                'required' => 'required',
                'rows'     => 3,
            ],
            [
                'id'        => 'embed_video_youtube',
                'value'     => ($data) ? $data->embed_video_youtube : '',
                'label'     => lang('Item.embed_video_youtube'),
                'form_control_class' => 'col-md-5 mb-3'
            ],
            [
                'id'                    => 'thumbnail',
                'value'                 => ($data) ? $data->thumbnail : '',
                'label'                 => lang('Item.thumbnail'),
                'type'                  => 'image',
            ],
            [
                'type'  => 'html',
                'form_control_class' => 'col-md-12',
                'html'  => $this->_html_display_price($data)
            ],
            [
                'type'  => 'html',
                'form_control_class' => 'col-md-12 mt-4',
                'html'  => $this->_html_slide_image_input()
            ],
            [
                'type'  => 'html',
                'form_control_class' => 'col-md-12 mt-4 variant-form '  . ($data ? ($data->with_variant === '0' ? 'd-none' : '') : 'd-none'),
                'html'  => $this->_html_variants($data)
            ],
            [
                'type'                  => 'submit',
                'label'                 => lang('Common.btn.save_w_icon'),
                'back_url'              => $this->data['module_url'],
                'back_label'            => lang('Common.cancel'),
                'input_container_class' => 'form-group row text-right mt-4 border-top pt-4'
            ],
        ];

        if ($data && $data->image_slides) {
            $this->data['image_slides_edit'] = json_encode($data->image_slides);
        }

        $form_builder = new \App\Libraries\FormBuilder();
        $this->data['form'] = [
            'action'    => route_to('item_save'),
            'build'     => $form_builder->build_form_horizontal($form),
        ];
        $this->data['breadcrumb'] = $breadcrumb->render();
        $this->data['data'] = $data;

        $this->data['pluginCSS'] = [
            base_url('css/filepond-plugin-image-preview.min.css'),
            base_url('css/filepond.min.css')
        ];
        $this->data['pluginJS'] = [
            base_url('js/filepond.min.js'),
            base_url('js/filepond-plugin-file-encode.js'),
            base_url('js/filepond-plugin-image-preview.min.js'),
            base_url('js/filepond.jquery.js'),
        ];
        $this->data['title'] = ($data ? lang('Common.edit') : lang('Common.add')) . ' ' . lang('Item.heading');
        $this->data['heading'] = $this->data['title'];
        return view('form_default', $this->data);
    }

    private function _html_display_price($data = NULL)
    {
        $html = '
        <div class="form-group row">
            <label for="with-variant" class="col-form-label col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4"></label>
            <div class="col-md-5">
                <div class="form-check form-switch">
                    <input type="checkbox" name="with_variant" class="form-check-input" role="switch" id="with-variant" ' . ($data ? ($data->with_variant === '1' ? 'checked' : '') : '') . '>
                    <label for="with-variant" class="form-check-label">Have Variant</label>
                </div>
            </div>
        </div>';
        $html .= '
        <div class="form-group row display-price ' . ($data ? ($data->with_variant === '1' ? 'd-none' : '') : '') . '">
            <label for="display-price" class="col-form-label col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4 col-md-2 col-sm-4">
                Display Price
            </label>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" name="display_price" value="' . ($data ? $data->display_price : '') . '" id="display-price" label="Display Price" class="form-control number"> 
                </div>
            </div>
        </div>';

        return $html;
    }

    private function _html_variants($data = NULL)
    {

        $rows = '<tr data-index="0">
                    <td>
                        <input type="text" class="form-control" name="variant[]">
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control number" name="price[]">
                        </div>
                    </td>
                    <td style="width:48px">
                        <a href="javascript:void(0)" class="text-danger btn btn-icon btn-pure danger remove-variant" data-index="0">
                            <i class="fi-close"></i>
                        </a>
                    </td>
                </tr>';
        if ($data) {
            $variantModel = new \App\Models\ItemVariantModel();
            $variants = $variantModel->where(['item_id' => $data->id])->findAll();

            $rows = '';
            foreach ($variants as $index => $value) {
                $removeButton =  $index !== 0 ?
                    '<a href="javascript:void(0)" class="text-danger btn btn-icon btn-pure danger remove-variant" data-index="' . $index . '">
                    <i class="fi-close"></i>
                </a>' : '';

                $rows .= '<tr data-rowIndex="' . $index . '">
                            <td>
                                <input type="text" class="form-control" name="variant[]" value="' . $value->variant . '">
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control number" name="price[]" value="' . $value->price . '">
                                </div>
                            </td>
                            <td style="width:48px">' . $removeButton . '</td>
                        </tr>';
            }
        }

        $html = '<h3 class="font-weight-bolder mb-2">Variant</h3>';
        $html .= '<div class="table-responsive">
                        <div class="card border rounded">
                            <div class="card-content p-0">
                                <table class="table mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Variant Item</th>
                                            <th>Price</th>
                                            <th style="width:48px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="form-table-variants">
                                        ' . $rows . '
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="button" id="add-variant" class="btn btn-info round float-right mt-3"><i class="fi-plus"></i> &nbsp;Add Variant</button>
                </div>';
        return $html;
    }

    private function _html_slide_image_input()
    {
        $html = '<h3 class="font-weight-bolder mb-2">Image Slides</h3>
                <input multiple accept="image/*" class="filepond" type="file"  data-max-file-size="5MB"/>';
        return $html;
    }

    public function get_list()
    {
        $this->request->isAJAX() or exit();
        $getData = $this->request->getGet();

        $filter['name'] = $getData['search'];
        $table = new \App\Models\TableModel('items');
        if (isset($getData['sort'])) {
            $table->setOrder([
                'sort'  => $getData['sort'],
                'order' => $getData['order']
            ]);
        }
        $table->setLimit($getData['offset'], $getData['limit']);
        $table->setFilter($filter);
        $table->setSelect("a.id, a.name, a.display_price, a.thumbnail, '" . route_to('item_form', 'ID') . "' AS `edit`, '" . route_to('item_delete', 'ID') . "' AS `delete`");
        $output['rows'] = $table->getAll();
        $output['total'] = $table->countAll();
        $table->setFilter();
        $output['totalNotFiltered'] = $table->countAll();
        echo json_encode($output);
    }

    public function save()
    {
        $this->request->isAJAX() or exit();
        $rules = [
            'name' => [
                'label' => lang('Item.name'),
                'rules' => 'required',
                'errors' => [
                    'required' => 'Item Name wajib diisi'
                ]
            ]
        ];

        $return['status'] = 'error';

        do {
            if (!$this->validate($rules)) {
                $return['message'] = $this->validator->listErrors('bootstrap_list');
                break;
            }
            $postData = input_filter($this->request->getPost());

            $image = $this->request->getFile('upload_image');
            $cld = new UploadApi();
            if ($image) {
                if ($image->isValid()) {
                    $upload = $cld->upload($image->getRealPath(), ['folder' => 'indopond/items']);
                    $postData['thumbnail'] = $upload['public_id'];
                }
            } else {
                if (isset($postData['id'])) {
                    if ($image = $this->model->find($postData['id'])) {
                        $postData['thumbnail'] = $image->thumbnail;
                        if ($image->thumbnail) {
                            if (isset($postData['delete_image']) && $postData['delete_image'] === '1') {
                                $postData['thumbnail'] = NULL;
                            }
                        }
                    }
                }
            }

            $files = $this->request->getPost('image_slides');
            $arrayFile = [];
            if ($files && count($files) > 0 && $files[0]) {

                foreach ($files as $file) {
                    $data = json_decode($file);
                    $base64  = 'data:' . $data->type . ';base64,' . $data->data;
                    $upload = $cld->upload($base64, ['folder' => 'indopond/items']);

                    $arrayFile[] = ['public_id' => $upload['public_id'], 'secure_url' => $upload['secure_url']];
                }
            }
            $variantModel = new \App\Models\ItemVariantModel();

            $postData['image_slides'] = count($arrayFile) > 0 ? json_encode($arrayFile) : NULL;

            if (isset($postData['with_variant'])) {
                if ($postData['with_variant'] === 'on') {
                    $postData['with_variant'] = 1;
                    $postData['display_price'] = NULL;
                    if (isset($postData['variant']) && isset($postData['price'])) {
                        if (count($postData['variant']) > 0 && count($postData['price']) > 0) {
                            $postData['display_price'] = $postData['price'][0];
                        }
                    }
                }
            } else {
                $postData['with_variant'] = 0;
            }

            if (!$postData['id']) {
                $this->model->insert($postData);
                $postData['id'] = $this->model->getInsertID();
            } else {
                $existing = $this->model->find($postData['id']);
                if ($existing->image_slides) {
                    foreach (json_decode($existing->image_slides) as $val) {
                        $cld->destroy($val->public_id);
                    }
                }
                $this->model->update($postData['id'], $postData);
                $variantModel->where('item_id', $postData['id'])->delete();
            }

            if (isset($postData['with_variant']) && isset($postData['variant']) && isset($postData['price'])) {
                $variant = $postData['variant'] ?? NULL;
                $price = $postData['price'] ?? 0;

                foreach ($postData['variant'] as $index => $val) {
                    $payload = [
                        'item_id' => $postData['id'],
                        'variant' => $variant[$index],
                        'price' => $price[$index]
                    ];
                    $variantModel->insert($payload);
                }
            }

            $return = [
                'message'  => sprintf(lang('Common.saved.success'), lang('Item.heading') . ' ' . $postData['name']),
                'status'   => 'success',
                'redirect' => route_to('items')
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
            $variantModel = new \App\Models\ItemVariantModel();
            $variantModel->where('item_id', $id)->delete();
            $return = ['message' => sprintf(lang('Common.deleted.success'), lang('Item.heading') . ' ' . $data->name), 'status' => 'success'];
        } else {
            $return = ['message' => lang('Common.not_found'), 'status' => 'error'];
        }
        echo json_encode($return);
    }

    private function _dropdownCategories()
    {
        $categories = new CategoryModel();
        $categories = $categories->findAll();
        $options = ['' => ''];
        if ($categories) {
            foreach ($categories as $category) {
                $options[$category->id] = ucwords($category->name);
            }
        }
        return $options;
    }

    private function _setDefaultBreadcrumb()
    {
        $breadcrumb = new \App\Libraries\Breadcrumb;
        $breadcrumb->add(lang('Common.home'), site_url());
        $breadcrumb->add(lang('Item.heading'), route_to('items'));

        return $breadcrumb;
    }
}
