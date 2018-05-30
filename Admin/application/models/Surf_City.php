<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surf_City extends CI_Model {

  
  public function loginOrSignUpCheck($mobile_no){
  	$this->db->select('user_id');
	$this->db->from('users');
	$this->db->where('phone',$mobile_no);
    	$q = $this->db->get();
	$data = $q->result();
	return $data;
  }
  
  /* register user */
  public function registerUser($first_name,$password,$address,$mobile_no,$last_name)
  {
    $this->db->select('user_id');
    $this->db->from('users');
    $where = "(phone = '$mobile_no')";
    $this->db->where($where);
    $query = $this->db->get();
		$service_name = $query->result();
    if ($service_name) {
      return 202;
    }else {
      $post_data = array(
        'user_fname'=>$first_name,
        'user_address'=>$address,
        'phone'=>$mobile_no,
        'user_lname'=>$last_name,
        'user_password'=>$password
      );
      //return $post_data;
      $this->db->insert('users',$post_data);
      return $this->db->affected_rows();
    }

  }
  
  public function checkLogin($user_id,$pass)
  {
    $this->db->select('user_id');
    $this->db->from('users');
    $this->db->where('phone',$user_id);
    $this->db->where('user_password',$pass);
    $q = $this->db->get();
    $data = $q->result();
    return $data;
  }
  
  public function getUserDetails($array){
  	$this->db->select('user_fname,user_lname,user_address,phone');
	$this->db->from('users');
	$this->db->where($array);
    	$q = $this->db->get();
	$data = $q->result();
	return $data;
  }
  
  
  public function getCity()
  {
    // here we select just the age column
    $this->db->select('*');
    $this->db->from('citys');
    $query = $this->db->get();
    $cities = $query->result();
    return $cities;
  }
  
  public function getShopListByCity($array){
  	$this->db->select('food_category.cate_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.food_category,shop_owner.opening,shop_owner.image_path');    
    	$this->db->from('shop_owner');
    	$this->db->join('food_category', 'shop_owner.food_category= food_category.id');
    	$this->db->where($array);
    	$this->db->where('shop_owner.is_active',1);
    	$query = $this->db->get();
    	$list = $query->result();
    	return $list;
  }
  
  public function getFoodListByCity($array){
    $this->db->select('food_category.cate_name,sub_food_category.sub_cat_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.food_category,shop_owner.opening,item_details.item_id,item_details.item_name,item_details.item_category,item_details.item_desc,item_details.image_path,item_details.item_price,item_details.sub_food_category');    
    $this->db->from('shop_owner');
    $this->db->join('item_details', 'shop_owner.owner_id= item_details.shop_id');
    $this->db->join('sub_food_category', 'item_details.sub_food_category= sub_food_category.id');
    $this->db->join('food_category', 'item_details.item_category= food_category.id');
    $this->db->where($array);
    $this->db->where('shop_owner.is_active',1);
    $this->db->where('item_details.is_active',1);
    $this->db->where('item_details.is_offer_item',0);
    $query = $this->db->get();
    $list = $query->result();
    return $list;
  }
  
  public function getOfferFoodListByCity($array){
    $this->db->select('food_category.cate_name,sub_food_category.sub_cat_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.food_category,shop_owner.opening,item_details.item_id,item_details.item_name,item_details.item_category,item_details.item_desc,item_details.image_path,item_details.item_price,item_details.sub_food_category');    
    $this->db->from('shop_owner');
    $this->db->join('item_details', 'shop_owner.owner_id= item_details.shop_id');
    $this->db->join('sub_food_category', 'item_details.sub_food_category= sub_food_category.id');
    $this->db->join('food_category', 'item_details.item_category= food_category.id');
    $this->db->where($array);
    $this->db->where('item_details.is_offer_item',1);
    $this->db->where('shop_owner.is_active',1);
    $this->db->where('item_details.is_active',1);
    $query = $this->db->get();
    $list = $query->result();
    return $list;
  }

   public function getCatAndSubCatList(){
   	$this->db->select('*');
    	$this->db->from('food_category');
    	$query = $this->db->get();
    	$food_category = $query->result();
    	$this->db->select('*');
    	$this->db->from('sub_food_category');
    	$query = $this->db->get();
    	$sub_food_category = $query->result();
    	$data = array('food_category'=>$food_category,'sub_food_category'=>$sub_food_category);
    	return $data;
   }
   
   public function getUserInCart($array){
   	$this->db->select('id');
    	$this->db->from('cart_list');
    	$this->db->where($array);
    	$query = $this->db->get();
    	$cart = $query->result();
    	return $cart;
   }
   
   public function getShopImages($array){
   	$this->db->select('*');
    	$this->db->from('shop_multiple_imgs');
    	$this->db->where($array);
    	$query = $this->db->get();
    	$cart = $query->result();
    	return $cart;
   }
   
   public function getInCartShopCheck($array){
   	$this->db->select('id');
    	$this->db->from('cart_list');
    	$this->db->where($array);
    	$query = $this->db->get();
    	$cart = $query->result();
    	return $cart;
   }
   public function getItemCheck($array){
   	$this->db->select('quantity,id');
    	$this->db->from('cart_item_list');
    	$this->db->where($array);
    	$query = $this->db->get();
    	$cart = $query->result();
    	return $cart;
   }
   
   public function updateItemToCart($cartItemArray,$idItemCart){
   	$this->db->where('id',$idItemCart);
	$this->db->update('cart_item_list',$cartItemArray);
	$updated_status = $this->db->affected_rows();
	if($updated_status):
    		return $idItemCart;
	else:
    		return false;
    	endif;
   }
   
   public function updateRmItemToCart($cartItemArray,$idItemCart){
   	$this->db->where($idItemCart);
	$this->db->update('cart_item_list',$cartItemArray);
	$updated_status = $this->db->affected_rows();
	if($updated_status):
    		return $idItemCart;
	else:
    		return false;
    	endif;
   }
   
   public function setPaymentDetails($array){
   	$this->db->insert('orders_details',$array);
   	$order_id = $this->db->insert_id();
   	
   	$this->db->select('*');
    	$this->db->from('cart_item_list');
    	$this->db->where('user_id',$array['user_id']);
    	$query = $this->db->get();
    	$dataList = $query->result();
    	$idAr = '';
    	foreach ($dataList as $key => $value) {
    		$orderId = $array['orderId'];
    		$item_id = $value->item_id;
    		$price = $value->price;
    		$quantity = $value->quantity;
    		$ordered_items = array('orderId'=>$orderId,'item_id'=>$item_id,'item_price'=>$price,'quantity'=>$quantity);
    		
    		$this->db->insert('ordered_items',$ordered_items);
   		$idAr = $this->db->insert_id();
    	}
    	
    	if($idAr){
    		$ar_user = array('user_id'=>$array['user_id']);
    		$this->db->where($ar_user);
    		$del=$this->db->delete('cart_list'); 
    		
    		$this->db->where($ar_user);
    		$del=$this->db->delete('cart_item_list'); 
    		
    		return true;
    	}else{
    		return false;
    	}
    	
   }
   
   public function removeItemFromCart($idItemCart,$array){   
    	$this->db->where($idItemCart);
    	$del=$this->db->delete('cart_item_list');  
    	
    	$this->db->select('id');
    	$this->db->from('cart_item_list');
    	$this->db->where($array);
    	$query = $this->db->get();
    	$cart = $query->result();
    	if(!$cart){
    		$this->db->where($array);
    		$del=$this->db->delete('cart_list');  
    	}
   }
   
   public function getCartList($array){
   
   	$this->db->select('id,owner_id');
    	$this->db->from('cart_list');
    	$this->db->where($array);
    	$query = $this->db->get();
    	$cart = $query->result();
    	
    	if($cart){
    			$data = array();
    			$id = '';
    			foreach ($cart as $key => $value) {
    			  $id = $value->owner_id;
    			}
    			$arOwner = array('owner_id' => $id );
    			
    			$this->db->select('owner_id,shop_name,shop_address,image_path,delivery_charges');
    			$this->db->from('shop_owner');
    			$this->db->where($arOwner);
    			$arrayShop = $this->db->get();
    			$data['shop_data'] = $arrayShop->result();
    			
    			
    			$this->db->select('item_id,quantity,price');
    			$this->db->from('cart_item_list');
    			$this->db->where($array);
    			$query = $this->db->get();
    			$cart_item = $query->result();
    			
    			$item_id = '';
    			$items = array();
    			foreach ($cart_item as $key => $vae) {
    			  $item_id = $vae->item_id;
    			  
    			  $aritem_id = array('item_id' => $item_id );
    			
    			  $this->db->select('item_id,item_name,image_path');
    			  $this->db->from('item_details');
    			  $this->db->where($aritem_id);
    			  $arrayShopItem = $this->db->get();
    			  $items[$key]['shop_item_data'] = $arrayShopItem->result();
    			  $items[$key]['quantity'] = $vae->quantity;
    			  $items[$key]['price'] = $vae->price;
    			}
    			$data['items']= $items;
    			return $data;
    			
    	}else{
    		return 202;
    	}
    	
    	
   	
   }
   
   public function addToCart($array){
   	$this->db->insert('cart_list',$array);
   	return $this->db->insert_id();
   
   }
   
   public function addItemToCart($array){
   	$this->db->insert('cart_item_list',$array);
   	return $this->db->insert_id();
   
   }
   
   
   public function getItemDetails($array){
    $this->db->select('food_category.cate_name,sub_food_category.sub_cat_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.food_category,shop_owner.opening,item_details.item_id,item_details.item_name,item_details.item_category,item_details.image_path,item_details.item_price,item_details.sub_food_category');    
    $this->db->from('item_details');
    $this->db->join('item_details', 'shop_owner.owner_id= item_details.shop_id');
    $this->db->join('sub_food_category', 'item_details.sub_food_category= sub_food_category.id');
    $this->db->join('food_category', 'item_details.item_category= food_category.id');
    $this->db->where($array);
    $query = $this->db->get();
    $list = $query->result();
    return $list;
   }
   
   
   
   public function getBookingHistory($array)
  {
    	$data = array();
    	$this->db->select('id,orderId,owner_id,quantity,payment_mode,date,amountPay,deliveryCharges,serviceCharges,address,phone');
    	$this->db->from('orders_details');
    	$this->db->order_by("orders_details.id", "desc");
    	$this->db->where($array);
    	$query = $this->db->get();
    	$cart = $query->result();
    	
    	foreach ($cart as $key => $value) {
    		$orderId = $value->orderId;
    		$data[$key]['amountPay'] = $value->amountPay;
    		$data[$key]['address'] = $value->address;
    		$data[$key]['date'] = $value->date;
    		$data[$key]['quantity'] = $value->quantity;
    		$data[$key]['phone'] = $value->phone;
    		$data[$key]['payment_mode'] = $value->payment_mode;
    		$shop_owner = array('owner_id'=>$value->owner_id);
    		$this->db->select('shop_phone,shop_name,image_path');
    		$this->db->from('shop_owner');
    		$this->db->where($shop_owner);
    		$query = $this->db->get();
    		$shop = $query->result();
    		$data[$key]['shop_data'] = $shop;
    		
    		$shop_owne = array('orderId'=>$value->orderId);
    		$this->db->select('item_id,item_price,quantity');
    		$this->db->from('ordered_items');
    		$this->db->where($shop_owne);
    		$query = $this->db->get();
    		$shop_item = $query->result();
    		
    		foreach ($shop_item as $ke => $vale){
    			$data[$key]['item_data'][$ke]['item_quantity'] = $vale->quantity;
    			$data[$key]['item_data'][$ke]['item_price'] = $vale->item_price;
    			
    			$item_owne = array('item_id'=>$vale->item_id);
    			$this->db->select('item_name,image_path');
    			$this->db->from('item_details');
    			$this->db->where($item_owne);
    			$query = $this->db->get();
    			$shop_item = $query->result();
    			
    			$data[$key]['item_data'][$ke]['item_data'] = $shop_item;
    		}
    		
    		
    	}
    	
    	
    	
	
	return $data;
  }
  
  
  public function changeForgotPass($phone,$user_password)
  {
    $this->db->where($phone);
    $this->db->update('users', $user_password);
    return $this->db->affected_rows();
  }
  
  public function getVenderPageInfo()
  {
    // here we select just the age column
    $this->db->select('id,area_name');
    $this->db->from('areas');
		$this->db->where('is_active',1);/*
    $this->db->join('table3', 'table1.id = table3.id');*/
    $query = $this->db->get();
		$areas = $query->result();

    $this->db->select('id,gender');
    $this->db->from('gender');
    $query = $this->db->get();
		$gender = $query->result();

    $this->db->select('id,name');
    $this->db->from('servicename');
		$this->db->where('is_active',1);
    $query = $this->db->get();
		$service_name = $query->result();

    $data = array('areas' => $areas, 'gender' => $gender, 'service_name' => $service_name);
		return $data;
  }

  

  public function registerVendor($full_name,$password,$address,$mobile_no,$email,$gender,$area,$file,$service_name_t,$description,$cost_per_day,$cost_per_hrs)
  {
    $this->db->select('id');
    $this->db->from('normal_usr');
    $where = "(email='$email' or mobile_no = '$mobile_no')";
    $this->db->where($where);
    $query = $this->db->get();
		$service_name = $query->result();
    if ($service_name) {
      return 202;
    }else {
      $post_data = array(
        'full_name'=>$full_name,
        'gender'=>$gender,
        'area'=>$area,
        'address'=>$address,
        'mobile_no'=>$mobile_no,
        'email'=>$email,
        'password'=>$password,
        'is_active'=>1,
        'username'=>"non",
        'is_serviceuser'=>1
      );
      //return $post_data;
      $this->db->insert('normal_usr',$post_data);
      $userid = $this->db->insert_id();

      $name = "assets/img/".$userid."/";
      //$name = "assets/img/1/";
       if (!file_exists($name)) {
          mkdir($name, 0777, TRUE);
       }
       //$userid = 2000;
       $pathImg=$name."{$file['name']}";
       $result = move_uploaded_file($file['tmp_name'], $pathImg);
       $post_data_s = array(
         'userid'=> $userid,
         'service_name'=>$service_name_t,
         'description'=>$description,
         'cost_per_day'=>$cost_per_day,
         'cost_per_hour'=>$cost_per_hrs,
         'image_path'=>$pathImg
       );
       $this->db->insert('service_user',$post_data_s);
       return $this->db->affected_rows();
       //return $post_data;
    }
  }

  public function getServiceNames()
  {
    $this->db->select('*');
    $this->db->from('servicename');
    $this->db->where('is_active',1);
    $query = $this->db->get();
    $service_name = $query->result();
    return $service_name;
  }

  public function bookAppointment($post_data)
  {
      $this->db->insert('booking_services',$post_data);
      return $this->db->insert_id();
  }

  public function getServiceNameOnly($serviceId)
  {
	$ar = array('id'=>$serviceId,'is_active'=>1);
    $this->db->select('name');
    $this->db->from('servicename');
		$this->db->where($ar);
    $query = $this->db->get();
		$service_name = $query->row();
    return $service_name->name;
  }
  public function checkOldPass($id,$old_pass,$new_pass)
  {
    //return $id;
    $arrayName = array('id' => $id, 'password' => $old_pass);
    $this->db->select('id');
    $this->db->from('normal_usr');
    $this->db->where($arrayName);
    $query = $this->db->get();
    //return $this->db->last_query();
		$user = $query->result();
    if ($user) {
      $data = array('password' => $new_pass);
      $this->db->where('id',$id);
			$this->db->update('normal_usr', $data);
			return ($this->db->affected_rows() > 0);
    }else {
      return false;
    }
  }

  public function getProfileData($id)
  {
    $this->db->select('user_fname,user_lname,user_address,phone,user_password');
    $this->db->from('users');
		$this->db->where('user_id',$id);
    $query = $this->db->get();
    return $query->result();
  }

  public function updateUserInfo($value)
  {
    $id = $value['user_id'];
		unset($value['user_id']);
		//array_splice($value, 1, 'item_id');
		$this->db->where('user_id', $id);
    $this->db->update("users",$value);
		$updated_status = $this->db->affected_rows();

    return $updated_status;
  }

  

  public function forgetPassword($mobile_no,$email)
  {
    $this->db->select('id');
    $this->db->from('normal_usr');
    $data3 = array('mobile_no'=>$mobile_no,'email'=>$email);
    $this->db->where($data3);
    $query = $this->db->get();

    $ret = false;
    $number = $query->num_rows();

     if( $number > 0)
     {
        $rand_number= mt_rand(100000, 999999);
                $ret = $rand_number;
              }else{
                $ret = false;
              }
              if ($ret) {
                return $arrayName = array('otp' => $ret,'user_id'=>$query->result() );
              }
               return false;

  //abhishek
  }

  
}
