<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Penugasan extends CI_Controller {
		public function index()
		{
            $Tanggal = date("d");
            //$TanggalAwal = 1;
            //$BulanAwal = 1;
            $Bulan = date("m");
            $Tahun = date("Y");
            $data['daftar_Shelter'] = $this->penugasan_penjaga_shelter_model->getAllPenugasanAndPetugas();
            $data['page_loc'] = "Shelter";

            $this->load->view('templates/header');
            $this->load->view('templates/navigation',$data);
			$this->load->view('penugasanShelter_view',$data);
			$this->load->view('templates/footer');
		}
		public function daftar_penjaga()
		{
            $Tanggal = date("d");
            $TanggalAwal = 1;
            $BulanAwal = 1;
            $Bulan = date("m");
            $Tahun = date("Y");
            $data['daftarPenjagaShelter'] = $this->penjaga_shelter_model-> getAllPenjagaShelter();
            $data['page_loc'] = "Daftar Penjaga";

			$this->load->view('templates/header');
			$this->load->view('templates/navigation',$data);
			$this->load->view('penugasanDaftarPenjaga_view',$data);
			$this->load->view('templates/footer');
		}
        
		public function doInsert()
		{
			$nama = $this->input->post("NamaPenjaga");
			$noKTP = $this->input->post("NoKTP");
			$noTelp = $this->input->post("NoTelp");
			$Alamat = $this->input->post("Alamat");
			$Password = $this->input->post("Password");
			$Username = $this->input->post("Username");
			$result = $this->penjaga_shelter_model->createNewPenjagaShelter($nama,$noKTP,$noTelp,$Alamat,$Username, $Password);
			if ($result)
			{
				$data['page_loc'] = "Tambah Penjaga";
				$this->load->view('templates/header');
				$this->load->view('templates/navigation',$data);
				$this->load->view('penugasanTambahPenjaga_view',$data);
				$this->load->view('templates/footer');
			}
		}
		
        public function tambah_penjaga()
		{	
            $data['page_loc'] = "Tambah Penjaga";
            $this->form_validation->set_rules('NamaPenjaga', 'Nama Penjaga', 'trim|required|xss_clean');
			$this->form_validation->set_rules('NoKTP', 'No KTP', 'trim|required|xss_clean');
			$this->form_validation->set_rules('NoTelp', 'No Telp', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Alamat', 'Alamat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Username', 'Username', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header');
				$this->load->view('templates/navigation',$data);
				$this->load->view('penugasanTambahPenjaga_view',$data);
				$this->load->view('templates/footer');
			}
		}
	}
?>
