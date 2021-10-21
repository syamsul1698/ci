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
                    <table class="table table-bordered table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($users->result() as $u) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $u->nama; ?></td>
                                    <td scope="col">
                                        <button data-toggle="modal" data-target="#modalEdit<?= $u->id_user; ?>" class="btn btn-warning"><i class="far fa-edit"></i></button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
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
<?php $i = 0;
foreach ($users->result() as $kk) : $i++; ?>
    <form action="<?= base_url('admin/edit'); ?>" method="POST">
        <div class="modal fade" id="modalEdit<?= $kk->id_user; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" class="form-control" name="id" value="<?= $kk->id_user; ?>">
                            <input type="text" readonly class="form-control" id="kelas" name="kelas" value="<?= $kk->nama; ?>">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Role Akses</label>
                            <select class="form-control" id="role" name="role">
                                <?php foreach ($role as $r) : ?>
                                    <?php if ($r->id_role == $kk->role_id) : ?>
                                        <option value="<?= $r->id_role; ?>" selected><?= $r->role; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $r->id_role; ?>"><?= $r->role; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
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