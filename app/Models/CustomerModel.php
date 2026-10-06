<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'account_number',
        'customer_name',
        'address',
        'email',
        'phone',
        'meter_number',
        'connection_type',
        'status',
    ];

    protected $validationRules = [
        'id'              => 'permit_empty|is_natural_no_zero',
        'account_number'  => 'required|max_length[50]|is_unique[customer_accounts.account_number,id,{id}]',
        'customer_name'   => 'required|min_length[2]|max_length[150]',
        'address'         => 'required|max_length[255]',
        'email'           => 'permit_empty|valid_email|max_length[100]',
        'phone'           => 'permit_empty|max_length[20]',
        'meter_number'    => 'permit_empty|max_length[50]',
        'connection_type' => 'required|in_list[residential,commercial,industrial]',
        'status'          => 'required|in_list[active,inactive,suspended]',
    ];

    protected $validationMessages = [
        'account_number' => ['required' => 'Account number is required.'],
        'customer_name'  => ['required' => 'Customer name is required.'],
    ];

    public function getCountByStatus(string $status): int
    {
        return $this->where('status', $status)->countAllResults();
    }
}
