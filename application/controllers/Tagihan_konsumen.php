<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tagihan_konsumen extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tagihan_konsumen_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tagihan_konsumen/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tagihan_konsumen/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tagihan_konsumen/index.html';
            $config['first_url'] = base_url() . 'tagihan_konsumen/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tagihan_konsumen_model->total_rows($q);
        $tagihan_konsumen = $this->Tagihan_konsumen_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tagihan_konsumen_data' => $tagihan_konsumen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('tagihan', $data);
        $this->load->view('footer');
    }

    public function listnya($id_prospek)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tagihan_konsumen/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tagihan_konsumen/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tagihan_konsumen/index.html';
            $config['first_url'] = base_url() . 'tagihan_konsumen/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tagihan_konsumen_model->total_rows2($q,$id_prospek);
        $tagihan_konsumen = $this->Tagihan_konsumen_model->get_limit_data2($config['per_page'], $start, $q,$id_prospek);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tagihan_konsumen_data' => $tagihan_konsumen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('tagihan_konsumen_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Tagihan_konsumen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_prospek' => $row->id_prospek,
		'id_customer' => $row->id_customer,
		'nama_konsumen' => $row->nama_konsumen,
		'nominal' => $row->nominal,
		'tanggal_pembayaran' => $row->tanggal_pembayaran,
		'keterangan' => $row->keterangan,
		'status' => $row->status,
	    );
            $this->load->view('header');
            $this->load->view('tagihan_konsumen_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tagihan_konsumen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tagihan_konsumen/create_action'),
	    'id' => set_value('id'),
	    'id_prospek' => set_value('id_prospek'),
	    'id_customer' => set_value('id_customer'),
	    'nama_konsumen' => set_value('nama_konsumen'),
	    'nominal' => set_value('nominal'),
	    'tanggal_pembayaran' => set_value('tanggal_pembayaran'),
	    'keterangan' => set_value('keterangan'),
	    'status' => set_value('status'),
	);

        $this->load->view('header');
        $this->load->view('tagihan_konsumen_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_prospek' => $this->input->post('id_prospek',TRUE),
		'id_customer' => $this->input->post('id_customer',TRUE),
		'nama_konsumen' => $this->input->post('nama_konsumen',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
		'tanggal_pembayaran' => $this->input->post('tanggal_pembayaran',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tagihan_konsumen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tagihan_konsumen'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tagihan_konsumen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tagihan_konsumen/update_action'),
		'id' => set_value('id', $row->id),
		'id_prospek' => set_value('id_prospek', $row->id_prospek),
		'id_customer' => set_value('id_customer', $row->id_customer),
		'nama_konsumen' => set_value('nama_konsumen', $row->nama_konsumen),
		'nominal' => set_value('nominal', $row->nominal),
		'tanggal_pembayaran' => set_value('tanggal_pembayaran', $row->tanggal_pembayaran),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('header');
            $this->load->view('tagihan_konsumen_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tagihan_konsumen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_prospek' => $this->input->post('id_prospek',TRUE),
		'id_customer' => $this->input->post('id_customer',TRUE),
		'nama_konsumen' => $this->input->post('nama_konsumen',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
		'tanggal_pembayaran' => $this->input->post('tanggal_pembayaran',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tagihan_konsumen_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tagihan_konsumen'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tagihan_konsumen_model->get_by_id($id);

        if ($row) {
            $this->Tagihan_konsumen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tagihan_konsumen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tagihan_konsumen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_prospek', 'id prospek', 'trim|required');
	$this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	$this->form_validation->set_rules('nama_konsumen', 'nama konsumen', 'trim|required');
	$this->form_validation->set_rules('nominal', 'nominal', 'trim|required|numeric');
	$this->form_validation->set_rules('tanggal_pembayaran', 'tanggal pembayaran', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tagihan_konsumen.php */
/* Location: ./application/controllers/Tagihan_konsumen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-05 16:46:39 */
/* http://harviacode.com */