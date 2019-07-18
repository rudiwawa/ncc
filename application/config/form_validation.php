<?php
$config = array(
        'sub_jenis_insert' => array(
                array(
                        'field' => 'id_jenis',
                        'label' => 'Jenis',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'ket_sub_jenis',
                        'label' => 'Sub Jenis',
                        'rules' => 'required',
                ),
        ),
        'jenis_insert' => array(
                array(
                        'field' => 'ket_jenis',
                        'label' => 'ket_jenis',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'img[]',
                        'label' => 'img[]',
                        'rules' => 'required',
                ),
        ),
        'jenis_insert_konten' => array(
                array(
                        'field' => 'id_jenis',
                        'label' => 'id_jenis',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'id_sub',
                        'label' => 'id_sub',
                        'rules' => 'required',
                ),
                // array(
                //         'field' => 'img[]',
                //         'label' => 'img[]',
                //         'rules' => 'required',
                // ),
                array(
                        'field' => 'ket_main',
                        'label' => 'ket_main',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'alamat[]',
                        'label' => 'alamat',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'loc[]',
                        'label' => 'loc[]',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'deskripsi',
                        'label' => 'deskripsi',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'tlp',
                        'label' => 'tlp',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'website',
                        'label' => 'website',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required',
                ),
        ),
        'jenis_update' => array(
                array(
                        'field' => 'ket_jenis',
                        'label' => 'ket_jenis',
                        'rules' => 'required',
                ),
        ),
        'sub_jenis_update' => array(
                array(
                        'field' => 'id_jenis',
                        'label' => 'Jenis',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'ket_sub_jenis',
                        'label' => 'Sub Jenis',
                        'rules' => 'required',
                ),
        )
);
?>