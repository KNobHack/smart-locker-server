<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="card col-lg-4 col-md-6 col-sm-12 mt-5 mx-auto">
    <div class="card-body">
        <h5 class="card-title text-center">Login</h5>
        <img src="Logo.png" alt="" class="img-fluid">
        <form action="<?= route_to('login') ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
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