<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Konsumen extends MY_Controller {

    // protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Konsumen_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'konsumen/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'konsumen/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'konsumen/index.html';
            $config['first_url'] = base_url() . 'konsumen/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Konsumen_model->total_rows($q);
        $konsumen = $this->Konsumen_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'konsumen_data' => $konsumen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('konsumen_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Konsumen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'customer_id' => $row->customer_id,
		'nama_lengkap' => $row->nama_lengkap,
		'jenis_kelamin' => $row->jenis_kelamin,
		'tanggal_lahir' => $row->tanggal_lahir,
		'alamat' => $row->alamat,
		'email' => $row->email,
		'password' => $row->password,
		'foto' => $row->foto,
		'role' => $row->role,
	    );
            $this->load->view('header');
            $this->load->view('konsumen_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('konsumen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('konsumen/create_action'),
	    'id' => set_value('id'),
	    'customer_id' => set_value('customer_id'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'no_ktp' => set_value('no_ktp'),
	    'no_hp' => set_value('no_hp'),
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


    // public function create_action() 
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->create();
    //     } else {
    //         $data = array(
	// 	'customer_id' => $this->input->post('customer_id',TRUE),
	// 	'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
	// 	'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
	// 	'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
	// 	'alamat' => $this->input->post('alamat',TRUE),
	// 	'email' => $this->input->post('email',TRUE),
	// 	'password' => $this->input->post('password',TRUE),
	// 	'foto' => $this->input->post('foto',TRUE),
	// 	'role' => $this->input->post('role',TRUE),
	//     );

    //         $this->Konsumen_model->insert($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');
    //         if($_SESSION['role']=='admin'){
    //             redirect(site_url('konsumen'));
    //         }else{
    //             redirect(site_url('auth_sales/register')); 
    //         }
    //     }
    // }

    
    // fungsi untuk save dan upload gambar
    public function create_action() 
    {
            $this->load->library('upload');
            // $nmfile = "home".time();
            $config['upload_path']   = './image/';
            $config['overwrite']     = true;
            $config['allowed_types'] = 'gif|jpeg|png|jpg|bmp';
            $config['file_name'] = $_FILES['foto']['name'];

            $this->upload->initialize($config);

            if($_FILES['foto']['name'])
            {
                if($this->upload->do_upload('foto'))
                {
                $gbr = $this->upload->data();
                $data = array(
                    'customer_id' => $this->input->post('customer_id',TRUE),
                    'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                    'no_ktp' => $this->input->post('no_ktp',TRUE),
                    'no_hp' => $this->input->post('no_hp',TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                    'alamat' => $this->input->post('alamat',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    'password' => $this->input->post('password',TRUE),
                    'foto' => $gbr['file_name'],
                    'role' => 'konsumen',
                    );

                    $this->Konsumen_model->insert($data);
                    $this->session->set_flashdata('message', 'Sukses mendaftar silahkan login ke akun anda');
                    if($_SESSION['role']=='admin'){
                        redirect(site_url('konsumen'));
                    }else{
                        redirect(site_url('auth_sales/register')); 
                    }
        }
    }
}
    
    public function update($id) 
    {
        $row = $this->Konsumen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('konsumen/update_action'),
		'id' => set_value('id', $row->id),
		'customer_id' => set_value('customer_id', $row->customer_id),
		'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
		'no_ktp' => set_value('no_ktp', $row->no_ktp),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'alamat' => set_value('alamat', $row->alamat),
		'email' => set_value('email', $row->email),
		'password' => set_value('password', $row->password),
		'foto' => set_value('foto', $row->foto),
		'role' => set_value('role', $row->role),
	    );
            $this->load->view('header');
            $this->load->view('konsumen_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('konsumen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'customer_id' => $this->input->post('customer_id',TRUE),
        'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
        'no_ktp' => $this->input->post('no_ktp',TRUE),
        'no_hp' => $this->input->post('no_hp',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'email' => $this->input->post('email',TRUE),
		'password' => $this->input->post('password',TRUE),
		'foto' => $this->input->post('foto',TRUE),
		'role' => $this->input->post('role',TRUE),
	    );

            $this->Konsumen_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('konsumen'));
        }
    }
    

    // fungsi untuk mengupdate barang
    public function update_action2() 
    {
        $this->load->library('upload');
        $nmfile = "home".time();
        $config['upload_path']   = './image/';
        $config['overwrite']     = true;
        $config['allowed_types'] = 'gif|jpeg|png|jpg|bmp';
        $config['file_name'] = $this->id;

        $this->upload->initialize($config);
        
                if(!empty($_FILES['foto']['name']))
                {  
                        unlink("./image/".$this->input->post('foto'));

                    if($_FILES['foto']['name'])
                    {
                        if($this->upload->do_upload('foto'))
                        {
                            $gbr = $this->upload->data();
                            $data = array(
                                'customer_id' => $this->input->post('customer_id',TRUE),
                                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                                'no_ktp' => $this->input->post('no_ktp',TRUE),
                                'no_hp' => $this->input->post('no_hp',TRUE),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                                'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                                'alamat' => $this->input->post('alamat',TRUE),
                                'email' => $this->input->post('email',TRUE),
                                'password' => $this->input->post('password',TRUE),
                                'role' => $this->input->post('role',TRUE),
                                'foto' => $gbr['file_name'],
                            );
                        }
                    }
                    $this->Konsumen_model->update($this->input->post('id', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('toko'));
                }
                    else
                        {
                            $data = array(
                                'customer_id' => $this->input->post('customer_id',TRUE),
                                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                                'no_ktp' => $this->input->post('no_ktp',TRUE),
                                'no_hp' => $this->input->post('no_hp',TRUE),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                                'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                                'alamat' => $this->input->post('alamat',TRUE),
                                'email' => $this->input->post('email',TRUE),
                                'password' => $this->input->post('password',TRUE),
                                'role' => $this->input->post('role',TRUE),
                            );
                        }
                        $this->Konsumen_model->update($this->input->post('id', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('toko'));
        }


    public function delete($id) 
    {
        $row = $this->Konsumen_model->get_by_id($id);

        if ($row) {
            $this->Konsumen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('konsumen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('konsumen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('customer_id', 'customer id', 'trim|required');
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('role', 'role', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Konsumen.php */
/* Location: ./application/controllers/Konsumen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-24 05:02:10 */
/* http://harviacode.com */