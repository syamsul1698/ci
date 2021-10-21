<?php
$filename = "Nilai_Siswa-" . date("d-m-Y") . '.xls';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=' . $filename . '');
header('Cache-Control: max-age=0');
?>

<div>
    <h5>Kelas : <?= $kelas->row()->kelas; ?></h5>
    <h5>Guru : <?= $mengajar->row()->nama_guru; ?></h5>
    <h5>Mata Pelajaran : <?= $mengajar->row()->mapel; ?></h5>

</div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">nama santri</th>
                <th scope="col" colspan="2">Nilai</th>
                <th scope="col"><i class="fas fa-cogs"></i></th>
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
                    $id = $n->id_santri;
                    $pengasuh = $mengajar->row()->id_pengasuh;

                    $query = "SELECT  santri.`nama`, nilai.`nilai`, nilai.`id_nilai`
                                FROM nilai JOIN santri
                                ON nilai.`user_id` = santri.`id_santri`
                                WHERE nilai.`user_id` = $id
                                AND nilai.`guru_id` = $pengasuh";
                    $nilais = $this->db->query($query)->result();
                    ?>
                    <?php foreach ($nilais as $ns) : ?>
                        <td><?= $ns->nilai; ?></td>

                    <?php endforeach; ?>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>