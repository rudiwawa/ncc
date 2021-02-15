<?php

class mPariwisata extends CI_Model {

    public function getDataDaftarPariwisata() {
        $query = $this->db->query("SELECT *, COUNT(*) as jumlah FROM `pariwisata_jenis` JOIN pariwisata_sub_jenis ON pariwisata_jenis.id_jenis = pariwisata_sub_jenis.id_jenis WHERE pariwisata_jenis.is_delete = '0'
        AND pariwisata_sub_jenis.is_delete = '0' GROUP BY pariwisata_sub_jenis.id_jenis");
        return $query->result_array();
    }

    public function getSubdaftarDataPariwisata($subdaftar) {
        /*$query = $this->db->query("SELECT * FROM `pariwisata_sub_jenis` WHERE (pariwisata_sub_jenis.id_jenis = '$subdaftar' AND pariwisata_sub_jenis.is_delete='0')");
        return $query->result_array();*/
		/*$query = $this->db->query("SELECT * FROM pariwisata_main m JOIN pariwisata_sub_jenis s JOIN pariwisata_jenis j 
        ON m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0'");*/
        
        /*$query = $this->db->query("SELECT * FROM pariwisata_sub_jenis JOIN pariwisata_jenis 
        ON pariwisata_sub_jenis.id_jenis = pariwisata_jenis.id_jenis AND pariwisata_sub_jenis.is_delete='0' 
        AND pariwisata_jenis.is_delete='0'");*/

        $query = $this->db->query("SELECT m.ket_main, m.time_update, m.id_admin, m.img, s.ket_sub_jenis, m.id_pariwisata FROM pariwisata_main m JOIN pariwisata_sub_jenis s JOIN pariwisata_jenis j 
        ON m.id_sub = s.id_sub AND s.id_jenis = j.id_jenis WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0' 
        AND j.id_jenis = '$subdaftar' ORDER BY ket_main DESC");

		return $query->result_array();
    }

    public function getJumlahSubdaftarPariwisata($subdaftar) {
        $query = $this->db->query("SELECT *, COUNT(*) as jumlah FROM pariwisata_main m JOIN pariwisata_sub_jenis s JOIN pariwisata_jenis j 
        ON m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0' GROUP BY m.id_sub ORDER BY ket_main DESC");
        return $query->result_array();
    }

    public function getJudulWisata($id) {
        $query = $this->db->query("SELECT ket_jenis FROM `pariwisata_jenis` WHERE id_jenis = '$id'");
        return $query->result_array();
    }

    public function getDetailDataPariwisata($kode) {
        $query = $this->db->query("SELECT * FROM `pariwisata_main` WHERE id_pariwisata = '$kode'");
        return $query->result_array();
    }

    public function getTempatWisataLain($kode) {
        $query = $this->db->query("SELECT * FROM `pariwisata_main` WHERE id_pariwisata != '$kode' ORDER BY RAND() LIMIT 5");
        return $query->result_array();
    }

}

?>