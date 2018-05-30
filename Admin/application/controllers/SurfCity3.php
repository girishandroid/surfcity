<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SurfCity3 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.wavexito.com',
            'smtp_port' => 25, //465,
            'smtp_user' => 'gosolapurgo@wavexito.com',
            'smtp_pass' => 'Admin@123',
            'smtp_crypto' => 'tls',
            'smtp_timeout' => '20',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
        );
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $this->load->library('email', $config);
    }

    public function loginOrSignUpCheck()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $isNumber = array();
        $user_id = $this->input->post('user_id');
        $this->load->model('Surf_City3');
        $isNumber = $this->Surf_City3->loginOrSignUpCheck($user_id);
        $id = '';
        if ($isNumber) {
            foreach ($isNumber as $key => $value) {
                $id = $value->user_id;
            }
            $success = true;
            $message = 'OK';
        } else {
            $success = false;
            $message = 'You Are Using This App First Time Please Register First';
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => $id, 'data' => $isNumber ));
    }

    /* register user */
    public function registerUser()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $first_name = $this->input->post('first_name');
        $password = $this->input->post('password');
        $address = $this->input->post('address');
        $mobile_no = $this->input->post('mobile_no');
        $last_name = $this->input->post('last_name');
        $this->load->model('Surf_City3');
        $result = $this->Surf_City3->registerUser($first_name, $password, $address, $mobile_no, $last_name);
        if ($result == 202) {
            $success = false;
            $message = 'Your Email Or Mobile number Register Already!';
        } elseif ($result) {
            $success = true;
            $message = 'You register Successfully! Please Login to processed';
        } else {
            $success = false;
            $message = 'Some Error In Registering Your Data';
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => ''));
    }

    public function checkLogin()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $this->load->model('Surf_City3');
        $userId = array('id' => 0);
        if ($userId = $this->Surf_City3->checkLogin($user_id, $password)) {
            $success = true;
            $message = 'You Login Successfully';
        } else {
            $success = false;
            $message = 'Wrong Password Entered Please Check!';
        }
        $id = '';
        foreach ($userId as $key => $value) {
            $id = $value->user_id;
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => $id));
    }

    public function getCity()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $this->load->model('Surf_City3');
        if ($city = $this->Surf_City3->getCity()) {
            $success = true;
            $message = 'Ok';
        } else {
            $success = false;
            $message = 'Try Again No City Available!';
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'cities' => $city));
    }

    public function getShopListByCity()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('shop_city')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getShopListByCity($this->input->post())) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'food_list' => $foodList));
    }

    public function getFoodListByCity()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('shop_city') && $this->input->post('owner_id')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getFoodListByCity($this->input->post())) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'food_list' => $foodList));
    }

    public function getOfferFoodListByCity()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('shop_city')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getOfferFoodListByCity($this->input->post())) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'food_list' => $foodList));
    }

    public function getShopImages()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('owner_id')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getShopImages($this->input->post())) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'shop_imgs' => $foodList));
    }

    public function getCartList()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('user_id')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getCartList($this->input->post())) {
                if ($foodList == 202) {
                    $success = false;
                    $message = 'No Food Found Here! Empty Cart';
                } else if ($foodList) {
                    $success = true;
                    $message = 'Ok';
                }

            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'shop_imgs' => $foodList));
    }

    public function getUserDetails()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('user_id')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getUserDetails($this->input->post())) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'user_details' => $foodList));
    }

    public function setPaymentDetails()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('user_id')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->setPaymentDetails($this->input->post())) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,Error To Submit Details!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'user_details' => $foodList));
    }

    public function getCatAndSubCatList()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        $this->load->model('Surf_City3');
        if ($dataList = $this->Surf_City3->getCatAndSubCatList()) {
            $success = true;
            $message = 'Ok';
        } else {
            $success = false;
            $message = 'Please Try Again,No Food Found Here!';
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'cat_list' => $dataList));
    }

    public function getItemDetails()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();

        $msgCart = 11; //--- Not OK
        if ($this->input->post('item_id') && $this->input->post('owner_id') && $this->input->post('user_id')) {
            $this->load->model('Surf_City3');
            $ar = array('user_id' => $this->input->post('user_id'));
            if ($dataList = $this->Surf_City3->getUserInCart($ar)) {
                //If User In Cart--- Not OK
                $success = true;
                $message = 'User In Cart';
                $msgCart = 13;
                $array = array('owner_id' => $this->input->post('owner_id'), 'user_id' => $this->input->post('user_id'));
                if ($dataList = $this->Surf_City3->getInCartShopCheck($array)) {

                    $success = true;
                    $message = 'User In Cart With Same Shop';
                    //have same shop in cart---OK
                    $msgCart = 15;
                    $id = '';
                    foreach ($dataList as $key => $value) {
                        $id = $value->id;
                    }
                    $arrayi = array('item_id' => $this->input->post('item_id'), 'cart_list_id' => $id);
                    if ($dataList = $this->Surf_City3->getItemCheck($arrayi)) {
                        //have same shop in cart---OK
                        $success = true;
                        $message = 'User In Cart With Same Shop And Item';
                        $msgCart = 16;

                    }
                } else {
                    $success = true;
                    $message = 'User In Cart But Not Has Same Shop In Cart';
                    //Do Not have same shop in cart--- Not OK
                    $msgCart = 14;
                }

            } else {
                $success = true;
                $message = 'User Not In Cart';
                //If User Not In Cart---OK
                $msgCart = 12;
            }

        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'cat_list' => $dataList, 'msg_cart' => $msgCart));
    }

    public function addToCart()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        $dataItem = array();

        $msgCart = 11; //--- Not OK
        $this->load->model('Surf_City3');
        if ($this->input->post('item_id') && $this->input->post('owner_id') && $this->input->post('user_id') && $this->input->post('quantity') && $this->input->post('price')) {
            
            $ar = array('user_id' => $this->input->post('user_id'));
            if ($dataList = $this->Surf_City3->getUserInCart($ar)) {
                //If User In Cart--- Not OK

                $cartId = '';
                foreach ($dataList as $key => $value) {
                    $cartId = $value->id;
                }
                $success = true;
                $message = 'User In Cart';
                $msgCart = 13;
                $array = array('owner_id' => $this->input->post('owner_id'), 'user_id' => $this->input->post('user_id'));
                if ($dataList = $this->Surf_City3->getInCartShopCheck($array)) {

                    $success = true;
                    $message = 'User In Cart With Same Shop';
                    //have same shop in cart---OK
                    $msgCart = 15;
                    $id = '';
                    foreach ($dataList as $key => $value) {
                        $id = $value->id;
                    }
                    $arrayi = array('item_id' => $this->input->post('item_id'), 'cart_list_id' => $id);
                    if ($dataList = $this->Surf_City3->getItemCheck($arrayi)) {
                        //have same shop in cart---OK
                        $success = true;
                        $message = 'User In Cart With Same Shop And Item';
                        $idItemCart = '';
                        foreach ($dataList as $key => $value) {
                            $idItemCart = $value->id;
                        }
                        $cartItemArray = array('quantity' => $this->input->post('quantity'), 'price' => $this->input->post('price'));

                        if ($idItem = $this->Surf_City3->updateItemToCart($cartItemArray, $idItemCart)) {
                            $arrayQut = array('id' => $idItem);
                            $quantity = $this->Surf_City3->getItemCheck($arrayQut);
                            $id = '';
                            foreach ($quantity as $key => $value) {
                                $id = $value->quantity;
                            }
                            $msgCart = $id;
                        } else {
                            $success = false;
                            $message = 'Error In Update' . $idItem;
                        }

                    } else {
                        $success = true;
                        $message = 'User In Cart With Same Shop And Different Item';
                        $cartItemArray = array('cart_list_id' => $cartId, 'user_id' => $this->input->post('user_id'), 'item_id' => $this->input->post('item_id'), 'quantity' => $this->input->post('quantity'), 'price' => $this->input->post('price'));
                        if ($idItem = $this->Surf_City3->addItemToCart($cartItemArray)) {
                            $arrayQut = array('id' => $idItem);
                            $quantity = $this->Surf_City3->getItemCheck($arrayQut);
                            $id = '';
                            foreach ($quantity as $key => $value) {
                                $id = $value->quantity;
                            }
                            $msgCart = $id;
                            $dataList = $idItem;
                        }

                    }
                } else {
                    $success = true;
                    $message = 'User In Cart But Not Has Same Shop In Cart';
                    //Do Not have same shop in cart--- Not OK
                    $msgCart = 10011;
                }

            } else {
                //Add User To Cart From Here
                $cartArray = array('user_id' => $this->input->post('user_id'), 'owner_id' => $this->input->post('owner_id'));
                if ($id = $this->Surf_City3->addToCart($cartArray)) {
                    $cartItemArray = array('cart_list_id' => $id, 'user_id' => $this->input->post('user_id'), 'item_id' => $this->input->post('item_id'), 'quantity' => $this->input->post('quantity'), 'price' => $this->input->post('price'));
                    if ($idItem = $this->Surf_City3->addItemToCart($cartItemArray)) {
                        $arrayQut = array('id' => $idItem);
                        $quantity = $this->Surf_City3->getItemCheck($arrayQut);
                        $id = '';
                        foreach ($quantity as $key => $value) {
                            $id = $value->quantity;
                        }
                        $msgCart = $id;
                        $success = true;
                        $message = 'Cart Added Succesfully And Item Added';
                    }
                    $success = true;
                    $message = 'Cart Added Succesfully';
                } else {
                    $success = false;
                    $message = 'Error To Add Item To Cart Please Try Again';
                }
            }

        }
        $dataItem = $this->Surf_City3->getItemByCity($this->input->post());
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'cat_list' => $dataList, 'msg_cart' => $msgCart, 'food_list' => $dataItem ));
    }

    public function removeFromCart()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $idItem = array();
        $dataItem = array();

        $msgCart = 11; //--- Not OK
        $this->load->model('Surf_City3');
        if ($this->input->post('item_id') && $this->input->post('owner_id') && $this->input->post('user_id')) {
            
            $qut = $this->input->post('quantity');

            $idItemCart = array('user_id' => $this->input->post('user_id'), 'item_id' => $this->input->post('item_id'));
            if ($qut > 0) {
                $cartItemArray = array('quantity' => $this->input->post('quantity'), 'price' => $this->input->post('price'));
                if ($idItem = $this->Surf_City3->updateRmItemToCart($cartItemArray, $idItemCart)) {
                    $arrayQut = array('id' => $idItem);
                    $quantity = $this->Surf_City3->getItemCheck($idItemCart);
                    $id = '';
                    foreach ($quantity as $key => $value) {
                        $id = $value->quantity;
                    }
                    $msgCart = $id;
                    $success = true;
                    $message = 'Quantity Removed From Cart';
                } else {
                    $success = false;
                    $message = 'Error In Update' . $idItem;
                }
            } else {
                //If Qut Equal to zero
                $recart = array('user_id' => $this->input->post('user_id'));
                $this->Surf_City3->removeItemFromCart($idItemCart, $recart);
                $success = true;
                $message = 'Quantity Removed From Cart';
                $msgCart = 0;
            }
            $dataItem = $this->Surf_City3->getItemByCity($this->input->post());
            echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'cat_list' => $idItem, 'msg_cart' => $msgCart, 'food_list'=> $dataItem));

        }else {
            echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'cat_list' => $idItem, 'msg_cart' => $msgCart, 'food_list' => $dataItem));
        }
    }

    public function getBookingHistory()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $idSend = $this->input->post('user_id');
        $this->load->model('Surf_City3');
        $checkProfile = $this->Surf_City3->getBookingHistory($this->input->post());

        if ($checkProfile) {
            $success = true;
            $message = 'You get History Data Ok';
        } else {
            $message = 'Data Not Avaliable For Request';
            //$message = $checkOldPass;
        }
        //$message=  $checkOldPass;

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'profileData' => $checkProfile));

    }

    public function changeForgotPass()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $id = $this->input->post('phone');
        $new_pass = $this->input->post('password');
        $phone = array('phone' => $id);
        $user_password = array('user_password' => $new_pass);
        $this->load->model('Surf_City3');
        $checkProfile = $this->Surf_City3->changeForgotPass($phone, $user_password);
        if ($checkProfile) {
            $success = true;
            $message = 'You Changed Password Successfully';
        } else {
            $message = 'You Changed Password Unsuccessfull! Please Try Again';
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => ''));

    }

    public function getVenderPageInfo()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $getAreaNGender = array();
        $this->load->model('Go_solapur');
        $getAreaNGender = $this->Go_solapur->getVenderPageInfo();
        if ($getAreaNGender) {
            $success = true;
            $message = 'OK';
        } else {
            $success = false;
            $message = 'Empty Response From Server Side';
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'data' => $getAreaNGender));

    }

    public function registerVendor()
    {
        $file = $_FILES['images'];
        $success = false;
        $message = 'Data Fetch Error';
        $full_name = $this->input->post('full_name');
        $password = $this->input->post('password');
        $address = $this->input->post('address');
        $mobile_no = $this->input->post('mobile_no');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');
        $area = $this->input->post('area');
        $service_name = $this->input->post('service_name');
        $description = $this->input->post('description');
        $cost_per_day = $this->input->post('cost_per_day');
        $cost_per_hrs = $this->input->post('cost_per_hrs');

        //$post_data = array('service_name'=>$service_name,'description'=>$description,'cost_per_day'=>$cost_per_day,'cost_per_hour'=>$cost_per_hrs,'image_path'=>$pathImg);

        $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');
        $extUpload = strtolower(substr(strrchr($file['name'], '.'), 1));
        if ($file['error'] == 0 && in_array($extUpload, $extsAllowed)) {
            $this->load->model('Go_solapur');
            $result = $this->Go_solapur->registerVendor($full_name, $password, $address, $mobile_no, $email, $gender, $area, $file, $service_name, $description, $cost_per_day, $cost_per_hrs);
            if ($result == 202) {
                $success = false;
                $message = 'Your Email Or Mobile number Register Already!';
            } else {
                $success = true;
                $message = 'You Register Successfully! Wait Until You\'r Account make Active ';
                //$message = $result;
            }
        } else {
            $message = 'Uploaded Image Format Not Correct';
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => ''));
    }

    public function getServiceNames()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $this->load->model('Go_solapur');
        $getServiceName = array();
        $getServiceName = $this->Go_solapur->getServiceNames();
        if ($getServiceName) {
            $success = true;
            $message = 'You Have get Service Names Successfully';
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'listServiceName' => $getServiceName));
    }

    public function validateOtp()
    {
        $success = true;
        $rand = rand(10000, 999999);
        $message = 'Welcome To Surf City. Kindly enter One Time Password (OTP) ' . $rand . ' To Complete Your Registration';

        //Multiple mobiles numbers separated by comma
        $mobileNumber = $this->input->post('mobile_no');
        //$mobileNumber = "7738186249";
        if (strlen($mobileNumber) > 10) {
            $mobileNumber = substr($mobileNumber, -10);
        }

        //$success = $this->sendMsg($mobileNumber,$message);
        $ms = 'Message not sent, Please try again.';
        //Your message to send, Add URL encoding here.
        if ($success) {
            $ms = 'Message Sent Successfully';
        }

        echo json_encode(array('success' => $success, 'message' => $ms, 'params' => $rand, 'msg' => $message, 'mob' => $mobileNumber));
    }

    public function bookAppointment()
    {
        $name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $date = $this->input->post('book_date');
        $address = $this->input->post('address');
        $mobileNo = $this->input->post('mobile_no');
        $time1 = $this->input->post('time');
        $area = $this->input->post('area');
        $time = 0;
        $serviceId = $this->input->post('serviceId');
        $userId = $this->input->post('id');
        $this->load->model('Go_solapur');
        //$datePass1 = date( "Y-m-d", strtotime($date));
        /*$datePass2 = date( "H:i:s", strtotime($time));*/
        $datePass2 = $time1;
        $post_data = array('service_date' => $date . " " . $datePass2, 'service_time' => $time, 'name' => $name, 'email_id' => $email, 'mobile' => $mobileNo, 'area' => $area, 'address' => $address, 'normal_user_id' => $userId, 'serviceId' => $serviceId);

        if ($this->Go_solapur->bookAppointment($post_data)) {
            $serviceName = $this->getServiceNameOnly($serviceId);
            $msg = 'Welcome To GoSolapurGo. Your ' . $serviceName . ' service here booked, Service Provier will contact you in short time.';
            if (strlen($mobileNo) > 10) {
                $mobileNo = substr($mobileNo, -10);
            }
            //$this->sendMsg($mobileNo,$msg);
            $success = true;
            $message = 'You appointment process Successfully Completed';
        } else {
            $success = false;
            $message = 'Error In appointment process Try Again!';
        }

        $appointmentArraySend = array('success' => $success, 'message' => $message, 'params' => '', 'msg' => $msg, 'mob' => $mobileNo);
        echo json_encode($appointmentArraySend);
    }

    public function getServiceNameOnly($serviceId)
    {
        $this->load->model('Go_solapur');
        return $this->Go_solapur->getServiceNameOnly($serviceId);
    }

    public function sendMsg($mobile_no, $message)
    {
        $success = true;
        //Prepare you post parameters
        $postData = array(
            'user' => 'gosolapurgo',
            'pass' => 'gosolapurgo',
            'sender' => 'GOSLPR',
            'phone' => '7738186249',
            'text' => $message,
            'stype' => 'flash',
            'priority' => 'ndnd',
        );
        //$url = 'http://transsms.wavexito.com/api/sendmsg.php?user=gosolapurgo&pass=gosolapurgo&sender=GOSLPR&phone=7738186249&text=aaaaaaaa Girish aaaagosolsaggg4&priority=ndnd&stype=normal';

        //API URL
        $url = "http://transsms.wavexito.com/api/sendmsg.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_PROXY => 'http://wavexito.com:2082/103.53.40.92/',
            CURLOPT_TIMEOUT => 30,
            CURLOPT_PROXYPORT => '103.53.40.92',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9'
            , CURLOPT_FOLLOWLOCATION => true,
        ));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);
        $ms = 'Message Sent Successfully';
        //Print error if any
        if (curl_errno($ch)) {
            $ms = 'error:' . curl_error($ch);
            $success = false;
            $ms = 'Message Not Sent try Again!' . $ms;
        }

        curl_close($ch);

        return $success;

    }

    public function changePassword()
    {

        $success = false;
        $message = 'Data Fetch Error';
        $idSend = $this->input->post('id');
        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');
        $this->load->model('Go_solapur');
        $checkOldPass = $this->Go_solapur->checkOldPass($idSend, $old_pass, $new_pass);

        if ($checkOldPass) {
            $success = true;
            $message = 'Change Password Successfull';
        } else {
            $message = 'Wrong Password Entered';
            //$message = $checkOldPass;
        }
        //$message=  $checkOldPass;

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => ''));

    }

    public function getProfileData()
    {
        $success = false;
        $message = 'Data Fetch Error';
        if ($this->input->post('user_id')) {
            $this->load->model('Surf_City3');
            $checkProfile = $this->Surf_City3->getProfileData($this->input->post('user_id'));

            if ($checkProfile) {
                $success = true;
                $message = 'You get Profile Data Ok';
            } else {
                $message = 'Error in Fetch Data';
                //$message = $checkProfile;
            }
        }
        //$message=  $checkOldPass;

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'profileData' => $checkProfile));

    }

    public function updateUserInfo()
    {
        $success = false;
        $message = 'Data Fetch Error';
        if ($this->input->post('user_id')) {
            $this->load->model('Surf_City3');
            $checkProfile = $this->Surf_City3->updateUserInfo($this->input->post());

            if ($checkProfile) {
                $success = true;
                $message = 'You get Profile Data Update Succesfully Ok';
            } else {
                $message = 'Error in Fetch Data';
                //$message = $checkProfile;
            }
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'params' => ''));
    }

    public function forgetPassword()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $mobile_no = $this->input->post('mobile_no');
        $email = $this->input->post('email');
        $this->load->model('Go_solapur');
        $checkProfile = $this->Go_solapur->forgetPassword($mobile_no, $email);

        if ($checkProfile) {
            $to = $email;
            //     $to = "shirish7894@gmail.com";

            $message = 'Your otp is ' . $checkProfile['otp'] . '
     ';
            $subject = "GoSolapurGo Account OTP = " . $checkProfile['otp'];
            $this->email->from('gosolapurgo@wavexito.com', 'gosolapurgo');
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            $this->email->send();
            $success = true;
            $message = 'You get OTP on mobile number';
        } else {
            $message = 'Data Not Avaliable For Request';
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'data' => $checkProfile));

    }

    public function howToUse()
    {
        $this->load->helper('url');
        $this->load->view('how_to_use');
    }

    public function isForceUpdateCheck()
    {
        //force_update    update -- for normal
        $success = true;
        $message = 'force_update';
        $version = $this->input->post('currentVersion');
        if ($version < 5) {
            $message = 'force_update';
        } else {
            $message = 'non_update';
        }
        echo json_encode(array('success' => $success, 'message' => $message));
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
    public function getAllItemsList()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post('shop_city')) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getAllItemsList($this->input->post())) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'food_list' => $foodList));
    }

    public function getDist()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post()) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getDist($this->input->post('lat'), $this->input->post('lng'), $this->input->post('km'))) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'food_list' => $foodList));
    }

    public function getAddress()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post()) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getAddress($this->input->post('lat'), $this->input->post('lng'))) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'data' => $foodList));
    }

    public function getLatLng()
    {
        $success = false;
        $message = 'Data Fetch Error';
        $foodList = array();
        if ($this->input->post()) {
            $this->load->model('Surf_City3');
            if ($foodList = $this->Surf_City3->getLatLng($this->input->post('address'))) {
                $success = true;
                $message = 'Ok';
            } else {
                $success = false;
                $message = 'Please Try Again,No Food Found Here!';
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message, 'params' => '', 'data' => $foodList));
    }

}
