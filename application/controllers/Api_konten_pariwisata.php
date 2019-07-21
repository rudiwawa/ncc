<?php
// import library dari REST_Controller
require APPPATH . '/libraries/REST_Controller.php';
// extends class dari REST_Controller
class Api_konten_pariwisata extends \Restserver\Libraries\REST_Controller
{

// constructor
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->library('session');
        $this->load->model('Pariwisata_konten_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        // $this->db->db_debug = FALSE;

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date('Y-m-d H:i:s');
    }

    public function index_get()
    {

        $data = $this->Pariwisata_konten_model->get_All();
        $this->response(
            ['msg_main' => [
                'status' => true,
                'msg' => "get data success",
            ],
                'msg_detail' => [
                    'item' => $data],
            ]
        );

    }

    public function data_byId_post()
    {
        $id = $this->post('id');
        $data = $this->Pariwisata_konten_model->get_byId($id);
        $this->response(
            ['msg_main' => [
                'status' => true,
                'msg' => "get data success",
            ],
                'msg_detail' => [
                    'item' => $data, $id],
            ]
        );

    }

    public function get_sub_byId_jenis_post()
    {
        $id = $this->post('id');
        $data = $this->Pariwisata_konten_model->get_sub_byId_jenis($id);
        $this->response(
            ['msg_main' => [
                'status' => true,
                'msg' => "get data succeSss",
            ],
                'msg_detail' => [
                    'item' => $data, $id],
            ]
        );
    }

    public function ket_jenis_get()
    {
        $data = $this->Pariwisata_konten_model->ket_jenis_get();
        $this->response(
            ['msg_main' => [
                'status' => true,
                'msg' => "get data success!",
            ],
                'msg_detail' => [
                    'item' => $data],
            ]
        );

    }
    public function get_alamat($alamat, $loc)
    {
        foreach ($alamat as $i => $value) {
            $result[$i] = array("alamat" => $alamat[$i], "loc" => $loc[$i]);
        }
        return $result;
    }

