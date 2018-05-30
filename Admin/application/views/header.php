<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Surfcity Admin</title>
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>services2/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/plugins/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/extensions/toastr.css">
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar">

    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a href="index.html" class="navbar-brand"><img width="150" height="50" alt="stack admin logo" src="<?php echo base_url(); ?>assets/img/logo.png" class="brand-logo">
                <!--<h2 class="brand-text">Surfcity</h2>--></a></li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu"></i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon ft-maximize"></i></a></li>
              <li class="nav-item nav-search"><a href="#" class="nav-link nav-link-search"><i class="ficon ft-search"></i></a>
                <div class="search-input">
                  <input type="text" placeholder="Explore Stack..." class="input">
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon ft-bell"></i><span class="tag tag-pill tag-default tag-danger tag-default tag-up" id="notification_count_1"><?php echo $noti_count; ?></span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag tag tag-default tag-danger float-xs-right m-0" id="notification_count_2"><?php echo $noti_count; ?> New</span></h6>
                  </li>
                  <li class="list-group scrollable-container"><a href="<?php echo base_url(); ?>index.php/welcome/orders" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">You have new order!</h6>
                        </div>
                      </div></a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="<?php echo base_url(); ?>services2/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name"><?php echo $this->session->userdata('name'); ?></span></a>
                <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item"><i class="ft-user"></i> Edit Profile</a><a href="#" class="dropdown-item"><i class="ft-mail"></i> My Inbox</a><a href="#" class="dropdown-item"><i class="ft-check-square"></i> Task</a><a href="#" class="dropdown-item"><i class="ft-message-square"></i> Chats</a>
                  <div class="dropdown-divider"></div><a href="#" class="dropdown-item"><i class="ft-power"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">



          <li class=" navigation-header"><span>View Data</span><i data-toggle="tooltip" data-placement="right" data-original-title="Apps" class=" ft-minus"></i>
          </li>
          <li class=" nav-item <?php if($selected_nav=="users") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/users"><i class="ft-user"></i><span data-i18n="" class="menu-title">Users</span></a>
          </li>
          <li class=" nav-item <?php if($selected_nav=="shops") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/shops"><i class="ft-briefcase"></i><span data-i18n="" class="menu-title">Shops</span></a>
          </li>
          <li class=" nav-item <?php if($selected_nav=="menus") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/menus"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Menu Items</span></a>
          </li>
          <li class=" nav-item <?php if($selected_nav=="offerMenus") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/offerMenus"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Offer Menu Items</span></a>
          </li>
           <li class=" navigation-header"><span>Orders</span><i data-toggle="tooltip" data-placement="right" data-original-title="Apps" class=" ft-minus"></i>
          </li>
           <li class=" nav-item <?php if($selected_nav=="orders") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/orders"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Order Placed</span></a>
          </li>
          <li class=" nav-item <?php if($selected_nav=="confirmOrders") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/confirmOrders"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Confirm Order</span></a>
          </li>
          <li class=" nav-item <?php if ($selected_nav == "cancelOrders") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/cancelOrders"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Cancel Order</span></a>
          </li>
          <li class=" navigation-header"><span>Add Data</span><i data-toggle="tooltip" data-placement="right" data-original-title="Apps" class=" ft-minus"></i>
          </li>
          <li class=" nav-item <?php if($selected_nav=="addShop") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/addShop"><i class="ft-plus-square"></i><span data-i18n="" class="menu-title">Add Shop</span></a>
          </li>
          <li class=" nav-item <?php if($selected_nav=="addMenu") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/addMenu"><i class="ft-layout"></i><span data-i18n="" class="menu-title">Add Menu Item</span></a>
          </li>
          <li class=" nav-item <?php if($selected_nav=="addOfferMenu") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/addOfferMenu"><i class="ft-layout"></i><span data-i18n="" class="menu-title">Add Offer Menu Item</span></a>
          </li>
          <li class=" navigation-header"><span>Discover</span><i data-toggle="tooltip" data-placement="right" data-original-title="Apps" class=" ft-minus"></i>
          </li>
          <li class=" nav-item <?php if($selected_nav=="addDiscoverItem") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/addDiscoverItem"><i class="ft-plus-square"></i><span data-i18n="" class="menu-title">Add Discover Item</span></a>
          </li>
          <li class=" nav-item <?php if($selected_nav=="discoverList") echo "active"; ?>"><a href="<?php echo base_url(); ?>index.php/welcome/discoverList"><i class="ft-plus-square"></i><span data-i18n="" class="menu-title">Discover Item List</span></a>
          </li>
        <!--  <li class=" nav-item"><a href="<?php echo base_url(); ?>chat-application.html"><i class="ft-message-square"></i><span data-i18n="" class="menu-title">Chat Application</span></a>
          </li>
          <li class=" nav-item"><a href="<?php echo base_url(); ?>project-summary.html"><i class="ft-airplay"></i><span data-i18n="" class="menu-title">Project Summary</span></a>
          </li>
          <li class=" nav-item"><a href="<?php echo base_url(); ?>invoice-template.html"><i class="ft-printer"></i><span data-i18n="" class="menu-title">Invoice Template</span></a>
          </li>-->


        </ul>
      </div>
    </div>

<div id="toast-container_danger" style="display:none;" class="toast-container toast-top-right"><div class="toast toast-error" aria-live="assertive" style="display: block;"><div class="toast-title" id="divToastTitleDanger">Inconceivable!</div><div class="toast-message"  id="divToastSubTitleDanger">I do not think that word means what you think it means.</div></div></div>
<div id="toast-container_success" style="display:none;"  class="toast-container toast-top-right"><div class="toast toast-success" aria-live="polite" style="display: block;"><div class="toast-title" id="divToastTitleSuccess">Miracle Max Says</div><div class="toast-message" id="divToastSubTitleSuccess">Have fun storming the castle!</div></div></div>
<script>
window.setInterval(function(){
 
 load_unseen_notification();
 
}, 5000);
 

function load_unseen_notification(){



$.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/welcome/load_unseen_notification",
           data: { 'is_active' : 1 },
           dataType:"json",
          cache: "false",
   success: function(response)
   {
       //var obj = JSON.parse(response);

    if(response.success)
        {
	var noti = document.getElementById('notification_count_1').innerHTML = response.count;
	var noti = document.getElementById('notification_count_2').innerHTML = response.count+' New';
           

        }
     else
       {
           
       }
    },
         error: function(jqXHR,textStatus,errorThrown){
               }
             });
}


 function displayDangerToast(title,message){
document.getElementById("divToastTitleDanger").innerHTML = title;
document.getElementById("divToastSubTitleDanger").innerHTML = message;
$('div#toast-container_danger').show();
setTimeout(function(){$('div#toast-container_danger').hide('slow'); }, 5000);
}
function displaySuccessToast(title,message){
document.getElementById("divToastTitleSuccess").innerHTML = title;
document.getElementById("divToastSubTitleSuccess").innerHTML = message;
$('div#toast-container_success').show();
setTimeout(function(){$('div#toast-container_success').hide('slow'); }, 5000);
}
/*window.onbeforeunload = function(){
   // Do something
   $.ajax({
   type: "POST",
   url: "<?php echo site_url(); ?>/welcome/logout",
   cache: false,
   success: function(obj){
     var data = JSON.parse(obj);
     if(data.success){
     }else {

         displayDangerToast("Delete User Error",data.message);
     }
   },
   error: function (jqXHR, exception) {
       console.log(jqXHR);
       // Your error handling logic here..
   }
 });
}*/
</script>
