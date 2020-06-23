<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider extends MY_Controller {

    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Slider_model');
        $this->load->library('form_validation');
        // $this->load->model('Transaksi_pesanan_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'slider/index.py?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'slider/index.py?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'slider/index.py';
            $config['first_url'] = base_url() . 'slider/index.py';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Slider_model->total_rows($q);
        // $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $slider = $this->Slider_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'slider_data' => $slider,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            // 'total_pemesanan' => $config['total_pemesanan'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('slider_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
     {   
        $row = $this->Slider_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'foto' => $row->foto,
		'tag_line' => $row->tag_line,
        'slogan' => $row->slogan,
        // 'total_pemesanan' => $config['total_pemesanan'],
	    );
            $this->load->view('header');
            $this->load->view('slider_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('slider'));
        }
    }

    public function create() 
    {  
        $data = array(
            'button' => 'Create',
            'action' => site_url('slider/create_action'),
	    'id' => set_value('id'),
	    'foto' => set_value('foto'),
	    'tag_line' => set_value('tag_line'),
        'slogan' => set_value('slogan'),
        // 'total_pemesanan' => $config['total_pemesanan'],
	);

        $this->load->view('header');
        $this->load->view('slider_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
            $this->load->library('upload');
            $nmfile = "home".time();
            $config['upload_path']   = './image/';
            $config['overwrite']     = true;
            $config['allowed_types'] = 'gif|jpeg|png|jpg|bmp';
            $config['file_name'] = $this->id;

            $this->upload->initialize($config);

            if($_FILES['foto']['name'])
            {
                if($this->upload->do_upload('foto'))
                {
                $gbr = $this->upload->data();
                $data = array(
            'foto' => $gbr['file_name'],
            'tag_line' => $this->input->post('tag_line',TRUE),
            'slogan' => $this->input->post('slogan',TRUE),
            );

                $this->Slider_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('slider'));
            }
        }
    }
    
    public function update($id) 
    {   
        $row = $this->Slider_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('slider/update_action'),
		'id' => set_value('id', $row->id),
		'foto' => set_value('foto', $row->foto),
		'tag_line' => set_value('tag_line', $row->tag_line),
        'slogan' => set_value('slogan', $row->slogan),
        // 'total_pemesanan' => $config['total_pemesanan'],
	    );
            $this->load->view('header');
            $this->load->view('slider_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('slider'));
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
        
                if(!empty($_FILES['foto']['name']))
                {  
                        unlink("./image/".$this->input->post('foto'));

                    if($_FILES['foto']['name'])
                    {
                        if($this->upload->do_upload('foto'))
                        {
                            $gbr = $this->upload->data();
                            $data = array(
                                'foto' => $gbr['file_name'],
                                'tag_line' => $this->input->post('tag_line',TRUE),
                                'slogan' => $this->input->post('slogan',TRUE),
                            );
                        }
                    }
                    $this->Slider_model->update($this->input->post('id', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('slider'));
                }
                    else
                        {
                            $data = array(
                                'tag_line' => $this->input->post('tag_line',TRUE),
                                'slogan' => $this->input->post('slogan',TRUE),
                            );
                        }
                    $this->Slider_model->update($this->input->post('id', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('slider'));
        }
    
    public function delete($id) 
    {
        $row = $this->Slider_model->get_by_id($id);

        if ($row) {
            $this->Slider_model->delete($id);
            unlink("./image/".$row->foto);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('slider'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('slider'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('tag_line', 'tag line', 'trim|required');
	$this->form_validation->set_rules('slogan', 'slogan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Slider.php */
/* Location: ./application/controllers/Slider.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-23 16:05:16 */
/* http://harviacode.com */