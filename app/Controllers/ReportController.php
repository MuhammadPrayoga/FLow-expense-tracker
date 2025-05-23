<?php
namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\CategoryModel;
use Dompdf\Dompdf;

class ReportController extends BaseController
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $transactionModel = new TransactionModel();
        $categoryModel = new CategoryModel();

        // Ambil parameter filter dari form (jika ada)
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        // Ambil data transaksi berdasarkan periode
        $data['transactions'] = $transactionModel
            ->select('transactions.*, categories.name as category_name, categories.type')
            ->join('categories', 'categories.category_id = transactions.category_id')
            ->where('transactions.user_id', session()->get('user_id'))
            ->where('transactions.date >=', $startDate)
            ->where('transactions.date <=', $endDate)
            ->findAll();

        // Ambil data untuk grafik
        $data['chart_data'] = $transactionModel
            ->select('categories.name, categories.type, SUM(transactions.amount) as total_amount')
            ->join('categories', 'categories.category_id = transactions.category_id')
            ->where('transactions.user_id', session()->get('user_id'))
            ->where('transactions.date >=', $startDate)
            ->where('transactions.date <=', $endDate)
            ->groupBy('categories.category_id')
            ->findAll();

        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;

        return view('reports/index', $data);
    }

    public function exportPdf()
    {
        $transactionModel = new TransactionModel();
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        // Ambil data transaksi untuk PDF
        $transactions = $transactionModel
            ->select('transactions.*, categories.name as category_name, categories.type')
            ->join('categories', 'categories.category_id = transactions.category_id')
            ->where('transactions.user_id', session()->get('user_id'))
            ->where('transactions.date >=', $startDate)
            ->where('transactions.date <=', $endDate)
            ->findAll();

        // Buat HTML untuk PDF
        $html = view('reports/pdf_template', [
            'transactions' => $transactions,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        // Inisialisasi dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $dompdf->stream('Laporan_Transaksi_' . $startDate . '_to_' . $endDate . '.pdf', ['Attachment' => true]);
    }
}