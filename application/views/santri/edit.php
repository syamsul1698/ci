<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open_multipart('santri/edit_profil'); ?>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="nis">NIS</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" readonly class="form-control" id="nis" name="nis" value="<?= $santri->nis; ?>">
                                <?php echo form_error('nis', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="kelas">Kelas</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="kelas" name="kelas">
                                    <?php foreach ($kelas as $k) : ?>
                                        <?php if ($k->id_kelas == $santri->kelas) : ?>
                                            <option value="<?= $k->id_kelas; ?>"><?= $k->kelas; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $k->id_kelas; ?>"><?= $k->kelas; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('kelas', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="nama">Nama Lengkap</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="hidden" name="nip" value="<?= $santri->id_santri; ?>">
                                <input type="hidden" name="nip1" value="<?= $santri->id_santri; ?>">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $santri->nama; ?>">
                                <?php echo form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">
                                <label for="lahir">Tempat & Tanggal Lahir</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="lahir" name="tempat" value="<?= $santri->tempat_lahir; ?>">
                                <?php echo form_error('tempat', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class=" col-lg-1 text-center">
                                <h4>-</h4>
                            </div>
                            <div class="col-lg-4">
                                <input type="date" class="form-control" id="lahir" name="tgl" value="<?= $santri->tgl_lahir; ?>">
                                <?php echo form_error('tgl', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">
                                <label for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $santri->alamat; ?>">
                                <?php echo form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="email" name="email" value="<?= $santri->email; ?>">
                                <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">Gambar</div>
                            <div class="col-lg-3">
                                <img width="75" src="<?= base_url('assets/img/profile/') . $santri->gambar; ?>" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="hidden" class="custom-file-input" id="gambar" name="hapus_gambar" value="<?= $santri->gambar; ?>">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->