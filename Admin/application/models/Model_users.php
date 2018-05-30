<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }
  public function getUsersList($city){
    $this->db->select('users.*,citys.city_name');
           $this->db->from('users');
					 $this->db->join('citys','citys.id= users.user_city','left');
					 if($city>0){

	            $data3 = array('users.user_city'=>$city);
	            $this->db->where($data3);
	 }
    	   $this->db->order_by("users.user_id", "desc");
           $query = $this->db->get();
           return $query->result();
  }
	public function removeUser($value)
	{
		# code...
		$this->db-> where('user_id', $value);
 		$this->db->delete('users');
		return $this->db->affected_rows();


	}
  public function getCityList(){
    $this->db->select('*');
           $this->db->from('citys');

           $query = $this->db->get();
           return $query->result();
  }
}
?>
