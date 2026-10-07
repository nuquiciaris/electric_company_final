<?php

namespace App\Controllers;

use App\Models\UserAccount;

class Auth extends BaseController
{
    protected UserAccount $userAccounts;

    public function __construct()
    {
        $this->userAccounts = new UserAccount();
    }

    public function index()
    {
        if (session()->get('isLoggedIn') === true && session()->get('user_id')) {
            return redirect()->to(base_url('accounts'));
        }

        return view('auth/login', [
            'title' => 'Sign In | Puihaha Electric',
            'page' => 'login',
        ]);
    }

    public function login()
    {
        $email = strtolower(trim((string) $this->request->getPost('username')));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->back()->withInput()->with('error', 'Username and password are required.');
        }

            $user = $this->userAccounts->where('email', $email)->first();        
        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        session()->regenerate(true);
        session()->set([
            'isLoggedIn'   => true,
            'logged_in'    => true,
            'user_id'      => $user['id'],
            'username'     => $user['email'],
            'display_name' => $user['first_name'] . ' ' . $user['last_name'],
        ]);

        return redirect()->to(base_url('accounts'));
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(base_url('login'));
    }
}
