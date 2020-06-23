<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grafik_model extends CI_Model
{

    
    function get_data()
    {
            
         $query="SELECT * from stok ORDER BY stok DESC limit 10";
         return $this->db->query($query)->result();
    }
    function get_data2()
    {
            
         $query="SELECT kode_barang,nama_barang, count(kode_barang) as kode  from sales_order GROUP BY kode_barang ORDER BY kode_barang DESC";
         return $this->db->query($query)->result();
    }

    function get_pembelian()
    {
        $query="SELECT kode_pembelian, SUM(jumlah) as jumlah FROM transaksi_pembelian_detail GROUP BY  kode_pembelian ORDER BY kode_pembelian ASC";
            return $this->db->query($query)->result();
    }


}
