<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index()
    {
        $customers = [
            ['full_name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@email.com', 'phone' => '09171234567'],
            ['full_name' => 'Maria Santos', 'email' => 'maria.santos@email.com', 'phone' => '09182345678'],
            ['full_name' => 'Pedro Reyes', 'email' => 'pedro.reyes@email.com', 'phone' => '09193456789'],
            ['full_name' => 'Ana Lopez', 'email' => 'ana.lopez@email.com', 'phone' => '09204567890'],
            ['full_name' => 'Jose Garcia', 'email' => 'jose.garcia@email.com', 'phone' => '09215678901'],
        ];

        $data['customers'] = $customers;

        return view('customers/index', $data);
    }
}