<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends MY_Controller {

    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        // $this->load->model('Transaksi_pesanan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'service/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'service/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'service/index.html';
            $config['first_url'] = base_url() . 'service/index.html';
        }

        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Service_model->total_rows($q);
        $service = $this->Service_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'service_data' => $service,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            // 'total_pemesanan'=>$config['total_pemesanan']
        );
        $this->load->view('header',$data);
        $this->load->view('service_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $row = $this->Service_model->get_by_id($id);
        if ($row) {
            $data = array(
		'judul' => $row->judul,
		'id' => $row->id,
		'foto' => $row->foto,
        'isi' => $row->isi,
        'total_pemesanan'=>$config['total_pemesanan'],
	    );
            $this->load->view('header',$data);
            $this->load->view('service_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service'));
        }
    }

    public function create() 
    {    
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $data = array(
            'button' => 'Create',
            'action' => site_url('service/create_action'),
	    'judul' => set_value('judul'),
	    'id' => set_value('id'),
	    'foto' => set_value('foto'),
        'isi' => set_value('isi'),
        // 'total_pemesanan'=>$config['total_pemesanan'],
	);

        $this->load->view('header',$data);
        $this->load->view('service_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->load->library('upload');
        $nmfile = "home".time();
        $config['upload_path']   = './image/';
        $config['overwrite']     = true;
        $config['allowed_types'] = 'gif|jpeg|png|jpg|bmp';
        $config['file_name'] = $this->input->post('foto');

        $this->upload->initialize($config);

            if($_FILES['foto']['name'])
            {
                if($this->upload->do_upload('foto'))
                {
                $gbr = $this->upload->data();
                $data = array(
                    'judul'=>$this->input->post('judul',TRUE),
                    'foto' => $gbr['file_name'],
                    'isi' => $this->input->post('isi',TRUE),
                );

                $this->Service_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('service'));
            }
        }
    }
    
    public function update($id) 
    {
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $row = $this->Service_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('service/update_action'),
		'judul' => set_value('judul', $row->judul),
		'id' => set_value('id', $row->id),
		'foto' => set_value('foto', $row->foto),
        'isi' => set_value('isi', $row->isi),
        // 'total_pemesanan'=>$config['total_pemesanan'],
	    );
            $this->load->view('header',$data);
            $this->load->view('service_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service'));
        }
    }
    
    public function update_action() 
    {
        $this->load->library('upload');
        $nmfile = "home".time();
        $config['upload_path']   = './image/';
        $config['overwrite']     = true;
        $config['allowed_types'] = 'gif|jpeg|png|jpg|bmp';
        $config['file_name'] = $this->id;

        $this->upload->initialize($config);
        
    if(!empty($_FILES['foto']['name'])){  
        unlink("./image/".$this->input->post('foto'));

          if($_FILES['foto']['name'])
        {
            if($this->upload->do_upload('foto'))
            {
                $gbr = $this->upload->data();

                        $data = array(
                            'judul'=>$this->input->post('judul',TRUE),
                            'foto' => $gbr['file_name'],
                            'isi' => $this->input->post('isi',TRUE),
                    );

            }
        }
       
        $this->Service_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('service'));
   
    }else{

                      $data = array(
                        'judul'=>$this->input->post('judul',TRUE),
                        'isi'=> $this->input->post('isi',TRUE)
                    );
        }

        $this->Service_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('service'));
    }
    
    
    public function delete($id) 
    {
        $row = $this->Service_model->get_by_id($id);

        if ($row) {
            $this->Service_model->delete($id);
            unlink("./image/".$row->foto);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('service'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('isi', 'isi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Service.php */
/* Location: ./application/controllers/Service.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-23 19:11:31 */
/* http://harviacode.com */