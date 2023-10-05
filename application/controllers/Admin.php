<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');;
		$this->load->library('upload');
        if ($this->session->userdata('logged_in')!= true && $this->session->userdata('role') != 'index') {
            redirect(base_url().'auth');
        }
	}

	public function index()
	{
		$this->load->view('admin/index');
	}

	public function upload_img($value)
	{
		$kode = round(microtime(true) * 1000);
		$config['upload_path'] = './images/siswa/';
		$config['allowed_types'] = '.jpg|png|jpeg';
		$config['max_size'] = '3000';
		$config['file_name'] = $kode;
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($value)) {
			return array( false, '' );
		} else {
			$fn = $this->upload->data();
			$nama = $fn['file_name'];
			return array( true, $nama );
		}
	}

	public function siswa()
	{
		$data['siswa'] = $this->m_model->get_data('siswa')->result();
		$this->load->view('admin/siswa', $data);
	}

	public function hapus_siswa($id)
	{
		// model get siswa
		$siswa = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->row();
		if ($siswa) {
			if ($siswa->foto !== 'User.png') {
				$file_path = './Images/siswa/' . $siswa->foto;

				if (file_exists($file_path)) {
					if (unlink($file_path)) {
						// hapus file berhasil menggunakan model delete 
						$this->m_model->delete('siswa', 'id_siswa', $id);
						redirect(base_url('admin/siswa'));
					} else {
						// gagal hapus file
						echo "Gagal menghapus file.";
					}
				} else {
					// File tidak ditemukan
					echo "File tidak di temukan.";
				}
			} else {
				// Tanpa hapus file 'User.png'
				$this->m_model->delete('siswa', 'id_siswa', $id);
				redirect(base_url('admin/siswa'));
			}

		} else {
			// Siswa tidak di temukan
			echo "Siswa tidak di temukan.";
		}
	}

	public function aksi_ubah_siswa()
	{
		$data = array (
			'nama_siswa' => $this->input->post('nama'),
			'nisn' => $this->input->post('nisn'),
			'gender' => $this->input->post('gender'),
			'id_kelas' =>$this->input->post('id_kelas'),
		);
		$eksekusi=$this->m_model->ubah_data
		('siswa', $data, array('id_siswa'=>$this->input->post('id_siswa')));
		if($eksekusi)
		{
			$this->session->set_flashdata('sukses', 'berhasil');
			redirect(base_url('admin/siswa'));
		} 
		else
		{
			$this->session->set_flashdata('error', 'gagal..');
			redirect(base_url('admin/ubah_siswa/'.$this->input->post('id_siswa')));
		}
	}

	public function tambah_siswa()
	{
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
		$this->load->view('admin/tambah_siswa', $data);
	}
	
	public function aksi_tambah_siswa()
	{
		$foto = $this->upload_img('foto');
		if ($foto[0] == false) {
			$data = [
				'foto' => 'User.png',
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' =>$this->input->post('id_kelas'),
			];
			$this->m_model->tambah_data('siswa', $data);
			redirect(base_url('admin/siswa'));
		} else {
			$data = [
				'foto' => $foto[1],
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' =>$this->input->post('id_kelas'),
			];
			$this->m_model->tambah_data('siswa', $data);
			redirect(base_url('admin/siswa'));
		}
	}

	public function ubah_siswa($id)
	{
		$data['siswa']=$this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
	$this->load->view('admin/ubah_siswa', $data);
	}

	public function akun()
	{
		$data['user']=$this->m_model->get_by_id('admin', 'id', $this->session->userdata('id'))->result();
		$this->load->view('admin/akun', $data);
	}

	public function aksi_ubah_akun()
	{
		$password_baru = $this->input->post('password_baru');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		$email = $this->input->post('email');
		$username = $this->input->post('username');

// Buat data yang akan diubah
		$data = array(
			'email' => $email,
			'username' => $username
		);
// Pastikan password baru dan konfirmasi password sama
		if (!empty($password_baru)) {
			if ($password_baru === $konfirmasi_password) {
// Jika ada password baru
				$data['password'] = md5($password_baru);
			} else {
				$this->session->set_flashdata('message', 'Password baru dan konfirmasi password harus sama');
				redirect(base_url('admin/akun'));
			}
		}
// Lakukan pembaruan data
		$this->session->set_userdata($data);
		$update_result = $this->m_model->ubah_data('admin', $data, array($id => $this->session->userdata('id')));

		if ($update_result) {
			redirect(base_url('admin/akun'));
		} else {
			redirect(base_url('admin/akun'));
		}
	}
