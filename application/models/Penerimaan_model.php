<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_model extends CI_Model {

    public $table = 'penerimaan';
    // public $id = 'kode_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }


    function kode()
    {
             $this->db->select('RIGHT(penerimaan.kode_transaksi,2) as kode_transaksi', FALSE);
             $this->db->order_by('kode_transaksi','DESC');    
             $this->db->limit(1);    
             $query = $this->db->get('penerimaan');  //cek dulu apakah ada sudah ada kode di tabel.    
             if($query->num_rows() <> 0){      
                  //cek kode jika telah tersedia    
                  $data = $query->row();      
                  $kode = intval($data->kode_transaksi) + 1; 
             }
             else{      
                  $kode = 1;  //cek jika kode belum terdapat pada table
             }
                 $tgl=date('dmY'); 
                 $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
                 $kodetampil = "PR".$tgl.$batas;  //format kode
                 return $kodetampil;  
   }



   public function get_by_session()
   {
       $query ="select a.kode_transaksi,a.status,a.tanggal_transaksi,b.sku,b.dsc,b.brand,b.dept,b.price,b.class,b.subclass,sum(b.qty) as jumlah_item, sum(b.subtotal) as total_transaksi FROM penerimaan b join hdr_penerimaan a on a.kode_transaksi =b.kode_transaksi GROUP BY a.kode_transaksi ORDER BY b.kode_transaksi";
       return $this->db->query($query);
   }


   public function detail_transaksi($kode_transaksi)
   {
       $query ="select a.kode_transaksi,a.status,a.tanggal_transaksi,b.sku,b.dsc,b.brand,b.dept,b.price,b.class,b.subclass,b.qty, b.subtotal FROM penerimaan b join hdr_penerimaan a on a.kode_transaksi = b.kode_transaksi WHERE a.kode_transaksi='$kode_transaksi' and b.kode_transaksi='$kode_transaksi'";
       return $this->db->query($query);
   }

   public function kode_transaksi($kode_transaksi)
   {
       $query ="select a.kode_transaksi,a.status,a.tanggal_transaksi,b.user_id,b.sku,b.dsc,b.brand,b.dept,b.price,b.class,b.subclass,b.qty,b.subtotal FROM penerimaan b join hdr_penerimaan a on a.kode_transaksi = b.kode_transaksi WHERE b.kode_transaksi='$kode_transaksi'";
       return $this->db->query($query);
   }


    function tabel_transaksi($user_id,$id)
    {
        $query="SELECT * FROM penerimaan where user_id='$user_id' and kode_transaksi ='$id'";
        return $this->db->query($query);
    }

    function hapus_temp($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('penerimaan');
    }


    function checkout1()
    {
        $kode_transaksi    = $_GET['kode_transaksi'];
         $user_id          = $_GET['user_id'];
         $sku              = $_GET['sku'];
         $description      = $_GET['description'];
         $brand            = $_GET['brand'];
         $price            = $_GET['price'];
         $dept             = $_GET['dept'];
         $classes          = $_GET['classes'];
         $subclass         = $_GET['subclass'];
         $qty              = $_GET['qty'];
         $subtotal         = $_GET['subtotal'];
         $tanggal          =$_GET['tanggal'];
            $data=array(
                'kode_transaksi'=>$kode_transaksi,
                'id_user'=>$user_id,
                'sku'=>$sku,
                'description'=>$description,
                'brand'=>$brand,
                'price'=>$price,
                'departement'=>$dept,
                'class'=>$classes,
                'subclass'=>$subclass,
                'jumlah'=>$qty,
                'total'=>$subtotal,
                'tanggal_transaksi'=>$tanggal,
            );
            $this->db->insert('dtl_transaksi',$data);
           
        }

        function checkout2()
        {
             $kode_transaksi    = $_GET['kode_transaksi'];
             $user_id          = $_GET['user_id'];
             $tanggal          =$_GET['tanggal'];
             $data=array(
                'kode_transaksi'=>$kode_transaksi,
                'status'=>3,
                'tanggal_transaksi'=>$tanggal,
                'id_user'=>$user_id
            );
            $this->db->insert('hdr_penerimaan',$data);
        }
    
    function insert_temp()
    {

         $kode_transaksi   = $_GET['kode_transaksi'];
         $user_id          = $_GET['user_id'];
         $sku              = $_GET['sku'];
         $description      = $_GET['description'];
         $brand            = $_GET['brand'];
         $price            = $_GET['price'];
         $dept             = $_GET['dept'];
         $classes            = $_GET['classes'];
         $subclass         = $_GET['subclass'];
         $qty              = $_GET['qty'];
         $subtotal         = $_GET['subtotal'];
         $tanggal         = $_GET['tanggal'];

        $data=array(
            'kode_transaksi'=>$kode_transaksi,
            'user_id'=>$user_id,
            'sku'=>$sku,
            'dsc'=>$description,
            'brand'=>$brand,
            'price'=>$price,
            'dept'=>$dept,
            'class'=>$classes,
            'subclass'=>$subclass,
            'qty'=>$qty,
            'subtotal'=>$subtotal,
            'tanggal'=>$tanggal
            );
        $this->db->insert('penerimaan',$data);
    }

    public function dapatkan2($brand,$bulan,$tahun)
    {
        
        $query="select tanggal,brand,price,sum(qty) as qty,sum(subtotal) as subtotal from penerimaan where brand LIKE'%$brand%' and MONTH(tanggal)='$bulan' and YEAR(tanggal)='$tahun'";
        return $this->db->query($query)->result();
    }
    public function dapatkan3($bulan,$tahun)
    {
        
        $query="select tanggal,brand,price,qty ,subtotal from penerimaan where MONTH(tanggal)='$bulan' and YEAR(tanggal)='$tahun'";
        return $this->db->query($query)->result();
    }


}

/* End of file Temp_transaksi.php */


?>