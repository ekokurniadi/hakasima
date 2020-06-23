<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sales_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sales/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sales/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sales/index.html';
            $config['first_url'] = base_url() . 'sales/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sales_model->total_rows($q);
        $sales = $this->Sales_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sales_data' => $sales,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('sales_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Sales_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nik' => $row->nik,
		'nama_lengkap' => $row->nama_lengkap,
		'jenis_kelamin' => $row->jenis_kelamin,
		'nomor_hp' => $row->nomor_hp,
		'password' => $row->password,
		'role' => $row->role,
		'foto' => $row->foto,
	    );
            $this->load->view('header');
            $this->load->view('sales_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sales'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sales/create_action'),
	    'id' => set_value('id'),
	    'nik' => set_value('nik'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'nomor_hp' => set_value('nomor_hp'),
	    'password' => set_value('password'),
	    'role' => set_value('role'),
	    'foto' => set_value('foto'),
	);

        $this->load->view('header');
        $this->load->view('sales_form', $data);
        $this->load->view('footer');
    }
    

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
                                'nik' => $this->input->post('nik',TRUE),
                                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                                'nomor_hp' => $this->input->post('nomor_hp',TRUE),
                                'password' => $this->input->post('password',TRUE),
                                'role' => $this->input->post('role',TRUE),
                                'foto' => $gbr['file_name'],
                            );
                        }
                    }
                    $this->Sales_model->update($this->input->post('id', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('sales'));
                }
                    else
                        {
                            $data = array(
                                'nik' => $this->input->post('nik',TRUE),
                                'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                                'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                                'nomor_hp' => $this->input->post('nomor_hp',TRUE),
                                'password' => $this->input->post('password',TRUE),
                                'role' => $this->input->post('role',TRUE),
                            );
                        }
                        $this->Sales_model->update($this->input->post('id', TRUE), $data);
                        $this->session->set_flashdata('message', 'Update Record Success');
                        redirect(site_url('sales'));
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
                        'nik' => $this->input->post('nik',TRUE),
                        'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                        'nomor_hp' => $this->input->post('nomor_hp',TRUE),
                        'password' => $this->input->post('password',TRUE),
                        'role' => $this->input->post('role',TRUE),
                        'foto' => $gbr['file_name'],
                );
    
                $this->Sales_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('sales'));
                }
            }
        }


    // public function create_action() 
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->create();
    //     } else {
    //         $data = array(
	// 	'nik' => $this->input->post('nik',TRUE),
	// 	'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
	// 	'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
	// 	'nomor_hp' => $this->input->post('nomor_hp',TRUE),
	// 	'password' => $this->input->post('password',TRUE),
	// 	'role' => $this->input->post('role',TRUE),
	// 	'foto' => $this->input->post('foto',TRUE),
	//     );

    //         $this->Sales_model->insert($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');
    //         redirect(site_url('sales'));
    //     }
    // }
    
    public function update($id) 
    {
        $row = $this->Sales_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sales/update_action'),
		'id' => set_value('id', $row->id),
		'nik' => set_value('nik', $row->nik),
		'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'nomor_hp' => set_value('nomor_hp', $row->nomor_hp),
		'password' => set_value('password', $row->password),
		'role' => set_value('role', $row->role),
		'foto' => set_value('foto', $row->foto),
	    );
            $this->load->view('header');
            $this->load->view('sales_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sales'));
        }
    }
    
    // public function update_action() 
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->update($this->input->post('id', TRUE));
    //     } else {
    //         $data = array(
	// 	'nik' => $this->input->post('nik',TRUE),
	// 	'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
	// 	'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
	// 	'nomor_hp' => $this->input->post('nomor_hp',TRUE),
	// 	'password' => $this->input->post('password',TRUE),
	// 	'role' => $this->input->post('role',TRUE),
	// 	'foto' => $this->input->post('foto',TRUE),
	//     );

    //         $this->Sales_model->update($this->input->post('id', TRUE), $data);
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //         redirect(site_url('sales'));
    //     }
    // }
    
    public function delete($id) 
    {
        $row = $this->Sales_model->get_by_id($id);

        if ($row) {
            unlink("./image/".$row->foto);
            $this->Sales_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sales'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sales'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('nomor_hp', 'nomor hp', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('role', 'role', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sales.xls";
        $judul = "sales";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Lengkap");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Role");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");

	foreach ($this->Sales_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_hp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->role);
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
        header("Content-Disposition: attachment;Filename=sales.doc");

        $data = array(
            'sales_data' => $this->Sales_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sales_doc',$data);
    }

}

/* End of file Sales.php */
/* Location: ./application/controllers/Sales.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-10 05:35:33 */
/* http://harviacode.com */