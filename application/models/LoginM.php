<?php

// extends class Model
class LoginM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tb_login
  public function add_login($nama,$email,$password){

    if(empty($nama) || empty($email) || empty($password)){
      return $this->empty_response();
    }else{
      $data = array(
        "nama"=>$nama,
        "email"=>$email,
        "password"=>$password
      );

      $this->db->where('email',$email);
      $check = $this->db->get('tb_login');
      if ($check->num_rows() < 1){
          $insert = $this->db->insert("tb_login", $data);
          if($insert){
            $response['status']=200;
            $response['error']=false;
            $response['message']='Data login berhasil ditambahkan.';
          }else{
            $response['status']=502;
            $response['error']=true;
            $response['message']='Data login gagal ditambahkan.';
          }
      } else {
          $response['status']=502;
          $response['error']=true;
          $response['message']='Email sudah didaftarkan!.';
      }
      return $response;
    }
  }

  // mengambil semua data login
  public function all_login(){

    $all = $this->db->get("tb_login")->result();
    $response['status']=200;
    $response['error']=false;
    $response['login']=$all;
    return $response;

  }

  // mengambil data login tertentu
  public function get_login($id){
    $this->db->where('id',$id);
    $login = $this->db->get('tb_login');
    $response['status']=200;
    $response['error']=false;
    $response['data']=$login->result();
    $response['message']='success';
    return $response;

  }

  public function auth_login($email,$password){
    $login = $this->db->get_where('tb_login',array('email'=>$email));
    if ($login->num_rows() > 0) {
        if(password_verify($password,$login->row()->password)){
            $response['status']=200;
            $response['error']=false;
            $response['data']=$login->result();
            $response['message']='success';   
        } else {
            $response['status']=502;
            $response['error']=true;
            $response['data']=null;
            $response['message']='Email atau password salah';
        }
    } else {
      $response['status']=502;
      $response['error']=true;
      $response['data']=null;
      $response['message']='Email atau password salah';
    }
    return $response;
  }

  // hapus data login
  public function delete_login($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_login");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data login berhasil dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data login gagal dihapus.';
        return $response;
      }
    }

  }

  // update login
  public function update_login($id,$nama,$email){

    if($id == '' || empty($nama) || empty($email)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
        "nama"=>$nama,
        "email"=>$email
      );

      $this->db->where($where);
      $update = $this->db->update("tb_login",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data login diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data login gagal diubah.';
        return $response;
      }
    }

  }
  
  public function upload_login($id, $foto){
      if($id == '' || empty($foto)){
          return $this->empty_response();
      } else {
            
            $path = $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",
						$_SERVER['SCRIPT_NAME'])."foto/".$id.".jpeg";
            $finalpath = base_url()."foto/".$id.".jpeg";
            
            if(file_put_contents($path, base64_decode($foto))){
                $where = array(
                    "id"=>$id
                );
                $set = array(
                    "foto"=>$finalpath
                );
                
                $this->db->where($where);
                $update = $this->db->update("tb_login",$set);
                if($update){
                    $response['status']=200;
                    $response['error']=false;
                    $response['message']='Foto berhasil diubah.';
                    return $response;
                }else{
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']='Foto gagal diubah.';
                    return $response;
                }  
            } else {
                $response['status']=502;
                $response['error']=true;
                $response['message']='Foto gagal diupload.';
                return $response;
            }
      }
  }

}

?>