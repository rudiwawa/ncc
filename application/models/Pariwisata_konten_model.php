<?php
class Pariwisata_konten_model extends CI_Model
{

    public function get_All()
    {
        $query = $this->db->query("select m.id_pariwisata, m.id_jenis, m.id_sub,
		m.ket_main,s.ket_sub_jenis,j.ket_jenis,
		m.detail,m.img,m.is_delete,m.time_update
		from pariwisata_main m
		join pariwisata_sub_jenis s
		join pariwisata_jenis j
		on m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub
		WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0'
		ORDER BY m.id_pariwisata DESC ");

        return $query->result_array();
    }

    public function get_sub_byId_jenis($id)
    {
        $id = "'" . $id . "'";
        $query = $this->db->query('SELECT * FROM `pariwisata_sub_jenis` where id_jenis =' . $id . 'AND is_delete = "0"');

        return $query->result_array();
    }

    public function get_byId($id)
    {
        $id = "'" . $id . "'";
        $query = $this->db->query("select m.id_pariwisata, m.id_jenis, m.id_sub,
		m.ket_main,s.ket_sub_jenis,j.ket_jenis,
		m.detail,m.img,m.is_delete,m.time_update
		from pariwisata_main m
		join pariwisata_sub_jenis s
		join pariwisata_jenis j
		on m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub
		WHERE m.id_pariwisata = " . $id);

        return $query->result_array();
    }

    public function ket_jenis_sub_get()
    {
        $query = $this->db->query("SELECT s.id_sub , s.id_jenis , s.ket_sub_jenis, j.ket_jenis
        FROM pariwisata_sub_jenis s
        JOIN pariwisata_jenis j
        ON s.id_jenis = j.id_jenis
        WHERE s.is_delete = '0' AND j.is_delete = '0'");
        return $query->result_array();
    }

    public function update_byId($id, $data)
    {
        $cek = $this->db->get_where('pariwisata_main', array('id_pariwisata' => $id));
        $count = $cek->num_rows();
        if ($count === 0) {
            return "ID not Exist";
        } else {
            $this->db->where('id_pariwisata', $id);
            return $this->db->update('pariwisata_main', $data);
        }

    }

    public function post_All($data)
    {
        $this->db->set($data);

        return $this->db->insert('pariwisata_main');
    }

    public function get_id()
    {
        $query = $this->db->query("SELECT `get_ID_main`() AS `id`;");
        return $query->result_array();
    }
    public function delete_byId($id)
    {

        $query = $this->db->delete('pariwisata_main', array('id_pariwisata' => $id));

        return $query;

    }
    public function getImg_byId($id)
    {

        $query = $this->db->query("SELECT `img` FROM `pariwisata_main` WHERE `pariwisata_main`.`id_pariwisata` = '" . $id . "';");

        return $query->result_array();

    }
}
