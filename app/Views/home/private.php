<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="row">
    <!-- customer-section start -->
    <div class="col-xl-12 col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Your private lockers</h5>
            </div>
            <div class="pro-scroll" style="height:300px;position:relative;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-b-0">
                            <thead>
                                <tr>
                                    <th>Locker ID</th>
                                    <th>Locker's Status</th>
                                    <th>Stuff(s) Weight</th>
                                    <th>Lock Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lockers as $locker) : ?>
                                    <tr>
                                        <td><?= $locker['id'] ?></td>
                                        <td>
                                            <div><label class="badge bg-light-<?= $locker['status_badge'] ?>"><?= $locker['status'] ?></label></div>
                                        </td>
                                        <td><?= $locker['weight'] ?> g</td>
                                        <td>
                                            <span class="material-icons-two-tone">
                                                <?= ($locker['status_lock']) ? 'lock' : 'lock_open' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#!" data-toggle="modal" data-target="#LockerModal">
                                                <i class="icon feather icon-info f-16 text-primary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customer-section end -->
</div>

<div id="LockerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="LockerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LockerModalTitle">Locker Detail</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Locker ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" readonly value="1234">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Locker Status</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" readonly value="Empty">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Weight</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" readonly value="1234">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Lock Status</label>
                        <div class="col-sm-9 my-auto">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Sterelize</label>
                        <div class="col-sm-9">
                            <button class="btn btn-success btn-sm" type="button">
                                <i class="feather icon-download-cloud"></i>
                                Sterelize Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>