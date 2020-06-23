<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends MY_Controller {

    protected $access=array('Admin');
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Grafik_model');
        $this->load->library('form_validation');
    }
    
	public function index()
	{	

        $data=array(
            'user'=>$this->db->get('user'),
            'penjualan'=>$this->db->get('sales_order'),
            'konsumen'=>$this->db->get('konsumen'),
            'barang'=>$this->db->get('barang')
            
        );
        $this->load->view('header');
        $this->load->view('index',$data);
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