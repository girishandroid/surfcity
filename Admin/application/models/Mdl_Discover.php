<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Discover Model Having Add Item To Discoder @method mixed addDiscoverItems()
 *  Active InActive Done From Here
 */
class Mdl_Discover extends CI_Model
{

    /**
     * Undocumented @method mixed addDiscoverItems()
     * @group Discover
     * Is Item Added Or Not.
     * @param array $values contain @param String $item_name
     * @param FILE $files
     * @return array array('success' => $success, 'message' => $message);
     */
    public function addDiscoverItems($values, $files)
    {
        $success = false;
        $message = "Data Uploding Error Please try Again";

        $_FILES = $files;
        if ($_FILES['file']['name']) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = str_replace(" ", "_", $file_name);
            $path = "assets/discover/";
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            if (move_uploaded_file($file_tmp, $path . $file_name)) {
                $ary = array('name' => $values['item_name'],'image_path' => $path . $file_name);
                $this->db->insert('discover_items', $ary);
                $isInsert = $this->db->insert_id();
                if ($isInsert) {
                    $success = true;
                    $message = "Discover item added Successfully.";
                } else {
                    $success = false;
                    $message = "Error In Insert into Database.";
                }
            }else {
                $success = false;
                $message = "Upload Image Giving Error";
            }

        }
        return array('success' => $success, 'message' => $message);
    }

    /**
     * Undocumented function getDiscList()
     * @group Discover
     *
     * @return array contain all list from @source DataBaseTbl Name :- discover_items
     */
    public function getDiscList()
    {
        $this->db->select('*');
        $this->db->from('discover_items');
        $query = $this->db->get();
        return $query->result();

    }

    /**
     * @group Discover
     * DB use discover_items on @column is_active
     * Called by function from @filesource Welcome controller 
     * @method mixed discoverListStatus($this->input->post())
     * @param Array $var
     * @return boolean
     */
    public function discoverListStatus($var)
    {
        if ($var) {
            $this->db->where('id', $var['item_id']);
            $this->db->update("discover_items", array('is_active' => $var['is_active'] ));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Undocumented function not called
     * @group Discover
     * @param [int] $itemId
     * @return array 
     */
    public function discoverItemsList($itemId = null)
    {
        if ($itemId) {
            $this->db->select('*');
            $this->db->from('discover_item_list');
            $this->db->where('discover_items_id',$itemId);
            $query = $this->db->get();
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Undocumented function getDiscList()
     * @group Discover
     *
     * @return array contain perticular item from @source DataBaseTbl Name :- discover_items
     */
    public function getDiscoverList(int $id = null)
    {
        $this->db->select('id,name');
        $this->db->from('discover_items');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->result_array()){
            return $query->result_array()[0];
        }
        return $query->result_array();

    }


    /**
     * Undocumented function
     * @group Discover @group globeData
     * @param integer $id compared with @param shop_city 
     * @return array
     */
    public function getShopList(int $id = null)
    {
        if ($id) {
            $this->db->select('owner_id,shop_name');
            $this->db->from('shop_owner');
            $this->db->where('shop_city', $id);
            $query = $this->db->get();
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * Undocumented function
     * @group Discover @group globeData
     * @param integer $id compared with @param shop_id 
     * @return array
     */
    public function getItemList(int $id = null)
    {
        if ($id) {
            $this->db->select('item_id,item_name');
            $this->db->from('item_details');
            $this->db->where('shop_id', $id);
            $query = $this->db->get();
            return $query->result();
        } else {
            return array();
        }
    }


    /**
     * Called by @method void addSubDiscoverItem() from @filesource Welcome.php controller
     *
     * @param array $array
     * @return boolean
     */
    public function addSubDiscoverItem($array = null)
    {
        if ($array) {
            $this->db->select('*');
            $this->db->from('discover_item_list');
            $this->db->where($array);
            $query = $this->db->get();
            $isData = $query->result();
            if ($isData) {
                return false;
            } else {
                $this->db->insert('discover_item_list', $array);
                return $this->db->insert_id();
            }      
            

        } else {
            return false;
        }
    }

    /**
     * Called by @method void discoverItemList($itemId) from @filesource Welcome.php controller
     *
     * @param int $id
     * @return array contain item name and image path
     */
    public function discoverItemList($id = null)
    {
        if ($id) {
            $this->db->select('item_details.item_name,item_details.image_path');
            $this->db->from('discover_item_list');
            $this->db->join('item_details', 'discover_item_list.item_details_id = item_details.item_id');
            $this->db->where('discover_items_id',$id);
            $query = $this->db->get();
            return $query->result();
        } else {
            return array();
        }
    }
}

/* End of file Mdl_Discover.php */
