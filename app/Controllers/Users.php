<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $users = [
            ['username' => 'admin01', 'full_name' => 'Cedrick Valera', 'role' => 'Administrator'],
            ['username' => 'cashier1', 'full_name' => 'Liza Cruz', 'role' => 'Cashier'],
            ['username' => 'cashier2', 'full_name' => 'Mark Tan', 'role' => 'Cashier'],
            ['username' => 'manager1', 'full_name' => 'Grace Uy', 'role' => 'Manager'],
            ['username' => 'staff01', 'full_name' => 'Rico Bautista', 'role' => 'Staff'],
        ];

        $data['users'] = $users;

        return view('users/index', $data);
    }
}