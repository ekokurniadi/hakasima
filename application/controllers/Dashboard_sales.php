<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard_sales extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Grafik_model');
        $this->load->library('form_validation');
    }
    
	public function index()
	{	
        $nik=$_SESSION['nik'];
        $data=array(
            'prospek'=>$this->db->query("select * from prospek where nik_sales='$nik'"),
            'penjualan'=>$this->db->query("select * from pembayaran where nik_sales='$nik'"),   
            
        );
        $this->load->view('header_sales');
        $this->load->view('index_sales',$data);
        $this->load->view('footer');
        
    } 
  

    public function get_data()
	{
		$this->load->model('Grafik_model');
		$data 	= $this->Grafik_model->get_data();
		$cek	= json_encode($data);
		print_r($cek);
		exit(); 
	}
    public function get_data2()
	{
		$this->load->model('Grafik_model');
		$data 	= $this->Grafik_model->get_data2();
		$cek	= json_encode($data);
		print_r($cek);
		exit(); 
	}
}
?>