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

                        <?php echo form_open_multipart('pengasuh/tambah'); ?>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="nip">NIP</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nip" name="nip" value="<?= set_value('nip'); ?>">
                                <?php echo form_error('nip', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="nama">Nama Lengkap</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                                <?php echo form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="mapel">Mata Pelajaran</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="mapel" name="mapel">
                                    <?php foreach ($mapel as $m) : ?>
                                        <option value="<?= $m->id_mapel; ?>"><?= $m->mapel; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('mapel', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">
                                <label for="lahir">Tempat & Tanggal Lahir</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="lahir" name="tempat" value="<?= set_value('tempat'); ?>">
                                <?php echo form_error('tempat', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class=" col-lg-1 text-center">
                                <h4>-</h4>
                            </div>
                            <div class="col-lg-4">
                                <input type="date" class="form-control" id="lahir" name="tgl" value="<?= set_value('tgl'); ?>">
                                <?php echo form_error('tgl', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">
                                <label for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat'); ?>">
                                <?php echo form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="hp">Nomor Telepon</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="hp" name="hp" value="<?= set_value('hp'); ?>">
                                <?php echo form_error('hp', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
                                <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" id="password" name="password">
                                <?php echo form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-lg-2">
                                <label for="password1">Konfirmasi Password</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="password" class="form-control" id="password1" name="password1">
                                <?php echo form_error('password1', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">Gambar</div>
                            <div class="col-lg-9">
                                <div class="custom-file">
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