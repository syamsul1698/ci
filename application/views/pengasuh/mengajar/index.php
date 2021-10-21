<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-lg-6">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($pengasuhs as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><a href="<?= base_url('mengajar/tambah/') . $p->nip; ?>"><?= $p->nama; ?></a></td>
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