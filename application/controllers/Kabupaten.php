<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kabupaten extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kabupaten_model');
        $this->load->library('form_validation');
    }


    // membuat kode barang otomatis
    function kode()
    {
             $this->db->select('RIGHT(kabupaten.kode_kabupaten,2) as kode_kabupaten', FALSE);
             $this->db->order_by('kode_kabupaten','DESC');    
             $this->db->limit(1);    
             $query = $this->db->get('kabupaten');  //cek dulu apakah ada sudah ada kode di tabel.    
             if($query->num_rows() <> 0){      
                  //cek kode jika telah tersedia    
                  $data = $query->row();      
                  $kode = intval($data->kode_kabupaten) + 1; 
             }
             else{      
                  $kode = 1;  //cek jika kode belum terdapat pada table
             }
                 $tgl=date('dmY'); 
                 $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
                 $kodetampil = "KAB".$batas;  //format kode
                 return $kodetampil;  
   }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kabupaten/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kabupaten/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kabupaten/index.html';
            $config['first_url'] = base_url() . 'kabupaten/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kabupaten_model->total_rows($q);
        $kabupaten = $this->Kabupaten_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kabupaten_data' => $kabupaten,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('kabupaten_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_provinsi' => $row->kode_provinsi,
		'kode_kabupaten' => $row->kode_kabupaten,
		'kabupaten' => $row->kabupaten,
	    );
            $this->load->view('header');
            $this->load->view('kabupaten_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kabupaten/create_action'),
	    'id' => set_value('id'),
	    'kode_provinsi' => set_value('kode_provinsi'),
	    'kode_kabupaten' => set_value('kode_kabupaten'),
	    'kabupaten' => set_value('kabupaten'),
	);
        $data['kode']=$this->kode();
        $this->load->view('header');
        $this->load->view('kabupaten_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_provinsi' => $this->input->post('kode_provinsi',TRUE),
		'kode_kabupaten' => $this->input->post('kode_kabupaten',TRUE),
		'kabupaten' => $this->input->post('kabupaten',TRUE),
	    );

            $this->Kabupaten_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kabupaten/update_action'),
		'id' => set_value('id', $row->id),
		'kode_provinsi' => set_value('kode_provinsi', $row->kode_provinsi),
		'kode' => set_value('kode_kabupaten', $row->kode_kabupaten),
		'kabupaten' => set_value('kabupaten', $row->kabupaten),
	    );
            $this->load->view('header');
            $this->load->view('kabupaten_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kode_provinsi' => $this->input->post('kode_provinsi',TRUE),
		'kode_kabupaten' => $this->input->post('kode_kabupaten',TRUE),
		'kabupaten' => $this->input->post('kabupaten',TRUE),
	    );

            $this->Kabupaten_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);

        if ($row) {
            $this->Kabupaten_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kabupaten'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_provinsi', 'kode provinsi', 'trim|required');
	$this->form_validation->set_rules('kode_kabupaten', 'kode kabupaten', 'trim|required');
	$this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kabupaten.php */
/* Location: ./application/controllers/Kabupaten.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-21 17:10:15 */
/* http://harviacode.com */