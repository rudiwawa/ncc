<?php
class Pariwisata_jenis_model extends CI_Model {

	public function get_All(){
		$query = $this->db->query("SELECT * FROM `pariwisata_jenis` where is_delete='0' ORDER BY id_jenis DESC ");

		return $query->result_array();
	}

	public function get_byId($id)
	{
		$id = "'".$id."'";
		$query = $this->db->query('SELECT id_sub,pariwisata_jenis.id_jenis,pariwisata_jenis.ket_jenis,ket_sub_jenis FROM pariwisata_sub_jenis JOIN pariwisata_jenis ON pariwisata_sub_jenis.id_jenis = pariwisata_jenis.id_jenis where id_sub='.$id);

		return $query->result_array();
	}

	public function ket_jenis_get()
	{
		$this->db->select('id_jenis,ket_jenis');
		$this->db->from('pariwisata_jenis');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_byId($id,$data){
		$cek = $this->db->get_where('pariwisata_jenis', array('id_jenis' => $id)); 
		$count = $cek->num_rows();
		if ($count === 0) {
			return "ID not Exist";
		}
		else{
			$this->db->where('id_jenis', $id);
			return $this->db->update('pariwisata_jenis', $data);
		}
		
	}

	public function post_All($data){
		$this->db->set($data);
		
		return $this->db->insert('pariwisata_jenis');
	}

	public function get_id()
	{
		$query = $this->db->query("SELECT `get_ID_sub`() AS `id`;");
		return $query->result_array();
	}
	public function delete_byId($id){

		$query = $this->db->query("UPDATE `pariwisata_jenis` SET `is_delete` = '1' WHERE `pariwisata_jenis`.`id_jenis` = '".$id."';");

		return $query;

	}
}
?>