<?= $this->include('layouts/head') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <?= $this->renderSection('content') ?>
        <!-- [ Main Content ] end -->
    </div>
</div>

<?= $this->include('layouts/required-js') ?>
<?= $this->renderSection('js') ?>
<?= $this->include('layouts/foot') ?>