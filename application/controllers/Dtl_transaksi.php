<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dtl_transaksi extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dtl_transaksi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'dtl_transaksi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'dtl_transaksi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'dtl_transaksi/index.html';
            $config['first_url'] = base_url() . 'dtl_transaksi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Dtl_transaksi_model->total_rows($q);
        $dtl_transaksi = $this->Dtl_transaksi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'dtl_transaksi_data' => $dtl_transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('dtl_transaksi_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Dtl_transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_transaksi' => $row->kode_transaksi,
		'sku' => $row->sku,
		'description' => $row->description,
		'brand' => $row->brand,
		'price' => $row->price,
		'departement' => $row->departement,
		'class' => $row->class,
		'subclass' => $row->subclass,
		'jumlah' => $row->jumlah,
		'total' => $row->total,
		'status' => $row->status,
		'id_user' => $row->id_user,
		'tanggal_transaksi' => $row->tanggal_transaksi,
	    );
            $this->load->view('header');
            $this->load->view('dtl_transaksi_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dtl_transaksi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dtl_transaksi/create_action'),
	    'id' => set_value('id'),
	    'kode_transaksi' => set_value('kode_transaksi'),
	    'sku' => set_value('sku'),
	    'description' => set_value('description'),
	    'brand' => set_value('brand'),
	    'price' => set_value('price'),
	    'departement' => set_value('departement'),
	    'class' => set_value('class'),
	    'subclass' => set_value('subclass'),
	    'jumlah' => set_value('jumlah'),
	    'total' => set_value('total'),
	    'status' => set_value('status'),
	    'id_user' => set_value('id_user'),
	    'tanggal_transaksi' => set_value('tanggal_transaksi'),
	);

        $this->load->view('header');
        $this->load->view('dtl_transaksi_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
		'sku' => $this->input->post('sku',TRUE),
		'description' => $this->input->post('description',TRUE),
		'brand' => $this->input->post('brand',TRUE),
		'price' => $this->input->post('price',TRUE),
		'departement' => $this->input->post('departement',TRUE),
		'class' => $this->input->post('class',TRUE),
		'subclass' => $this->input->post('subclass',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'total' => $this->input->post('total',TRUE),
		'status' => $this->input->post('status',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
	    );

            $this->Dtl_transaksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dtl_transaksi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Dtl_transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dtl_transaksi/update_action'),
		'id' => set_value('id', $row->id),
		'kode_transaksi' => set_value('kode_transaksi', $row->kode_transaksi),
		'sku' => set_value('sku', $row->sku),
		'description' => set_value('description', $row->description),
		'brand' => set_value('brand', $row->brand),
		'price' => set_value('price', $row->price),
		'departement' => set_value('departement', $row->departement),
		'class' => set_value('class', $row->class),
		'subclass' => set_value('subclass', $row->subclass),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'total' => set_value('total', $row->total),
		'status' => set_value('status', $row->status),
		'id_user' => set_value('id_user', $row->id_user),
		'tanggal_transaksi' => set_value('tanggal_transaksi', $row->tanggal_transaksi),
	    );
            $this->load->view('header');
            $this->load->view('dtl_transaksi_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dtl_transaksi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
		'sku' => $this->input->post('sku',TRUE),
		'description' => $this->input->post('description',TRUE),
		'brand' => $this->input->post('brand',TRUE),
		'price' => $this->input->post('price',TRUE),
		'departement' => $this->input->post('departement',TRUE),
		'class' => $this->input->post('class',TRUE),
		'subclass' => $this->input->post('subclass',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'total' => $this->input->post('total',TRUE),
		'status' => $this->input->post('status',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
	    );

            $this->Dtl_transaksi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dtl_transaksi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Dtl_transaksi_model->get_by_id($id);

        if ($row) {
            $this->Dtl_transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dtl_transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dtl_transaksi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_transaksi', 'kode transaksi', 'trim|required');
	$this->form_validation->set_rules('sku', 'sku', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('brand', 'brand', 'trim|required');
	$this->form_validation->set_rules('price', 'price', 'trim|required');
	$this->form_validation->set_rules('departement', 'departement', 'trim|required');
	$this->form_validation->set_rules('class', 'class', 'trim|required');
	$this->form_validation->set_rules('subclass', 'subclass', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('tanggal_transaksi', 'tanggal transaksi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Dtl_transaksi.php */
/* Location: ./application/controllers/Dtl_transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-10-08 19:16:13 */
/* http://harviacode.com */