<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="mb-3">
                <button data-toggle="modal" data-target="#modaltambah" class="btn btn-primary">Tambah Data</button>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable">
                    <thead>
                        <tr>

                            <th scope="col">Hari</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Jam Awal</th>
                            <th scope="col">Jam Akhir</th>
                            <th scope="col">Jam Keterangan</th>
                            <th scope="col"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jam as $j) :
                            $hari = $j['hari'];
                        ?>
                            <?php $data = $this->db->query("SELECT * FROM jam WHERE hari = '$hari' ")->result_array();
                            $jumlah = $this->db->query("SELECT * FROM jam WHERE hari = '$hari' ")->num_rows();
                            ?>
                            <tr>
                                <td rowspan="<?= $jumlah + 1; ?>"> <?= $hari ?> </td>
                                <?php foreach ($data as $d) : ?>
                            <tr>
                                <td><?= $d['jamke']; ?></td>
                                <td><?= $d['jam_awal']; ?></td>
                                <td><?= $d['jam_akhir']; ?></td>
                                <td><?= $d['keterangan']; ?></td>
                                <td>
                                    <a href="<?= base_url('jadwal/edit/') . $d['id_jam']; ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                    <a href="<?= base_url('jadwal/hapus/') . $d['id_jam']; ?>" class="btn btn-danger remove"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jam Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('jadwal/tambah'); ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="hari">Hari</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="hari" name="hari">
                                            <?php foreach ($haris as $h) : ?>
                                                <option value="<?= $h; ?>"><?= $h; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="jamawal">Jam Awal</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="time" class="form-control" id="jamawal" name="jamawal">
                                        <?= form_error('jamawal', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="jamke">Jam Ke -</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="jamke" name="jamke">
                                            <?php for ($i = 1; $i <= 20; $i++) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="jamakhir">Jam Akhir</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="time" class="form-control" id="jamakhir" name="jamakhir">
                                        <?= form_error('jamakhir', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="keterangan">Keterangan</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="keterangan" name="ket">
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>