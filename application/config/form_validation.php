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
                        'field' => 'img',
                        'label' => 'img',
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