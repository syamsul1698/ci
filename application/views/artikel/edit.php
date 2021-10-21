<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="container">
                <?php echo form_open_multipart('artikel/edit'); ?>
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="<?= $artikel->row()->id_artikel; ?>">
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="judul">Judul Artikel</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= $artikel->row()->judul; ?>">
                            <?php echo form_error('judul', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="isi">Isi Artikel</label>
                        </div>
                        <div class="col-lg-10">
                            <textarea class="form-control" id="isi" rows="7" name="isi"><?= $artikel->row()->isi; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <label for="isi">Gambar</label>
                    </div>
                    <div class="col-lg-2">
                        <img width="100" src="<?= base_url('assets/img/artikel/') . $artikel->row()->gambar; ?>" alt="">
                    </div>
                    <div class="col-lg-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label class="custom-file-label" for="gambar">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Tambah Artikel</button>
                </div>
                </form>
            </div>


        </div>



    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->