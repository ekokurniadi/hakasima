<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skema_kredit extends MY_Controller {

    protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Skema_kredit_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'skema_kredit/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'skema_kredit/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'skema_kredit/index.html';
            $config['first_url'] = base_url() . 'skema_kredit/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Skema_kredit_model->total_rows($q);
        $skema_kredit = $this->Skema_kredit_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'skema_kredit_data' => $skema_kredit,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('skema_kredit_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Skema_kredit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_skema' => $row->id_skema,
		'kode_barang' => $row->kode_barang,
	    );
            $this->load->view('header');
            $this->load->view('skema_kredit_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skema_kredit'));
        }
    }

    // simpan ke database
    public function input_ajax()
    {
        $this->Skema_kredit_model->insert_temp();
    }


    // save all
    public function checkout()
    {
    
       $this->Skema_kredit_model->checkout2();
    }



    // tampilkan ke view
    public function load_temp()
    {
        echo " <table id='example1' class='table table-bordered' >
                    <tr>
                     <th>No</th>
                    <th>Kode Barang</th>
                    <th>Harga</th>
                    <th>Tenor</th>
                    <th>Angsuran</th>
                    <th>Komisi</th>
                    <th>Kontes</th>
                    <th>Action</th>
                    </tr>";
                    $id=$_GET['id_skema'];
                    $no=1;
                    $data = $this->Skema_kredit_model->tabel_transaksi($id)->result();
                    foreach ($data as $d) {
                        echo "<tr id='dataku$d->id'>
                                <td>$no</td>
                                <td>$d->kode_barang</td>
                                <td>$d->harga</td>
                                <td>$d->tenor</td>
                                <td>$d->angsuran</td>
                                <td>$d->komisi</td>
                                <td>$d->kontes</td>
                                <td><button type='button' class='btn btn-danger btn-sm' onClick='hapus($d->id)'>Batal</button></td>
                             </tr>";
                        $no++;
                        
                    }
                    echo "</table>";                    
    }


    public function hapus_temp()
    {
        $id=$_GET['id'];
        $this->Skema_kredit_model->hapus_temp($id);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('skema_kredit/create_action'),
	    'id' => set_value('id'),
	    'id_skema' => set_value('id_skema'),
        'kode_barang' => set_value('kode_barang'),
        'brg'=>$this->db->get('stok')->result()
	);

        $data['kode']=$this->Skema_kredit_model->kode();
        $this->load->view('header');
        $this->load->view('skema_kredit_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_skema' => $this->input->post('id_skema',TRUE),
		'kode_barang' => $this->input->post('kode_barang',TRUE),
	    );

            $this->Skema_kredit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('skema_kredit'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Skema_kredit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('skema_kredit/update_action'),
		'id' => set_value('id', $row->id),
		'kode' => set_value('id_skema', $row->id_skema),
        'kode_barang' => set_value('kode_barang', $row->kode_barang),
        'nama_barang'=>$this->db->query("SELECT * FROM barang where kode_barang='$row->kode_barang'")->row_array()
	    );
            $this->load->view('header');
            $this->load->view('skema_kredit_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skema_kredit'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_skema' => $this->input->post('id_skema',TRUE),
		'kode_barang' => $this->input->post('kode_barang',TRUE),
	    );

            $this->Skema_kredit_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('skema_kredit'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Skema_kredit_model->get_by_id($id);

        if ($row) {
            $this->Skema_kredit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('skema_kredit'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skema_kredit'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_skema', 'id skema', 'trim|required');
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "skema_kredit.xls";
        $judul = "skema_kredit";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Skema");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");

	foreach ($this->Skema_kredit_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_skema);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=skema_kredit.doc");

        $data = array(
            'skema_kredit_data' => $this->Skema_kredit_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('skema_kredit_doc',$data);
    }

}

/* End of file Skema_kredit.php */
/* Location: ./application/controllers/Skema_kredit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-10 06:41:50 */
/* http://harviacode.com */