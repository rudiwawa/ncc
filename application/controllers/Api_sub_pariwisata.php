<?php
// import library dari REST_Controller
require APPPATH . '/libraries/REST_Controller.php';
// extends class dari REST_Controller
class Api_sub_pariwisata extends \Restserver\Libraries\REST_Controller
{

// constructor
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Pariwisata_sub_jenis_model');
        // $this->db->db_debug = FALSE;

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date('Y-m-d H:i:s');
        $header_auth = $this->input->request_headers();
        // var_dump($header_auth['eek']);
        // var_dump(md5($_SESSION["token"]."tp"));
        if ($header_auth['eek']!=md5($_SESSION["token"]."tp")) {
            redirect("/notfound");
        }
    }

    public function index_get()
    {

        $data = $this->Pariwisata_sub_jenis_model->get_All();
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
        $data = $this->Pariwisata_sub_jenis_model->get_byId($id);
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

    public function ket_jenis_get()
    {
        $data = $this->Pariwisata_sub_jenis_model->ket_jenis_get();
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

    public function index_post()
    {
        $id = $this->Pariwisata_sub_jenis_model->get_id();
        // var_dump($id);
        $data = array(
            'id_sub' => $id[0]['id'],
            'id_jenis' => $this->post('id_jenis'),
            'ket_sub_jenis' => $this->post('ket_sub_jenis'),
            'is_delete' => '0',
            'time_update' => $this->now,
            'id_admin' => "admin2");
        // var_dump();
        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('sub_jenis_insert');
        $errors = $this->form_validation->error_array();

        // var_dump($is_valid);
        // var_dump(validation_errors());
        if ($is_valid) {
            $query = $this->Pariwisata_sub_jenis_model->post_All($data);
            if ($query === true) {
                $this->response(
                    ['msg_main' => [
                        'status' => true,
                        'msg' => "UPDATE data success",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id, "valid" . $is_valid],
                    ]
                );
            } else {
                $this->response(
                    ['msg_main' => [
                        'status' => false,
                        'msg' => "UPDATE data FAILED",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id],
                    ]
                );

            }
        } else {
            $this->response(
                ['msg_main' => [
                    'status' => false,
                    'msg' => "Form Tidak Valid",
                ],
                    'msg_detail' => [
                        'item' => $errors],
                ]
            );
        }

    }
    public function index_put()
    {
        $id = $this->put('id_sub');
        $data = array(
            'id_jenis' => $this->put('id_jenis'),
            'ket_sub_jenis' => $this->put('ket_sub_jenis'),
            'id_admin' => "admin2",
            'time_update' => $this->now,
        );
        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('sub_jenis_update');
        $errors = $this->form_validation->error_array();

        if ($is_valid) {
            $query = $this->Pariwisata_sub_jenis_model->put_byId($id, $data);
            if ($query === true) {
                $this->response(
                    ['msg_main' => [
                        'status' => true,
                        'msg' => "UPDATE data success",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id, "valid" . $is_valid],
                    ]
                );
            } else {
                $this->response(
                    ['msg_main' => [
                        'status' => false,
                        'msg' => "UPDATE data FAILED",
                    ],
                        'msg_detail' => [
                            'item' => $query, $id],
                    ]
                );
            }
        } else {
            $this->response(
                ['msg_main' => [
                    'status' => false,
                    'msg' => "Form Tidak Valid",
                ],
                    'msg_detail' => [
                        'item' => $errors],
                ]
            );
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $query = $this->Pariwisata_sub_jenis_model->delete_byId($id);
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
