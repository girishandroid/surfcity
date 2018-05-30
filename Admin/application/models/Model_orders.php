<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_orders extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }
  public function getShopsList($city){
    $this->db->select('shop_owner.*,citys.city_name');
           $this->db->from('shop_owner');
					 $this->db->join('citys','citys.id= shop_owner.shop_city','left');
					 if($city>0){

	            $data3 = array('shop_owner.shop_city'=>$city);
	            $this->db->where($data3);
	 }
           $query = $this->db->get();
           return $query->result();
  }
    public function getOrderList($city){
    $this->db->select('orders_details.*,citys.city_name,shop_owner.owner_name,shop_owner.shop_phone,shop_owner.shop_city,shop_owner.shop_address,shop_owner.shop_name,payment_mode.mode_name ,users.user_fname,users.user_lname');
           $this->db->from('orders_details');
		$this->db->join('users','orders_details.user_id= users.user_id','left');
		$this->db->join('citys','citys.id= orders_details.city','left');
		$this->db->join('shop_owner','orders_details.owner_id= shop_owner.owner_id','left');
		$this->db->join('payment_mode','payment_mode.id= orders_details.payment_mode','left');
		 if($city>0){

	            $data3 = array('shop_owner.shop_city'=>$city);
	            $this->db->where($data3);
	  	 }
	  	 $this->db->where('orders_details.status',0);
	   $this->db->order_by("orders_details.id", "desc");
           $query = $this->db->get();
           return $query->result();
  }
  
  public function getConfirmOrderList($city){
    $this->db->select('orders_details.*,citys.city_name,shop_owner.owner_name,shop_owner.shop_phone,shop_owner.shop_city,shop_owner.shop_address,shop_owner.shop_name,payment_mode.mode_name ,users.user_fname,users.user_lname');
           $this->db->from('orders_details');
		$this->db->join('users','orders_details.user_id= users.user_id','left');
		$this->db->join('citys','citys.id= orders_details.city','left');
		$this->db->join('shop_owner','orders_details.owner_id= shop_owner.owner_id','left');
		$this->db->join('payment_mode','payment_mode.id= orders_details.payment_mode','left');
		 if($city>0){

	            $data3 = array('shop_owner.shop_city'=>$city);
	            $this->db->where($data3);
	  	 }
	  	 $this->db->where('orders_details.status',1);
	   $this->db->order_by("orders_details.id", "desc");
           $query = $this->db->get();
           return $query->result();
  }

	public function getCancelOrderList($city)
	{
		$this->db->select('orders_details.*,citys.city_name,shop_owner.owner_name,shop_owner.shop_phone,shop_owner.shop_city,shop_owner.shop_address,shop_owner.shop_name,payment_mode.mode_name ,users.user_fname,users.user_lname');
		$this->db->from('orders_details');
		$this->db->join('users', 'orders_details.user_id= users.user_id', 'left');
		$this->db->join('citys', 'citys.id= orders_details.city', 'left');
		$this->db->join('shop_owner', 'orders_details.owner_id= shop_owner.owner_id', 'left');
		$this->db->join('payment_mode', 'payment_mode.id= orders_details.payment_mode', 'left');
		if ($city > 0) {
			$data3 = array('shop_owner.shop_city' => $city);
			$this->db->where($data3);
		}
		$this->db->where('orders_details.status', 2);
		$this->db->order_by("orders_details.id", "desc");
		$query = $this->db->get();
		return $query->result();
	}
  
  public function getItemsDetails($city){
    $this->db->select('ordered_items.*,item_details.item_name,item_details.image_path');
           $this->db->from('ordered_items');
	 $this->db->join('item_details','item_details.item_id= ordered_items.item_id','left');
					 

	            $data3 = array('ordered_items.orderId'=>$city);
	            $this->db->where($data3);
	 
           $query = $this->db->get();
           return $query->result();
  }
	public function removeShop($value)
	{
		# code...

		$this->db-> where('shop_id', $value);
 		$this->db->delete('item_details');
		$this->db-> where('owner_id', $value);
 		$this->db->delete('shop_owner');
		return $this->db->affected_rows();


	}
	
	public function addShopNew($form)
	{
		$this->db->insert('shop_owner',$form);
	return $this->db->insert_id();
	}
	
	public function addMultipleImgesData($id,$imagesPath)
	{
		$form = array('owner_id'=>$id,'image_path'=>$imagesPath);
		$this->db->insert('shop_multiple_imgs',$form);
		return $this->db->insert_id();
	}
  public function getCityList(){
    $this->db->select('*');
           $this->db->from('citys');

           $query = $this->db->get();
           return $query->result();
  }
	public function checkShopNew($shop_name,$shop_email,$shop_phone){
		$this->db->select('owner_id');
					 $this->db->from('shop_owner');/*
					 $this->db->where('shop_name',$shop_name);
					 $this->db->where('shop_email',$shop_email);
					 $this->db->where('shop_phone',$shop_phone);*/
					 $this->db->where("(shop_name='".$shop_name."' OR shop_email='".$shop_email."' OR shop_phone='".$shop_phone."')", NULL, FALSE);

					 $query = $this->db->get();
					 return $query->result();
	}
	public function updateImagePath($id,$path)
	{

    $this->db->where('owner_id', $id);
    $this->db->update("shop_owner", array('image_path' => $path));
	return $this->db->insert_id();
	}
	
	//Update Status Start
	public function changeStatusOrdered($value)
	{
		$id = $value['id'];
		unset($value['id']);
		//array_splice($value, 1, 'item_id');
		$this->db->where('id', $id);
    $this->db->update("orders_details",$value);
		$updated_status = $this->db->affected_rows();

		return $id;
	}
	
	//Update Status End
	
	//Get Count Start
	public function load_unseen_notification()
	{
		$this->db->select('*');
           	$this->db->from('orders_details');
		$this->db->where('is_notify', 0);
           	$query = $this->db->get();
           	return $query->num_rows();
	}
	
	//Get Count End
	
	//Update Noti Status Start
	public function changeOrderNotify($value)
	{
		
		//array_splice($value, 1, 'item_id');
		$this->db->where('is_notify', 0);
    		$this->db->update("orders_details",$value);
		$updated_status = $this->db->affected_rows();

		return $id;
	}
	
	//Update Noti Status End



}
?>
