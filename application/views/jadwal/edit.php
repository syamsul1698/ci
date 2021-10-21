<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('jadwal/update'); ?>" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="hari">Hari</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" readonly class="form-control" name="id" value="<?= $jam['id_jam']; ?>">
                                    <input type="text" readonly class="form-control" name="hari" value="<?= $jam['hari']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="jamawal">Jam Awal</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="time" class="form-control" id="jamawal" name="jamawal" value="<?= $jam['jam_awal']; ?>">
                                    <?= form_error('jamawal', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="jamke">Jam Ke -</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control" id="jamke" name="jamke">
                                        <?php if ($jam['jamke']) : ?>
                                            <option value="<?= $jam['jamke']; ?>"><?= $jam['jamke']; ?></option>
                                        <?php else : ?>
                                            <?php for ($i = 1; $i <= 20; $i++) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="jamakhir">Jam Akhir</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="time" class="form-control" id="jamakhir" name="jamakhir" value="<?= $jam['jam_akhir']; ?>">
                                    <?= form_error('jamakhir', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="keterangan" name="ket" value="<?= $jam['keterangan']; ?>">
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Ubah Data</button>
        </div>
        </form>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->