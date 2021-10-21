<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm col-lg-4">
                    <thead>
                        <tr>
                            <th scope="col">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mengajar->result() as $m) : ?>
                            <tr>

                                <td><a href="<?= base_url('nilai/siswa/') . $m->kelas_id; ?>"><?= $m->nama_kelas; ?></a></td>
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