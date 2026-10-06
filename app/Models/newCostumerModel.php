<?php

namespace App\Models;

use CodeIgniter\Model;

class newCustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'account_number',
        'customer_name',
        'email',
        'phone',
        'connection_type',
        'status',
        'created_at'
    ];

    public function getCountByStatus($status)
    {
        return $this
            ->where('status', $status)
            ->countAllResults();
    }
}