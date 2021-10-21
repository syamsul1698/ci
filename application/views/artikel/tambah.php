<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <?php echo form_open_multipart('artikel/tambahartikel'); ?>
            <div class="form-group">
                <label for="judul">Judul Artikel</label>
                <input type="text" class="form-control" id="judul" name="judul">
                <?php echo form_error('judul', '<small class="form-text text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="isi">Isi Artikel</label>
                <textarea class="form-control" id="isi" rows="7" name="isi"></textarea>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                <label class="custom-file-label" for="gambar">Choose file</label>
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