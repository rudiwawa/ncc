<?php
// import library dari REST_Controller
require APPPATH . '/libraries/REST_Controller.php';
// extends class dari REST_Controller
class TesApi extends \Restserver\Libraries\REST_Controller{
// constructor
  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->database();
    $this->db->db_debug = TRUE;

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    public function index_get(){
// testing response
        $response['status']=200;
        $response['error']=false;
        $response['message']='Hai FROM response';
// tampilkan response
        $this->response($response);
    }
    public function sub_get(){

        $transaksi = $this->db->query(
            "SELECT * FROM `pariwisata_sub_jenis` LIMIT 15"
        )->result_array();
        $this->response(
            ['msg_main'=> [
                'status'           => true,
                'msg'           => "get data success"
            ] ,
            'msg_detail'=> [
                'item'           => $transaksi]
            ]
        );

    }
}
?>