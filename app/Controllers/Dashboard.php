<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;

class Dashboard extends BaseController
{
    protected CustomerAccountModel $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        $keyword = trim((string) $this->request->getGet('search'));
        $status  = (string) $this->request->getGet('status');
        $type    = (string) $this->request->getGet('type');
        $perPage = 10;

        switch (true) {
            case $keyword !== '':
                $accounts = $this->customerModel->searchAccounts($keyword, $perPage);
                break;

            case in_array($status, ['active', 'inactive', 'suspended'], true):
                $accounts = $this->customerModel->getAccountsByStatus($status, $perPage);
                break;

            case in_array($type, ['residential', 'commercial', 'industrial'], true):
                $accounts = $this->customerModel->getAccountsByType($type, $perPage);
                break;

            default:
                $accounts = $this->customerModel->getAccountsPaginated($perPage);
        }

        return view('dashboard/index', [
            'title'              => 'Customer Accounts Dashboard',
            'accounts'           => $accounts,
            'pager'              => $this->customerModel->pager,
            'total_accounts'     => $this->customerModel->getTotalAccounts(),
            'active_accounts'    => $this->customerModel->getCountByStatus('active'),
            'inactive_accounts'  => $this->customerModel->getCountByStatus('inactive'),
            'suspended_accounts' => $this->customerModel->getCountByStatus('suspended'),
            'current_page'       => $this->customerModel->pager->getCurrentPage('default'),
            'search_keyword'     => $keyword,
            'filter_status'      => $status,
            'filter_type'        => $type,
        ]);
    }

    public function viewcount(int $id)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        $account = $this->customerModel->find($id);

        if ($account === null) {
            return redirect()->to(base_url('dashboard'))->with('error', 'Account not found.');
        }

        return view('dashboard/view_account', [
            'title'   => 'Customer Account Details',
            'account' => $account,
        ]);
    }
}
