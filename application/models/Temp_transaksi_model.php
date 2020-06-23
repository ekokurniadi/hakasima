<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Temp_transaksi_model extends CI_Model {

    public $table = 'temp_transaksi';
    // public $id = 'kode_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function tabel_transaksi($user_id,$id)
    {
        $query="SELECT * FROM temp_transaksi where user_id='$user_id' and kode_transaksi ='$id'";
        return $this->db->query($query);
    }

    function grandtotal($user_id,$id)
    {
     $query = "SELECT sum(subtotal) as total FROM temp_transaksi WHERE kode_transaksi='$id' AND user_id='$user_id' ";
      return $this->db->query($query);

    }

    function hapus_temp($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('temp_transaksi');
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
            $this->db->insert('hdr_transaksi',$data);
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
        $this->db->insert('temp_transaksi',$data);
    }


    public function get_by_session($pengguna)
    {
        $query ="select a.kode_transaksi,a.status,a.tanggal_transaksi,b.sku,b.dsc,b.brand,b.dept,b.price,b.class,b.subclass,sum(b.qty) as jumlah_item, sum(b.subtotal) as total_transaksi FROM temp_transaksi b join hdr_transaksi a on a.kode_transaksi =b.kode_transaksi where user_id='$pengguna' GROUP BY a.kode_transaksi ORDER BY b.kode_transaksi";
        return $this->db->query($query);
    }
    
    public function detail_transaksi($pengguna,$kode_transaksi)
    {
        $query ="select a.kode_transaksi,a.status,a.tanggal_transaksi,b.sku,b.dsc,b.brand,b.dept,b.price,b.class,b.subclass,b.qty, b.subtotal FROM temp_transaksi b join hdr_transaksi a on a.kode_transaksi = b.kode_transaksi WHERE a.kode_transaksi='$kode_transaksi' and b.kode_transaksi='$kode_transaksi' and b.user_id='$pengguna'";
        return $this->db->query($query);
    }

    public function kode_transaksi($kode_transaksi)
    {
        $query ="select a.kode_transaksi,a.status,a.tanggal_transaksi,b.user_id,b.sku,b.dsc,b.brand,b.dept,b.price,b.class,b.subclass,b.qty,b.subtotal FROM temp_transaksi b join hdr_transaksi a on a.kode_transaksi = b.kode_transaksi WHERE b.kode_transaksi='$kode_transaksi'";
        return $this->db->query($query);
    }

    public function dapatkan($brand,$bulan,$tahun)
    {
        
        $query="select brand,price,sum(qty) as qty,sum(subtotal) as subtotal from temp_transaksi where brand LIKE'%$brand%' and MONTH(tanggal)='$bulan' and YEAR(tanggal)='$tahun'";
        return $this->db->query($query)->result();
    }
    public function dapatkan4($bulan,$tahun)
    {
        
        $query="select brand,price,qty,subtotal from temp_transaksi where MONTH(tanggal)='$bulan' and YEAR(tanggal)='$tahun'";
        return $this->db->query($query)->result();
    }
  

}



?>