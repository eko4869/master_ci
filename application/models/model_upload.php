<?php if(!defined ('BASEPATH')) exit ('no direct script access allowed');

class Model_upload extends CI_Model
{  
  
	function __construct()
    {
      parent::__construct();
      $this->gallery_path     = realpath(APPPATH . '../upload_image');
      $this->gallery_path_url = base_url().'upload_image';
    }

	function upload_gambar($gambar,$no,$folder)
    {
      $pic = $gambar['name'];
      $arr = explode('.', $pic);
      $ext = strtolower(end($arr));
                          
      $extoke = array('jpg', 'jpeg', 'gif', 'png');
      if (!in_array($ext, $extoke)) $ext = '';
            
      $uploaddir  = "./upload_image/".$folder;
      $fname      = $no.'.'.$ext;
            
      $target_path = $uploaddir."/".$fname;
      if(file_exists($target_path)) @unlink($target_path);
      move_uploaded_file($gambar['tmp_name'], $target_path);
      
      return $fname;
    } 
function upload_file($laporan,$no,$folder)
    {
      $pic = $laporan['name'];
      $arr = explode('.', $pic);
      $ext = strtolower(end($arr));
                          
      $extoke = array('doc', 'txt', 'pdf', 'rtf');
      if (!in_array($ext, $extoke)) $ext = '';
            
      $uploaddir  = "./upload_file/".$folder;
      $fname      = $no.'.'.$ext;
            
      $target_path = $uploaddir."/".$fname;
      if(file_exists($target_path)) @unlink($target_path);
      move_uploaded_file($laporan['tmp_name'], $target_path);
      
      return $fname;
    } 


  
}

?>