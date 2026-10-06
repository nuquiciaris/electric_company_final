<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5" style="max-width: 850px;">
        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary mb-3">Back to Dashboard</a>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Account <?= esc($account['account_number']) ?></h1>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Customer Name</dt><dd class="col-sm-8"><?= esc($account['customer_name']) ?></dd>
                    <dt class="col-sm-4">Address</dt><dd class="col-sm-8"><?= esc($account['address']) ?></dd>
                    <dt class="col-sm-4">Phone</dt><dd class="col-sm-8"><?= esc($account['phone']) ?></dd>
                    <dt class="col-sm-4">Email</dt><dd class="col-sm-8"><?= esc($account['email']) ?></dd>
                    <dt class="col-sm-4">Meter Number</dt><dd class="col-sm-8"><?= esc($account['meter_number']) ?></dd>
                    <dt class="col-sm-4">Connection Type</dt><dd class="col-sm-8"><?= esc(ucfirst($account['connection_type'])) ?></dd>
                    <dt class="col-sm-4">Status</dt><dd class="col-sm-8"><?= esc(ucfirst($account['status'])) ?></dd>
                    <dt class="col-sm-4">Created</dt><dd class="col-sm-8"><?= esc($account['created_at']) ?></dd>
                    <dt class="col-sm-4">Updated</dt><dd class="col-sm-8"><?= esc($account['updated_at']) ?></dd>
                </dl>
            </div>
        </div>
    </main>
</body>
</html>
