<?php
class Pariwisata_sub_jenis_model extends CI_Model {

	public function get_All(){
		$query = $this->db->query('SELECT id_sub,pariwisata_jenis.ket_jenis,ket_sub_jenis,pariwisata_sub_jenis.is_delete,pariwisata_sub_jenis.time_update,pariwisata_sub_jenis.id_admin FROM pariwisata_sub_jenis JOIN pariwisata_jenis ON pariwisata_sub_jenis.id_jenis = pariwisata_jenis.id_jenis');

		return $query->result_array();
	}

	public function put_byId($id,$data){
		$cek = $this->db->get_where('pariwisata_sub_jenis', array('id_sub' => $id)); 
		$count = $cek->num_rows();
		if ($count === 0) {
			return "ID not Exist";
		}
		else{
			$this->db->where('id_sub', $id);
			return $this->db->update('pariwisata_sub_jenis', $data);
		}
		
	}

	public function post_All($data){
		$this->db->set($data);
		$this->db->insert('pariwisata_sub_jenis');
	}
	public function delete_byId($id){
		$this->db->where('id_sub', $id);
		$this->db->delete('pariwisata_sub_jenis');
	}

}
?>