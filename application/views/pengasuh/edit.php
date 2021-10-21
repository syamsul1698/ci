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
                        <?php
                        if (isset($error)) {
                            echo "ERROR UPLOAD : <br/>";
                            print_r($error);
                            echo "<hr/>";
                        }
                        ?>
                        <?php echo form_open_multipart('pengasuh/edit_profil'); ?>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="nip">NIP</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" readonly class="form-control" id="nip" name="nip" value="<?= $pengasuhs->row()->nip; ?>">
                                <?php echo form_error('nip', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="nama">Nama Lengkap</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $pengasuhs->row()->nama; ?>">
                                <?php echo form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">
                                <label for="lahir">Tempat & Tanggal Lahir</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="lahir" name="tempat" value="<?= $pengasuhs->row()->tempat_lahir; ?>">
                                <?php echo form_error('tempat', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            <div class=" col-lg-1 text-center">
                                <h4>-</h4>
                            </div>
                            <div class="col-lg-4">
                                <input type="date" class="form-control" id="lahir" name="tgl" value="<?= $pengasuhs->row()->tgl_lahir; ?>">
                                <?php echo form_error('tgl', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">
                                <label for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pengasuhs->row()->alamat; ?>">
                                <?php echo form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="hp">Nomor Telepon</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="hp" name="hp" value="<?= $pengasuhs->row()->hp; ?>">
                                <?php echo form_error('hp', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="email" name="email" value="<?= $pengasuhs->row()->email; ?>">
                                <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-2">Gambar</div>
                            <div class="col-lg-3">
                                <img width="75" src="<?= base_url('assets/img/profile/') . $pengasuhs->row()->gambar; ?>" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="hidden" class="custom-file-input" id="gambar" name="hapus_gambar" value="<?= $pengasuhs->row()->gambar; ?>">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Ubah Data</button>
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