<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prospek_model extends CI_Model
{

    public $table = 'prospek';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }


    function kode1()
    {
             $this->db->select('RIGHT(prospek.id_customer,2) as id_customer', FALSE);
             $this->db->order_by('id_customer','DESC');    
             $this->db->limit(1);    
             $query = $this->db->get('prospek');  //cek dulu apakah ada sudah ada kode di tabel.    
             if($query->num_rows() <> 0){      
                  //cek kode jika telah tersedia    
                  $data = $query->row();      
                  $kode = intval($data->id_customer) + 1; 
             }
             else{      
                  $kode = 1;  //cek jika kode belum terdapat pada table
             }
                 $tgl=date('dmY'); 
                 $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
                 $kodetampil = "CUS".$tgl.$batas;  //format kode
                 return $kodetampil;  
   }

   function kode()
   {
            $this->db->select('RIGHT(prospek.id_prospek,2) as id_prospek', FALSE);
            $this->db->order_by('id_prospek','DESC');    
            $this->db->limit(1);    
            $query = $this->db->get('prospek');  //cek dulu apakah ada sudah ada kode di tabel.    
            if($query->num_rows() <> 0){      
                 //cek kode jika telah tersedia    
                 $data = $query->row();      
                 $kode = intval($data->id_prospek) + 1; 
            }
            else{      
                 $kode = 1;  //cek jika kode belum terdapat pada table
            }
                $tgl=date('dmY'); 
                $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
                $kodetampil = "PRS-".$batas;  //format kode
                return $kodetampil;  
  }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
    $this->db->where('status','baru');
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
    
    $this->db->where('status','baru');
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    function update2($id_prospek, $data)
    {
        $this->db->where('id_prospek', $id_prospek);
        $this->db->update($this->table, $data);
    }

    function get_by2($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('prospek')->row();
    }
    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Prospek_model.php */
/* Location: ./application/models/Prospek_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-10 05:58:03 */
/* http://harviacode.com */