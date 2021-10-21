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
            <div class="card-body">
                <div>
                    <!--<form action="<?= base_url('absen/excel'); ?>" method="POST">-->
                    <!--    <div class="form-group">-->
                    <!--        <input type="hidden" readonly class="form-control" name="id_kelas" value="<?= $this->uri->segment(3); ?>">-->
                    <!--        <input type="hidden" readonly class="form-control" name="id_guru" value="<?= $mengajar->row()->pengasuh_id; ?>">-->
                    <!--        <button type="submit" class="btn btn-facebook"><i class="far fa-file-excel"></i>Export</button>-->
                    <!--    </div>-->
                    <!--</form>-->
                    
<form action="<?= base_url('absen/excel'); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" readonly class="form-control" name="id_kelas" value="<?= $this->uri->segment(3); ?>">
                        <input type="hidden" readonly class="form-control" name="id_guru" value="<?= $mengajar->row()->pengasuh_id; ?>">
                        <button type="submit" class="btn btn-facebook"><i class="far fa-file-excel"></i> Export</button>
                    </div>
                </form>
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
                                <th scope="col">Jumlah Hadir</th>
                                <th scope="col">Sakit</th>
                                <th scope="col">Izin</th>
                                <th scope="col" colspan="2">Alpa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($nilai as $n) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $n->nama; ?></td>
                                    <?php
                                   $id = $n->nis;
                                    $pengasuh = $mengajar->row()->nip;;

                                    $query = "SELECT  santri.`nama`, absen.*, santri.`id_santri`
                                FROM absen JOIN santri
                                ON absen.`user_id` = santri.`nis`
                                WHERE absen.`user_id` = $id
                                AND absen.`guru_id` = $pengasuh";
                                    $nilais = $this->db->query($query)->result();
                                    ?>
                                     <?php if ($nilais) : ?>
                                        <?php foreach ($nilais as $ns) : ?>
                                            <td><?= $ns->hadir; ?></td>
                                            <td><?= $ns->sakit; ?></td>
                                            <td><?= $ns->izin; ?></td>
                                            <td><?= $ns->alpa; ?></td>
                                            <td>
                                                <a href="<?= base_url('absen/hapus/') . $ns->id_absen; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i>Hapus Absen</a>
                                            </td>

                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td>
                                            <button data-toggle="modal" data-target="#tambahModal<?= $n->nama; ?>" class="btn btn-primary"><i class="far fa-edit"></i></button>
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


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<?php $i = 0;
foreach ($nilai as $k) : $i++; ?>
    <form action="<?= base_url('absen/tambah'); ?>" method="POST">
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
                            <label for="hadir">Hadir</label>
                            <select class="form-control" id="hadir" name="hadir">

                                <?php for ($h = 0; $h <= 50; $h++) : ?>
                                    <option value="<?= $h; ?>"><?= $h; ?></option>
                                <?php endfor; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sakit">Sakit</label>
                            <select class="form-control" id="sakit" name="sakit">

                                <?php for ($s = 0; $s <= 50; $s++) : ?>
                                    <option value="<?= $s; ?>"><?= $s; ?></option>
                                <?php endfor; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="izin">Izin</label>
                            <select class="form-control" id="izin" name="izin">

                                <?php for ($i = 0; $i <= 50; $i++) : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alpa">Alpa</label>
                            <select class="form-control" id="alpa" name="alpa">

                                <?php for ($a = 0; $a <= 50; $a++) : ?>
                                    <option value="<?= $a; ?>"><?= $a; ?></option>
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