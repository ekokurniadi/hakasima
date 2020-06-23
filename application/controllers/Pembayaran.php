<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran extends MY_Controller {

    // protected $access = array('Admin', 'Editor','Author');
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Prospek_model');
        $this->load->model('Sales_order_model');
        $this->load->library('form_validation');
        require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
    }

    public function index()
    {
        $sessi=$_SESSION['username'];
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pembayaran/index.py?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembayaran/index.py?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembayaran/index.py';
            $config['first_url'] = base_url() . 'pembayaran/index.py';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pembayaran_model->total_rows($q,$sessi);
        $pembayaran = $this->Pembayaran_model->get_limit_data($config['per_page'], $start, $q,$sessi);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pembayaran_data' => $pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('pembayaran_list', $data);
        $this->load->view('footer');
    }
    public function history()
    {
        $sessi=$_SESSION['username'];
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pembayaran/index.py?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembayaran/index.py?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembayaran/index.py';
            $config['first_url'] = base_url() . 'pembayaran/index.py';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pembayaran_model->total_rows($q,$sessi);
        $pembayaran = $this->Pembayaran_model->get_limit_data2($config['per_page'], $start, $q,$sessi);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pembayaran_data' => $pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('history_pembayaran', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);
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
		'jenis_pembelian' => $row->jenis_pembelian,
		'harga' => $row->harga,
		'tenor' => $row->tenor,
		'angsuran' => $row->angsuran,
		'status' => $row->status,
		'nik_sales' => $row->nik_sales,
	    );
            $this->load->view('header');
            $this->load->view('pembayaran_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }


    public function ambil_data()
    {
        $id_prospek = $_POST['id_prospek'];
        $data = $this->db->query("SELECT * FROM prospek WHERE id_prospek='$id_prospek'")->result();
        foreach($data as $row)
        {
            $data =array(
            'id_customer' => $row->id_customer,
            'nama' => $row->nama,
            'alamat' => $row->alamat,
            'tanggal' => $row->tanggal,
            'no_ktp' => $row->no_ktp,
            'no_hp' => $row->no_hp,
            'kode_barang' => $row->kode_barang,
            'nama_barang' => $row->nama_barang,
            'jumlah' => $row->jumlah,
            'nik_sales' => $row->nik_sales,
            );
            
           echo json_encode($data);
        }
    }
    public function metode_pembayaran()
    {
        $kode_barang = $_POST['kode_barang'];
        $jenis_pembelian = $_POST['jenis_pembelian'];
        $data = $this->db->query("SELECT * FROM detail_skema WHERE jenis_pembelian='$jenis_pembelian' and kode_barang='$kode_barang'")->result();
        foreach($data as $row)
        {
            $data =array(
            'harga' => $row->harga,
            'tenor' => $row->tenor,
            'angsuran' => $row->angsuran,

            );
            
           echo json_encode($data);
        }
    }
    public function tenor()
    {
        $kode_barang = $_POST['kode_barang'];
        $tenor=$_POST['tenor'];
        $jenis_pembelian = $_POST['jenis_pembelian'];
        $data = $this->db->query("SELECT * FROM detail_skema WHERE jenis_pembelian='$jenis_pembelian' and kode_barang='$kode_barang' and tenor='$tenor'")->result();
        foreach($data as $row)
        {
            $data =array(
            'harga' => $row->harga,
            'angsuran' => $row->angsuran,
            'tenor' => $row->tenor,

            );
            
           echo json_encode($data);
        }
    }

    public function create() 
    {
        $sessi=$_SESSION['username'];
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembayaran/create_action'),
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
	    'jenis_pembelian' => set_value('jenis_pembelian'),
	    'harga' => set_value('harga'),
	    'tenor' => set_value('tenor'),
	    'angsuran' => set_value('angsuran'),
	    'status' => set_value('status'),
        'nik_sales' => set_value('nik_sales'),
        'pros'=>$this->db->query("select * from prospek where status='DEAL' and nik_sales='$sessi' and status !='paid'")->result()
	);

        $this->load->view('header');
        $this->load->view('pembayaran_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $id_prospek=$this->input->post('id_prospek');
        $tenor=$this->input->post('tenor');
        if($tenor=''){
           $tenor='0';
        }else{
            $tenor=$this->input->post('tenor'); 
        }
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
		'jenis_pembelian' => $this->input->post('jenis_pembelian',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'tenor' => $tenor,
		'angsuran' => $this->input->post('angsuran',TRUE),
		'status' => $this->input->post('status',TRUE),
		'nik_sales' => $this->input->post('nik_sales',TRUE),
	    );

            $this->Pembayaran_model->insert($data);
            $this->Sales_order_model->insert($data);
            $this->db->query("UPDATE prospek set status ='paid' where id_prospek='$id_prospek'");
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function cetak($id)
    {
        $dompdf= new Dompdf();
       
        $data['sales_order_data']=  $this->Sales_order_model->get_by2($id);
       
        $html=$this->load->view('cetak_pembayaran',$data,true);
       
        $dompdf->load_html($html);
        $dompdf->set_paper('A4','landscape');
        $dompdf->render();
       
        $pdf = $dompdf->output();
 
        $dompdf->stream('Sales pembayaran.pdf',array("Attachment"=>FALSE));
     }

    public function update($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembayaran/update_action'),
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
		'jenis_pembelian' => set_value('jenis_pembelian', $row->jenis_pembelian),
		'harga' => set_value('harga', $row->harga),
		'tenor' => set_value('tenor', $row->tenor),
		'angsuran' => set_value('angsuran', $row->angsuran),
		'status' => set_value('status', $row->status),
		'nik_sales' => set_value('nik_sales', $row->nik_sales),
	    );
            $this->load->view('header');
            $this->load->view('pembayaran_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
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
		'jenis_pembelian' => $this->input->post('jenis_pembelian',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'tenor' => $this->input->post('tenor',TRUE),
		'angsuran' => $this->input->post('angsuran',TRUE),
		'status' => $this->input->post('status',TRUE),
		'nik_sales' => $this->input->post('nik_sales',TRUE),
	    );

            $this->Pembayaran_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_prospek', 'id prospek', 'trim|required');
	$this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('no_ktp', 'no ktp', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('jenis_pembelian', 'jenis pembelian', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('tenor', 'tenor', '');
	$this->form_validation->set_rules('angsuran', 'angsuran', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('nik_sales', 'nik sales', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pembayaran.xls";
        $judul = "pembayaran";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pembelian");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Tenor");
	xlsWriteLabel($tablehead, $kolomhead++, "Angsuran");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Nik Sales");

	foreach ($this->Pembayaran_model->get_all() as $data) {
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
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_pembelian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tenor);
	    xlsWriteNumber($tablebody, $kolombody++, $data->angsuran);
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
        header("Content-Disposition: attachment;Filename=pembayaran.doc");

        $data = array(
            'pembayaran_data' => $this->Pembayaran_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pembayaran_doc',$data);
    }

}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-11 19:57:46 */
/* http://harviacode.com */