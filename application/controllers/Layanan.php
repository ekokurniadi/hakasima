<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layanan extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Layanan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'layanan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'layanan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'layanan/index.html';
            $config['first_url'] = base_url() . 'layanan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Layanan_model->total_rows($q);
        $layanan = $this->Layanan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'layanan_data' => $layanan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('layanan_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'layanan' => $row->layanan,
	    );
            $this->load->view('header');
            $this->load->view('layanan_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('layanan/create_action'),
	    'id' => set_value('id'),
	    'layanan' => set_value('layanan'),
	);

        $this->load->view('header');
        $this->load->view('layanan_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'layanan' => $this->input->post('layanan',TRUE),
	    );

            $this->Layanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('layanan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('layanan/update_action'),
		'id' => set_value('id', $row->id),
		'layanan' => set_value('layanan', $row->layanan),
	    );
            $this->load->view('header');
            $this->load->view('layanan_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'layanan' => $this->input->post('layanan',TRUE),
	    );

            $this->Layanan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('layanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $this->Layanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('layanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('layanan', 'layanan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Layanan.php */
/* Location: ./application/controllers/Layanan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-21 17:09:55 */
/* http://harviacode.com */