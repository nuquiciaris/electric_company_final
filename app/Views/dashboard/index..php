<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?= esc($title) ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f4f6fb;
        }

        .stat-card {
            border: 0;
            color: #ffffff;
        }

        .stat-total {
            background: #5b67d8;
        }

        .stat-active {
            background: #198754;
        }

        .stat-inactive {
            background: #dc3545;
        }

        .stat-suspended {
            background: #f0ad00;
        }

        .badge-active {
            background-color: #198754;
        }

        .badge-inactive {
            background-color: #dc3545;
        }

        .badge-suspended {
            background-color: #f0ad00;
            color: #212529;
        }

        .pagination {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand">
                Puihaha Electric Company
            </span>

            <div>
                <a
                    class="btn btn-outline-light btn-sm me-2"
                    href="<?= base_url('home') ?>"
                >
                    Public Site
                </a>

                <a
                    class="btn btn-light btn-sm"
                    href="<?= base_url('logout') ?>"
                >
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <h1 class="h3 mb-4">
            Customer Accounts Dashboard
        </h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card stat-card stat-total">
                    <div class="card-body">
                        <h2><?= esc($total_accounts) ?></h2>
                        <span>Total Accounts</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-active">
                    <div class="card-body">
                        <h2><?= esc($active_accounts) ?></h2>
                        <span>Active</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-inactive">
                    <div class="card-body">
                        <h2><?= esc($inactive_accounts) ?></h2>
                        <span>Inactive</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-suspended">
                    <div class="card-body">
                        <h2><?= esc($suspended_accounts) ?></h2>
                        <span>Suspended</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form
                    method="get"
                    action="<?= base_url('dashboard') ?>"
                    class="row g-3"
                >
                    <div class="col-md-4">
                        <input
                            type="search"
                            class="form-control"
                            name="search"
                            placeholder="Name, account, email or phone"
                            value="<?= esc($search_keyword) ?>"
                        >
                    </div>

                    <div class="col-md-3">
                        <select
                            class="form-select"
                            name="status"
                        >
                            <option value="">
                                All statuses
                            </option>

                            <option
                                value="active"
                                <?= $filter_status === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                <?= $filter_status === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Inactive
                            </option>

                            <option
                                value="suspended"
                                <?= $filter_status === 'suspended'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Suspended
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select
                            class="form-select"
                            name="type"
                        >
                            <option value="">
                                All connection types
                            </option>

                            <option
                                value="residential"
                                <?= $filter_type === 'residential'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Residential
                            </option>

                            <option
                                value="commercial"
                                <?= $filter_type === 'commercial'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Commercial
                            </option>

                            <option
                                value="industrial"
                                <?= $filter_type === 'industrial'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Industrial
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Account</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if ($accounts === []): ?>
                        <tr>
                            <td
                                colspan="6"
                                class="text-center text-muted py-4"
                            >
                                No accounts found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($accounts as $account): ?>
                            <tr>
                                <td>
                                    <?= esc($account['account_number']) ?>
                                </td>

                                <td>
                                    <?= esc($account['customer_name']) ?>
                                </td>

                                <td>
                                    <?= esc($account['email']) ?>
                                </td>

                                <td>
                                    <?= esc(
                                        ucfirst(
                                            $account['connection_type']
                                        )
                                    ) ?>
                                </td>

                                <td>
                                    <span
                                        class="badge badge-<?= esc(
                                            $account['status']
                                        ) ?>"
                                    >
                                        <?= esc(
                                            ucfirst($account['status'])
                                        ) ?>
                                    </span>
                                </td>

                                <td>
                                    <a
                                        class="btn btn-sm btn-outline-primary"
                                        href="<?= base_url(
                                            'viewcount/'
                                            . $account['id']
                                        ) ?>"
                                    >
                                        <i class="bi bi-eye"></i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div
                class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center gap-3"
            >
                <span>
                    Page <?= esc($current_page) ?>
                    of <?= esc(
                        $pager->getPageCount('default')
                    ) ?>
                </span>

                <?= $pager->links(
                    'default',
                    'default_full'
                ) ?>
            </div>
        </div>
    </main>
</body>
</html>