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
            <div class="mb-3">
                <a href="<?= base_url('pengasuh/tambah'); ?>" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">TTL</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Gambar</th>
                            <th scope="col"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($pengasuhs as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $p->nama; ?></td>
                                <td><?= $p->nip; ?></td>
                                <td><?= $p->tempat_lahir . ', ' . $p->tgl_lahir; ?></td>
                                <td><?= $p->email; ?></td>
                                <td><?= $p->alamat; ?></td>
                                <td><img src="<?= base_url('assets/img/profile/') . $p->gambar; ?>" width="50" alt=""></td>
                                <td scope="col">
                                    <a href="<?= base_url('pengasuh/edit/') . $p->id_pengasuh; ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                    <a href="<?= base_url('pengasuh/hapus/') . $p->id_pengasuh; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->