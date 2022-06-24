<?php require_once __DIR__ . '/../templates/header.php' ?>
<?php var_dump($_SESSION) ?? "Belum ada Session"; ?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-4">
            <main class="form-signin w-100" style="margin: 250px 0;">
                <form action="/login" method="POST">
                    <img src="<?= BASE_URL . 'assets/img/logo.png' ?>" class="rounded-3" alt="..." width="50" height="50">
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                    <?php if (isset($_SESSION['message_error'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            Gagal Login
                        </div>
                    <?php endif; ?>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Enter user ID" name="name">
                        <label for="floatingInput">User ID</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-dark" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') ?></p>
                </form>
            </main>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php' ?>