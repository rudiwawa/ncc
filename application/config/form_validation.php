<?php
$re1='([)';	# Any Single Character 1
$re2='(")';	# Any Single Character 2
$re3='([+-]?\\d*\\.\\d+)(?![-+0-9\\.])';	# Float 1
$re4='(")';	# Any Single Character 3
$re5='(,)';	# Any Single Character 4
$re6='(")';	# Any Single Character 5
$re7='([+-]?\\d*\\.\\d+)(?![-+0-9\\.])';	# Float 2
$re8='(")';	# Any Single Character 6
$re9='(])';	# Any Single Character 7


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
                        'rules' => 'required|alpha_numeric_spaces',
                        'errors'=> array(
                                'regex_match' => 'Hanya boleh karakter A-Z , 0-9, dan "."',
                        ),
                ),
        ),
        'jenis_insert' => array(
                array(
                        'field' => 'ket_jenis',
                        'label' => 'jenis',
                        'rules' => 'required|alpha_numeric_spaces',
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
                        'rules' => 'required|alpha_numeric_spaces',
                ),
                array(
                        'field' => 'alamat[]',
                        'label' => 'alamat',
                        'rules' => 'required',
                ),
                array(
                        'field' => 'loc[]',
                        'label' => 'Latitude & Longitude',
                        'rules' => "required|regex_match[/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9."/]",
                        'errors'=> array(
                                'regex_match' => 'format salah -> contoh ["0.989897","0.989897"]',
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
                        'rules' => 'required|callback_validate_phone',
                        'errors'=> array(
                                'validate_phone' => 'Nomor telp tidak valid. Contoh yang benar: <br>
                                <mark>+62 888 9999 6656<mark>
        <mark>(0361) 227337 <br></mark>
        <mark>088888888888 <br></mark>
                                ',
                        ),
                ),
                array(
                        'field' => 'website',
                        'label' => 'Website',
                        'rules' => 'trim|required|regex_match[/[-a-zA-Z0-9@:%_\+.~\#?&\/\/=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&\/\/=]*)?/]',
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
                        'rules' => 'required|alpha_numeric_spaces',
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
                        'rules' => 'required|alpha_numeric_spaces',
                ),
        )
);
?>