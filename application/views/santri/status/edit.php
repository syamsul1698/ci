<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('status/edit/') . $santri->id_santri; ?>" method="POST">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama">Nama Lengkap</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="hidden" name="id" value="<?= $santri->id_santri; ?>">
                        <input type="text" readonly class="form-control" id="nama" name="nama" value="<?= $santri->nama; ?>">
                        <?php echo form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="status">Status Pembayaran</label>
                    </div>
                    <div class="col-lg-9">
                        <select name="status" id="status" class="form-control">
                            <?php foreach ($status as $stat) : ?>
                                <?php if ($stat->id_status == $santri->status_bayar) : ?>
                                    <option value="<?= $stat->id_status; ?>" selected><?= $stat->status; ?></option>
                                <?php else : ?>
                                    <option value="<?= $stat->id_status; ?>"><?= $stat->status; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->