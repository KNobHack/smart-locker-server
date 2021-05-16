<?= $this->include('layouts/head-auth') ?>

<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <!-- <img src="Logo.png" alt="" class="img-fluid mb-4"> -->
                        <h4 class="mb-3 f-w-400">Sign up</h4>
                        <?php if ($alert = session('alert')) : ?>
                            <div class="alert alert-<?= $alert['type'] ?>" role="alert">
                                <?= $alert['message'] ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= route_to('register') ?>" method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <input type="text" class="form-control" placeholder="Username" value="<?= old('username') ?>" name="username">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i data-feather="lock"></i></span>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <button class="btn btn-warning btn-block mb-4">Sign up</button>
                            <p class="mb-2">Already have an account? <a href="<?= route_to('loginPage') ?>" class="f-w-400">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('layouts/head-auth') ?>