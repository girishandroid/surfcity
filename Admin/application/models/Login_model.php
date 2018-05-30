<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

  public function checkLogin($email,$password){
    $this->db->select('*');
           $this->db->from('admin_login');
           $data3 = array('admin_name'=>$email,'password'=>$password);
           $this->db->where($data3);
           $query = $this->db->get();
           return $query->result();
  }
}
?>
