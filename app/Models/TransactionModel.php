<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $allowedFields = ['user_id', 'category_id', 'amount', 'date', 'description'];
}