// KEUANGAN
	public function keuangan()
    {
        $data['keuangan'] = $this->m_model->get_data('keuangan')->result();
		$this->load->view('admin/keuangan',$data);
    }

	public function aksi_tambah_keuangan()
	{
		$data = [
			'pemasukan' => $this->input->post('pemasukan'),
			'pengeluaran' => $this->input->post('pengeluaran'),
			'tanggal' => $this->input->post('tanggal'),
		];
		$this->m_model->tambah_data('keuangan', $data);
		redirect(base_url('admin/keuangan'));
	}

	public function tambah_keuangan()
	{
		$data['keuangan'] = $this->m_model->get_data('keuangan')->result();
		$this->load->view('admin/tambah_keuangan',$data);
	}

	public function hapus_keuangan($id)
	{
		$this->m_model->delete('keuangan', 'id', $id);
		redirect(base_url('admin/keuangan')); 
	}

	public function ubah_keuangan($id)
	{
		$data['keuangan'] = $this->m_model->get_by_id('keuangan', 'id', $id)->result();
        $this->load->view('admin/ubah_keuangan', $data);
	}

	public function aksi_ubah_keuangan()
	{
		$data = [
			'pemasukan' => $this->input->post('pemasukan'),
			'pengeluaran' => $this->input->post('pengeluaran'),
			'tanggal' => $this->input->post('tanggal'),

		];
		$eksekusi=$this->m_model->ubah_data
		('keuangan', $data, array('id'=>$this->input->post('id')));
		if($eksekusi){
			$this->session->set_flashdata('sukses', 'berhasil');
			redirect(base_url('admin/keuangan'));
		} else {
			$this->session->set_flashdata('error', 'gagal...');
			redirect(base_url('admin/keuangan/ubah_keuangan'.$this->input->post('id')));
		}
	}

	// wekmrkrk
	public function  export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font'=> ['bold' => true],
            'alignment'=> [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment ::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment ::VERTICAL_CENTER
            ],
            'borders'=> [
                'top'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'right'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'bottom'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'left'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN]
            ],
            ];
        $style_row = [
            
            'alignment'=> [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment ::VERTICAL_CENTER
            ],
            'borders'=> [
                'top'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'right'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'bottom'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'left'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN]
            ],
            ];
    // Head
            $sheet->setCellValue('A1','DATA SISWA');
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->getFont()->setBold(true);
    
            $sheet->setCellValue('A2','ID');
            $sheet->setCellValue('B2','NAMA SISWA');
            $sheet->setCellValue('C2','NISN');
            $sheet->setCellValue('D2','GENDER');
            $sheet->setCellValue('E2','KELAS');
            $sheet->setCellValue('F2','FOTO');
    
            $sheet->getStyle('A2')->applyFromArray($style_col);
            $sheet->getStyle('B2')->applyFromArray($style_col);
            $sheet->getStyle('C2')->applyFromArray($style_col);
            $sheet->getStyle('D2')->applyFromArray($style_col);
            $sheet->getStyle('E2')->applyFromArray($style_col);
            $sheet->getStyle('F2')->applyFromArray($style_col);
    // get data dari database
            $data_siswa = $this->m_model->get_data('siswa')->result();
    // isi
            $no=1;
            $numrow=3;
            foreach ($data_siswa as $data) {
            $sheet->setCellValue('A'.$numrow,$data->id_siswa);
            $sheet->setCellValue('B'.$numrow,$data->nama_siswa);
            $sheet->setCellValue('C'.$numrow,$data->nisn);
            $sheet->setCellValue('D'.$numrow,$data->gender);
            $sheet->setCellValue('E'.$numrow,tampil_full_kelas_byid($data->id_kelas));

    
    $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);

    $no++;
    $numrow++;
    }
    
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(30);

            $sheet->getDefaultRowDimension()->setRowHeight(-1);
    
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
            $sheet->setTitle("LAPORAN DATA SISWA");
    
    
            header('Content-Type: aplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Siswa.xlsx"');
            header('cache-Control: max-age=0');
    
            $writer =new Xlsx($spreadsheet);
			$writer->save('php://output');
    }

	public function import()
	{
		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			$object = PhpOffice\PhpSpreadsheet\IOFactory::load($path);
			foreach ($object->getWorksheetIterator() as $worksheet) 
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestRow();
				for ($row=2; $row <= $highestRow; $row++) 
				{ 
					$id_siswa = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$nama_siswa = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$nisn = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$gender = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$id_kelas = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$foto = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

					$get_id_by_nisn = $this->m_model->get_by_nisn($nisn);
					$data = array(
						'id_siswa' => $id_siswa,
						'nama_siswa' => $nama_siswa,
						'nisn' => $nisn,
						'gender' => $gender,
						'id_kelas' => $id_kelas,
						'foto' => $foto,
					);
					$this->m_model->tambah_data('siswa', $data);
				}
			}
			redirect(base_url('admin/siswa'));
		} else {
			echo 'Invalid File';
		}
	}
}

?>




