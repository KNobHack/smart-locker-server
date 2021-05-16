<?= $this->include('layouts/head-auth') ?>
<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <img src="assets/images/LOGO-login.png" alt="" class="img-fluid mb-4">
                        <h4 class="mb-3 f-w-400">Login</h4>
                        <?php if ($alert = session('alert')) : ?>
                            <div class="alert alert-<?= $alert['type'] ?>" role="alert">
                                <?= $alert['message'] ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= route_to('login') ?>" method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <input type="text" class="form-control" placeholder="Username" value="<?= old('username') ?>" name="username">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i data-feather="lock"></i></span>
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                            <button class="btn btn-warning btn-block mb-4 text-white" type="submit">Login</button>
                        </form>
                        <p class="mb-2">Don't have an account?
                            <a href="<?= route_to('registerPage') ?>" class="f-w-400">Sign Up!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('layouts/foot-auth') ?>