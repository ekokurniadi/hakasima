<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_masuk extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_masuk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang_masuk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang_masuk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang_masuk/index.html';
            $config['first_url'] = base_url() . 'barang_masuk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_masuk_model->total_rows($q);
        $barang_masuk = $this->Barang_masuk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_masuk_data' => $barang_masuk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('barang_masuk_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Barang_masuk_model->get_by_id($id);
        
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_barang_masuk' => $row->id_barang_masuk,
		'tanggal' => $row->tanggal,
	    );
            $this->load->view('header');
            $this->load->view('lihat_barang_masuk', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_masuk'));
        }
    }


       // simpan ke database
       public function input_ajax()
       {
           $this->Barang_masuk_model->insert_temp();
       }
   
   
       // save all
       public function checkout()
       {
       
          $this->Barang_masuk_model->checkout2();
       }
   
   
   
       // tampilkan ke view
       public function load_temp()
       {
           echo " <table id='example1' class='table table-bordered' >
                    <thead>
                       <tr style='background-color:#605CA8;color:white;'>
                        <th>No</th>
                       <th>Kode Barang</th>
                       <th>Nama Barang</th>
                       <th>Jumlah</th>
                       <th>Action</th>
                       </tr>
                       </thead>
                       <tbody>";
                       $id=$_GET['id_barang_masuk'];
                       $no=1;
                       $total=0;
                       $period_array=array();
                       $data = $this->Barang_masuk_model->tabel_transaksi($id)->result();
                       foreach ($data as $d) {
                           echo "<tr id='dataku$d->id'>
                                   <td>$no</td>
                                   <td>$d->kode_barang</td>
                                   <td>$d->nama_barang</td>
                                   <td>$d->jumlah</td>
                                   <td style='text-align:center;'><button type='button' class='btn btn-danger btn-flat btn-sm' onClick='hapus($d->id)'>Hapus</button></td>
                                </tr> 
                                </tbody>";
                           $no++;
                           $period_array[] = intval($d->jumlah);
                       }
                       echo "<tfoot>
                       <tr style='font-weight:bold' >
                            <td colspan='3' style='text-align:right'>Total Barang </td>
                            <td colspan='2' >".$total=array_sum($period_array)."</td>
                        </tr>
                       </tfoot>";
                       echo "</table>";                    
       }
   
       // tampilkan ke view
       public function load_temp2()
       {
           echo " <table id='example1' class='table table-bordered' >
                    <thead>
                       <tr style='background-color:#605CA8;color:white;'>
                        <th>No</th>
                       <th>Kode Barang</th>
                       <th>Nama Barang</th>
                       <th>Jumlah</th>
                      
                       </tr>
                       </thead>
                       <tbody>";
                       $id=$_GET['id_barang_masuk'];
                       $no=1;
                       $total=0;
                       $period_array=array();
                       $data = $this->Barang_masuk_model->tabel_transaksi($id)->result();
                       foreach ($data as $d) {
                           echo "<tr id='dataku$d->id'>
                                   <td>$no</td>
                                   <td>$d->kode_barang</td>
                                   <td>$d->nama_barang</td>
                                   <td>$d->jumlah</td>
                                  
                                </tr> 
                                </tbody>";
                           $no++;
                           $period_array[] = intval($d->jumlah);
                       }
                       echo "<tfoot>
                       <tr style='font-weight:bold' >
                            <td colspan='3' style='text-align:right'>Total Barang </td>
                            <td colspan='2' >".$total=array_sum($period_array)."</td>
                        </tr>
                       </tfoot>";
                       echo "</table>";                    
       }
   


       public function ambil_data()
       {
           $kode_barang = $_POST['kode_barang'];
           $data = $this->db->query("SELECT * FROM stok WHERE kode_barang='$kode_barang'")->result();
           foreach($data as $dd)
           {
               $data =array(
                   'nama_barang'=>$dd->nama_barang
               );
               
              echo json_encode($data);
           }
       }
   
   
       public function hapus_temp()
       {
           $id=$_GET['id'];
           $this->Barang_masuk_model->hapus_temp($id);
       }



    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang_masuk/create_action'),
	    'id' => set_value('id'),
	    'id_barang_masuk' => set_value('id_barang_masuk'),
	    'tanggal' => set_value('tanggal'),
	    'kode_barang' => set_value('kode_barang'),
	    'barang' => $this->db->get('stok')->result()
	);
        $data['kode']=$this->Barang_masuk_model->kode();
        $this->load->view('header');
        $this->load->view('barang_masuk_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_barang_masuk' => $this->input->post('id_barang_masuk',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
	    );

            $this->Barang_masuk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang_masuk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Barang_masuk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang_masuk/update_action'),
		'id' => set_value('id', $row->id),
		'id_barang_masuk' => set_value('id_barang_masuk', $row->id_barang_masuk),
		'tanggal' => set_value('tanggal', $row->tanggal),
	    );
            $this->load->view('header');
            $this->load->view('barang_masuk_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_masuk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_barang_masuk' => $this->input->post('id_barang_masuk',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
	    );

            $this->Barang_masuk_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang_masuk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_masuk_model->get_by_id($id);

        if ($row) {
            $this->Barang_masuk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang_masuk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_masuk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_barang_masuk', 'id barang masuk', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "barang_masuk.xls";
        $judul = "barang_masuk";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Barang Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

	foreach ($this->Barang_masuk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_barang_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=barang_masuk.doc");

        $data = array(
            'barang_masuk_data' => $this->Barang_masuk_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('barang_masuk_doc',$data);
    }

}

/* End of file Barang_masuk.php */
/* Location: ./application/controllers/Barang_masuk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-13 12:59:30 */
/* http://harviacode.com */