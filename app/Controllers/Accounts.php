<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Accounts extends BaseController
{
    protected CustomerModel $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $keyword = trim((string) $this->request->getGet('search'));
        $status  = (string) $this->request->getGet('status');
        $type    = (string) $this->request->getGet('type');

        $query = $this->customerModel;

        if ($keyword !== '') {
            $query->groupStart()
                ->like('account_number', $keyword)
                ->orLike('customer_name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
                ->groupEnd();
        }

        if (in_array($status, ['active', 'inactive', 'suspended'], true)) {
            $query->where('status', $status);
        } else {
            $status = '';
        }

        if (in_array($type, ['residential', 'commercial', 'industrial'], true)) {
            $query->where('connection_type', $type);
        } else {
            $type = '';
        }

        $accounts = $query->orderBy('created_at', 'DESC')->paginate(10);

        return view('accounts/index', [
            'title'            => 'Customer Accounts',
            'accounts'         => $accounts,
            'total'            => $this->customerModel->countAll(),
            'active'           => $this->customerModel->getCountByStatus('active'),
            'inactive'         => $this->customerModel->getCountByStatus('inactive'),
            'suspended'        => $this->customerModel->getCountByStatus('suspended'),
            'search'           => $keyword,
            'status'           => $status,
            'type'             => $type,
            'pager'            => $query->pager,
        ]);
    }

    public function newAccount()
    {
        return view('accounts/form', [
            'title'   => 'Add Customer Account',
            'account' => [],
            'editing' => false,
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost([
            'account_number', 'customer_name', 'address', 'email', 'phone',
            'meter_number', 'connection_type', 'status',
        ]);
        $data['email'] = trim((string) ($data['email'] ?? '')) ?: null;
        $data['phone'] = trim((string) ($data['phone'] ?? '')) ?: null;
        $data['meter_number'] = trim((string) ($data['meter_number'] ?? '')) ?: null;

        if (!$this->customerModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->customerModel->errors());
        }

        return redirect()->to(base_url('accounts'))->with('success', 'Customer account added successfully.');
    }

    public function viewAccount(int $id)
    {
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to(base_url('accounts'))->with('error', 'Account not found.');
        }

        return view('accounts/view_account', [
            'title'   => 'Customer Account Details',
            'account' => $account,
        ]);
    }

    public function edit(int $id)
    {
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to(base_url('accounts'))->with('error', 'Account not found.');
        }

        return view('accounts/form', [
            'title'   => 'Edit Customer Account',
            'account' => $account,
            'editing' => true,
        ]);
    }

    public function update(int $id)
    {
        if (!$this->customerModel->find($id)) {
            return redirect()->to(base_url('accounts'))->with('error', 'Account not found.');
        }

        $data = $this->request->getPost([
            'account_number', 'customer_name', 'address', 'email', 'phone',
            'meter_number', 'connection_type', 'status',
        ]);
        $data['email'] = trim((string) ($data['email'] ?? '')) ?: null;
        $data['phone'] = trim((string) ($data['phone'] ?? '')) ?: null;
        $data['meter_number'] = trim((string) ($data['meter_number'] ?? '')) ?: null;

        // The id is used by the uniqueness rule, then discarded by field protection.
        $data['id'] = $id;
        if (!$this->customerModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->customerModel->errors());
        }

        return redirect()->to(base_url('accounts/' . $id))->with('success', 'Customer account updated successfully.');
    }

    public function delete(int $id)
    {
        if (!$this->customerModel->find($id)) {
            return redirect()->to(base_url('accounts'))->with('error', 'Account not found.');
        }

        $this->customerModel->delete($id);

        return redirect()->to(base_url('accounts'))->with('success', 'Customer account deleted successfully.');
    }
}
