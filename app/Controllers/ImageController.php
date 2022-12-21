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

    public function create()
    {
        $data = [
            'title' => 'Upload new image - Seri Tutorial CodeIgniter 4: Fitur Upload @ qadrlabs.com'
        ];

        return view('images/create', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect('index');
        }

        $validationRule = [
            'image' => [
                'label' => 'Image File',
                'rules' => 'uploaded[image]'
                    . '|is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[image,1000]'
                    . '|max_dims[image,4000,4000]',
            ],
        ];
        $validated = $this->validate($validationRule);

        if ($validated) {
            $caption = $this->request->getPost('caption');
            $image = $this->request->getFile('image');
            $filename = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $filename);

            $uploadedImage = [
                'caption' => $caption,
                'path' => $image->getName()
            ];

            $save = $this->model->save($uploadedImage);
            if ($save) {
                return redirect()->to(base_url('image'))
                    ->with('success', 'Image uploaded');
            } else {
                session()->setFlashdata('error', $this->model->errors());
                return redirect()->back();
            }

        }

        session()->setFlashdata('error', $this->validator->getErrors());
        return redirect()->back();

    }
}
