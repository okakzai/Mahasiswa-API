<?php

// extends class Model
class MhsM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tb_mhs
  public function add_mhs($nim,$nama,$jurusan){

    if(empty($nim) || empty($nama) || empty($jurusan)){
      return $this->empty_response();
    }else{
      $data = array(
        "nim"=>$nim,
        "nama"=>$nama,
        "jurusan"=>$jurusan
      );

      $insert = $this->db->insert("tb_mhs", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data mahasiswa berhasil ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mahasiswa gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data mhs
  public function all_mhs(){

    $all = $this->db->get("tb_mhs")->result();
    $response['status']=200;
    $response['error']=false;
    $response['mhs']=$all;
    return $response;

  }

  // mengambil data mhs tertentu
  public function get_mhs_by_id($id){

    $mhs = $this->db->get_where('tb_mhs', array('id' => $id))->result();
    $response['status']=200;
    $response['error']=false;
    $response['mhs']=$mhs;
    return $response;

  }

  // hapus data mhs
  public function delete_mhs($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_mhs");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data mahasiswa berhasil dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mahasiswa gagal dihapus.';
        return $response;
      }
    }

  }

  // update mhs
  public function update_mhs($id,$nim,$nama,$jurusan){

    if($id == '' || empty($nim) || empty($nama) || empty($jurusan)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
        "nim"=>$nim,
        "nama"=>$nama,
        "jurusan"=>$jurusan
      );

      $this->db->where($where);
      $update = $this->db->update("tb_mhs",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data mahasiswa berhasil diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mahasiswa gagal diubah.';
        return $response;
      }
    }

  }
  
  public function foto_mhs($id, $foto){
      if($id == '' || empty($foto)){
          return $this->empty_response();
      } else {
          $path = $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",
						$_SERVER['SCRIPT_NAME'])."foto_mhs/".$id.".jpeg";
            $finalpath = base_url()."foto_mhs/".$id.".jpeg";
            if(file_put_contents($path, base64_decode($foto))){
                $where = array(
                    "id"=>$id
                );
                $set = array(
                    "foto"=>$finalpath
                );
                
                $this->db->where($where);
                $update = $this->db->update("tb_mhs",$set);
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
  
  public function upload_mhs($id, $foto){
      if($id == '' || empty($foto)){
          return $this->empty_response();
      } else {
            
            $path = $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",
						$_SERVER['SCRIPT_NAME'])."foto_mhs/".$id.".jpeg";
            $finalpath = base_url()."foto_mhs/".$id.".jpeg";
            
            if(file_put_contents($path, base64_decode($foto))){
                $where = array(
                    "id"=>$id
                );
                $set = array(
                    "foto"=>$finalpath
                );
                
                $this->db->where($where);
                $update = $this->db->update("tb_mhs",$set);
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
