<?php

class mFasilitas extends CI_Model {

    public function getDataDaftarFasilitas() {
        $query = $this->db->query("SELECT id_jenis, ket_jenis, COUNT(*) as jumlah FROM `fasilitas_jenis` WHERE is_delete='0' GROUP BY ket_jenis ORDER BY id_jenis DESC");
		return $query->result_array();
    }

    public function getSubdaftarDataFasilitas($subdaftar) {
        $query = $this->db->query("SELECT * FROM `fasilitas_sub_jenis` WHERE (id_jenis = '$subdaftar' AND is_delete='0')");
        return $query->result_array();
    }

    public function getJudulFasilitas($id) {
        $query = $this->db->query("SELECT ket_jenis FROM `fasilitas_jenis` WHERE id_jenis = '$id'");
        return $query->result_array();
    }

    public function getDetailDataFasilitas($kode) {
        $query = $this->db->query("SELECT * FROM `fasilitas_content` WHERE id__sub_jenis = '$kode'");
        return $query->result_array();
    }

    public function getTempatFasilitasLain($kode) {
        $query = $this->db->query("SELECT * FROM `fasilitas_content` WHERE id__sub_jenis != '$kode' ORDER BY RAND() LIMIT 5");
        return $query->result_array();
    }

}

?>