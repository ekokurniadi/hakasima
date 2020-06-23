<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About extends MY_Controller {

    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('About_model');
        $this->load->library('form_validation');
        // $this->load->model('Transaksi_pesanan_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'about/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'about/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'about/index.html';
            $config['first_url'] = base_url() . 'about/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->About_model->total_rows($q);
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $about = $this->About_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'about_data' => $about,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            // 'total_pemesanan'=>$config['total_pemesanan'],
        );
        $this->load->view('header');
        $this->load->view('about_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $row = $this->About_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'profil' => $row->profil,
        'isi' => $row->isi,
        // 'total_pemesanan'=>$config['total_pemesanan'],
	    );
            $this->load->view('header');
            $this->load->view('about_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }

    public function create() 
    {
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $data = array(
            'button' => 'Create',
            'action' => site_url('about/create_action'),
	    'id' => set_value('id'),
	    'profil' => set_value('profil'),
        'isi' => set_value('isi'),
        // 'total_pemesanan'=>$config['total_pemesanan'],
	);

        $this->load->view('header');
        $this->load->view('about_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'profil' => $this->input->post('profil',TRUE),
		'isi' => $this->input->post('isi',TRUE),
	    );

            $this->About_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('about'));
        }
    }
    
    public function update($id) 
    {
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $row = $this->About_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('about/update_action'),
		'id' => set_value('id', $row->id),
		'profil' => set_value('profil', $row->profil),
        'isi' => set_value('isi', $row->isi),
        // 'total_pemesanan'=>$config['total_pemesanan'],
	    );
            $this->load->view('header');
            $this->load->view('about_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'profil' => $this->input->post('profil',TRUE),
		'isi' => $this->input->post('isi',TRUE),
	    );

            $this->About_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('about'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->About_model->get_by_id($id);

        if ($row) {
            $this->About_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('about'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('profil', 'profil', 'trim|required');
	$this->form_validation->set_rules('isi', 'isi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-23 16:45:06 */
/* http://harviacode.com */