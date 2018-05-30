<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->db = $this->load->database('default', true);
    }
    public function index()
    {
        $this->admin();
    }
    public function header($headerData)
    {
        $this->load->model('Model_orders');
        $id = $this->Model_orders->load_unseen_notification();
        $headerData['noti_count'] = $id;
        $this->load->view('header', $headerData);
    }
    public function logout()
    {

        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('name');
    }

    public function footer()
    {
        $this->load->view('footer');
    }
    public function admin()
    {

        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('name');
        $this->load->view('admin');

    }
    public function adminLogin()
    {
        # code...
        if ($this->input->post('email') && $this->input->post('password')) {
            $this->load->model('Login_model');
            if ($data = $this->Login_model->checkLogin($this->input->post('email'), $this->input->post('password'))) {
                $this->session->set_userdata(array(
                    'userId' => $data[0]->admin_id,
                    'name' => $data[0]->admin_name,
                ));
                $success = true;
                $message = "Login Success";
            } else {
                $success = false;
                $message = "Wrong Email OR Password";
            }

        } else {
            $success = false;
            $message = "Enter all data";
        }
        echo json_encode(array('success' => $success, 'message' => $message));

    }
    public function users()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->get('city')) {
                $viewData['citySelected'] = $this->input->get('city');
            } else {
                $viewData['citySelected'] = 0;
            }
            $headerData['selected_nav'] = "users";
            $this->header($headerData);
            $this->load->model('Model_users');
            $viewData['cityList'] = $this->Model_users->getCityList();
            $viewData['userList'] = $this->Model_users->getUsersList($viewData['citySelected']);
            $this->load->view('userList', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }

    public function removeUser()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('userid')) {
                $this->load->model('Model_users');
                if ($this->Model_users->removeUser($this->input->post('userid'))) {
                    $success = true;
                    $message = "User deleted Successfully.";
                } else {
                    # code...
                    $success = false;
                    $message = "Error to delete User.";
                }
            } else {
                $success = false;
                $message = "Enter all data";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    public function orders()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->get('city')) {
                $viewData['citySelected'] = $this->input->get('city');
            } else {
                $viewData['citySelected'] = 0;
            }
            $headerData['selected_nav'] = "orders";
            $this->header($headerData);
            $this->load->model('Model_orders');
            $viewData['cityList'] = $this->Model_orders->getCityList();
            $data = $this->Model_orders->getOrderList($this->input->get('city'));
            $dataNew = array();
            foreach ($data as $value) {
                $dataCreate['orderDetails'] = $value;
                $dataCreate['items'] = $this->Model_orders->getItemsDetails($value->orderId);
                $dataNew[] = $dataCreate;
            }
            $viewData['getOrderList'] = $dataNew;
            $viewData['shopList'] = $this->Model_orders->getShopsList($viewData['citySelected']);
            $this->load->view('orderDetails', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }

    public function confirmOrders()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->get('city')) {
                $viewData['citySelected'] = $this->input->get('city');
            } else {
                $viewData['citySelected'] = 0;
            }
            $headerData['selected_nav'] = "confirmOrders";
            $this->header($headerData);
            $this->load->model('Model_orders');
            $viewData['cityList'] = $this->Model_orders->getCityList();
            $data = $this->Model_orders->getConfirmOrderList($this->input->get('city'));
            $dataNew = array();
            foreach ($data as $value) {
                $dataCreate['orderDetails'] = $value;
                $dataCreate['items'] = $this->Model_orders->getItemsDetails($value->orderId);
                $dataNew[] = $dataCreate;
            }
            $viewData['getOrderList'] = $dataNew;
            $viewData['shopList'] = $this->Model_orders->getShopsList($viewData['citySelected']);
            $this->load->view('confirmOrderDetails', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }
    }

    public function cancelOrders()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->get('city')) {
                $viewData['citySelected'] = $this->input->get('city');
            } else {
                $viewData['citySelected'] = 0;
            }
            $headerData['selected_nav'] = "cancelOrders";
            $this->header($headerData);
            $this->load->model('Model_orders');
            $viewData['cityList'] = $this->Model_orders->getCityList();
            $data = $this->Model_orders->getCancelOrderList($this->input->get('city'));
            $dataNew = array();
            foreach ($data as $value) {
                $dataCreate['orderDetails'] = $value;
                $dataCreate['items'] = $this->Model_orders->getItemsDetails($value->orderId);
                $dataNew[] = $dataCreate;
            }
            $viewData['getOrderList'] = $dataNew;
            $viewData['shopList'] = $this->Model_orders->getShopsList($viewData['citySelected']);
            $this->load->view('cancelOrderDetails', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }
    }

    public function shops()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->get('city')) {
                $viewData['citySelected'] = $this->input->get('city');
            } else {
                $viewData['citySelected'] = 0;
            }
            $headerData['selected_nav'] = "shops";
            $this->header($headerData);
            $this->load->model('Model_shops');
            $viewData['cityList'] = $this->Model_shops->getCityList();
            $viewData['shopList'] = $this->Model_shops->getShopsList($viewData['citySelected']);
            $this->load->view('shopList', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }
    public function removeShop()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('userid')) {
                $this->load->model('Model_shops');
                if ($this->Model_shops->removeShop($this->input->post('userid'))) {
                    $success = true;
                    $message = "Shop deleted Successfully.";
                } else {
                    # code...
                    $success = false;
                    $message = "Error to delete Shop.";
                }
            } else {
                $success = false;
                $message = "Enter all data";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }
    public function menus()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "menus";
            $this->header($headerData);
            $this->load->model('Model_menus');
            $viewData['shopList'] = $this->Model_menus->getShopList();
            if ($this->input->get('shopId') && $this->input->get('shopId') > 0) {
                $viewData['menuList'] = $this->Model_menus->getMenuList($this->input->get('shopId'));
            } else {
                # code...
                $viewData['menuList'] = array();
            }
            $this->load->view('menuList', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }

    public function offerMenus()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "offerMenus";
            $this->header($headerData);
            $this->load->model('Model_menus');
            $viewData['shopList'] = $this->Model_menus->getShopList();
            if ($this->input->get('shopId') && $this->input->get('shopId') > 0) {
                $viewData['menuList'] = $this->Model_menus->getOfferMenuList($this->input->get('shopId'));
            } else {
                # code...
                $viewData['menuList'] = array();
            }
            $this->load->view('offerMenuList', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }

    public function editMenu()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "editMenu";
            $this->header($headerData);
            $this->load->model('Model_menus');
            $viewData['cateList'] = $this->Model_menus->getCateList();
            $viewData['shopList'] = $this->Model_menus->getShopList();
            $viewData['subCateList'] = $this->Model_menus->getSubCateList();
            if ($this->input->get('itemId') && $this->input->get('itemId') > 0) {
                $viewData['menuItemList'] = $this->Model_menus->getMenuItemList($this->input->get('itemId'));
            }
            $this->load->view('editMenu', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }
    }

    public function editShopMenu()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "editShop";
            $this->header($headerData);
            $this->load->model('Model_shops');
            $this->load->model('Model_menus');
            $viewData['cityList'] = $this->Model_shops->getCityList();
            $viewData['cateList'] = $this->Model_menus->getCateList();
            $viewData['typeList'] = $this->Model_menus->getTypeList();
            if ($this->input->get('owner_id') && $this->input->get('owner_id') > 0) {
                $viewData['menuItemList'] = $this->Model_menus->getShopMenuList($this->input->get('owner_id'));
                $viewData['menuItemImagesList'] = $this->Model_menus->getShopMenuImgsList($this->input->get('owner_id'));
            }
            $this->load->view('editShop', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }
    }

    public function addMenu()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "addMenu";
            $this->header($headerData);
            $this->load->model('Model_menus');
            $viewData['cateList'] = $this->Model_menus->getCateList();
            $viewData['shopList'] = $this->Model_menus->getShopList();
            $viewData['subCateList'] = $this->Model_menus->getSubCateList();
            $this->load->view('addMenu', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }

    

    public function addOfferMenu()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "addOfferMenu";
            $this->header($headerData);
            $this->load->model('Model_menus');
            $viewData['cateList'] = $this->Model_menus->getCateList();
            $viewData['shopList'] = $this->Model_menus->getShopList();
            $viewData['subCateList'] = $this->Model_menus->getSubCateList();
            $this->load->view('addOfferMenu', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }
    }
    public function addMenuItem()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('shop_id') && $this->input->post('item_name') && $this->input->post('item_category') && $this->input->post('sub_food_category') && $this->input->post('item_desc') && $this->input->post('item_price') && $this->input->post('item_sellprice')) {

                $this->load->model('Model_menus');
                //if(!$this->Model_menus->checkMenuNew($this->input->post('item_name'))){

                if ($id = $this->Model_menus->addMenuItem($this->input->post())) {

                    $file_name = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $file_name = str_replace(" ", "_", $file_name);
                    $path = "assets/images/" . $this->input->post('shop_id') . "/" . $id . "/";
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }
                    if (move_uploaded_file($file_tmp, $path . $file_name)) {
                        $this->Model_menus->updateImagePath($id, $path . $file_name);
                        $success = true;
                        $message = "Menu item added Successfully.";
                    } else {
                        $success = true;
                        $message = "Menu item added Successfully. Failed to Upload Image";
                    }
                    //    $message = "Menu Item deleted Successfully.";
                } else {
                    # code...
                    $success = false;
                    $message = "Failed to add menu item";
                }
                //}else{
                //    $success = false;
                //    $message = "Item already exists Please change name";
                //}
            } else {
                $success = false;
                $message = "Enter all data";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    public function updateStatusShopMenuItem()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('owner_id')) {
                $this->load->model('Model_menus');
                if ($id = $this->Model_menus->updateShopMenuItem($this->input->post())) {
                    $success = true;
                    $message = "Your Status Changes Successfully";
                } else {
                    $success = false;
                    $message = "Error Please try Again";
                }

            } else {
                $success = false;
                $message = "Error In Data fetch";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    public function updateStatusMenuItem()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('item_id')) {
                $this->load->model('Model_menus');
                if ($id = $this->Model_menus->updateMenuItem($this->input->post())) {
                    $success = true;
                    $message = "Your Status Changes Successfully";
                } else {
                    $success = false;
                    $message = "Error Please try Again";
                }

            } else {
                $success = false;
                $message = "Error In Data fetch";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    //Confirm Status Of Order Start
    public function changeStatusOrdered()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('id')) {
                $this->load->model('Model_orders');
                if ($id = $this->Model_orders->changeStatusOrdered($this->input->post())) {
                    $success = true;
                    $message = "Your Status Changes Successfully";
                } else {
                    $success = false;
                    $message = "Error Please try Again";
                }

            } else {
                $success = false;
                $message = "Error In Data fetch";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }
    //Confirm Status Of Order End

    //Noti Count Of Order Start
    public function load_unseen_notification()
    {
        $count = 0;
        if ($this->session->userdata('userId')) {
            $this->load->model('Model_orders');
            $id = $this->Model_orders->load_unseen_notification();
            $success = true;
            $message = "Your Status Changes Successfully";
            $count = $id;
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'count' => $count));
    }
    //Noti Count Of Order End

    //Noti Count Of Order Start
    public function changeOrderNotify()
    {
        if ($this->session->userdata('userId')) {
            $this->load->model('Model_orders');
            $id = $this->Model_orders->changeOrderNotify($this->input->post());
            $success = true;
            $message = "Your Status Changes Successfully";
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }
    //Noti Count Of Order End

    public function updateMenuItem()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('shop_id') && $this->input->post('item_name') && $this->input->post('item_category') && $this->input->post('sub_food_category') && $this->input->post('item_desc') && $this->input->post('item_price') && $this->input->post('item_sellprice')) {

                $this->load->model('Model_menus');
                //if(!$this->Model_menus->checkMenuNew($this->input->post('item_name'))){

                if ($id = $this->Model_menus->updateMenuItem($this->input->post())) {

                    $file_name = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $file_name = str_replace(" ", "_", $file_name);
                    $path = "assets/images/" . $this->input->post('shop_id') . "/" . $id . "/";
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    } else {
                        if (is_file($path)) {
                            unlink($path);
                        }

                    }
                    if (move_uploaded_file($file_tmp, $path . $file_name)) {
                        $this->Model_menus->updateImagePath($id, $path . $file_name);
                        $success = true;
                        $message = "Menu item added Successfully.";
                    } else {
                        $success = true;
                        $message = "Menu item added Successfully. Failed to Upload Image";
                    }
                    //    $message = "Menu Item deleted Successfully.";
                } else {
                    # code...
                    $success = false;
                    $message = "Failed to add menu item";
                }

            } else {
                $success = false;

                //$message = $this->input->post();
                $message = "Enter all data";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    public function addOfferMenuItem()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('shop_id') && $this->input->post('item_name') && $this->input->post('item_category') && $this->input->post('sub_food_category') && $this->input->post('item_desc') && $this->input->post('item_price') && $this->input->post('item_sellprice')) {

                $this->load->model('Model_menus');
                //if(!$this->Model_menus->checkMenuNew($this->input->post('item_name'))){

                if ($id = $this->Model_menus->addMenuItem($this->input->post())) {

                    $file_name = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $file_name = str_replace(" ", "_", $file_name);
                    $path = "assets/images/" . $this->input->post('shop_id') . "/" . $id . "/";
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }
                    if (move_uploaded_file($file_tmp, $path . $file_name)) {
                        $this->Model_menus->updateImagePath($id, $path . $file_name);
                        $success = true;
                        $message = "Menu item added Successfully.";
                    } else {
                        $success = true;
                        $message = "Menu item added Successfully. Failed to Upload Image";
                    }
                    //    $message = "Menu Item deleted Successfully.";
                } else {
                    # code...
                    $success = false;
                    $message = "Failed to add menu item";
                }
                //}else{
                //    $success = false;
                //    $message = "Item already exists Please change name";
                //}
            } else {
                $success = false;
                $message = "Enter all data";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    public function addShop()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "addShop";
            $this->header($headerData);
            $this->load->model('Model_shops');
            $this->load->model('Model_menus');
            $viewData['cityList'] = $this->Model_shops->getCityList();
            $viewData['cateList'] = $this->Model_menus->getCateList();
            $viewData['typeList'] = $this->Model_menus->getTypeList();
            $this->load->view('addShop', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }
    public function getData()
    {
        $success = false;
        $message = "Error In Update Database";
        if ($this->input->post('owner_id') && $this->input->post('rank')) {
            $this->load->model('Model_shops');
            $data = $this->Model_shops->getData($this->input->post());
            if ($data) {
                $success = true;
                $message = "Your Shop Rank Is Updated";
            }
        }

        echo json_encode(array('success' => $success, 'message' => $message));
    }
    public function addShopNew()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('owner_name') && $this->input->post('shop_name') && $this->input->post('delivery_charges') && $this->input->post('opening') && $this->input->post('shop_address') && $this->input->post('shop_landmark') && $this->input->post('shop_city') && $this->input->post('food_category') && $this->input->post('shop_desc') && $this->input->post('shop_phone') && $this->input->post('shop_email')) {
                $this->load->model('Model_shops');
                if (!$this->Model_shops->checkShopNew($this->input->post('shop_name'), $this->input->post('shop_email'), $this->input->post('shop_phone'))) {
                    if ($id = $this->Model_shops->addShopNew($this->input->post())) {

                        $file_name = $_FILES['file']['name'];
                        $file_tmp = $_FILES['file']['tmp_name'];
                        $file_name = str_replace(" ", "_", $file_name);
                        $path = "assets/images/" . $id . "/";
                        if (!is_dir($path)) {
                            mkdir($path, 0755, true);
                        }
                        if (move_uploaded_file($file_tmp, $path . $file_name)) {
                            $this->Model_shops->updateImagePath($id, $path . $file_name);
                            $success = true;
                            $message = "Menu item added Successfully.";
                        } else {
                            $success = true;
                            $message = "Menu item added Successfully. Failed to Upload Image";
                        }

                        //Upload Multiple Images Code Starts
                        $data = array();
                        if (!empty($_FILES['userFiles']['name'])) {
                            $filesCount = count($_FILES['userFiles']['name']);
                            for ($i = 0; $i < $filesCount; $i++) {
                                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
                                $uploadPath = "assets/images/" . $id . "/";
                                if (!is_dir($uploadPath)) {
                                    mkdir($path, 0755, true);
                                }

                                $config['upload_path'] = $uploadPath;
                                $config['allowed_types'] = 'gif|jpg|png';

                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
                                if ($this->upload->do_upload('userFile')) {
                                    $fileData = $this->upload->data();
                                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                                }
                                $this->Model_shops->addMultipleImgesData($id, $uploadPath . $uploadData[$i]['file_name']);
                            }

                            if (!empty($uploadData)) {
                                //Insert file information into the database

                                $success = true;
                                $message = "Menu item added Successfully.";
                            } else {
                                $success = true;
                                $message = "Menu item added Successfully. Image Upload Having Some Error!";
                            }
                        }
                        //Upload Multiple Images Code Ends

                        //    $message = "Menu Item deleted Successfully.";
                    } else {
                        # code...
                        $success = false;
                        $message = "Failed to add menu item";
                    }
                } else {
                    $success = false;
                    $message = "Shop already exists Please change name or email or phone.";
                }
            } else {
                $success = false;
                $message = "Enter all data";
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    public function updateShopNew()
    {
        if ($this->session->userdata('userId')) {
            if ($this->input->post('owner_name') && $this->input->post('shop_name') && $this->input->post('delivery_charges') && $this->input->post('opening') && $this->input->post('shop_address') && $this->input->post('shop_landmark') && $this->input->post('shop_city') && $this->input->post('food_category') && $this->input->post('shop_desc') && $this->input->post('shop_phone') && $this->input->post('shop_email')) {
                $this->load->model('Model_shops');
                if ($this->Model_shops->checkShopNewTwo($this->input->post('shop_email'), $this->input->post('shop_phone'))) {
                    if ($id = $this->Model_shops->updateShopNew($this->input->post())) {
                        if ($_FILES['file']['name']) {
                            $file_name = $_FILES['file']['name'];
                            $file_tmp = $_FILES['file']['tmp_name'];
                            $file_name = str_replace(" ", "_", $file_name);
                            $path = "assets/images/" . $id . "/";
                            if (!is_dir($path)) {
                                mkdir($path, 0755, true);
                            } else {
                                if (is_file($path)) {
                                    unlink($path);
                                }

                            }
                            if (move_uploaded_file($file_tmp, $path . $file_name)) {
                                $this->Model_shops->updateImagePath($id, $path . $file_name);
                                $success = true;
                                $message = "Menu item added Successfully.";
                            }

                        } else {
                            $success = true;
                            $message = "Menu item added Successfully. Failed to Upload New Image";
                        }

                        if ($_FILES['userFiles']['name']) {
                            # code...

                            //Upload Multiple Images Code Starts
                            $data = array();
                            if (!empty($_FILES['userFiles']['name'][0])) {
                                $this->Model_shops->deleteAllMultipleImgs($this->input->post('owner_id'));
                                $filesCount = count($_FILES['userFiles']['name']);
                                for ($i = 0; $i < $filesCount; $i++) {
                                    $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                                    $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                                    $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                                    $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                                    $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
                                    $uploadPath = "assets/images/" . $id . "/";
                                    if (!is_dir($uploadPath)) {
                                        mkdir($uploadPath, 0755, true);
                                    } else {
                                        if (is_file($uploadPath)) {
                                            unlink($uploadPath);
                                        }

                                    }

                                    $config['upload_path'] = $uploadPath;
                                    $config['allowed_types'] = 'gif|jpg|png';

                                    $this->load->library('upload', $config);
                                    $this->upload->initialize($config);
                                    if ($this->upload->do_upload('userFile')) {
                                        $fileData = $this->upload->data();
                                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                                        $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                                        $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                                    }
                                    $this->Model_shops->addMultipleImgesData($id, $uploadPath . $uploadData[$i]['file_name']);
                                }

                                if (!empty($uploadData)) {
                                    //Insert file information into the database

                                    $success = true;
                                    $message = "Menu item added Successfully.";

                                } else {
                                    $success = true;
                                    $message = "Menu item added Successfully. Image Upload Having Some Error!";
                                }
                            }
                        }
                        //Upload Multiple Images Code Ends

                        //    $message = "Menu Item deleted Successfully.";
                    } else {
                        # code...
                        $success = false;
                        $message = "Failed to add menu item";
                    }
                } else {
                    $success = false;
                    $message = "You Can't change email or phone number";
                }
            } else {
                $success = false;
                $message = "Enter all data";
                //$message = $this->input->post();
            }
        } else {
            $success = false;
            $message = "Please Login Again";
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }



    /**
     * load view from @filesource addDiscoverItem.php 
     * @group Discover
     * @return void
     */
    public function addDiscoverItem()
    {
        if ($this->session->userdata('userId')) {

            $headerData['selected_nav'] = "addDiscoverItem";
            $this->header($headerData);
            $this->load->view('addDiscoverItem');
            $this->footer();
        } else {
            $this->admin();
        }

    }
    /**
     * 	Undocumented function
     *  @group Discover
     *	get @param array $discoverLists from model @method mixed getDiscList()
     * 	@return view contain at @filesource discoverList.php
     */
    public function discoverList()
    {
        if ($this->session->userdata('userId')) {
            $headerData['selected_nav'] = "discoverList";
            $this->header($headerData);
            $this->load->model('Mdl_Discover');
            $viewData['discoverLists'] = $this->Mdl_Discover->getDiscList();
            $this->load->view('discoverList', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }

    /** Discover Items Added From Here with pass from
     * @group Discover
     * @filesource addDiscoverItem
     * @param String $item_name
     * @param File $file
     */
    public function addDiscoverItems()
    {
		$success = false;
		$message = "Please Login Again";
		$data = array();
        if ($this->session->userdata('userId')) {
			if ($this->input->post('item_name')&&$_FILES) {
				$this->load->model('Mdl_Discover');
				if ($data = $this->Mdl_Discover->addDiscoverItems($this->input->post(), $_FILES)) {
					$success = true;
					$message = "Data Inserted Successfully.";
				} else {
					$success = false;
					$message = "Insert Data Giving Error";
				}
			} else {
				$success = false;
				$message = "Please Insert Discover Name And Image File";

			}           
        }
		echo json_encode(array('success' => $success, 'message' => $message,'data'=>$data));
    }

    /** Discover list change status from here
     * @group Discover
     * @filesource discoverList.php
     * @param int $item_id
     * @param int $is_active
     */
    public function discoverListStatus()
    {
        $success = false;
        $message = "Please Login Again";
        if ($this->session->userdata('userId')) {
            if ($this->input->post('item_id')) {
                $this->load->model('Mdl_Discover');
                if ($this->Mdl_Discover->discoverListStatus($this->input->post())) {
                    $success = true;
                    $message = "Status Change Successfully.";
                } else {
                    $success = false;
                    $message = "Status Change Failed";
                }
            } else {
                $success = false;
                $message = "Error In File Choose";

            }
        }
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    /**
     * @group Discover
     * Load View From Id @param int $itemId compared with table DB discoverList column
     * called from @filesource discoverList.php
     * @return void
     */
    public function discoverItems()
    {
        if ($this->session->userdata('userId')) {
            $headerData['selected_nav'] = "discoverList";
            $this->header($headerData);
            $this->load->model('Model_orders');
            $viewData['cityList'] = $this->Model_orders->getCityList();
            if ($this->input->get('itemId') && $this->input->get('itemId') > 0) {
                $this->load->model('Mdl_Discover');
                $viewData['discoverItems'] = $this->Mdl_Discover->getDiscoverList($this->input->get('itemId'));
            }
            $this->load->view('discoverItems', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }

    /**
     * getShopList Accourding to city selected
     * @param int $id passed in post method cityId
     *
     * @return void
     */
    public function getShopList()
    {
        $success = false;
        $message = "Please Login Again";
        $data = array();
        if ($this->session->userdata('userId')) {
            if ($this->input->post('id')) {
                $this->load->model('Mdl_Discover');
                if ($data =$this->Mdl_Discover->getShopList($this->input->post('id'))) {
                    $success = true;
                    $message = "Data Fetched";
                } else {
                    $success = false;
                    $message = "Error In Fetch Data";
                }
            } else {
                $success = false;
                $message = "Wrong City Send";

            }
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'data' => $data));

    }

    /**
     * getShopList Accourding to shop selected
     * @param int $id passed in post method menuItemId
     *
     * @return void
     */
    public function getItemList()
    {
        $success = false;
        $message = "Please Login Again";
        $data = array();
        if ($this->session->userdata('userId')) {
            if ($this->input->post('id')) {
                $this->load->model('Mdl_Discover');
                if ($data = $this->Mdl_Discover->getItemList($this->input->post('id'))) {
                    $success = true;
                    $message = "Data Fetched";
                } else {
                    $success = false;
                    $message = "Error In Fetch Data";
                }
            } else {
                $success = false;
                $message = "Wrong City Send";

            }
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'data' => $data));

    }

    /**
     * Called From @filesource discoverItems.php
     * @group Discover
     * passed @param integer $discover_items_id & @param int $item_details_id
     *
     * @property-write json_encode $array
     * @return void
     */
    public function addSubDiscoverItem()
    {
        $success = false;
        $message = "Please Login Again";
        $data = array();
        
        if ($this->session->userdata('userId')) {
            if ($this->input->post('discover_items_id')&& $this->input->post('item_details_id')) {
                $this->load->model('Mdl_Discover');
                
                if ($data = $this->Mdl_Discover->addSubDiscoverItem($this->input->post())) {
                    
                    $success = true;
                    $message = "Data Added";
                } else {
                    $success = false;
                    $message = "Item Already Added";
                }
            } else {
                $success = false;
                $message = "Wrong City Send";

            }
        }
        echo json_encode(array('success' => $success, 'message' => $message, 'data' => $data));

    }


    /**
     * @group Discover
     * Load View From Id @param int $itemId compared with table DB discoverList column
     * called from @filesource discoverList.php
     * @return void
     */
    public function discoverItemList()
    {
        if ($this->session->userdata('userId')) {
            $headerData['selected_nav'] = "discoverList";
            $this->header($headerData);
            if ($this->input->get('itemId') && $this->input->get('itemId') > 0) {
                $this->load->model('Mdl_Discover');
                $viewData['discoverItems'] = $this->Mdl_Discover->discoverItemList($this->input->get('itemId'));
            }
            $this->load->view('discoverItems', $viewData);
            $this->footer();
        } else {
            $this->admin();
        }

    }


}
