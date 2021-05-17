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
                                    <?php $lkr_id = $locker['id'] ?>
                                    <tr>
                                        <td><?= $locker['id'] ?></td>
                                        <td>
                                            <div>
                                                <label id="tbl-locker-status-<?= $lkr_id ?>" class="badge bg-light-<?= $locker['status_badge'] ?>">
                                                    <?= $locker['status'] ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td id="tbl-locker-weight-<?= $lkr_id ?>"><?= $locker['weight'] ?>g</td>
                                        <td>
                                            <span id="tbl-locker-lock-<?= $lkr_id ?>" class="material-icons-two-tone">
                                                <?= ($locker['status_lock']) ? 'lock' : 'lock_open' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#!" data-toggle="modal" data-target="#LockerModal" data-locker_id="<?= $locker['id'] ?>">
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
                            <input type="text" class="form-control-plaintext locker_id" readonly value="1234">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Locker Status</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext locker_status" readonly value="Empty">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Weight</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext locker_weight" readonly value="1234">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Sterelize</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext locker_sterilize" readonly value="1234">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Lock Status</label>
                        <div class="col-sm-9 my-auto">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input lock_status">
                            </div>
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

<?= $this->section('js') ?>
<script>
    async function lockerStatus(locker_id) {
        let url = `<?= base_url() ?>/api/locker/status/${locker_id}`;
        let response = await fetch(url);

        if (response.ok) { // if HTTP-status is 200-299
            // get the response body (the method explained below)
            let json = await response.json();
            return json;
        } else {
            alert("HTTP-Error: " + response.status);
        }
    }

    async function lockerLock(locker_id, lock) {
        let url = `<?= base_url() ?>/api/locker/lock/${locker_id}/${lock}`;
        let response = await fetch(url);

        if (response.ok) { // if HTTP-status is 200-299
            // get the response body (the method explained below)
            let json = await response.json();
            return json;
        } else {
            alert("HTTP-Error: " + response.status);
        }
    }

    async function LockerStatuses() {
        let url = `<?= base_url() ?>/api/lockers/statuses/`;
        let response = await fetch(url);

        if (response.ok) { // if HTTP-status is 200-299
            // get the response body (the method explained below)
            let json = await response.json();
            return json;
        } else {
            alert("HTTP-Error: " + response.status);
        }
    }

    $('#LockerModal').on('show.bs.modal', async function(event) {
        var button = $(event.relatedTarget)
        var locker_id = button.data('locker_id')
        let response = await lockerStatus(locker_id)

        var modal = $(this)
        modal.find('.locker_id').val(response.id)
        modal.find('.locker_status').val(response.status)
        modal.find('.locker_weight').val(response.weight + "g")
        modal.find('.locker_sterilize').val(response.sterilize)

        if (response.status_lock == '1') {
            modal.find('.lock_status').prop('checked', true);
        } else {
            modal.find('.lock_status').prop('checked', false);
        }
    });

    async function refreshTable() {
        let response = await LockerStatuses();
        let status, weight, lock;
        for (let i = 0; i < response.length; i++) {
            status = $('#tbl-locker-status-' + response[i].id);
            weight = $('#tbl-locker-weight-' + response[i].id);
            lock = $('#tbl-locker-lock-' + response[i].id);

            status.html(response[i].status);
            if (response[i].status == 'Empty') {
                status
                    .removeClass('bg-light-warning')
                    .addClass('bg-light-success');
            } else {
                status
                    .removeClass('bg-light-success')
                    .addClass('bg-light-warning');
            }

            weight.html(response[i].weight + 'g');

            if (response[i].status_lock == '1') {
                lock.html('lock');
            } else {
                lock.html('lock_open');
            }
        }
    }

    setInterval(async function() {
        await refreshTable();
    }, 20000);

    $('.lock_status').on('change', function(event) {
        let locker_id = $('#LockerModal').find('.locker_id').val();
        if (this.checked) {
            lockerLock(locker_id, 1);
        } else {
            lockerLock(locker_id, 0);
        }
        console.log('ok');
    });
</script>
<?= $this->endSection() ?>