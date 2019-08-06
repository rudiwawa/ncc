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
                        'label' => 'jenis',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'img[]',
                        'label' => 'gambar',
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
                        'label' => 'Nama Pariwisata',
                        'rules' => 'required|alpha',
                ),
                array(
                        'field' => 'alamat[]',
                        'label' => 'alamat',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'loc[]',
                        'label' => 'Latitude & Longitude',
                        'rules' => 'required',
                        'errors'=> array(
                                'regex_match' => '',
                        ),
                ),
                array(
                        'field' => 'deskripsi',
                        'label' => 'deskripsi',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'tlp',
                        'label' => 'Telepon',
                        'rules' => 'required|regex_match[/([\[\(])?(?:(\+62)|62|0)\1? ?-? ?8(?!0|4|6)\d(?!0)\d\1? ?-? ?\d{3,4} ?-? ?\d{3,5}(?: ?-? ?\d{3})?\b/]',
                        'errors'=> array(
                                'regex_match' => 'cok ngawut koe!',
                        ),
                ),
                array(
                        'field' => 'website',
                        'label' => 'Website',
                        'rules' => 'required|valid_url',
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email',
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