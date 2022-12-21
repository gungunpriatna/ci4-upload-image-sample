<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ImageModel;
class ImageController extends BaseController
{
    public function __construct()
    {
        $this->model = new ImageModel();
        $this->helpers = ['form', 'url'];

    }

    public function index()
    {
        $data = [
            'images' => $this->model->paginate(6),
            'pager' => $this->model->pager,
            'title' => 'Image Gallery - Seri Tutorial CodeIgniter 4: Fitur Upload @ qadrlabs.com'
        ];

        return view('images/index', $data);
    }
}
