<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Keuangan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
        if ($this->session->userdata('logged_in') != true && $this->session->userdata('role') != 'keuangan') {
            redirect(base_url().'auth');
        }
	}

	public function index()
	{
		$this->load->view('keuangan/index');
	}

    public function dashboard()
    {
        $this->load->view('keuangan/dashboard');
    }

    public function pembayaran()
    {

        $data['pembayaran'] = $this->m_model->get_data('pembayaran')->result();
		$this->load->view('keuangan/pembayaran',$data);
    }

    public function aksi_tambah_pembayaran()
	{
		$data = [
			'id_siswa' => $this->input->post('id_siswa'),
			'id_kelas' => $this->input->post('id_kelas'),
			'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
			'total_pembayaran' => $this->input->post('total_pembayaran'),
		];
		$this->m_model->tambah_data('pembayaran', $data);
		redirect(base_url('keuangan/pembayaran'));
	}

	public function tambah_pembayaran()
	{
		$data['pembayaran'] = $this->m_model->get_data('pembayaran')->result();
		$data['siswa'] = $this->m_model->get_data('siswa')->result();
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
		$this->load->view('keuangan/tambah_pembayaran',$data);
	}

	public function hapus_pembayaran($id)
	{
		$this->m_model->delete('pembayaran', 'id', $id);
		redirect(base_url('keuangan/pembayaran')); 
	}

	public function ubah_pembayaran($id)
	{
		$data['pembayaran'] = $this->m_model->get_by_id('pembayaran', 'id', $id)->result();
        $this->load->view('keuangan/ubah_pembayaran', $data);
	}

	public function aksi_ubah_pembayaran()
	{
		$data = [
			'id' => $this->input->post('id'),
			'id_siswa' => $this->input->post('id_siswa'),
			'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
			'total_pembayaran' => $this->input->post('total_pembayaran'),

        ];
		$eksekusi=$this->m_model->ubah_data
		('pembayaran', $data, array('id'=>$this->input->post('id')));
		if($eksekusi){
			$this->session->set_flashdata('sukses', 'berhasil');
			redirect(base_url('keuangan/pembayaran'));
		} else {
			$this->session->set_flashdata('error', 'gagal...');
			redirect(base_url('keuangan/pembayaran/ubah_pembayaran'.$this->input->post('id')));
		}
	}


// export
	public function exportToCSV()
    {
        // Ambil data yang akan diekspor (gantilah dengan data Anda)
        $data = $this->m_model->get_data('pembayaran')->result();
    
        // Nama file CSV yang akan dihasilkan
        $filename = 'export_data.csv';
    
        // Set header HTTP untuk membuat browser mengenali file sebagai CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
    
        // Buat file CSV
        $output = fopen('php://output', 'w');
    
        // Tambahkan header
        fputcsv($output, array('ID', 'JENIS PEMBAYARAN' , 'TOTAL PEMBAYARAN' ));
    
        // Isi data
        foreach ($data as $item) {
            fputcsv($output, array($item->id, $item->jenis_pembayaran , $item->total_pembayaran)); 
        }
    
        fclose($output);
    }


// import
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
					$jenis_pembayaran = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$total_pembayaran = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$nisn = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

					$get_id_by_nisn = $this->m_model->get_by_nisn($nisn);
					$data = array(
						'jenis_pembayaran' => $jenis_pembayaran,
						'total_pembayaran' => $total_pembayaran,
						'id_siswa' => $get_id_by_nisn,
					);
					$this->m_model->tambah_data('pembayaran', $data);
				}
			}
			redirect(base_url('keuangan/pembayaran'));
		} else {
			echo 'Invalid File';
		}
	}

	public function export_pembayaran()
	{
		$data['data_pembayaran'] = $this->m_model->get_data('pembayaran')->result();
		$data['nama'] = 'pembayaran';
		if ($this->uri->segment(3) == "pdf") {
			$this->load->library('pdf');
			$this->pdf->load_view('keuangan/export_data_pembayaran', $data);
			$this->pdf->render();
			$this->pdf->stream("data_pembayaran.pdf", array("Attachment" => false));
		} else {
			$this->load->view('keuangan/download_data_pembayaran', $data);
		}
	}

	public function export_guru()
	{
		$data['data_guru'] = $this->m_model->get_data('guru')->result();
		$data['nama'] = 'guru';
		if ($this->uri->segment(3) == "pdf") {
			$this->load->library('pdf');
			$this->pdf->load_view('keuangan/export_data_guru', $data);
			$this->pdf->render();
			$this->pdf->stream("data_guru.pdf", array("Attachment" => false));
		} else {
			$this->load->view('keuangan/download_data_guru', $data);
		}
	}
}

?>



