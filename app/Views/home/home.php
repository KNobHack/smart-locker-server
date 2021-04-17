<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="card mt-5">
    <div class="card-body">
        <h5 class="card-title text-center">Welcome <?= $username ?></h5>
        <div class="d-grid gap-2 mx-auto">
            <a href="" class="btn btn-primary">Public</a>
            <a href="" class="btn btn-secondary">Private</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>