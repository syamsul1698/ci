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
            <div class="col-lg-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <div class="mb-3">
                            <button data-toggle="modal" data-target="#modalTambah" class="btn btn-primary">Tambah Data</button>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($mapel as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $m->mapel; ?></td>
                                    <td scope="col">
                                        <button data-toggle="modal" data-target="#modalEdit<?= $m->id_mapel; ?>" class="btn btn-warning"><i class="far fa-edit"></i></button>
                                        <a href="<?= base_url('mapel/hapus/') . $m->id_mapel; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<form action="<?= base_url('mapel/tambah'); ?>" method="POST">
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mapel">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" name="mapel">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal -->
<?php $i = 0;
foreach ($mapel as $kk) : $i++; ?>
    <form action="<?= base_url('mapel/edit'); ?>" method="POST">
        <div class="modal fade" id="modalEdit<?= $kk->id_mapel; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <input type="text" class="form-control" id="mapel" name="mapel" value="<?= $kk->mapel; ?>">
                            <input type="hidden" class="form-control" name="id" value="<?= $kk->id_mapel; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>