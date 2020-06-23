<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class UTAMA extends MY_Controller {	
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('About_model');
        $this->load->model('Slider_model');
		$this->load->model('Galeri_model');
		$this->load->model('Service_model');
		
        $this->load->library('form_validation');
	}

	public function index()
	{	
		
		$config['about']=$this->About_model->get_all();
		$config['slider']=$this->Slider_model->get_all();
		$config['galeri']=$this->Galeri_model->get_all();
		$config['service']=$this->Service_model->get_all();
		$data=array(
			'about'=>$config['about'],
			'slider'=>$config['slider'],
			'galeri'=>$config['galeri'],
			'service'=>$config['service'],
		);
		$this->load->view('web/header');
		$this->load->view('web/index',$data);
		$this->load->view('web/footer');
		
		
		
	}


}