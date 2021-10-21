<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
        <div class="card-body">
            <div>
<form action="<?= base_url('nilai/excel'); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" readonly class="form-control" name="id_kelas" value="<?= $this->uri->segment(3); ?>">
                        <input type="hidden" readonly class="form-control" name="id_guru" value="<?= $mengajar->row()->pengasuh_id; ?>">
                        <button type="submit" class="btn btn-facebook"><i class="far fa-file-excel"></i> Export</button>
                    </div>
                </form>
                <!--<a href="<?= base_url('nilai/excel/') . $kelas->row()->id_kelas; ?>" class="btn btn-facebook"><i class="far fa-file-excel"></i> Export</a>-->
                <h5>Kelas : <?= $kelas->row()->kelas; ?></h5>
                <h5>Guru : <?= $mengajar->row()->nama_guru; ?></h5>
                <h5>Mata Pelajaran : <?= $mengajar->row()->mapel; ?></h5>

            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">nama santri</th>
                            <th scope="col" colspan="2">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($nilai as $n) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td>
                                    <?= $n->nama; ?>
                                </td>
                                <?php
                                $id = $n->nis;
                                $pengasuh = $mengajar->row()->nip;;

                                $query = "SELECT  santri.`nama`, nilai.`nilai` AS nilaisiswa, nilai.`id_nilai`
                                FROM nilai JOIN santri
                                ON nilai.`user_id` = santri.`nis`
                                WHERE nilai.`user_id` = $id
                                AND nilai.`guru_id` = $pengasuh";
                                $nilais = $this->db->query($query)->result();
                                ?>
                                 <?php if ($nilais) : ?>
                                    <?php foreach ($nilais as $ns) : ?>
                                        <td><?= $ns->nilaisiswa; ?></td>
                                        <td>
                                            <a href="<?= base_url('nilai/hapus/') . $ns->id_nilai; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i>Hapus Nilai</a>
                                        </td>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <td>
                                        <button data-toggle="modal" data-target="#tambahModal<?= $n->nama; ?>" class="btn btn-primary"><i class="far fa-edit"></i>Tambah Nilai</button>
                                    </td>
                                <?php endif; ?>

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
<?php $i = 0;
foreach ($nilai as $k) : $i++; ?>
    <form action="<?= base_url('nilai/tambah'); ?>" method="POST">
        <div class="modal fade" id="tambahModal<?= $k->nama; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama siswa</label>
                            <input readonly type="hidden" class="form-control" name="id" value="<?= $k->nis; ?>">
                            <input readonly type="hidden" class="form-control" name="mapel" value="<?= $mengajar->row()->id_mapel; ?>">
                            <input readonly type="hidden" class="form-control" name="pengasuh" value="<?= $mengajar->row()->nip; ?>">
                            <input readonly type="hidden" class="form-control" name="kelas" value="<?= $this->uri->segment(3); ?>">
                            <input readonly type="text" class="form-control" id="nama" name="nama" value="<?= $k->nama; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <select class="form-control" id="nilai" name="nilai">

                                <?php for ($i = 10; $i <= 100; $i++) : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>

                            </select>
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
<?php endforeach; ?>