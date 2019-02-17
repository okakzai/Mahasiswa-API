<?php

require APPPATH . 'libraries/REST_Controller.php';

class Login extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('LoginM');
  }

  // method index untuk menampilkan semua data login menggunakan method get
  public function index_get(){
    $response = $this->LoginM->all_login();
    $this->response($response);
  }

  public function id_post(){
    $response = $this->LoginM->get_login($this->post('id'));
    $this->response($response);
  }

  public function auth_post(){
    $response = $this->LoginM->auth_login($this->post('email'),$this->post('password'));
    $this->response($response);
  }

  // untuk menambah login menaggunakan method post
  public function add_post(){
    $response = $this->LoginM->add_login(
        $this->input->post('nama'),
        $this->input->post('email'),
        password_hash($this->post('password'), PASSWORD_DEFAULT)
      );
    $this->response($response);
  }

  // update data login menggunakan method put
  public function update_put(){
      if($this->put('foto')){
          $response = $this->LoginM->upload_login(
            $this->put('id'),
            $this->put('foto')
            );
      } else {
          $response = $this->LoginM->update_login(
            $this->put('id'),
            $this->put('nama'),
            $this->put('email')
            );
      }
    
    $this->response($response);
  }

  // hapus data login menggunakan method delete
  public function delete_delete(){
    $response = $this->LoginM->delete_login(
        $this->delete('id')
      );
    $this->response($response);
  }

}

?>