    public function upload_gambar($img)
    {

    }
    public function index_post()
    {
        $alamat = $this->get_alamat($this->post('alamat'), $this->post('loc'));
        $detail = array(
            "alamat" => $alamat,
            "ket" => $this->post('deskripsi'),
            "tlp" => $this->post('tlp'),
            "website" => $this->post('website'),
            "email" => $this->post('email'),
        );
        $tmpAlamat = array(
            'alamat'=>$this->post('alamat'),
            'loc'=>$this->post('loc')
        );
        // var_dump(json_encode($detail));
        // $img = $_FILES['img']['name'];
        // var_dump($img[0]);

        // $file_element_name = $this->put('img');
        $id = $this->Pariwisata_konten_model->get_id();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        // $img =
        // $is_upload_succces = $this->upload->do_multi_upload('img');
        // $file = $this->upload->data();
        // var_dump(json_encode($upload_data_img));

        $data = array(
            'id_pariwisata' => $id[0]['id'],
            'id_jenis' => $this->post('id_jenis'),
            'id_sub' => $this->post('id_sub'),
            'ket_main' => $this->post('ket_main'),
            'detail' => json_encode($detail),
            'img' => !empty($_FILES['img']['name']) ? $_FILES['img']['name'] : '',
            'is_delete' => "0",
            'time_update' => $this->now,
            'id_admin' => "admin1",
        );
        // VALIDASI FORM
        // $c =$_FILES['img']['name'];
        // echo("ssss");
        // var_dump ($c);
        // var_dump ($this->post('c'));
        // var_dump ($_FILES['img']['name']);
        $tmppicture = !empty($_FILES['img']['name'])?$_FILES['img']['name']:NULL;
        $tmppicture =$tmppicture[0];
        $this->form_validation->set_data(array_merge($this->input->post())); //digabungkan buat cek semua
        $is_valid = $this->form_validation->run('jenis_insert_konten');
        $errors = $this->form_validation->error_array();
        $error_upload = array('img' => $this->upload->display_errors());
  

        // $query = $this->Pariwisata_konten_model->post_All($data);

        if ($is_valid && !empty($tmppicture)) {

            $filesCount = count($_FILES['img']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name'] = $_FILES['img']['name'][$i];
                $_FILES['file']['type'] = $_FILES['img']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['img']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['img']['error'][$i];
                $_FILES['file']['size'] = $_FILES['img']['size'][$i];

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $upload_data_img[$i] = $fileData['file_name'];
                    // $upload_data_img[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
            $data['img'] = json_encode($upload_data_img);
            $query = $this->Pariwisata_konten_model->post_All($data);
            if ($query === true) {
                $this->response(
                    ['msg_main' => [
                        'status' => true,
                        'msg' => "1. UPDATE data success",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id, "valid" . $is_valid],
                    ]
                );
            } else {
                $this->response(
                    ['msg_main' => [
                        'status' => false,
                        'msg' => "2 UPDATE data FAILED",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id, $is_upload_succces],
                    ]
                );

            }
        } else {
            $msg =array ();
            if(empty($tmppicture)){
                $msg =  array ("img[]"=>"gambar tidak boleh kosong");
                // echo ("kok");
            }
            $this->response(
                ['msg_main' => [
                    'status' => false,
                    'msg' => "3 Form Tidak Valid",
                ],
                    'msg_detail' => [
                        'item' => [$msg,$errors, $error_upload]],
                ]
            );
        }

    }

    public function update_post()
    {
        $alamat = $this->get_alamat($this->post('alamat'), $this->post('loc'));
        $detail = array(
            "alamat" => $alamat,
            "ket" => $this->post('deskripsi'),
            "tlp" => $this->post('tlp'),
            "website" => $this->post('website'),
            "email" => $this->post('email'),
        );
        $tmpAlamat = array(
            'alamat'=>$this->post('alamat'),
            'loc'=>$this->post('loc')
        );
        // var_dump(json_encode($detail));
        // $img = $_FILES['img']['name'];
        // var_dump($img[0]);

        // $file_element_name = $this->put('img');
        $id = $this->Pariwisata_konten_model->get_id();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        // $img =
        // $is_upload_succces = $this->upload->do_multi_upload('img');
        // $file = $this->upload->data();
        // var_dump(json_encode($upload_data_img));

        $data = array(
            'id_pariwisata' => $id[0]['id'],
            'id_jenis' => $this->post('id_jenis'),
            'id_sub' => $this->post('id_sub'),
            'ket_main' => $this->post('ket_main'),
            'detail' => json_encode($detail),
            'img' => !empty($_FILES['img']['name']) ? $_FILES['img']['name'] : '',
            'is_delete' => "0",
            'time_update' => $this->now,
            'id_admin' => "admin1",
        );
        // VALIDASI FORM
        // $c =$_FILES['img']['name'];
        // echo("ssss");
        // var_dump ($c);
        // var_dump ($this->post('c'));
        // var_dump ($_FILES['img']['name']);
        $tmppicture = !empty($_FILES['img']['name'])?$_FILES['img']['name']:NULL;
        $tmppicture =$tmppicture[0];
        $this->form_validation->set_data(array_merge($this->input->post())); //digabungkan buat cek semua
        $is_valid = $this->form_validation->run('jenis_insert_konten');
        $errors = $this->form_validation->error_array();
        $error_upload = array('img' => $this->upload->display_errors());
  

        // $query = $this->Pariwisata_konten_model->post_All($data);

        if ($is_valid && !empty($tmppicture)) {

            $filesCount = count($_FILES['img']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name'] = $_FILES['img']['name'][$i];
                $_FILES['file']['type'] = $_FILES['img']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['img']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['img']['error'][$i];
                $_FILES['file']['size'] = $_FILES['img']['size'][$i];

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $upload_data_img[$i] = $fileData['file_name'];
                    // $upload_data_img[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
            $data['img'] = json_encode($upload_data_img);
            $query = $this->Pariwisata_konten_model->update_byId($id,$data);
            if ($query === true) {
                $this->response(
                    ['msg_main' => [
                        'status' => true,
                        'msg' => "1. UPDATE data success",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id, "valid" . $is_valid],
                    ]
                );
            } else {
                $this->response(
                    ['msg_main' => [
                        'status' => false,
                        'msg' => "2 UPDATE data FAILED",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id, $is_upload_succces],
                    ]
                );

            }
        } else {
            $msg =array ();
            if(empty($tmppicture)){
                $msg =  array ("img[]"=>"gambar tidak boleh kosong");
                // echo ("kok");
            }
            $this->response(
                ['msg_main' => [
                    'status' => false,
                    'msg' => "3 Form Tidak Valid",
                ],
                    'msg_detail' => [
                        'item' => [$msg,$errors, $error_upload]],
                ]
            );
        }

    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $query = $this->Pariwisata_konten_model->delete_byId($id);
        if ($query === true) {
            $this->response(
                ['msg_main' => [
                    'status' => true,
                    'msg' => "DELETE data success",
                ],
                    'msg_detail' => [
                        'item' => $query],
                ]
            );
        } else {
            $this->response(
                ['msg_main' => [
                    'status' => false,
                    'msg' => "DELETE data FAILED",
                ],
                    'msg_detail' => [
                        'item' => $query, $id],
                ]
            );

        }
    }
}
