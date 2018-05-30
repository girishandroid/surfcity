<link rel="apple-touch-icon" href="<?php echo base_url(); ?>services2/app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>services2/app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/fonts/feather/style.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/extensions/pace.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<!-- END VENDOR CSS-->
<!-- BEGIN STACK CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/colors.css">
<!-- END STACK CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
<!-- END Page Level CSS-->
<!-- BEGIN Custom CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/assets/css/style.css">
<!-- END Custom CSS-->
<!--START select 2 css-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/vendors/css/forms/selects/select2.min.css">
<!--END select 2 css-->

<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-body">

        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" id="basic-layout-form-center">Discover Sub Item</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                
              </div>
    <div class="card-body collapse in">
      <div class="card-block">

        <div class="card-text">
            <?php 
                if ($discoverItems):?>
                    <p>Discover Item Name --> <?php echo $discoverItems['name']; ?> </p>
                <?php 
                else:
                ?>
                    <p>Reselect Discover Item </p>
                <?php
                endif;
            ?>
          
        </div>

        <form class="form" id="formDiscoveritem" action="javascript:formDiscoveritem();">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-body">
                <div class="form-group">
                  <label for="eventInput1">Select Shop</label>
                  <select class="select2 form-control" id="city_list" onchange="changeCity(this);" required data-validation-required-message="This field is required">
                      <option value="">Select Shop</option>
                      <?php
                        foreach ($cityList as $shop) :
                        ?>
                      <option value="<?php echo $shop->id; ?>" ><?php echo $shop->city_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="eventInput1">Select Shop</label>
                  <select class="select2 form-control" id="shop_list" onchange="changeShop(this);" required data-validation-required-message="This field is required">
                      <option value="">Select Shop</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="eventInput1">Select Item</label>
                  <select class="select2 form-control" id="item_list" name="item_details_id" required data-validation-required-message="This field is required">
                      <option value="">Select Item</option>
                  </select>
                </div>

                <input type="hidden"  name="discover_items_id" value="<?php echo $discoverItems['id']; ?>"/>

                

          <div class="form-actions center">
            
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-check-square-o"></i> Add Discover
            </button>
          </div>
        </form>

      </div>


    </div>
  </div>
</div>
        </div>
      </div>
    </div>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<!--get List Of Table-->

<script>

function changeCity(obj) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>/welcome/getShopList",
        data: { 'id' : obj.value },
        dataType:"json",
        cache: "false",
        success: function (obj) {
            $('#shop_list').empty();
            $('#shop_list').append($('<option></option>').val("").html("Select Shop"));
            if (obj.success) {
                $.each(obj.data, function(i, p) {
                    $('#shop_list').append($('<option></option>').val(p.owner_id).html(p.shop_name));
                });
            }
            else {
                displayDangerToast("Re-Select City", obj.message);
            }
                $('#item_list').empty();
                $('#item_list').append($('<option></option>').val("").html("Select Item"));
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.result);
        }
    });
}

function changeShop(obj) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>/welcome/getItemList",
        data: { 'id' : obj.value },
        dataType:"json",
        cache: "false",
        success: function (obj) {
            $('#item_list').empty();
            $('#item_list').append($('<option></option>').val("").html("Select Item"));
            if (obj.success) {
                $.each(obj.data, function(i, p) {
                    $('#item_list').append($('<option></option>').val(p.item_id).html(p.item_name));
                });
            }
            else {
                displayDangerToast("Re-Select City", obj.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.result);
        }
    });
}

function formDiscoveritem() {
    var form = $('form#formDiscoveritem')[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>/welcome/addSubDiscoverItem",
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.success) {
                $("form#formDiscoveritem")[0].reset();
                displaySuccessToast("Discover item added successfully", obj.message);
            }
            else {
                displayDangerToast("Discover item insert failed", obj.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.result);
        }
    });
}

</script>

<!-- BEGIN VENDOR JS-->
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->

<!-- BEGIN PAGE VENDOR JS-->
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN STACK JS-->
<script src="<?php echo base_url(); ?>services2/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END STACK JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="<?php echo base_url(); ?>services2/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
</body>
</html>
