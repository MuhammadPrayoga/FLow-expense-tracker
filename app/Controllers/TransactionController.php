<?php
namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\CategoryModel;

class TransactionController extends BaseController
{
    public function index()
    {
        $model = new TransactionModel();
        $data['transactions'] = $model->where('user_id', session()->get('user_id'))->findAll();
        return view('transactions/index', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('transactions/create', $data);
    }

    public function store()
    {
        $model = new TransactionModel();
        $data = [
            'user_id' => session()->get('user_id'),
            'category_id' => $this->request->getPost('category_id'),
            'amount' => $this->request->getPost('amount'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description')
        ];
        $model->insert($data);
        return redirect()->to('/transactions');
    }
}