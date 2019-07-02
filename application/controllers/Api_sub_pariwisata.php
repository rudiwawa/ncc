<?php
// import library dari REST_Controller
require APPPATH . '/libraries/REST_Controller.php';
// extends class dari REST_Controller
class Api_sub_pariwisata extends \Restserver\Libraries\REST_Controller{

// constructor
  public function __construct($config = 'rest'){
    parent::__construct($config);
    $this->load->library('session');
    $this->load->model('Pariwisata_sub_jenis_model');
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

        $data = $this->Pariwisata_sub_jenis_model->get_All();
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

    public function index_post(){

        $data = array(
            'id_jenis'       => $this->post('id_jenis'),
            'ket_sub_jenis'       => $this->post('ket_sub_jenis'),
            'is_delete'          => 0,
            'time_update'          => $this->now,
            'id_admin'          => "admin2");
        $query = $this->Pariwisata_sub_jenis_model->post_All($data);
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
                'item'           => $query]
            ]
        );

    }
}
    public function index_put(){
        $id = $this->put('id');
        $data = array(
            'id_jenis'       => $this->put('id_jenis'),
            'ket_sub_jenis'       => $this->put('ket_sub_jenis'),
            'id_admin'          => "admin2",
            'time_update'          => $this->now
        );
        $query = $this->Pariwisata_sub_jenis_model->put_byId($id,$data);
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
                'item'           => [$query,$id]]
            ]
        );
    }

}
}
?>