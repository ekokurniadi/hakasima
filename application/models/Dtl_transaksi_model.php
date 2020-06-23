<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dtl_transaksi_model extends CI_Model
{

    public $table = 'dtl_transaksi';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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
        $this->db->like('id', $q);
	$this->db->or_like('kode_transaksi', $q);
	$this->db->or_like('sku', $q);
	$this->db->or_like('description', $q);
	$this->db->or_like('brand', $q);
	$this->db->or_like('price', $q);
	$this->db->or_like('departement', $q);
	$this->db->or_like('class', $q);
	$this->db->or_like('subclass', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('tanggal_transaksi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('kode_transaksi', $q);
	$this->db->or_like('sku', $q);
	$this->db->or_like('description', $q);
	$this->db->or_like('brand', $q);
	$this->db->or_like('price', $q);
	$this->db->or_like('departement', $q);
	$this->db->or_like('class', $q);
	$this->db->or_like('subclass', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('tanggal_transaksi', $q);
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Dtl_transaksi_model.php */
/* Location: ./application/models/Dtl_transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-10-08 19:16:13 */
/* http://harviacode.com */