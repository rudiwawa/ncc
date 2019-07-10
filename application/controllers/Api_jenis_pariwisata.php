<?php
// import library dari REST_Controller
require APPPATH . '/libraries/REST_Controller.php';
// extends class dari REST_Controller
class Api_jenis_pariwisata extends \Restserver\Libraries\REST_Controller{

// constructor
  public function __construct($config = 'rest'){
    parent::__construct($config);
    $this->load->library('session');
    $this->load->model('Pariwisata_jenis_model');
    $this->load->helper(array('form', 'url'));
    // $this->db->db_debug = FALSE;
    

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date('Y-m-d H:i:s');
    }

    public function index_get(){

        $data = $this->Pariwisata_jenis_model->get_All();
        $this->response(
            ['msg_main'=> [
                'status'           => true,
                'msg'           => "get data success"
            ] ,
            'msg_detail'=> [
                'item'           => $data]
            ]
        );

    }

    public function data_byId_post(){
        $id = $this->post('id');
        $data = $this->Pariwisata_jenis_model->get_byId($id);
        $this->response(
            ['msg_main'=> [
                'status'           => true,
                'msg'           => "get data success"
            ] ,
            'msg_detail'=> [
                'item'           => $data]
            ]
        );

    }

    public function ket_jenis_get(){
        $data = $this->Pariwisata_jenis_model->ket_jenis_get();
        $this->response(
            ['msg_main'=> [
                'status'           => true,
                'msg'           => "get data success!"
            ] ,
            'msg_detail'=> [
                'item'           => $data]
            ]
        );

    }

    public function index_post(){
        $id = $this->Pariwisata_jenis_model->get_id();
        // var_dump($id);
        $data = array(
            'id_sub'       => $id[0]['id'],
            'id_jenis'       => $this->post('id_jenis'),
            'ket_sub_jenis'       => $this->post('ket_sub_jenis'),
            'is_delete'          => '0',
            'time_update'          => $this->now,
            'id_admin'          => "admin2");
        $query = $this->Pariwisata_jenis_model->post_All($data);
        if ($query===TRUE) {
           $this->response(
            ['msg_main'=> [
                'status'           => true,
                'msg'           => "UPDATE data success"
            ] ,
            'msg_detail'=> [
                'item'           => $query,$id]
            ]
        );
       } else {
        $this->response(
            ['msg_main'=> [
                'status'           => false,
                'msg'           => "UPDATE data FAILED"
            ] ,
            'msg_detail'=> [
                'item'           => $query,$id]
            ]
        );

    }
}
public function update_post(){
    // $file_element_name = $this->put('img');

    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);
    // $file = $this->input->post('img');
// if ( ! $this->upload->do_upload($file))  ERROR ! CUMA GARA GARA SEHARUSNYA LANGSUNG NAME NYA BUKAN MASUKIN POST ANJAYYY GG CI
    if ( ! $this->upload->do_upload('img'))
    {
      $id_jenis = $this->post('id_jenis');
        // $file_id = $this->files_model->insert_file($file['file_name'], $_POST['title']);
      $data = array(
        'ket_jenis'       => $this->post('ket_jenis'),
        'time_update'          => $this->now
    );
      $query = $this->Pariwisata_jenis_model->update_byId($id_jenis,$data);
      $error = array('error' => $this->upload->display_errors());
      if ($query===TRUE) {
         $this->response(
            ['msg_main'=> [
                'status'           => true,
                'msg'           => "UPDATE data success"
            ] ,
            'msg_detail'=> [
                'item'           => $query, "tidak ada image"]
            ]
        );
     } else {
        $this->response(
            ['msg_main'=> [
                'status'           => false,
                'msg'           => "UPDATE data FAILED"
            ] ,
            'msg_detail'=> [
                'item'           => [$query,$id_jenis],"tidak ada image"]
            ]
        );
    }

}
else
{
    $id_jenis = $this->post('id_jenis');
    $file = $this->upload->data();
        // $file_id = $this->files_model->insert_file($file['file_name'], $_POST['title']);
    $data = array(
        'ket_jenis'       => $this->post('ket_jenis'),
        'img'          => $file['file_name'],
        'time_update'          => $this->now
    );
    $query = $this->Pariwisata_jenis_model->update_byId($id_jenis,$data);
    if ($query===TRUE) {
     $this->response(
        ['msg_main'=> [
            'status'           => true,
            'msg'           => "UPDATE data success"
        ] ,
        'msg_detail'=> [
            'item'           => $query]
        ]
    );
 } else {
    $this->response(
        ['msg_main'=> [
            'status'           => false,
            'msg'           => "UPDATE data FAILED"
        ] ,
        'msg_detail'=> [
            'item'           => [$query,$id_jenis]]
        ]
    );
}
}

}


public function index_delete(){
    $id = $this->delete('id');
    $query = $this->Pariwisata_jenis_model->delete_byId($id);
    if ($query===TRUE) {
       $this->response(
        ['msg_main'=> [
            'status'           => true,
            'msg'           => "DELETE data success"
        ] ,
        'msg_detail'=> [
            'item'           => $query]
        ]
    );
   } else {
    $this->response(
        ['msg_main'=> [
            'status'           => false,
            'msg'           => "DELETE data FAILED"
        ] ,
        'msg_detail'=> [
            'item'           => $query,$id]
        ]
    );

}
}
}
?>