<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_menus extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }
  public function getMenuList($shop){
    $this->db->select('item_details.*,shop_owner.shop_name,food_category.cate_name');
           $this->db->from('item_details');
					 $this->db->join('shop_owner','shop_owner.owner_id= item_details.shop_id','left');
					 $this->db->join('food_category','food_category.id= item_details.item_category','left');
					 if($shop>0){

	            $data3 = array('item_details.shop_id'=>$shop,'is_offer_item'=>0);
	            $this->db->where($data3);
	 }
           $query = $this->db->get();
           return $query->result();
  }

  public function getOfferMenuList($shop){
    $this->db->select('item_details.*,shop_owner.shop_name,food_category.cate_name');
           $this->db->from('item_details');
					 $this->db->join('shop_owner','shop_owner.owner_id= item_details.shop_id','left');
					 $this->db->join('food_category','food_category.id= item_details.item_category','left');
					 if($shop>0){

	            $data3 = array('item_details.shop_id'=>$shop,'is_offer_item'=>1);
	            $this->db->where($data3);
	 }
           $query = $this->db->get();
           return $query->result();
  }
	public function removeMenu($value)
	{
		# code...
		$this->db-> where('item_id', $value);
 		$this->db->delete('item_details');
		return $this->db->affected_rows();


	}
	public function getCateList(){
    $this->db->select('*');
           $this->db->from('food_category');
           $query = $this->db->get();
           return $query->result();
  }

	public function getTypeList()
	{
		$this->db->select('*');
		$this->db->from('tag_type');
		$query = $this->db->get();
		return $query->result();
	}

  public function getSubCateList(){
  	$this->db->select('*');
        $this->db->from('sub_food_category');
        $query = $this->db->get();
        return $query->result();
  }
  public function getShopList(){
    $this->db->select('owner_id,shop_name');
           $this->db->from('shop_owner');
           $query = $this->db->get();
           return $query->result();
  }
	public function addMenuItem($form)
	{
		$this->db->insert('item_details',$form);
	return $this->db->insert_id();
	}

	public function updateMenuItem($value)
	{
		$id = $value['item_id'];
		unset($value['item_id']);
		//array_splice($value, 1, 'item_id');
		$this->db->where('item_id', $id);
    $this->db->update("item_details",$value);
		$updated_status = $this->db->affected_rows();

		return $id;
	}

	public function updateShopMenuItem($value)
	{
		$id = $value['owner_id'];
		unset($value['owner_id']);
		//array_splice($value, 1, 'item_id');
		$this->db->where('owner_id', $id);
    $this->db->update("shop_owner",$value);
		$updated_status = $this->db->affected_rows();

		return $id;
	}
	public function updateImagePath($id,$path)
	{

    $this->db->where('item_id', $id);
    $this->db->update("item_details", array('image_path' => $path));
	return $this->db->insert_id();
	}
	public function checkMenuNew($menu_name){
		$this->db->select('item_id');
					 $this->db->from('item_details');
					 $this->db->where('item_name',$menu_name);
					 $query = $this->db->get();
					 return $query->result();
	}

	public function getMenuItemList($value)
	{
					 $this->db->select('*');
           $this->db->from('item_details');
					 $this->db->where('item_id',$value);
           $query = $this->db->get();
           return $query->result();
	}

	public function getShopMenuList($value)
	{
		$this->db->select('*');
		$this->db->from('shop_owner');
		$this->db->where('owner_id',$value);
		$query = $this->db->get();
		return $query->result();
	}

	public function getShopMenuImgsList($value)
	{
		$this->db->select('*');
		$this->db->from('shop_multiple_imgs');
		$this->db->where('owner_id',$value);
		$query = $this->db->get();
		return $query->result();
	}

}


?>
