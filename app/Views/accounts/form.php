<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Puihaha Electric</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow border-0 mx-auto" style="max-width: 850px;">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4"><h1 class="h3 mb-0"><?= esc($title) ?></h1><a href="<?= base_url('accounts') ?>" class="btn btn-outline-secondary">Back</a></div>

            <?php $errors = session()->getFlashdata('errors') ?? []; ?>
            <?php if ($errors): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

            <?php $action = $editing ? base_url('accounts/' . $account['id'] . '/update') : base_url('accounts'); ?>
            <form method="post" action="<?= $action ?>">
                <?= csrf_field() ?>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="account_number">Account Number</label><input class="form-control" id="account_number" name="account_number" value="<?= esc(old('account_number', $account['account_number'] ?? '')) ?>" required></div>
                    <div class="col-md-6"><label class="form-label" for="customer_name">Customer Name</label><input class="form-control" id="customer_name" name="customer_name" value="<?= esc(old('customer_name', $account['customer_name'] ?? '')) ?>" required></div>
                    <div class="col-12"><label class="form-label" for="address">Address</label><textarea class="form-control" id="address" name="address" rows="3" required><?= esc(old('address', $account['address'] ?? '')) ?></textarea></div>
                    <div class="col-md-6"><label class="form-label" for="phone">Phone</label><input class="form-control" id="phone" name="phone" value="<?= esc(old('phone', $account['phone'] ?? '')) ?>"></div>
                    <div class="col-md-6"><label class="form-label" for="email">Email</label><input class="form-control" type="email" id="email" name="email" value="<?= esc(old('email', $account['email'] ?? '')) ?>"></div>
                    <div class="col-md-4"><label class="form-label" for="meter_number">Meter Number</label><input class="form-control" id="meter_number" name="meter_number" value="<?= esc(old('meter_number', $account['meter_number'] ?? '')) ?>"></div>
                    <div class="col-md-4">
                        <label class="form-label" for="connection_type">Connection Type</label>
                        <?php $selectedType = old('connection_type', $account['connection_type'] ?? 'residential'); ?>
                        <select class="form-select" id="connection_type" name="connection_type"><?php foreach (['residential', 'commercial', 'industrial'] as $option): ?><option value="<?= $option ?>" <?= $selectedType === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach; ?></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="status">Status</label>
                        <?php $selectedStatus = old('status', $account['status'] ?? 'active'); ?>
                        <select class="form-select" id="status" name="status"><?php foreach (['active', 'inactive', 'suspended'] as $option): ?><option value="<?= $option ?>" <?= $selectedStatus === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach; ?></select>
                    </div>
                </div>
                <button class="btn btn-primary mt-4" type="submit">Save Customer Account</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
