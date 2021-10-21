<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Artikel</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                </div>
                <div class="mb-2">
                    <a href="<?= base_url('artikel/tambahartikel'); ?>" class="btn btn-primary">Tambah Data</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul Artikel</th>
                                <th scope="col">Isi Artikel</th>
                                <th scope="col">Gambar</th>
                                <th scope="col"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($artikel->result() as $art) : ?>
                                <tr>
                                    <th scope="col"><?= $i++; ?></th>
                                    <td scope="col"><?= $art->judul; ?></td>
                                    <td scope="col"><?= substr($art->isi, 0, 200); ?>...</td>
                                    <td scope="col">
                                        <img width="75" src="<?= base_url('assets/img/artikel/') . $art->gambar; ?>">
                                    </td>
                                    <td scope="col">
                                        <a href="<?= base_url('artikel/edit/') . $art->id_artikel; ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        <a href="<?= base_url('artikel/hapus/') . $art->id_artikel; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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