<?php

class mPariwisata extends CI_Model {

    public function getDataDaftarPariwisata() {
        $query = $this->db->query("SELECT id_jenis, ket_jenis, COUNT(*) as jumlah FROM `pariwisata_jenis` WHERE is_delete='0' GROUP BY ket_jenis ORDER BY id_jenis DESC");
		return $query->result_array();
    }

    public function getSubdaftarDataPariwisata($subdaftar) {
        $query = $this->db->query("SELECT * FROM `pariwisata_sub_jenis` WHERE (id_jenis = '$subdaftar' AND is_delete='0')");
        return $query->result_array();
    }

    public function getJudulWisata($id) {
        $query = $this->db->query("SELECT ket_jenis FROM `pariwisata_jenis` WHERE id_jenis = '$id'");
        return $query->result_array();
    }

    public function getDetailDataPariwisata($kode) {
        $query = $this->db->query("SELECT * FROM `pariwisata_content` WHERE id__sub_jenis = '$kode'");
        return $query->result_array();
    }

    public function getTempatWisataLain($kode) {
        $query = $this->db->query("SELECT * FROM `pariwisata_content` WHERE id__sub_jenis != '$kode' ORDER BY RAND() LIMIT 5");
        return $query->result_array();
    }

}

?>