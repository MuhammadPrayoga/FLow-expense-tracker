<?php
namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $categoryModel = new CategoryModel();
        $transactionModel = new TransactionModel();

        // Ambil daftar kategori untuk form
        $data['categories'] = $categoryModel->where('type', 'expense')->findAll();

        // Ambil data untuk grafik: total pengeluaran per kategori
        $data['chart_data'] = $transactionModel
            ->select('categories.name, SUM(transactions.amount) as total_expense')
            ->join('categories', 'categories.category_id = transactions.category_id')
            ->where('categories.type', 'expense')
            ->where('transactions.user_id', session()->get('user_id'))
            ->groupBy('categories.category_id')
            ->findAll();

        return view('dashboard/index', $data);
    }
}