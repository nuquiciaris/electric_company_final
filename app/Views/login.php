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
</head>

<body class="bg-light">
    <div
        class="container min-vh-100 d-flex align-items-center justify-content-center"
    >
        <div
            class="card shadow border-0"
            style="width: 100%; max-width: 420px;"
        >
            <div class="card-body p-5">
                <h1 class="h3 text-center mb-2">
                    Puihaha Electric Company
                </h1>

                <p class="text-muted text-center mb-4">
                    Dashboard Login
                </p>

                <form
                    method="post"
                    action="<?= base_url('login') ?>"
                >
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label
                            for="username"
                            class="form-label"
                        >
                            Username
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                        >
                    </div>

                    <div class="mb-4">
                        <label
                            for="password"
                            class="form-label"
                        >
                            Password
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100"
                    >
                        Login
                    </button>
                </form>

                <p class="small text-muted text-center mt-3 mb-0">
                    Temporary login: credentials are not checked yet.
                </p>
            </div>
        </div>
    </div>
</body>
</html>