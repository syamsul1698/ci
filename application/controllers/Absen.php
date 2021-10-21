<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('auth_model', 'auth');
        $this->load->model('mengajar_model', 'mengajar');
        $this->load->model('santri_model', 'santri');
        $this->load->model('kelas_model', 'kelas');
        $this->load->model('absen_model', 'absen');
        $this->load->model('pengasuh_model', 'pengasuh');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['mengajar'] = $this->mengajar->getAllMengajarkelas();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();


        $data['judul'] = 'Absen';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar',$data);
        $this->load->view('absen/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function kelas()
    {
        $data['user'] = $this->auth->getSession();
        $data['nilai'] = $this->santri->getSantriByKelas();
        $data['mengajar'] = $this->mengajar->getAllMengajarkelas();
        $data['kelas'] = $this->kelas->getKelasByUrl();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();


        $data['judul'] = 'Absen';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar',$data);
        $this->load->view('absen/kelas', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambah()
    {
        $nilai = [
            'user_id' => $this->input->post('id'),
            'mapel_id' => $this->input->post('mapel'),
            'guru_id' => $this->input->post('pengasuh'),
            'kelas_id' => $this->input->post('kelas'),
            'hadir' => $this->input->post('hadir'),
            'sakit' => $this->input->post('sakit'),
            'izin' => $this->input->post('izin'),
            'alpa' => $this->input->post('alpa'),
        ];

        $kelas = $this->input->post('kelas');
        $this->db->insert('absen', $nilai);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Ditambah</div>');
        redirect("absen/kelas/$kelas");
    }

    public function hapus($id)
    {
        $data = $this->db->get_where('absen', ['id_absen' => $id])->row_array();
        $kelas = $data['kelas_id'];

        $this->db->where('id_absen', $id);
        $this->db->delete('absen');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah dihapus</div>');
        redirect("absen/kelas/$kelas");
    }
    
     public function excel()
    {

        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $excel = new PHPExcel();

        $excel->getProperties()->setCreator('Al-Junaidiyah')
            ->setLastModifiedBy('Operator')
            ->setTitle("Absen Siswa")
            ->setDescription("Nilai Siswa")
            ->setKeywords("Data Siswa");

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
            ]
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
            ]
        ];
        
        // $nilai = $this->nilai->exportNilaiByKelas();
        $id = $this->input->post('id_kelas');
        $pengasuh = $this->input->post('id_guru');


        $nilai = $this->db->query("SELECT absen.*, kelas.`kelas` AS nama_kelas, pengasuh.`nama` AS namaguru, santri.`nis`, santri.`nama` AS namasiswa, mapel.`mapel` AS nama_mapel
        FROM absen JOIN pengasuh
        ON absen.`guru_id` = pengasuh.`nip`
        JOIN kelas ON absen.`kelas_id`= kelas.`id_kelas`
        JOIN santri ON absen.`user_id` = santri.`nis`
        JOIN mapel ON absen.`mapel_id` = mapel.`id_mapel`
        WHERE absen.`kelas_id`= $id
        AND absen.`guru_id` = $pengasuh");
        
        $guru=$nilai->row()->namaguru;
        $kelas=$nilai->row()->nama_kelas;
        $mapel=$nilai->row()->nama_mapel;
        
        


        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Absen Siswa");
        $excel->getActiveSheet()->mergeCells('A1:G1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "Nama Kelas");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', ": $kelas");
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "Nama Guru");
        $excel->setActiveSheetIndex(0)->setCellValue('C4', ": $guru");
        $excel->setActiveSheetIndex(0)->setCellValue('A5', "Mata Pelajaran");
        $excel->setActiveSheetIndex(0)->setCellValue('C5', ": $mapel");
        $excel->setActiveSheetIndex(0)->setCellValue('A6', "No");
        $excel->setActiveSheetIndex(0)->setCellValue('B6', "Nama");
        $excel->setActiveSheetIndex(0)->setCellValue('C6', "NIS");
        $excel->setActiveSheetIndex(0)->setCellValue('D6', "Hadir");
        $excel->setActiveSheetIndex(0)->setCellValue('E6', "Sakit");
        $excel->setActiveSheetIndex(0)->setCellValue('F6', "Izin");
        $excel->setActiveSheetIndex(0)->setCellValue('G6', "Alpa");
        
        


        $excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);

        

        $no = 1;
        $numrow = 7;
        foreach ($nilai->result() as $n) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $n->namasiswa);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $n->nis);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $n->hadir);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $n->sakit);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $n->izin);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $n->alpa);

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(5);

        // tinggi cell
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        $excel->getActiveSheet(0)->setTitle("Nilai Siswa");
        $excel->setActiveSheetIndex(0);

        // proses file excel
        // $filename="Nilai-Siswa.xls";
        $filename = "Absen_Siswa-" . date("d-m-Y") . '.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    ob_end_clean();
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename='.$filename);
    $objWriter->save('php://output');
        
    }

    public function eexcel()
    {
        $id = $this->input->post('id_guru');
        $kelas = $this->input->post('id_kelas');

        $this->absen->getAbsenByKelas($id, $kelas);

        $kelassiswa = $this->santri->getSantriByKelasabsen($kelas);
        $mengajar = $this->mengajar->getAllMengajarkelas();


        include(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        include(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        $object->getProperties()->setCreator("Al-Junaidiyah");
        $object->getProperties()->setLastModifiedBy("Al-Junaidiyah");
        $object->getProperties()->setTitle("Daftar Nilai Siswa");
        $object->getProperties()->setSubject("");
        $object->getProperties()->setDescription("");

        $object->setActiveSheetIndex(0);

        $namaguru = $mengajar->row()->nama_guru;
        $namakelas = $mengajar->row()->nama_kelas;
        $mapel = $mengajar->row()->mapel;


        $object->getActiveSheet()->setCellValue('A2', "Nama Guru : $namaguru");
        $object->getActiveSheet()->setCellValue('A3', "Kelas : $namakelas  ");
        $object->getActiveSheet()->setCellValue('A4', "Mata Pelajaran : $mapel");
        $object->getActiveSheet()->setCellValue('A5', "No.");
        $object->getActiveSheet()->setCellValue('B5', "Nama");
        $object->getActiveSheet()->setCellValue('C5', "Nilai");

        $i = 1;
        $baris = 6;
        foreach ($kelassiswa as $k) {

            $object->getActiveSheet()->setCellValue('A' . $baris, $i);
            $object->getActiveSheet()->setCellValue('B' . $baris, $k->nama);

            $id = $k->id_santri;
            $pengasuh = $mengajar->row()->id_pengasuh;

            $query = "SELECT  santri.`nama`, absen.`hadir`, absen.`alpa`
                                FROM absen JOIN santri
                                ON absen.`user_id` = santri.`id_santri`
                                WHERE absen.`user_id` = $id
                                AND absen.`guru_id` = $pengasuh";
            $nilais = $this->db->query($query)->result();

            foreach ($nilais as $n) {
                $object->getActiveSheet()->setCellValue('C' . $baris, $n->hadir);
                $object->getActiveSheet()->setCellValue('D' . $baris, $n->alpa);
            }
            $i++;
            $baris++;
        }
        $filename = "Nilai_Siswa-" . date("d-m-Y") . '.xlsx';

        $object->getActiveSheet(0)->setTitle("Nilai Siswa");
        $object->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $filename . '');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $write->save('php://output');
    }
}
