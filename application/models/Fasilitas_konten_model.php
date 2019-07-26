<?php
class Fasilitas_konten_model extends CI_Model {

	public function get_All(){
		$query = $this->db->query("select m.id_fasilitas, m.id_jenis, m.id_sub,
		m.ket_main,s.ket_sub_jenis,j.ket_jenis,
		m.detail,m.img,m.is_delete,m.time_update
		from fasilitas_main m
		join fasilitas_sub_jenis s
		join fasilitas_jenis j
		on m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub
		WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0'
		ORDER BY m.id_fasilitas DESC ");

		return $query->result_array();
	}

	public function get_sub_byId_jenis($id){
		$id = "'".$id."'";
		$query = $this->db->query('SELECT * FROM `fasilitas_sub_jenis` where id_jenis ='.$id.'AND is_delete = "0"');

		return $query->result_array();
	}

	public function get_byId($id)
	{
		$id = "'".$id."'";
		$query = $this->db->query("select m.id_fasilitas, m.id_jenis, m.id_sub,
		m.ket_main,s.ket_sub_jenis,j.ket_jenis,
		m.detail,m.img,m.is_delete,m.time_update
		from fasilitas_main m
		join fasilitas_sub_jenis s
		join fasilitas_jenis j
		on m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub
		WHERE m.id_fasilitas = ".$id );

		return $query->result_array();
	}

	public function ket_jenis_get()
	{
		$this->db->select('id_jenis,ket_jenis');
		$this->db->from('fasilitas_main');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_byId($id,$data){
		$cek = $this->db->get_where('fasilitas_main', array('id_fasilitas' => $id)); 
		$count = $cek->num_rows();
		if ($count === 0) {
			return "ID not Exist";
		}
		else{
			$this->db->where('id_fasilitas', $id);
			return $this->db->update('fasilitas_main', $data);
		}
		
	}

	public function post_All($data){
		$this->db->set($data);
		
		return $this->db->insert('fasilitas_main');
	}

	public function get_id()
	{
		$query = $this->db->query("SELECT `get_ID_main_fasilitas`() AS `id`;");
		return $query->result_array();
	}
	public function delete_byId($id){

		$query = $this->db->delete('fasilitas_main', array('id_fasilitas' => $id));

		return $query;

	}
	public function getImg_byId($id){

		$query = $this->db->query("SELECT `img` FROM `fasilitas_main` WHERE `fasilitas_main`.`id_fasilitas` = '".$id."';");

		return $query->result_array();

	}
}
?>