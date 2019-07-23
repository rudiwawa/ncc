<?php
class Fasilitas_jenis_model extends CI_Model {

	public function get_All(){
		$query = $this->db->query("SELECT * FROM `fasilitas_jenis` where is_delete='0' ORDER BY id_jenis DESC ");

		return $query->result_array();
	}

	public function get_byId($id)
	{
		$id = "'".$id."'";
		$query = $this->db->query('SELECT ket_jenis,img FROM fasilitas_jenis where id_jenis='.$id);

		return $query->result_array();
	}

	public function ket_jenis_get()
	{
		$this->db->select('id_jenis,ket_jenis');
		$this->db->from('fasilitas_jenis');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_byId($id,$data){
		$cek = $this->db->get_where('fasilitas_jenis', array('id_jenis' => $id)); 
		$count = $cek->num_rows();
		if ($count === 0) {
			return "ID not Exist";
		}
		else{
			$this->db->where('id_jenis', $id);
			return $this->db->update('fasilitas_jenis', $data);
		}
		
	}

	public function post_All($data){
		$this->db->set($data);
		
		return $this->db->insert('fasilitas_jenis');
	}

	public function get_id()
	{
		$query = $this->db->query("SELECT `get_ID_jenis_fasilitas`() AS `id`;");
		return $query->result_array();
	}
	public function delete_byId($id){

		$query = $this->db->query("UPDATE `fasilitas_jenis` SET `is_delete` = '1' WHERE `fasilitas_jenis`.`id_jenis` = '".$id."';");

		return $query;

	}
}
?>