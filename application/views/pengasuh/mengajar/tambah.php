<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
            <div class="col-lg-6">
                <h5>Nama : <?= $pengasuh->row()->nama; ?></h5>
                <h5>NIP : <?= $pengasuh->row()->nip; ?></h5>
                <h5>Mata Pelajaran : <?= $pengasuh->row()->matapelajaran; ?></h5>
            </div>
            <div class="col-lg-6">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($mengajar->result() as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $m->nama_kelas; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<form action="<?= base_url('mengajar/tambahdata'); ?>" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="hidden" readonly class="form-control" id="id" name="id" value="<?= $this->uri->segment(3); ?>">
                        <input type="hidden" readonly class="form-control" id="id" name="mapel" value="<?=$pengasuh->row()->mengajar;?>">
                        <select class="form-control" id="kelas" name="kelas">
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k->id_kelas; ?>"><?= $k->kelas; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('kelas', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>