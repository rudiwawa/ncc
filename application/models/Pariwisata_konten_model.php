<?php
class Pariwisata_konten_model extends CI_Model {

	public function get_All(){
		$query = $this->db->query("SELECT * FROM `pariwisata_main` where is_delete='0' ORDER BY id_jenis DESC ");

		return $query->result_array();
	}

	public function get_sub_byId_jenis($id){
		$id = "'".$id."'";
		$query = $this->db->query('SELECT * FROM `pariwisata_sub_jenis` where id_jenis ='.$id.'AND is_delete = "0"');

		return $query->result_array();
	}

	public function get_byId($id)
	{
		$id = "'".$id."'";
		$query = $this->db->query('SELECT ket_jenis,img FROM pariwisata_main where id_jenis='.$id);

		return $query->result_array();
	}

	public function ket_jenis_get()
	{
		$this->db->select('id_jenis,ket_jenis');
		$this->db->from('pariwisata_main');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_byId($id,$data){
		$cek = $this->db->get_where('pariwisata_main', array('id_jenis' => $id)); 
		$count = $cek->num_rows();
		if ($count === 0) {
			return "ID not Exist";
		}
		else{
			$this->db->where('id_jenis', $id);
			return $this->db->update('pariwisata_main', $data);
		}
		
	}

	public function post_All($data){
		$this->db->set($data);
		
		return $this->db->insert('pariwisata_main');
	}

	public function get_id()
	{
		$query = $this->db->query("SELECT `get_ID_jenis`() AS `id`;");
		return $query->result_array();
	}
	public function delete_byId($id){

		$query = $this->db->query("UPDATE `pariwisata_main` SET `is_delete` = '1' WHERE `pariwisata_main`.`id_jenis` = '".$id."';");

		return $query;

	}
}
?>