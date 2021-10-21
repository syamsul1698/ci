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
            <div class="row mb-3">
                <div class="col">
                    <a href="<?= base_url('santri/tambah'); ?>" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Gambar</th>
                            <th scope="col"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($santri as $s) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $s->nama; ?></td>
                                <td><?= $s->tempat_lahir . ', ' . $s->tgl_lahir; ?></td>
                                <td><?= $s->alamat; ?></td>
                                <td><?= $s->nis; ?></td>
                                <td><?= $s->nama_kelas; ?></td>
                                <td><img width="50" src="<?= base_url('assets/img/profile/') . $s->gambar; ?>" alt=""></td>
                                <td scope="col">
                                    <a href="<?= base_url('santri/edit/') . $s->id_santri; ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                    <a href="<?= base_url('santri/hapus/') . $s->nis; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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