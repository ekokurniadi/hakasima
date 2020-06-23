<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tentang extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tentang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tentang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tentang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tentang/index.html';
            $config['first_url'] = base_url() . 'tentang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tentang_model->total_rows($q);
        $tentang = $this->Tentang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tentang_data' => $tentang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('tentang_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Tentang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'tentang_kami' => $row->tentang_kami,
	    );
            $this->load->view('header');
            $this->load->view('tentang_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tentang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tentang/create_action'),
	    'id' => set_value('id'),
	    'tentang_kami' => set_value('tentang_kami'),
	);

        $this->load->view('header');
        $this->load->view('tentang_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tentang_kami' => $this->input->post('tentang_kami',TRUE),
	    );

            $this->Tentang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tentang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tentang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tentang/update_action'),
		'id' => set_value('id', $row->id),
		'tentang_kami' => set_value('tentang_kami', $row->tentang_kami),
	    );
            $this->load->view('header');
            $this->load->view('tentang_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tentang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'tentang_kami' => $this->input->post('tentang_kami',TRUE),
	    );

            $this->Tentang_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tentang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tentang_model->get_by_id($id);

        if ($row) {
            $this->Tentang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tentang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tentang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tentang_kami', 'tentang kami', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tentang.php */
/* Location: ./application/controllers/Tentang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-22 11:12:33 */
/* http://harviacode.com */