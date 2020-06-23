<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hdr_transaksi extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Hdr_transaksi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'hdr_transaksi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'hdr_transaksi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'hdr_transaksi/index.html';
            $config['first_url'] = base_url() . 'hdr_transaksi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Hdr_transaksi_model->total_rows($q);
        $hdr_transaksi = $this->Hdr_transaksi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'hdr_transaksi_data' => $hdr_transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('hdr_transaksi_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Hdr_transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_transaksi' => $row->kode_transaksi,
		'tanggal_transaksi' => $row->tanggal_transaksi,
		'total' => $row->total,
		'status' => $row->status,
		'id_user' => $row->id_user,
	    );
            $this->load->view('header');
            $this->load->view('hdr_transaksi_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hdr_transaksi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hdr_transaksi/create_action'),
	    'id' => set_value('id'),
	    'kode_transaksi' => set_value('kode_transaksi'),
	    'tanggal_transaksi' => set_value('tanggal_transaksi'),
	    'total' => set_value('total'),
	    'status' => set_value('status'),
	    'id_user' => set_value('id_user'),
	);

        $this->load->view('header');
        $this->load->view('hdr_transaksi_form', $data);
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
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
		'total' => $this->input->post('total',TRUE),
		'status' => $this->input->post('status',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
	    );

            $this->Hdr_transaksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('hdr_transaksi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Hdr_transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hdr_transaksi/update_action'),
		'id' => set_value('id', $row->id),
		'kode_transaksi' => set_value('kode_transaksi', $row->kode_transaksi),
		'tanggal_transaksi' => set_value('tanggal_transaksi', $row->tanggal_transaksi),
		'total' => set_value('total', $row->total),
		'status' => set_value('status', $row->status),
		'id_user' => set_value('id_user', $row->id_user),
	    );
            $this->load->view('header');
            $this->load->view('hdr_transaksi_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hdr_transaksi'));
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
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
		'total' => $this->input->post('total',TRUE),
		'status' => $this->input->post('status',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
	    );

            $this->Hdr_transaksi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hdr_transaksi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Hdr_transaksi_model->get_by_id($id);

        if ($row) {
            $this->Hdr_transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hdr_transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hdr_transaksi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_transaksi', 'kode transaksi', 'trim|required');
	$this->form_validation->set_rules('tanggal_transaksi', 'tanggal transaksi', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "hdr_transaksi.xls";
        $judul = "hdr_transaksi";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Total");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");

	foreach ($this->Hdr_transaksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_transaksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_transaksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->total);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_user);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=hdr_transaksi.doc");

        $data = array(
            'hdr_transaksi_data' => $this->Hdr_transaksi_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('hdr_transaksi_doc',$data);
    }

}

/* End of file Hdr_transaksi.php */
/* Location: ./application/controllers/Hdr_transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-10-08 19:26:17 */
/* http://harviacode.com */