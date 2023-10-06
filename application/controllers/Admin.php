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

	public function export() {

        // Load autoloader Composer
        
        $spreadsheet = new Spreadsheet();

        // Buat lembar kerja aktif
        $sheet = $spreadsheet->getActiveSheet();
        // Data yang akan diekspor (contoh data)
        $data = $this->m_model->get_data('siswa')->result();
        
        // Buat objek Spreadsheet
        $headers = ['ID','NAMA SISWA','NISN', 'GENDER', 'KELAS'];
        $rowIndex = 1;
        foreach ($headers as $header) {
            $sheet->setCellValueByColumnAndRow($rowIndex, 1, $header);
            $rowIndex++;
        }
        
        // Isi data dari database
        $rowIndex = 2;
        foreach ($data as $rowData) {
            $columnIndex = 1;
            $id = ''; // Variabel untuk menyimpan id
            $siswaName = ''; // Variabel untuk menyimpan nama siswa
            $nisn = ''; // Variabel untuk menyimpan jenis pembayaran
            $gender = ''; // Variabel untuk menyimpan total pembayaran
            $kelas = ''; // Variabel untuk menyimpan kelas
        
            foreach ($rowData as $cellName => $cellData) {
                if($cellName == 'id_siswa'){
                    $id = $cellData;
                }elseif ($cellName == 'nama_siswa') {
                    $siswaName = $cellData;
                } elseif ($cellName == 'nisn') {
                    $nisn = $cellData;
                } elseif ($cellName == 'gender') {
                    $gender = $cellData;
                } elseif ($cellName == 'id_kelas') {
                    $kelas = tampil_full_kelas_byid($cellData);
                }
        
                // Anda juga dapat menambahkan logika lain jika perlu
                // Contoh: Menghitung total pembayaran, mengubah format tanggal, dll.
                
                // Contoh: $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $cellData);
                $columnIndex++;
            }
        
            // Setelah loop, Anda memiliki data yang diperlukan dari setiap kolom
            // Anda dapat mengisinya ke dalam lembar kerja Excel di sini
            $sheet->setCellValueByColumnAndRow(1, $rowIndex, $id);
            $sheet->setCellValueByColumnAndRow(2, $rowIndex, $siswaName);
            $sheet->setCellValueByColumnAndRow(3, $rowIndex, $nisn);
            $sheet->setCellValueByColumnAndRow(4, $rowIndex, $gender);
            $sheet->setCellValueByColumnAndRow(5, $rowIndex, $kelas);
        
            $rowIndex++;
        }
        // Auto size kolom berdasarkan konten
        foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Set style header
        // $headerStyle = [
        //     'font' => ['bold' => true],
        //     'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        // ];
        // $sheet->getStyle('A1:' . $sheet->getHighestDataColumn() . '1')->applyFromArray($headerStyle);
        
        // Konfigurasi output Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'SISWA.xlsx'; // Nama file Excel yang akan dihasilkan
        
        // Set header HTTP untuk mengunduh file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Outputkan file Excel ke browser
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




