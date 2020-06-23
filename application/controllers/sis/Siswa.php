<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'siswa/index.html';
            $config['first_url'] = base_url() . 'siswa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Siswa_model->total_rows($q);
        $siswa = $this->Siswa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'siswa_data' => $siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('siswa_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nis' => $row->nis,
		'nama' => $row->nama,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
		'agama' => $row->agama,
		'jenis_kelamin' => $row->jenis_kelamin,
		'alamat' => $row->alamat,
		'kelas' => $row->kelas,
		'foto' => $row->foto,
	    );
            $this->load->view('header');
            $this->load->view('siswa_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siswa/create_action'),
	    'id' => set_value('id'),
	    'nis' => set_value('nis'),
	    'nama' => set_value('nama'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'agama' => set_value('agama'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'alamat' => set_value('alamat'),
	    'kelas' => set_value('kelas'),
	    'foto' => set_value('foto'),
         'content_kelas'=>$this->db->get('kelas')->result(),
	);

        $this->load->view('header');
        $this->load->view('siswa_form', $data);
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
                        'nis' => $this->input->post('nis',TRUE),
                        'nama' => $this->input->post('nama',TRUE),
                        'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                        'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                        'agama' => $this->input->post('agama',TRUE),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                        'alamat' => $this->input->post('alamat',TRUE),
                        'kelas' => $this->input->post('kelas',TRUE),
                        'foto' => $gbr['file_name']
                        );

                }
            }

          $this->Siswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('siswa'));
    }
    
    public function update($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswa/update_action'),
		'id' => set_value('id', $row->id),
		'nis' => set_value('nis', $row->nis),
		'nama' => set_value('nama', $row->nama),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'agama' => set_value('agama', $row->agama),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'alamat' => set_value('alamat', $row->alamat),
		'kelas' => set_value('kelas', $row->kelas),
		'foto' => set_value('foto', $row->foto),
         'content_kelas'=>$this->db->get('kelas')->result(),
	    );
            $this->load->view('header');
            $this->load->view('siswa_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
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
            unlink("./images/".$this->input->post('foto'));

              if($_FILES['foto']['name'])
            {
                if($this->upload->do_upload('foto'))
                {
                    $gbr = $this->upload->data();

                            $data = array(
                            'nis' => $this->input->post('nis',TRUE),
                            'nama' => $this->input->post('nama',TRUE),
                            'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                            'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                            'agama' => $this->input->post('agama',TRUE),
                            'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                            'alamat' => $this->input->post('alamat',TRUE),
                            'kelas' => $this->input->post('kelas',TRUE),
                            'foto' => $gbr['file_name']
                        );

                }
            }
           
            $this->Siswa_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa'));
       
        }else{

                          $data = array(
                            'nis' => $this->input->post('nis',TRUE),
                            'nama' => $this->input->post('nama',TRUE),
                            'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                            'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                            'agama' => $this->input->post('agama',TRUE),
                            'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                            'alamat' => $this->input->post('alamat',TRUE),
                            'kelas' => $this->input->post('kelas',TRUE),
                        );
            }

            $this->Siswa_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa'));
   }

    
    public function delete($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            unlink("./images/".$row->foto);
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nis', 'nis', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('agama', 'agama', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "siswa.xls";
        $judul = "siswa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nis");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");

	foreach ($this->Siswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelas);
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
        header("Content-Disposition: attachment;Filename=siswa.doc");

        $data = array(
            'siswa_data' => $this->Siswa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('siswa_doc',$data);
    }

}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-02-26 15:52:14 */
/* http://harviacode.com */