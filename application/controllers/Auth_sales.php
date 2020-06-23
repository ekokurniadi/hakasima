<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_sales extends MY_Controller {	
	public function logged_in_check()
	{
		if ($this->session->userdata("logged_in")) {
			redirect("toko");
		}
	}
	public function index()
	{	
		$this->logged_in_check();
		$this->load->library('form_validation');
		$this->form_validation->set_rules("email", "Email", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		if ($this->form_validation->run() == true) 
		{
			$this->load->model('auth_model2', 'auth');	
			$status = $this->auth->validate();
			if ($status == ERR_INVALID_USERNAME) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email atau Password Salah</div>');
			}
			elseif ($status == ERR_INVALID_PASSWORD) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" style="">&times;</a>Email atau Password Salah</div>');
			}
			else
			{
				$this->session->set_userdata($this->auth->get_data());
				$this->session->set_userdata("logged_in", true);
				redirect("toko");
			}
		}
		$this->load->view("web/login");
	}
	public function logout()
	{
		$this->session->unset_userdata("logged_in");
		$this->session->sess_destroy();
		redirect("auth_sales");
	}
	public function register()
	{
		$data['kode']=$this->kode();
	$this->load->view('web/register',$data);
	}

	public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('konsumen/create_action'),
	    'id' => set_value('id'),
	    'customer_id' => set_value('customer_id'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'alamat' => set_value('alamat'),
	    'email' => set_value('email'),
	    'password' => set_value('password'),
	    'foto' => set_value('foto'),
	    'role' => set_value('role'),
	);
        $data['kode']=$this->kode();
        $this->load->view('header');
        $this->load->view('konsumen_form', $data);
        $this->load->view('footer');
    }
    
    // membuat kode barang otomatis
    function kode()
    {
             $this->db->select('RIGHT(konsumen.customer_id,2) as customer_id', FALSE);
             $this->db->order_by('customer_id','DESC');    
             $this->db->limit(1);    
             $query = $this->db->get('konsumen');  //cek dulu apakah ada sudah ada kode di tabel.    
             if($query->num_rows() <> 0){      
                  //cek kode jika telah tersedia    
                  $data = $query->row();      
                  $kode = intval($data->customer_id) + 1; 
             }
             else{      
                  $kode = 1;  //cek jika kode belum terdapat pada table
             }
                 $tgl=date('dmY'); 
                 $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
                 $kodetampil = "CUS".$tgl.$batas;  //format kode
                 return $kodetampil;  
   }



	public function forget()
	{
		$this->load->view('forget');
	}
}