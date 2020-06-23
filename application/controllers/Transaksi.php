<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends MY_Controller {

    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Hdr_transaksi_model');
        $this->load->model('Dtl_transaksi_model');
        $this->load->model('Temp_transaksi_model');
        $this->load->library('form_validation');
        require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
    }


    public function input_ajax()
    {
        $this->Temp_transaksi_model->insert_temp();
    }

    public function checkout()
    {
    
       $this->Temp_transaksi_model->checkout2();
    }


    public function load_temp()
    {
        echo " <table class='table table-bordered'>
                    <tr>
                     <th>No</th>
                    <th>SKU</th>
                    <th>Description</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Dept</th>
                    <th>Class</th>
                    <th>Subclass</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                    </tr>";
                    $user_id=$this->session->userdata['username'];
                    $id=$_GET['kode_transaksi'];
                    $no=1;
                    $data = $this->Temp_transaksi_model->tabel_transaksi($user_id,$id)->result();
                    $period_array = array();
                    $total;
                    foreach ($data as $d) {
                        $total =$d->price * $d->qty;
                        $jenisnya=$d->subclass;
                        if($jenisnya=='1'){
                        $jenis = "<span class='label bg-purple'>Make Up</span>";
                        }else if($jenisnya=='2'){
                            $jenis = "<span class='label bg-maroon'>Skin Care</span>";
                        }else{
                            $jenis = "<span class='label bg-olive'>Tester</span>";
                        }
                        $period_array[] = intval($d->subtotal);
                        echo "<tr id='dataku$d->id'>
                                <td>$no</td>
                                <td>$d->sku</td>
                                <td>$d->dsc</td>
                                <td>$d->brand</td>
                                <td>$d->price</td>
                                <td>$d->dept</td>
                                <td>$d->class</td>
                                <td>$jenis</td>
                                <td>$d->qty</td>
                                <td>".number_format($total)."</td>
                                <td><button type='button' class='btn btn-danger btn-sm' onClick='hapus($d->id)'>Batal</button></td>
                             </tr>";
                        $no++;
                        
                    }
                    echo "</table>";
                    echo"<table class='table table-bordered'>";
                    echo" <tbody style='width:80px' >
                     <tr>
                        <td>Grandtotal</td>
                        <td><input type='text' class='form-control' name='tipu' id='tipu' value=".number_format($total=array_sum($period_array))." readonly='true'></td>
                        <td><input type='hidden' class='form-control' name='array' id='array' value=".$total=array_sum($period_array)." readonly='true'></td>
                        </tr>
                        <tr>
                        <td>Dibayar</td>
                        <td><input type='text' class='form-control' name='bayar' id='bayar' onkeypress='saatEnter(this, event)'></td>
                        </tr>
                        </tr>
                        <td>Kembalian</td>
                        <td><input type='text' class='form-control' name='kembalian' id='kembalian' readonly='true'></td>
                        </tr>";
                  
                    echo"</table>";
                    echo"<script>
                    function sum2() {
                          var txtFirstNumberValue = $('#array').val();
                          var txtSecondNumberValue = $('#bayar').val();
                          var result = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);
                          if (!isNaN(result)) {
                             document.getElementById('kembalian').value = result;
                          }else{
                              document.getElementById('kembalian').value=0;
                          }
                          
                    }
                    </script>";
                    echo "<script type='text/javascript'>
                    function saatEnter(inField, e) {
                        var charCode;
                        var txtFirstNumberValue = $('#array').val();
                        var txtSecondNumberValue = $('#bayar').val();
                        var result = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);
                      
                        if(e && e.which){
                            charCode = e.which;
                        }else if(window.event){
                            e = window.event;
                            charCode = e.keyCode;
                        }
                        if(charCode == 13) {
                            if (!isNaN(result)) {
                                document.getElementById('kembalian').value = result;
                             }else{
                                 document.getElementById('kembalian').value=0;
                             }
                            if (parseInt(txtSecondNumberValue) < parseInt(txtFirstNumberValue)) {
                                alert('pembayaran kurang');
                             }else{
                                 document.getElementById('kembalian').value=result;
                             }
                        }
                    }
                </script>";
                    
    }

    public function ambil_data()
    {
        $sku = $_POST['sku'];
        $data = $this->db->query("SELECT * FROM stok_sku WHERE sku='$sku'")->result();
        foreach($data as $dd)
        {
            $data =array(
                'description'=>$dd->description,
                'brand'=>$dd->brand,
                'price'=>$dd->price,
                'departement'=>$dd->departement,
                'classes'=>$dd->class,
                'subclass'=>$dd->subclass,
                'stok'=>$dd->stok
            );
            
           echo json_encode($data);
        }
    }

    public function hapus_temp()
    {
        $id=$_GET['id'];
        $this->Temp_transaksi_model->hapus_temp($id);
    }
    
    public function index()
    {
        $pengguna=$this->session->userdata('username');
        $tr = $this->Temp_transaksi_model->get_by_session($pengguna)->result();

        $data = array(
            'dt' => $tr
        );
        $this->load->view('header');
        $this->load->view('dtl_transaksi_list', $data);
        $this->load->view('footer');
    }
    public function detail_transaksi($kode_transaksi)
    {
        $pengguna=$this->session->userdata('username');
        $tr = $this->Temp_transaksi_model->detail_transaksi($pengguna,$kode_transaksi)->result();

        $data = array(
            'dt' => $tr
        );
        $this->load->view('header');
        $this->load->view('tabel_detail_transaksi', $data);
        $this->load->view('footer');
    }


    public function cetak_nota($kode_transaksi)
    {
       
         
        $dompdf= new Dompdf();
      
       $data['nota']=$this->Temp_transaksi_model->kode_transaksi($kode_transaksi)->result();
      
       $html=$this->load->view('cetak_nota',$data,true);
      
       $dompdf->load_html($html);
       $dompdf->set_paper('A4','landscape');
       $dompdf->render();
      
       $pdf = $dompdf->output();

       $dompdf->stream('Nota Transaksi.pdf',array("Attachment"=>FALSE));
    }

    public function lihat_pesanan($id)
    {
         $data['kode'] = $this->Transaksi_pesanan_model->kode();
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Transaksi_pesanan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Transaksi_pesanan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Transaksi_pesanan/index.html';
            $config['first_url'] = base_url() . 'Transaksi_pesanan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Transaksi_pesanan_model->total_rows($q);
        $config['total_pemesanan'] = $this->Transaksi_pesanan_model->total_pemesanan();
        $Transaksi_pemesanan_teknisi = $this->Transaksi_pesanan_model->get_group_lengkap($id)->result();
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'Transaksi_pemesanan_teknisi_data' => $Transaksi_pemesanan_teknisi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'total_pemesanan' => $config['total_pemesanan'],
            'start' => $start,
        );
        
        $this->load->view('header',$data);
        $this->load->view('lihat_pesanan', $data);
         $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->Transaksi_pesanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_pemesanan' => $row->kode_pemesanan,
		'kode_barang' => $row->kode_barang,
		'tanggal' => $row->tanggal,
		'jumlah' => $row->jumlah,
	    );
            $this->load->view('header');
            $this->load->view('Transaksi_pesanan_read', $data);
             $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Transaksi_pesanan'));
        }
    }


    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dtl_transaksi/create_action'),
	    'id' => set_value('id'),
	    'kode_transaksi' => set_value('kode_transaksi'),
	    'sku' => set_value('sku'),
	    'description' => set_value('description'),
	    'brand' => set_value('brand'),
	    'price' => set_value('price'),
	    'departement' => set_value('departement'),
	    'class' => set_value('class'),
	    'subclass' => set_value('subclass'),
	    'jumlah' => set_value('jumlah'),
	    'total' => set_value('total'),
	    'status' => set_value('status'),
	    'id_user' => set_value('id_user'),
	    'tanggal_transaksi' => set_value('tanggal_transaksi'),
	);
        
        $data['kode'] = $this->Hdr_transaksi_model->kode();
        $this->load->view('header');
        $this->load->view('transaksi_form', $data);
         $this->load->view('footer');
    }
    
    public function create_action() 
    {
        
            $data2=array(
                'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
                'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE), 
                'total' => $this->input->post('total',TRUE),
                'status' => $this->input->post('status',TRUE),
                'id_user' => $this->input->post('id_user',TRUE),
            );
            $data = array(
                'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
                'sku' => $this->input->post('sku',TRUE),
                'description' => $this->input->post('description',TRUE),
                'brand' => $this->input->post('brand',TRUE),
                'price' => $this->input->post('price',TRUE),
                'departement' => $this->input->post('departement',TRUE),
                'class' => $this->input->post('class',TRUE),
                'subclass' => $this->input->post('subclass',TRUE),
                'jumlah' => $this->input->post('jumlah',TRUE),
                'total' => $this->input->post('total',TRUE),
                'status' => $this->input->post('status',TRUE),
                'id_user' => $this->input->post('id_user',TRUE),
                'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
	    );
            $this->Dtl_transaksi_model->insert($data);
            $this->Hdr_transaksi_model->insert($data2);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Transaksi'));
    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_pesanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Transaksi_pesanan/update_action'),
		'id' => set_value('id', $row->id),
		'kode_pemesanan' => set_value('kode_pemesanan', $row->kode_pemesanan),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jumlah' => set_value('jumlah', $row->jumlah),
	    );
            $this->load->view('header');
            $this->load->view('Transaksi_pesanan_form', $data);
             $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Transaksi_pesanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kode_pemesanan' => $this->input->post('kode_pemesanan',TRUE),
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
	    );

            $this->Transaksi_pesanan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Transaksi_pesanan'));
        }
    }
    
    public function selesai($id) 
    {
         $this->Transaksi_pesanan_model->ubah_statusya($id);

            $this->session->set_flashdata('message', 'Record Success');
            redirect(site_url('Transaksi_pesanan'));
    }

     public function delete($id) 
    {
           $row = $this->Transaksi_pesanan_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_pesanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Transaksi_pesanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Transaksi_pesanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_pemesanan', 'kode pembelian', 'trim|required');
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Transaksi_pesanan.xls";
        $judul = "Transaksi_pesanan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
       
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pembelian");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

	foreach ($this->Transaksi_pesanan_model->get_all() as $data) {
            $kolombody = 0;

        
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pemesanan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);
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
        header("Content-Disposition: attachment;Filename=Transaksi_pesanan.doc");

        $data = array(
            'Transaksi_pesanan_data' => $this->Transaksi_pesanan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('Transaksi_pesanan_doc',$data);
    }

}

