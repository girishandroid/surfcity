<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_shops extends CI_Model {

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
	public function removeShop($value)
	{
		# code...

		$this->db-> where('shop_id', $value);
 		$this->db->delete('item_details');
		$this->db-> where('owner_id', $value);
 		$this->db->delete('shop_owner');
		return $this->db->affected_rows();


	}

	public function deleteAllMultipleImgs($value)
	{
		$this->db-> where('owner_id', $value);
 		$this->db->delete('shop_multiple_imgs');
		return $this->db->affected_rows();
	}
	public function addShopNew($form)
	{
		//$this->db->insert('shop_owner',$form);
	//return $this->db->insert_id();
		$form['rank'] = '1';
		$this->db->insert('shop_owner',$form);
		$id = $this->db->insert_id();
		$value = array('rank' => $id );
		$this->db->where('owner_id', $id);
    		$this->db->update("shop_owner",$value);
		$updated_status = $this->db->affected_rows();
		return $id;
	}
	
	public function getData($value)
	{
		$old_rank = "";
		$this->db->select('rank');
		$this->db->from('shop_owner');
		$this->db->where('owner_id', $value['owner_id']);
		$query = $this->db->get();
		$old_rank = $query->result_array();
		if ($old_rank) {
			$old_rank = $old_rank[0];
			$old_rank = $old_rank['rank'];

		if ($old_rank==$value['rank']) {
			return $value['rank'];
		}else {
			$this->db->select('owner_id');
			$this->db->from('shop_owner');
			$this->db->where('rank', $value['rank']);
			$query = $this->db->get();
			$owner_id = $query->result_array();

			if ($owner_id) {
				$owner_id = $owner_id[0];
				$owner_id = $owner_id['owner_id'];
				$ar_rank = array('rank' => '-1' );
				$this->db->where('owner_id', $owner_id);
		    $this->db->update("shop_owner",$ar_rank);
				$updated_status = $this->db->affected_rows();
			}


			$ar_rank2 = array('rank' => $value['rank'] );
			$this->db->where('owner_id', $value['owner_id']);
	    $this->db->update("shop_owner",$ar_rank2);
			$updated_status = $this->db->affected_rows();
			if ($owner_id) {
				$ar_rank = array('rank' => $old_rank );
				$this->db->where('owner_id', $owner_id);
		    $this->db->update("shop_owner",$ar_rank);
				$updated_status = $this->db->affected_rows();
			}
			return $updated_status;
		}

	}else {
		return false;
	}

	}

	public function updateShopNew($value)
	{
		$id = $value['owner_id'];
		unset($value['owner_id']);
		//array_splice($value, 1, 'item_id');
		$this->db->where('owner_id', $id);
    $this->db->update("shop_owner",$value);
		$updated_status = $this->db->affected_rows();

		return $id;
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

	public function checkShopNewTwo($shop_email,$shop_phone){
		$this->db->select('owner_id');
					 $this->db->from('shop_owner');/*
					 $this->db->where('shop_name',$shop_name);
					 $this->db->where('shop_email',$shop_email);
					 $this->db->where('shop_phone',$shop_phone);*/
					 $this->db->where("(shop_email='".$shop_email."' OR shop_phone='".$shop_phone."')", NULL, FALSE);

					 $query = $this->db->get();
					 return $query->result();
	}
	public function updateImagePath($id,$path)
	{

    $this->db->where('owner_id', $id);
    $this->db->update("shop_owner", array('image_path' => $path));
	return $this->db->insert_id();
	}
}
?>
