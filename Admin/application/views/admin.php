<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Surfcity Admin</title>
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>services2/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/extensions/pace.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/forms/toggle/switchery.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/colors.css">

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/plugins/forms/validation/form-validation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/plugins/forms/switch.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/assets/css/style.css">
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/plugins/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/extensions/toastr.css">
  </head>
  <body>
    <div id="toast-container_danger" style="display:none;" class="toast-container toast-top-right"><div class="toast toast-error" aria-live="assertive" style="display: block;"><div class="toast-title" id="divToastTitleDanger">Inconceivable!</div><div class="toast-message"  id="divToastSubTitleDanger">I do not think that word means what you think it means.</div></div></div>
    <div id="toast-container_success" style="display:none;"  class="toast-container toast-top-right"><div class="toast toast-success" aria-live="polite" style="display: block;"><div class="toast-title" id="divToastTitleSuccess">Miracle Max Says</div><div class="toast-message" id="divToastSubTitleSuccess">Have fun storming the castle!</div></div></div>
    <script>
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
    </script>

        <div class="content-body"><!-- Input Validation start -->
<section class="input-validation">
	<div class="row">
		<div class="col-md-7" style="margin-top:8%;margin-left:20%;margin-right:20%;">
			<div class="card">
				<div class="card-header">

            <img height="50" src="<?php echo base_url(); ?>assets/img/logo.png">
          <center>
					<h4 class="card-title">surfcity Admin Login</h4>
        </center>
        <br>
        <br>

    <form style="margin-right:10%;margin-left:10%;" id="formLogin" action="javascript:adminLogin();">
      <div class="form-group">

										<h5>Enter Email Address <span class="required">*</span></h5>
										<div class="controls">
											<input type="text" class="form-control" name="email" placeholder="Email Address" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="Enter Valid Email">
										</div>
									</div>
                  <div class="form-group">
  										<h5>Password Input Field <span class="required">*</span></h5>
  										<div class="controls">
  											<input type="password" name="password"  placeholder="Password" class="form-control" required data-validation-required-message="This field is required">
  										</div>
  									</div>
                    <div class="text-xs-right">
										<button type="submit" class="btn btn-success">Login <i class="fa fa-thumbs-o-up position-right"></i></button>
										<button type="reset" class="btn btn-danger">Reset <i class="fa fa-refresh position-right"></i></button>
									</div>
    </form>
</div>
</div>
</div>
</div>
</section>
</div>
  </body>
  <script>
function adminLogin(){
  var form = $('form#formLogin')[0];

      var data = new FormData(form);

  var regview;

     $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>/welcome/adminLogin",
            data: data,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
    success: function(response)
    {
        var obj = JSON.parse(response);

     if(obj.success)
         {
            window.location.href = "<?php echo site_url(); ?>/welcome/users";
         }
      else
        {
            displayDangerToast("login Failed",obj.message);
        }
     },
          error: function(jqXHR,textStatus,errorThrown){
          alert(jqXHR.result);
                }
              });
}
  </script>

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN STACK JS-->
    <script src="<?php echo base_url(); ?>services2/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>services2/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END STACK JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url(); ?>services2/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
