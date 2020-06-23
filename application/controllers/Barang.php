<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_rows($q);
        $barang = $this->Barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_data' => $barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('barang_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_barang' => $row->kode_barang,
		'nama_barang' => $row->nama_barang,
		'deskripsi_barang' => $row->deskripsi_barang,
		'harga' => $row->harga,
		'foto' => $row->foto,
	    );
            $this->load->view('header');
            $this->load->view('barang_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang/create_action'),
	    'id' => set_value('id'),
	    'kode_barang' => set_value('kode_barang'),
	    'nama_barang' => set_value('nama_barang'),
	    'deskripsi_barang' => set_value('deskripsi_barang'),
	    'harga' => set_value('harga'),
	    'foto' => set_value('foto'),
	);

        $data['kode']=$this->Barang_model->kode();
        $this->load->view('header');
        $this->load->view('barang_form', $data);
        $this->load->view('footer');
    }
    
    // public function create_action() 
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->create();
    //     } else {
    //         $data = array(
	// 	'kode_barang' => $this->input->post('kode_barang',TRUE),
	// 	'nama_barang' => $this->input->post('nama_barang',TRUE),
	// 	'foto' => $this->input->post('foto',TRUE),
	//     );

    //         $this->Barang_model->insert($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');
    //         redirect(site_url('barang'));
    //     }
    // }
    

    // fungsi untuk save dan upload gambar
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
                    'kode_barang' => $this->input->post('kode_barang',TRUE),
                    'nama_barang' => $this->input->post('nama_barang',TRUE),
                    'deskripsi_barang' => $this->input->post('deskripsi_barang',TRUE),
                    'harga' => $this->input->post('harga',TRUE),
                    'foto' => $gbr['file_name'],
            );

            $this->Barang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang'));
            }
        }
    }

    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/update_action'),
		'id' => set_value('id', $row->id),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'deskripsi_barang' => set_value('deskripsi_barang', $row->deskripsi_barang),
		'harga' => set_value('harga', $row->harga),
		'foto' => set_value('foto', $row->foto),
	    );
            $data['kode']=$this->Barang_model->kode();
            $this->load->view('header');
            $this->load->view('barang_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }
    
    // public function update_action() 
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->update($this->input->post('id', TRUE));
    //     } else {
    //         $data = array(
	// 	'kode_barang' => $this->input->post('kode_barang',TRUE),
	// 	'nama_barang' => $this->input->post('nama_barang',TRUE),
	// 	'foto' => $this->input->post('foto',TRUE),
	//     );

    //         $this->Barang_model->update($this->input->post('id', TRUE), $data);
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //         redirect(site_url('barang'));
    //     }
    // }
    

    // fungsi untuk mengupdate barang
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
                                'kode_barang' => $this->input->post('kode_barang',TRUE),
                                'nama_barang' => $this->input->post('nama_barang',TRUE),
                                'deskripsi_barang' => $this->input->post('deskripsi_barang',TRUE),
                                'harga' => $this->input->post('harga',TRUE),
                                'foto' => $gbr['file_name'],
                            );
                        }
                    }
                    $this->Barang_model->update($this->input->post('id', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('barang'));
                }
                    else
                        {
                            $data = array(
                                'kode_barang' => $this->input->post('kode_barang',TRUE),
                                'nama_barang' => $this->input->post('nama_barang',TRUE),
                                'deskripsi_barang' => $this->input->post('deskripsi_barang',TRUE),
                                'harga' => $this->input->post('harga',TRUE),
                            );
                        }
                        $this->Barang_model->update($this->input->post('id', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('barang'));
        }

    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            unlink("./image/".$row->foto);
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('deskripsi_barang', 'deskripsi barang', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "barang.xls";
        $judul = "barang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");

	foreach ($this->Barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->harga);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=barang.doc");

        $data = array(
            'barang_data' => $this->Barang_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('barang_doc',$data);
    }

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-10 05:12:40 */
/* http://harviacode.com */