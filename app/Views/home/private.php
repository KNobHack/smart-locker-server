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
                                            <div>
                                                <label id="tbl-locker-lock-<?= $lkr_id ?>" class="badge bg-light-<?= $locker['lock_badge'] ?>">
                                                    <?= ($locker['status_lock'] == '1') ? "Locked" : "Unlocked" ?>
                                                </label>
                                            </div>
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
                            <input type="text" class="form-control-plaintext locker_id" readonly value="12345678">
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
                            <input type="text" class="form-control-plaintext locker_weight" readonly value="50g">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Sterilize</label>
                        <div class="col-sm-9 my-auto">
                            <label class="badge bg-light-danger locker_sterilize">
                                Not sterilize yet
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Lock Status</label>
                        <div class="col-sm-9 my-auto">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input lock_status">
                                <label class="badge bg-light-success lock_status_badge">
                                    Unlocked
                                </label>
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
        var button = $(event.relatedTarget);
        var locker_id = button.data('locker_id')
        let response = await lockerStatus(locker_id)
        console.log(response);

        var modal = $(this)
        modal.find('.locker_id').val(response.id)
        modal.find('.locker_status').val(response.status);
        modal.find('.locker_weight').val(response.weight + "g")

        modal.find('.locker_sterilize').html(response.sterilize)
        if (response.sterilize == 'Sterilized') {
            modal.find('.locker_sterilize')
                .removeClass('bg-light-danger')
                .removeClass('bg-light-warning')
                .addClass('bg-light-success');
        } else if (response.sterilize == 'Sterilizing') {
            modal.find('.locker_sterilize')
                .removeClass('bg-light-danger')
                .removeClass('bg-light-success')
                .addClass('bg-light-warning');
        } else {
            modal.find('.locker_sterilize')
                .removeClass('bg-light-warning')
                .removeClass('bg-light-success')
                .addClass('bg-light-danger');
        }

        if (response.status_lock == '1') {
            modal.find('.lock_status').prop('checked', true);
            modal.find('.lock_status_badge').html('Locked');
            modal.find('.lock_status_badge')
                .removeClass('bg-light-warning')
                .addClass('bg-light-success');
        } else {
            modal.find('.lock_status').prop('checked', false);
            modal.find('.lock_status_badge').html('Unlocked');
            modal.find('.lock_status_badge')
                .removeClass('bg-light-success')
                .addClass('bg-light-warning');

        }
    });

    async function refreshTable() {
        let response = await LockerStatuses();
        console.log(response);
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

            if (response[i].lock == '1') {
                lock
                    .removeClass('bg-light-warning')
                    .addClass('bg-light-success');

                lock.html('Locked');
            } else {
                lock
                    .removeClass('bg-light-success')
                    .addClass('bg-light-warning');

                lock.html('Unlocked');
            }
        }
    }

    setInterval(async function() {
        await refreshTable();
    }, 10000);

    $('.lock_status').on('change', function(event) {
        let locker_id = $('#LockerModal').find('.locker_id').val();
        if (this.checked) {
            lockerLock(locker_id, 1);
            $('#LockerModal').find('.lock_status_badge').html('Locked');
            $('#LockerModal').find('.lock_status_badge')
                .removeClass('bg-light-warning')
                .addClass('bg-light-success');
        } else {
            lockerLock(locker_id, 0);
            $('#LockerModal').find('.lock_status_badge').html('Unlocked');
            $('#LockerModal').find('.lock_status_badge')
                .removeClass('bg-light-success')
                .addClass('bg-light-warning');
        }
    });
</script>
<div class="fixed-button active">
    <a href="#" data-toggle="modal" data-target="#insertLockerModal" class="btn btn-md btn-primary">
        <i class="material-icons-two-tone text-white">add</i> Add Locker</a>
</div>

<div id="insertLockerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="insertLockerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertLockerModalTitle">Add Locker</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLockerForm">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Locker ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control locker_id">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Passcode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control locker_status">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Submit</button>
                <!-- <button type="button" class="btn btn-primary" onclick="document.getElementById('addLockerForm').submit()">Submit</button> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>