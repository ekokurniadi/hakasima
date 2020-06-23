<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelian extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembelian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pembelian/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembelian/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembelian/index.html';
            $config['first_url'] = base_url() . 'pembelian/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pembelian_model->total_rows($q);
        $pembelian = $this->Pembelian_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pembelian_data' => $pembelian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('pembelian_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Pembelian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_pembelian' => $row->kode_pembelian,
		'tanggal' => $row->tanggal,
		'customer_id' => $row->customer_id,
		'alamat' => $row->alamat,
		'provinsi' => $row->provinsi,
		'kecamatan' => $row->kecamatan,
		'kabupaten' => $row->kabupaten,
		'ekspedisi' => $row->ekspedisi,
		'layanan' => $row->layanan,
		'status' => $row->status,
	    );
            $this->load->view('header');
            $this->load->view('pembelian_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembelian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembelian/create_action'),
	    'id' => set_value('id'),
	    'kode_pembelian' => set_value('kode_pembelian'),
	    'tanggal' => set_value('tanggal'),
	    'customer_id' => set_value('customer_id'),
	    'alamat' => set_value('alamat'),
	    'provinsi' => set_value('provinsi'),
	    'kecamatan' => set_value('kecamatan'),
	    'kabupaten' => set_value('kabupaten'),
	    'ekspedisi' => set_value('ekspedisi'),
	    'layanan' => set_value('layanan'),
	    'status' => set_value('status'),
	);

        $this->load->view('header');
        $this->load->view('pembelian_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_pembelian' => $this->input->post('kode_pembelian',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'customer_id' => $this->input->post('customer_id',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'provinsi' => $this->input->post('provinsi',TRUE),
		'kecamatan' => $this->input->post('kecamatan',TRUE),
		'kabupaten' => $this->input->post('kabupaten',TRUE),
		'ekspedisi' => $this->input->post('ekspedisi',TRUE),
		'layanan' => $this->input->post('layanan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Pembelian_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pembelian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pembelian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembelian/update_action'),
		'id' => set_value('id', $row->id),
		'kode_pembelian' => set_value('kode_pembelian', $row->kode_pembelian),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'customer_id' => set_value('customer_id', $row->customer_id),
		'alamat' => set_value('alamat', $row->alamat),
		'provinsi' => set_value('provinsi', $row->provinsi),
		'kecamatan' => set_value('kecamatan', $row->kecamatan),
		'kabupaten' => set_value('kabupaten', $row->kabupaten),
		'ekspedisi' => set_value('ekspedisi', $row->ekspedisi),
		'layanan' => set_value('layanan', $row->layanan),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('header');
            $this->load->view('pembelian_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembelian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kode_pembelian' => $this->input->post('kode_pembelian',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'customer_id' => $this->input->post('customer_id',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'provinsi' => $this->input->post('provinsi',TRUE),
		'kecamatan' => $this->input->post('kecamatan',TRUE),
		'kabupaten' => $this->input->post('kabupaten',TRUE),
		'ekspedisi' => $this->input->post('ekspedisi',TRUE),
		'layanan' => $this->input->post('layanan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Pembelian_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pembelian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pembelian_model->get_by_id($id);

        if ($row) {
            $this->Pembelian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pembelian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembelian'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_pembelian', 'kode pembelian', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('customer_id', 'customer id', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
	$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
	$this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required');
	$this->form_validation->set_rules('ekspedisi', 'ekspedisi', 'trim|required');
	$this->form_validation->set_rules('layanan', 'layanan', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pembelian.php */
/* Location: ./application/controllers/Pembelian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-27 14:21:47 */
/* http://harviacode.com */