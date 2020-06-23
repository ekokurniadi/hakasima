<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ongkir extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ongkir_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'ongkir/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ongkir/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ongkir/index.html';
            $config['first_url'] = base_url() . 'ongkir/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ongkir_model->total_rows($q);
        $ongkir = $this->Ongkir_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ongkir_data' => $ongkir,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('ongkir_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Ongkir_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_ongkir' => $row->kode_ongkir,
		'ekspedisi' => $row->ekspedisi,
	    );
            $this->load->view('header');
            $this->load->view('ongkir_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ongkir'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ongkir/create_action'),
	    'id' => set_value('id'),
	    'kode_ongkir' => set_value('kode_ongkir'),
	    'ekspedisi' => set_value('ekspedisi'),
	);
        $data['kode_provinsi']=$this->Ongkir_model->get_provinsi();
        $data['kode']=$this->Ongkir_model->kode();
        $this->load->view('header');
        $this->load->view('ongkir_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_ongkir' => $this->input->post('kode_ongkir',TRUE),
		'ekspedisi' => $this->input->post('ekspedisi',TRUE),
	    );

            $this->Ongkir_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ongkir'));
        }
    }


     // tampilkan ke view
     public function load_temp()
     {
         echo " <table id='example1' class='table table-bordered' >
                  <thead>
                     <tr style='background-color:#605CA8;color:white;'>
                      <th>No</th>
                     <th>Provinsi</th>
                     <th>Kabupaten</th>
                     <th>Layanan</th>
                     <th>Lama Pengiriman</th>
                     <th>Ongkos</th>
                     <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>";
                     $id=$_GET['kode_ongkir'];
                     $no=1;
                     $total=0;
                     $period_array=array();
                     $data = $this->db->query("SELECT a.*,b.provinsi FROM detail_ongkir a JOIN provinsi b on a.id_provinsi=b.id where a.kode_ongkir='$id'")->result();
                     foreach ($data as $d) {
                         $ongkir=number_format($d->ongkir,0,',','.');
                         echo "<tr id='dataku$d->id'>
                                 <td>$no</td>
                                 <td>$d->provinsi</td>
                                 <td>$d->kabupaten</td>
                                 <td>$d->layanan</td>
                                 <td>$d->lama_pengiriman Hari</td>
                                 <td>Rp.$ongkir</td>
                                 <td style='text-align:center;'><button type='button' class='btn btn-danger btn-flat btn-sm' onClick='hapus($d->id)'>Hapus</button></td>
                              </tr> 
                              </tbody>";
                         $no++;
                     }
                     echo "</table>";                    
     }
    

     public function input_ajax(){
         
        $kode_ongkir            = $_GET['kode_ongkir'];
        $ekspedisi              = $_GET['ekspedisi'];
        $id_provinsi            = $_GET['id_provinsi'];
        $kabupaten              =$_GET['kabupaten'];
        $layanan                =$_GET['layanan'];
        $ongkir                 = $_GET['ongkir'];
        $lama                   = $_GET['lama'];
       
     
       $data=array(
           'kode_ongkir'=>$kode_ongkir,
           'ekspedisi'=>$ekspedisi,
           'id_provinsi'=>$id_provinsi,
           'kabupaten'=>$kabupaten,
           'layanan'=>$layanan,
           'ongkir'=>$ongkir,
           'lama_pengiriman'=>$lama,
           
           );
       $this->db->insert('detail_ongkir',$data);
     }

     public function list_kab(){
        // Ambil data ID Provinsi yang dikirim via ajax post
        $kode_provinsi = $this->input->post('kode_provinsi');
        $provi = $this->Ongkir_model->get_list_kab($kode_provinsi);
 
        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>--Please-Select---</option>";
        foreach($provi as $data){
            $lists .= "<option value='".$data->kabupaten."'>".$data->kabupaten."</option>"; // Tambahkan tag option ke variabel $lists
        }
        $callback = array('list_kab'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

     public function hapus_temp()
     {
         $id=$_GET['id'];
         $this->db->query("DELETE FROM detail_ongkir where id='$id'");
     }

    public function update($id) 
    {
        $row = $this->Ongkir_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ongkir/update_action'),
		'id' => set_value('id', $row->id),
		'kode' => set_value('kode_ongkir', $row->kode_ongkir),
		'ekspedisi' => set_value('ekspedisi', $row->ekspedisi),
        );
            $data['kode_provinsi']=$this->Ongkir_model->get_provinsi();
            $this->load->view('header');
            $this->load->view('ongkir_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ongkir'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kode_ongkir' => $this->input->post('kode_ongkir',TRUE),
		'ekspedisi' => $this->input->post('ekspedisi',TRUE),
	    );

            $this->Ongkir_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ongkir'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ongkir_model->get_by_id($id);

        if ($row) {
            $this->Ongkir_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ongkir'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ongkir'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_ongkir', 'kode ongkir', 'trim|required');
	// $this->form_validation->set_rules('ekspedisi', 'ekspedisi', 'required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

