<?php

// import library dari REST_Controller
require APPPATH . 'libraries/REST_Controller.php';

// extends class dari REST_Controller
class TestApi extends REST_Controller{

  // constructor
  public function __construct(){
    parent::__construct();
  }

  public function index_get(){

    // testing response
    $response['status']=200;
    $response['error']=false;
    $response['message']='Hai from response';

    // tampilkan response
    $this->response($response);

  }

  public function user_get(){

    // testing response
    $response['status']=200;
    $response['error']=false;
    $response['user']['username']='admin';
    $response['user']['email']='admin@admin.com';
    $response['user']['detail']['full_name']='Rahmat Sabilluin';
    $response['user']['detail']['position']='Web Developer';
    $response['user']['detail']['specialize']='HTML,CSS,JS,PHP,Laravel,CodeIgniter,MySQL,PostgreSQL,Oracle';

    //tampilkan response
    $this->response($response);

  }

}

?>
