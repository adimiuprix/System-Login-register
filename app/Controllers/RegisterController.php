<?php namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Register page'
        ];

        return view('auth/register', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('nama');
        $email = $this->request->getPost('surel');
        $password = $this->request->getPost('password');

        $user = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];

        $save = $this->model->save($user);

        if ($save) {
            session()->setFlashdata('success', 'Register Berhasil!');
            return redirect()->to(base_url('login'));
        } else {
            session()->setFlashdata('error', $this->model->errors());
            return redirect()->back();
        }
    }
}