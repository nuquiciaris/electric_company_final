<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puihaha Electric - Customer Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px 0; }
        .main-container { background: white; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,.1); padding: 30px; margin: 20px auto; }
        .header-section { text-align: center; margin-bottom: 30px; }
        .header-section h1 { color: #667eea; font-weight: bold; }
        .stats-card { border-radius: 10px; padding: 20px; margin-bottom: 20px; color: white; }
        .stats-card h3 { font-size: 2rem; font-weight: bold; margin: 0; }
        .stats-card p { margin: 5px 0 0; opacity: .9; }
        .card-total { background: linear-gradient(135deg, #667eea, #764ba2); }
        .card-active { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .card-inactive { background: linear-gradient(135deg, #ee0979, #ff6a00); }
        .card-suspended { background: linear-gradient(135deg, #fc4a1a, #f7b733); }
        .search-filter-section { background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        .table-container { overflow-x: auto; }
        .badge-active { background-color: #28a745; }
        .badge-inactive { background-color: #dc3545; }
        .badge-suspended { background-color: #ffc107; color: #000; }
        .pagination { margin-top: 20px; }
        .pagination a, .pagination span { margin-right: 8px; }
    </style>
</head>
<body>
<div class="container">
    <div class="main-container">
        <div class="header-section">
            <h1><i class="bi bi-lightning-charge-fill text-warning"></i> Puihaha Electric Company</h1>
            <p class="text-muted">Customer Account Management System</p>
            <p class="text-muted">Logged in as <strong><?= esc(session()->get('username') ?? 'User') ?></strong></p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">
            <a href="<?= base_url('accounts/new') ?>" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add Account</a>
            <form method="post" action="<?= base_url('logout') ?>">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </div>

        <div class="row mb-4">
            <div class="col-md-3"><div class="stats-card card-total"><h3><?= esc($total) ?></h3><p>Total Accounts</p></div></div>
            <div class="col-md-3"><div class="stats-card card-active"><h3><?= esc($active) ?></h3><p>Active Accounts</p></div></div>
            <div class="col-md-3"><div class="stats-card card-inactive"><h3><?= esc($inactive) ?></h3><p>Inactive Accounts</p></div></div>
            <div class="col-md-3"><div class="stats-card card-suspended"><h3><?= esc($suspended) ?></h3><p>Suspended Accounts</p></div></div>
        </div>

        <div class="search-filter-section">
            <form method="get" action="<?= base_url('accounts') ?>">
                <div class="row g-3">
                    <div class="col-md-4"><input type="text" class="form-control" name="search" placeholder="Search by name, account, email, phone..." value="<?= esc($search) ?>"></div>
                    <div class="col-md-3"><select class="form-select" name="status"><option value="">All Status</option><?php foreach (['active', 'inactive', 'suspended'] as $option): ?><option value="<?= $option ?>" <?= $status === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-3"><select class="form-select" name="type"><option value="">All Types</option><?php foreach (['residential', 'commercial', 'industrial'] as $option): ?><option value="<?= $option ?>" <?= $type === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Search</button></div>
                </div>
            </form>
            <?php if ($search || $status || $type): ?><div class="mt-2"><a href="<?= base_url('accounts') ?>" class="btn btn-sm btn-secondary"><i class="bi bi-x-circle"></i> Clear Filters</a></div><?php endif; ?>
        </div>

        <div class="table-container">
            <table class="table table-hover">
                <thead class="table-dark"><tr><th>Account Number</th><th>Customer Name</th><th>Email</th><th>Phone</th><th>Connection Type</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                <?php if (empty($accounts)): ?>
                    <tr><td colspan="7" class="text-center text-muted">No accounts found</td></tr>
                <?php else: ?>
                    <?php foreach ($accounts as $account): ?>
                        <tr>
                            <td><strong><?= esc($account['account_number']) ?></strong></td>
                            <td><?= esc($account['customer_name']) ?></td>
                            <td><?= esc($account['email'] ?? '') ?></td>
                            <td><?= esc($account['phone'] ?? '') ?></td>
                            <td><span class="badge bg-info"><?= esc(ucfirst($account['connection_type'])) ?></span></td>
                            <td><span class="badge badge-<?= esc($account['status']) ?>"><?= esc(ucfirst($account['status'])) ?></span></td>
                            <td class="text-nowrap">
                                <a href="<?= base_url('accounts/' . $account['id']) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> View</a>
                                <a href="<?= base_url('accounts/' . $account['id'] . '/edit') ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i> Edit</a>
                                <form method="post" action="<?= base_url('accounts/' . $account['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Delete this customer account?');">
                                    <?= csrf_field() ?><button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($pager): ?>
            <div class="d-flex justify-content-between align-items-center"><div>Showing page <?= (int) $pager->getCurrentPage() ?> of <?= max(1, (int) $pager->getPageCount()) ?></div><div><?= $pager->links() ?></div></div>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
