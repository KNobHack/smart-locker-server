<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="card col-lg-4 col-md-6 col-sm-12 mt-5 mx-auto">
    <div class="card-body">
        <h5 class="card-title text-center h1">Login</h5>
        <img src="<?= base_url('/assets/Logo.png') ?>" alt="" class="img-fluid">
        <?php if ($alert = session('alert')) : ?>
            <div class="alert alert-<?= $alert['type'] ?>" role="alert">
                <?= $alert['message'] ?>
            </div>
        <?php endif; ?>
        <form action="<?= route_to('login') ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" value="<?= old('username') ?>" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Log in</button>
                <a href="<?= route_to('registerPage') ?>" class="card-link">Don't have an account? Sign Up!</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>