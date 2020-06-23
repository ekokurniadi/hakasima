<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prospek extends MY_Controller {

    // protected $access = array('Sales');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Prospek_model');
        $this->load->library('form_validation');
        require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
    }

    public function index()
    {
        
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'prospek/index.py?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'prospek/index.py?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'prospek/index.py';
            $config['first_url'] = base_url() . 'prospek/index.py';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Prospek_model->total_rows($q);
        $prospek = $this->Prospek_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'prospek_data' => $prospek,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('prospek_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Prospek_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_prospek' => $row->id_prospek,
		'id_customer' => $row->id_customer,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'tanggal' => $row->tanggal,
		'no_ktp' => $row->no_ktp,
		'no_hp' => $row->no_hp,
		'kode_barang' => $row->kode_barang,
		'nama_barang' => $row->nama_barang,
		'jumlah' => $row->jumlah,
		// 'jenis_pembelian' => $row->jenis_pembelian,
		'status' => $row->status,
		'nik_sales' => $row->nik_sales,
	    );
            $this->load->view('header');
            $this->load->view('prospek_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prospek'));
        }
    }

    public function ajukan($id_prospek)
    {
        $this->db->query("update prospek set status='baru' where id_prospek ='$id_prospek'");
        redirect('toko/index','refresh');
        
    }

    public function hapus($id_prospek)
    {
        $this->db->query("delete from prospek where id_prospek ='$id_prospek'");
        redirect('toko/index','refresh');
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('prospek/create_action'),
	    'id' => set_value('id'),
	    'id_prospek' => set_value('id_prospek'),
	    'id_customer' => set_value('id_customer'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'tanggal' => set_value('tanggal'),
	    'no_ktp' => set_value('no_ktp'),
	    'no_hp' => set_value('no_hp'),
	    'kode_barang' => set_value('kode_barang'),
	    'nama_barang' => set_value('nama_barang'),
	    'jumlah' => set_value('jumlah'),
	    // 'jenis_pembelian' => set_value('jenis_pembelian'),
	    'status' => set_value('status'),
        'kobar'=>$this->db->get('stok')->result()
	);

        $data['kode']=$this->Prospek_model->kode();
        $data['kode1']=$this->Prospek_model->kode1();
        $this->load->view('header');
        $this->load->view('prospek_form', $data);
        $this->load->view('footer');
    }
    
    public function cetak($id)
    {
        $dompdf= new Dompdf();
       
        $data['prospek_data']=  $this->Prospek_model->get_by2($id);
       
        $html=$this->load->view('prospek_doc',$data,true);
       
        $dompdf->load_html($html);
        $dompdf->set_paper('A4','landscape');
        $dompdf->render();
       
        $pdf = $dompdf->output();
 
        $dompdf->stream('Prospek.pdf',array("Attachment"=>FALSE));
     }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_prospek' => $this->input->post('id_prospek',TRUE),
		'id_customer' => $this->input->post('id_customer',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'no_ktp' => $this->input->post('no_ktp',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		// 'jenis_pembelian' => $this->input->post('jenis_pembelian',TRUE),
		'status' => $this->input->post('status',TRUE),
		'nik_sales' => $this->input->post('nik_sales',TRUE),
	    );

            $this->Prospek_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('prospek'));
        }
    }
    
    public function ambil_data()
    {
        $kode_barang = $_POST['kode_barang'];
        $data = $this->db->query("SELECT * FROM stok WHERE kode_barang='$kode_barang'")->result();
        foreach($data as $dd)
        {
            $data =array(
                'nama_barang'=>$dd->nama_barang,
                'stok'=>$dd->stok,
            );
            
           echo json_encode($data);
        }
    }


    public function update($id) 
    {
        $row = $this->Prospek_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('prospek/update_action'),
		'id' => set_value('id', $row->id),
		'id_prospek' => set_value('id_prospek', $row->id_prospek),
		'id_customer' => set_value('id_customer', $row->id_customer),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'no_ktp' => set_value('no_ktp', $row->no_ktp),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'jumlah' => set_value('jumlah', $row->jumlah),
		// 'jenis_pembelian' => set_value('jenis_pembelian', $row->jenis_pembelian),
		'status' => set_value('status', $row->status),
        'kobar'=>$this->db->get('barang')->result()
	);

        $data['kode']=$this->Prospek_model->kode();
        $data['kode1']=$this->Prospek_model->kode1();
        $this->load->view('header');
        $this->load->view('prospek_form', $data);
        $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prospek'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_prospek' => $this->input->post('id_prospek',TRUE),
		'id_customer' => $this->input->post('id_customer',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'no_ktp' => $this->input->post('no_ktp',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		// 'jenis_pembelian' => $this->input->post('jenis_pembelian',TRUE),
		'status' => $this->input->post('status',TRUE),
		'nik_sales' => $this->input->post('nik_sales',TRUE),
	    );

            $this->Prospek_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('prospek'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Prospek_model->get_by_id($id);

        if ($row) {
            $this->Prospek_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('prospek'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prospek'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_prospek', 'id prospek', 'trim|required');
	$this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('no_ktp', 'no ktp', 'trim|required|min_length[16]|max_length[16]');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	// $this->form_validation->set_rules('jenis_pembelian', 'jenis pembelian', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('nik_sales', 'nik sales', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "prospek.xls";
        $judul = "prospek";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Prospek");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Customer");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "No Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
	// xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pembelian");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Nik Sales");

	foreach ($this->Prospek_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_prospek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_customer);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
	    // xlsWriteLabel($tablebody, $kolombody++, $data->jenis_pembelian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik_sales);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=prospek.doc");

        $data = array(
            'prospek_data' => $this->Prospek_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('prospek_doc',$data);
    }

}

/* End of file Prospek.php */
/* Location: ./application/controllers/Prospek.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-10 05:58:03 */
/* http://harviacode.com */