<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surf_City3 extends CI_Model
{

    public function loginOrSignUpCheck($mobile_no)
    {
        $this->db->select('user_id,lat,lng');
        $this->db->from('users');
        $this->db->where('phone', $mobile_no);
        $q = $this->db->get();
        $data = $q->result();
        return $data;
    }

    /* register user */
    public function registerUser($first_name, $password, $address, $mobile_no, $last_name)
    {
        $this->db->select('user_id');
        $this->db->from('users');
        $where = "(phone = '$mobile_no')";
        $this->db->where($where);
        $query = $this->db->get();
        $service_name = $query->result();
        if ($service_name) {
            return 202;
        } else {
            $post_data = array(
                'user_fname' => $first_name,
                'user_address' => $address,
                'phone' => $mobile_no,
                'user_lname' => $last_name,
                'user_password' => $password,
            );
            //return $post_data;
            $this->db->insert('users', $post_data);
            return $this->db->affected_rows();
        }

    }

    public function checkLogin($user_id, $pass)
    {
        $this->db->select('user_id');
        $this->db->from('users');
        $this->db->where('phone', $user_id);
        $this->db->where('user_password', $pass);
        $q = $this->db->get();
        $data = $q->result();
        return $data;
    }

    public function getUserDetails($array)
    {
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

    /**
     * All Shop List By City Category with pagination
     *
     * @param [type] $array
     * @return array
     */
    public function getShopListByCity($array)
    {
        $filterList = array();
        $offerList = false;
        $nearMe = false;
        $lat = "";
        $lng = "";
        if (array_key_exists('filterList', $array)) {
            $filterList = json_decode($array['filterList'], true);
        }
        if (array_key_exists('offerList', $array)) {
            $offerList = json_decode($array['offerList'], true);
        }
        if (array_key_exists('nearMe', $array)) {
            $nearMe = json_decode($array['nearMe'], true);
        }
        if($nearMe){
            $lat = $array['lat'];
            $lng = $array['lng'];
        }
        if (array_key_exists('lat', $array)) {
            unset($array['lat']);
        }
        if (array_key_exists('lng', $array)) {
            unset($array['lng']);
        }
        if (array_key_exists('nearMe', $array)) {
            unset($array['nearMe']);
        }
        unset($array['offerList']);
        unset($array['filterList']);
        $count = $array['count'];
        unset($array['count']);
        $limit = 5;
        $start = $count * $limit;
        $serch = '';
        $serch = $array['query'];
        unset($array['query']);
        if($nearMe){
            $this->db->select("food_category.cate_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.lat,shop_owner.lng,shop_owner.comment,shop_owner.discount,shop_owner.food_category,shop_owner.opening,shop_owner.image_path,shop_owner.tag, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance");
        }else{
            $this->db->select('food_category.cate_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.lat,shop_owner.lng,shop_owner.comment,shop_owner.discount,shop_owner.food_category,shop_owner.opening,shop_owner.image_path,shop_owner.tag');
        }
        //$this->db->select('food_category.cate_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.lat,shop_owner.lng,shop_owner.comment,shop_owner.discount,shop_owner.food_category,shop_owner.opening,shop_owner.image_path');

        $this->db->from('shop_owner');
        $this->db->join('food_category', 'shop_owner.food_category= food_category.id');
        $this->db->where($array);
        if ($nearMe) {
            $this->db->having('distance <= 8');
            $this->db->order_by('distance');
        }
        $this->db->where('shop_owner.is_active', 1);
        if ($offerList) {
            $this->db->where('shop_owner.discount!=', 0);
        }
        if($nearMe){
            $this->db->where('shop_owner.lat!=', 0);
            $this->db->where('shop_owner.lat!=', null);
            $this->db->where('shop_owner.lng!=', 0);
            $this->db->where('shop_owner.lng!=', null);
        }

        if ($limit || $limit != "") {
            $this->db->limit($limit, $start);
        }
        $this->db->like('shop_owner.shop_name', $serch);
        if (count($filterList) > 0) {
            foreach ($filterList as $key => $val) {
                if ($key == 0) {
                    $this->db->like('shop_owner.food_category', $val);
                } else {
                    $this->db->or_like('shop_owner.food_category', $val);
                }

            }
        }
        $this->db->order_by("shop_owner.tag", "desc");
        $this->db->order_by("rank", "asc");
        $query = $this->db->get();
        $list = $query->result();

        return $list;
    }

    /**
     * All Shop Item List By City Category with pagination
     *
     * @param [type] $array
     * @return array
     */
    public function getFoodListByCity($array)
    {

        $filterList = array();
        if (array_key_exists('filterList', $array)) {
            $filterList = json_decode($array['filterList'], true);
        }
        unset($array['filterList']);
        $count = $array['count'];
        unset($array['count']);
        $limit = 5;
        $start = $count * $limit;
        $serch = '';
        $serch = $array['query'];
        unset($array['query']);

        $this->db->select('food_category.cate_name,sub_food_category.sub_cat_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.food_category,shop_owner.opening,item_details.item_id,item_details.item_name,item_details.item_category,item_details.item_desc,item_details.image_path,item_details.item_price,item_details.sub_food_category,cart_item_list.quantity');
        $this->db->from('shop_owner');
        $this->db->join('item_details', 'shop_owner.owner_id= item_details.shop_id');
        $this->db->join('sub_food_category', 'item_details.sub_food_category= sub_food_category.id');
        $this->db->join('food_category', 'item_details.item_category= food_category.id');
        $this->db->join('cart_list', 'cart_list.owner_id= shop_owner.owner_id AND cart_list.user_id =' . $array['user_id'], 'left');
        $this->db->join('cart_item_list', 'cart_list.id= cart_item_list.cart_list_id AND item_details.item_id =cart_item_list.item_id', 'left');
        $this->db->where('shop_owner.owner_id', $array['owner_id']);
        $this->db->where('shop_owner.shop_city', $array['shop_city']);
        $this->db->where('shop_owner.is_active', 1);
        $this->db->where('item_details.is_active', 1);
        $this->db->where('item_details.is_offer_item', 0);
        if ($limit || $limit != "") {
            $this->db->limit($limit, $start);
        }
        $this->db->like('item_details.item_name', $serch);
        if (count($filterList) > 0) {
            foreach ($filterList as $key => $val) {
                if ($key == 0) {
                    $this->db->like('item_details.sub_food_category', $val);
                } else {
                    $this->db->or_like('item_details.sub_food_category', $val);
                }

            }
        }
        $this->db->order_by("item_details.item_name", "asc");
        $query = $this->db->get();
        $list = $query->result();
        $data = array('data' => $list);
        $data['is_cart_open'] = true;
        $this->db->select('id');
        $this->db->from('cart_list');
        $this->db->where('user_id', $array['user_id']);
        $query2 = $this->db->get();
        $check = $query2->result();
        if ($check) {
            $this->db->select('id');
            $this->db->from('cart_list');
            $this->db->where('user_id', $array['user_id']);
            $this->db->where('owner_id', $array['owner_id']);
            $query3 = $this->db->get();
            $check2 = $query3->result();
            if (!$check2) {
                $data['is_cart_open'] = false;
            }
        }
        return $data;
    }

    public function getItemByCity($array)
    {
        $this->db->select('food_category.cate_name,sub_food_category.sub_cat_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.food_category,shop_owner.opening,item_details.item_id,item_details.item_name,item_details.item_category,item_details.item_desc,item_details.image_path,item_details.item_price,item_details.sub_food_category,cart_item_list.quantity');
        $this->db->from('shop_owner');
        $this->db->join('item_details', 'shop_owner.owner_id= item_details.shop_id');
        $this->db->join('sub_food_category', 'item_details.sub_food_category= sub_food_category.id');
        $this->db->join('food_category', 'item_details.item_category= food_category.id');
        $this->db->join('cart_list', 'cart_list.owner_id= shop_owner.owner_id AND cart_list.user_id =' . $array['user_id'], 'left');
        $this->db->join('cart_item_list', 'cart_list.id= cart_item_list.cart_list_id AND item_details.item_id =cart_item_list.item_id', 'left');
        $this->db->where('shop_owner.owner_id', $array['owner_id']);
        $this->db->where('shop_owner.is_active', 1);
        $this->db->where('item_details.is_active', 1);
        $this->db->where('item_details.is_offer_item', 0);
        $this->db->where('item_details.item_id', $array['item_id']);
        $this->db->order_by("item_details.item_name", "asc");
        $query = $this->db->get();
        $list = $query->result();
        $data = array('data' => $list);
        $data['is_cart_open'] = true;
        $this->db->select('id');
        $this->db->from('cart_list');
        $this->db->where('user_id', $array['user_id']);
        $query2 = $this->db->get();
        $check = $query2->result();
        if ($check) {
            $this->db->select('id');
            $this->db->from('cart_list');
            $this->db->where('user_id', $array['user_id']);
            $this->db->where('owner_id', $array['owner_id']);
            $query3 = $this->db->get();
            $check2 = $query3->result();
            if (!$check2) {
                $data['is_cart_open'] = false;
            }
        }
        return $data;
    }
    public function getOfferFoodListByCity($array)
    {
        $this->db->select('food_category.cate_name,sub_food_category.sub_cat_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.food_category,shop_owner.opening,item_details.item_id,item_details.item_name,item_details.item_category,item_details.item_desc,item_details.image_path,item_details.item_price,item_details.sub_food_category');
        $this->db->from('shop_owner');
        $this->db->join('item_details', 'shop_owner.owner_id= item_details.shop_id');
        $this->db->join('sub_food_category', 'item_details.sub_food_category= sub_food_category.id');
        $this->db->join('food_category', 'item_details.item_category= food_category.id');
        $this->db->where($array);
        $this->db->where('item_details.is_offer_item', 1);
        $this->db->where('shop_owner.is_active', 1);
        $this->db->where('item_details.is_active', 1);
        $query = $this->db->get();
        $list = $query->result();
        $this->db->select('*');
        $this->db->from('shop_owner');
        $this->db->where($array);
        $this->db->where('is_on_offer', 1);
        $query2 = $this->db->get();
        $list2 = $query2->result();
        $data = array('item_list' => $list, 'shop_list' => $list2);
        return $data;
    }

    public function getCatAndSubCatList()
    {
        $this->db->select('*');
        $this->db->from('food_category');
        $query = $this->db->get();
        $food_category = $query->result();
        $this->db->select('*');
        $this->db->from('sub_food_category');
        $query = $this->db->get();
        $sub_food_category = $query->result();
        $data = array('food_category' => $food_category, 'sub_food_category' => $sub_food_category);
        return $data;
    }

    public function getUserInCart($array)
    {
        $this->db->select('id');
        $this->db->from('cart_list');
        $this->db->where($array);
        $query = $this->db->get();
        $cart = $query->result();
        return $cart;
    }

    public function getShopImages($array)
    {
        $this->db->select('*');
        $this->db->from('shop_multiple_imgs');
        $this->db->where($array);
        $query = $this->db->get();
        $cart = $query->result();
        return $cart;
    }

    public function getInCartShopCheck($array)
    {
        $this->db->select('id');
        $this->db->from('cart_list');
        $this->db->where($array);
        $query = $this->db->get();
        $cart = $query->result();
        return $cart;
    }
    public function getItemCheck($array)
    {
        $this->db->select('quantity,id');
        $this->db->from('cart_item_list');
        $this->db->where($array);
        $query = $this->db->get();
        $cart = $query->result();
        return $cart;
    }

    public function updateItemToCart($cartItemArray, $idItemCart)
    {
        $this->db->where('id', $idItemCart);
        $this->db->update('cart_item_list', $cartItemArray);
        $updated_status = $this->db->affected_rows();
        if ($updated_status):
            return $idItemCart;
        else:
            return false;
        endif;
    }

    public function updateRmItemToCart($cartItemArray, $idItemCart)
    {
        $this->db->where($idItemCart);
        $this->db->update('cart_item_list', $cartItemArray);
        $updated_status = $this->db->affected_rows();
        if ($updated_status):
            return $idItemCart;
        else:
            return false;
        endif;
    }

    public function setPaymentDetails($array)
    {
        $this->db->insert('orders_details', $array);
        $order_id = $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('cart_item_list');
        $this->db->where('user_id', $array['user_id']);
        $query = $this->db->get();
        $dataList = $query->result();
        $idAr = '';
        foreach ($dataList as $key => $value) {
            $orderId = $array['orderId'];
            $item_id = $value->item_id;
            $price = $value->price;
            $quantity = $value->quantity;
            $ordered_items = array('orderId' => $orderId, 'item_id' => $item_id, 'item_price' => $price, 'quantity' => $quantity);

            $this->db->insert('ordered_items', $ordered_items);
            $idAr = $this->db->insert_id();
        }

        if ($idAr) {
            $ar_user = array('user_id' => $array['user_id']);
            $this->db->where($ar_user);
            $del = $this->db->delete('cart_list');

            $this->db->where($ar_user);
            $del = $this->db->delete('cart_item_list');

            return true;
        } else {
            return false;
        }

    }

    public function removeItemFromCart($idItemCart, $array)
    {
        $this->db->where($idItemCart);
        $del = $this->db->delete('cart_item_list');

        $this->db->select('id');
        $this->db->from('cart_item_list');
        $this->db->where($array);
        $query = $this->db->get();
        $cart = $query->result();
        if (!$cart) {
            $this->db->where($array);
            $del = $this->db->delete('cart_list');
        }
    }

    /**
     * Cart List Aqquring Function
     *
     * @param [array] $array
     * @return void
     */
    public function getCartList($array)
    {

        $this->db->select('id,owner_id');
        $this->db->from('cart_list');
        $this->db->where($array);
        $query = $this->db->get();
        $cart = $query->result_array();
        if ($cart) {
            $packCharg = 0;
            $discountTotal = 0;
            $gstPer = 0;
            $delivery_charges = 0;
            $itemTotal = 0;
            $data = array();
            $id = $cart[0]['owner_id'];
            $arOwner = array('owner_id' => $id);
            $this->db->select('owner_id,shop_name,shop_address,image_path,delivery_charges,discount,gst_per,comment,pack_charg');
            $this->db->from('shop_owner');
            $this->db->where($arOwner);
            $arrayShop = $this->db->get();
            $data['shop_data'] = $arrayShop->result_array();
            $packCharg = $data['shop_data'][0]['pack_charg'];
            $discountTotal = $data['shop_data'][0]['discount'];
            $gstPer = $data['shop_data'][0]['gst_per'];
            $delivery_charges = $data['shop_data'][0]['delivery_charges'];
            $this->db->select('item_id,quantity,price');
            $this->db->from('cart_item_list');
            $this->db->where($array);
            $query = $this->db->get();
            $cart_item = $query->result();

            $item_id = '';
            $items = array();
            $p = 0;
            foreach ($cart_item as $key => $vae) {
                $item_id = $vae->item_id;
                $aritem_id = array('item_id' => $item_id);
                $this->db->select('item_id,item_name,item_price,image_path,discount,pack_charg');
                $this->db->from('item_details');
                $this->db->where($aritem_id);
                $arrayShopItem2 = $this->db->get();
                $items[$key]['shop_item_data'] = $arrayShopItem2->result();
                $arrayShopItem  = $arrayShopItem2->result_array(); 
                if(count($arrayShopItem)>0){
                    $arrayShopItem = $arrayShopItem[0];
                    $price =  $arrayShopItem['item_price'];
                    $pack_charg = $arrayShopItem['pack_charg'];
                    $pack_charg = 10;
                    $discount = $arrayShopItem['discount'];
                    $discount = 2;
                    $price = $price * $vae->quantity;
                    $items[$key]['total_price'] = $price + $pack_charg;
                    $items[$key]['discount'] = $discount;
                    $items[$key]['pack_charg'] = $pack_charg;
                    $items[$key]['quantity'] = $vae->quantity;
                    $items[$key]['price'] = $vae->price;
                    if ($discount != 0) {
                        $dis_price = ($discount * $price) / 100;
                        $items[$key]['total_price'] = $price + $pack_charg - $dis_price;
                    }
                    $itemTotal = $itemTotal  + $items[$key]['total_price'];
                }else{
                    $items[$key]['quantity'] = $vae->quantity;
                    $items[$key]['price'] = $vae->price;
                }
            }
            $itemTotalAll = $itemTotal + $packCharg;
            if ($gstPer != 0) {
                $gstPer = ($gstPer * $itemTotal) / 100;
            }
            if ($discountTotal != 0) {
                $dis_price = ($discountTotal * $itemTotal) / 100;
                $itemTotalAll = $itemTotal + $packCharg - $dis_price;
                $discountTotal = $dis_price;
            }
            
            $cartTotal = $itemTotalAll + $delivery_charges + $gstPer;
            $data['items'] = $items;
            $data['item_total'] = number_format($itemTotalAll, 2);
            $data['cart_total'] = number_format($cartTotal, 2);
            $data['delivery_charges'] = number_format($delivery_charges, 2);
            $data['pack_charg'] = number_format($packCharg, 2);
            $data['discount'] = number_format($discountTotal, 2);
            $data['gst_per'] = number_format($gstPer, 2);
            $data['message'] = "Item Charges Included discount and packing charges on items.";
            return $data;

        } else {
            return 202;
        }

    }

    public function addToCart($array)
    {
        $this->db->insert('cart_list', $array);
        return $this->db->insert_id();

    }

    public function addItemToCart($array)
    {
        $this->db->insert('cart_item_list', $array);
        return $this->db->insert_id();

    }

    public function getItemDetails($array)
    {
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
            $shop_owner = array('owner_id' => $value->owner_id);
            $this->db->select('shop_phone,shop_name,image_path');
            $this->db->from('shop_owner');
            $this->db->where($shop_owner);
            $query = $this->db->get();
            $shop = $query->result();
            $data[$key]['shop_data'] = $shop;

            $shop_owne = array('orderId' => $value->orderId);
            $this->db->select('item_id,item_price,quantity');
            $this->db->from('ordered_items');
            $this->db->where($shop_owne);
            $query = $this->db->get();
            $shop_item = $query->result();

            foreach ($shop_item as $ke => $vale) {
                $data[$key]['item_data'][$ke]['item_quantity'] = $vale->quantity;
                $data[$key]['item_data'][$ke]['item_price'] = $vale->item_price;

                $item_owne = array('item_id' => $vale->item_id);
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

    public function changeForgotPass($phone, $user_password)
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
        $this->db->where('is_active', 1); /*
        $this->db->join('table3', 'table1.id = table3.id');*/
        $query = $this->db->get();
        $areas = $query->result();

        $this->db->select('id,gender');
        $this->db->from('gender');
        $query = $this->db->get();
        $gender = $query->result();

        $this->db->select('id,name');
        $this->db->from('servicename');
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        $service_name = $query->result();

        $data = array('areas' => $areas, 'gender' => $gender, 'service_name' => $service_name);
        return $data;
    }

    public function registerVendor($full_name, $password, $address, $mobile_no, $email, $gender, $area, $file, $service_name_t, $description, $cost_per_day, $cost_per_hrs)
    {
        $this->db->select('id');
        $this->db->from('normal_usr');
        $where = "(email='$email' or mobile_no = '$mobile_no')";
        $this->db->where($where);
        $query = $this->db->get();
        $service_name = $query->result();
        if ($service_name) {
            return 202;
        } else {
            $post_data = array(
                'full_name' => $full_name,
                'gender' => $gender,
                'area' => $area,
                'address' => $address,
                'mobile_no' => $mobile_no,
                'email' => $email,
                'password' => $password,
                'is_active' => 1,
                'username' => "non",
                'is_serviceuser' => 1,
            );
            //return $post_data;
            $this->db->insert('normal_usr', $post_data);
            $userid = $this->db->insert_id();

            $name = "assets/img/" . $userid . "/";
            //$name = "assets/img/1/";
            if (!file_exists($name)) {
                mkdir($name, 0777, true);
            }
            //$userid = 2000;
            $pathImg = $name . "{$file['name']}";
            $result = move_uploaded_file($file['tmp_name'], $pathImg);
            $post_data_s = array(
                'userid' => $userid,
                'service_name' => $service_name_t,
                'description' => $description,
                'cost_per_day' => $cost_per_day,
                'cost_per_hour' => $cost_per_hrs,
                'image_path' => $pathImg,
            );
            $this->db->insert('service_user', $post_data_s);
            return $this->db->affected_rows();
            //return $post_data;
        }
    }

    public function getServiceNames()
    {
        $this->db->select('*');
        $this->db->from('servicename');
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        $service_name = $query->result();
        return $service_name;
    }

    public function bookAppointment($post_data)
    {
        $this->db->insert('booking_services', $post_data);
        return $this->db->insert_id();
    }

    public function getServiceNameOnly($serviceId)
    {
        $ar = array('id' => $serviceId, 'is_active' => 1);
        $this->db->select('name');
        $this->db->from('servicename');
        $this->db->where($ar);
        $query = $this->db->get();
        $service_name = $query->row();
        return $service_name->name;
    }
    public function checkOldPass($id, $old_pass, $new_pass)
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
            $this->db->where('id', $id);
            $this->db->update('normal_usr', $data);
            return ($this->db->affected_rows() > 0);
        } else {
            return false;
        }
    }

    public function getProfileData($id)
    {
        $this->db->select('user_fname,user_lname,user_address,phone,user_password');
        $this->db->from('users');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function updateUserInfo($value)
    {
        $id = $value['user_id'];
        unset($value['user_id']);
        //array_splice($value, 1, 'item_id');
        $this->db->where('user_id', $id);
        $this->db->update("users", $value);
        $updated_status = $this->db->affected_rows();

        return $updated_status;
    }

    public function forgetPassword($mobile_no, $email)
    {
        $this->db->select('id');
        $this->db->from('normal_usr');
        $data3 = array('mobile_no' => $mobile_no, 'email' => $email);
        $this->db->where($data3);
        $query = $this->db->get();

        $ret = false;
        $number = $query->num_rows();

        if ($number > 0) {
            $rand_number = mt_rand(100000, 999999);
            $ret = $rand_number;
        } else {
            $ret = false;
        }
        if ($ret) {
            return $arrayName = array('otp' => $ret, 'user_id' => $query->result());
        }
        return false;

        //abhishek
    }


    /**
     * Start Adding New Service on Date 18/05/2018
     * By Girish G Akhare Last Updated.
     */

    /**
     * get all items by category veg and non-veg only
     * passed @param integer $shop_city city id
     * passed @param integer $user_id user id
     * passed @param integer $is_veg 1 or 2
     *
     * @return void
     */

    public function getAllItemsList($array)
    {
        $this->db->select('food_category.cate_name,sub_food_category.sub_cat_name,shop_owner.owner_id,shop_owner.shop_name,shop_owner.shop_desc,shop_owner.food_category,shop_owner.opening,item_details.item_id,item_details.item_name,item_details.item_category,item_details.item_desc,item_details.image_path,item_details.item_price,item_details.sub_food_category,cart_item_list.quantity');
        $this->db->from('shop_owner');
        $this->db->join('item_details', 'shop_owner.owner_id= item_details.shop_id');
        $this->db->join('sub_food_category', 'item_details.sub_food_category= sub_food_category.id');
        $this->db->join('food_category', 'item_details.item_category= food_category.id');
        $this->db->join('cart_list', 'cart_list.owner_id= shop_owner.owner_id AND cart_list.user_id =' . $array['user_id'], 'left');
        $this->db->join('cart_item_list', 'cart_list.id= cart_item_list.cart_list_id AND item_details.item_id =cart_item_list.item_id', 'left');
        $this->db->where('shop_owner.shop_city', $array['shop_city']);
        $this->db->where('shop_owner.is_active', 1);
        $this->db->where('food_category.id', $array['is_veg']);
        $this->db->where('item_details.is_active', 1);
        $this->db->where('item_details.is_offer_item', 0);
        $this->db->order_by("item_details.item_name", "asc");
        $query = $this->db->get();
        $list = $query->result();
        $list2 = array();
        $list2 = $list;
        $m = "ds";
        $this->db->select('id');
        $this->db->from('cart_list');
        $this->db->where('user_id', $array['user_id']);
        $query6 = $this->db->get();
        $check6 = $query6->result();
        $setTrue = false;
        if (!$check6) {
            $setTrue = true;
        }
        foreach ($list2 as $key => $value) {
            if ($setTrue) {
                $list[$key]->is_cart_open = true;
            } else {
                $m = $value->owner_id;
                $this->db->select('id');
                $this->db->from('cart_list');
                $this->db->where('owner_id', $m);
                $this->db->where('user_id', $array['user_id']);
                $query5 = $this->db->get();
                $check5 = $query5->result();
                if (!$check5) {
                    $list[$key]->is_cart_open = false;
                } else {
                    $list[$key]->is_cart_open = true;
                }  
            }
            
            
        }

        $data = array('data' => $list);
        $data['is_cart_open'] = true;
        $this->db->select('id');
        $this->db->from('cart_list');
        $this->db->where('user_id', $array['user_id']);
        $query2 = $this->db->get();
        $check = $query2->result();
        if ($check) {
            $this->db->select('id');
            $this->db->from('cart_list');
            $this->db->where('user_id', $array['user_id']);
            $query3 = $this->db->get();
            $check2 = $query3->result();
            if (!$check2) {
                $data['is_cart_open'] = false;
            }
        }
        return $data;
    }

    public function getDist($lat , $lng, $miles)
    {
        $lat1 = "19.074108799999998";
        $lon1 = "73.01110840000001";
        $lat2 = "19.0101947";
        $lon2 = "73.10226690000002";

        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $lat1 . ',' . $lon1 . '&destinations=' . $lat2 . ',' . $lon2 . '&mode=driving&language=pl-PL';
        /* $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch); */
        //$s = ;json_decode(file_get_contents($url), true)
        //$s = json_decode(file_get_contents($url), true);
        $s =0;
        if (json_decode(file_get_contents($url), true)['rows'][0]['elements'][0]['distance']['value'] <= 8000) {
            $s =1;
        } else {
            $s =2;
        }
        //return $s;
        $this->db->select("*, ( if(json_decode(file_get_contents($url), true)['rows'][0]['elements'][0]['distance']['value']<=8000){return 1;}else{return 2;} ) AS distance");
        $this->db->from('shop_owner');
        $this->db->where('owner_id', '196');
        //$this->db->having('distance <= ' . $miles);
        $this->db->order_by('distance');
        $this->db->limit(20, 0);
        $query3 = $this->db->get();
        return $query3->result();
        $response = file_get_contents($url);
        $response_a = json_decode($response, true);
        $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
        $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

        return array('distance' => $dist, 'time' => $time,'res'=> $response);
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        return $kilometers;

        $this->db->select("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance");
        $this->db->from('shop_owner');
        $this->db->having('distance <= ' . $miles);
        $this->db->order_by('distance');
        $this->db->limit(20, 0);
        $query3 = $this->db->get();
        return $query3->result();
    }

    public function getAddress($lat, $lng)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat."," .$lng . "&sensor=false&key=AIzaSyAnf8l5bjU6MUoNLjpNqn3tWZeeO3uStqQ";
        $response = file_get_contents($url);
        $response_a = json_decode($response, true);
        
        return $response_a;

    }

    public function getLatLng($address)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyAnf8l5bjU6MUoNLjpNqn3tWZeeO3uStqQ";
        $response = file_get_contents($url);
        $response_a = json_decode($response, true);
        
        return $response_a;

    }

}
