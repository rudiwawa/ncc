<?php

class mFasilitas extends CI_Model {

    /*public function getDataDaftarFasilitas() {
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
    }*/

    public function getDataDaftarFasilitas() {
        $query = $this->db->query("SELECT *, COUNT(*) as jumlah FROM `fasilitas_jenis` WHERE is_delete='0' GROUP BY ket_jenis ORDER BY id_jenis DESC");
		return $query->result_array();
    }

    public function getSubdaftarDataFasilitas($subdaftar) {
        /*$query = $this->db->query("SELECT * FROM `pariwisata_sub_jenis` WHERE (pariwisata_sub_jenis.id_jenis = '$subdaftar' AND pariwisata_sub_jenis.is_delete='0')");
        return $query->result_array();*/
		/*$query = $this->db->query("SELECT * FROM pariwisata_main m JOIN pariwisata_sub_jenis s JOIN pariwisata_jenis j 
        ON m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0'");*/
        
        /*$query = $this->db->query("SELECT * FROM pariwisata_sub_jenis JOIN pariwisata_jenis 
        ON pariwisata_sub_jenis.id_jenis = pariwisata_jenis.id_jenis AND pariwisata_sub_jenis.is_delete='0' 
        AND pariwisata_jenis.is_delete='0'");*/

        $query = $this->db->query("SELECT m.ket_main, m.time_update, m.id_admin, m.img, s.ket_sub_jenis, m.id_fasilitas FROM fasilitas_main m JOIN fasilitas_sub_jenis s JOIN fasilitas_jenis j 
        ON m.id_sub = s.id_sub AND s.id_jenis = j.id_jenis WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0' 
        AND j.id_jenis = '$subdaftar' ORDER BY ket_main DESC");

		return $query->result_array();
    }

    public function getJumlahSubdaftarFasilitas($subdaftar) {
        $query = $this->db->query("SELECT *, COUNT(*) as jumlah FROM fasilitas_main m JOIN fasilitas_sub_jenis s JOIN fasilitas_jenis j 
        ON m.id_jenis = j.id_jenis AND m.id_sub = s.id_sub WHERE m.is_delete = '0' AND s.is_delete = '0' AND j.is_delete='0' GROUP BY m.id_sub ORDER BY ket_main DESC");
        return $query->result_array();
    }

    public function getJudulFasilitas($id) {
        $query = $this->db->query("SELECT ket_jenis FROM `fasilitas_jenis` WHERE id_jenis = '$id'");
        return $query->result_array();
    }

    public function getDetailDataFasilitas($kode) {
        $query = $this->db->query("SELECT * FROM `fasilitas_main` WHERE id_fasilitas = '$kode'");
        return $query->result_array();
    }

    public function getTempatFasilitasLain($kode) {
        $query = $this->db->query("SELECT * FROM `fasilitas_main` WHERE id_fasilitas != '$kode' ORDER BY RAND() LIMIT 5");
        return $query->result_array();
    }

}

?>