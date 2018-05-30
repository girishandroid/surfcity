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
          					<h4 class="card-title" id="basic-layout-form-center">Add Menu Item</h4>
          					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          					<div class="heading-elements">
          						<ul class="list-inline mb-0">
          							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
          							<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
          							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
          							<li><a data-action="close"><i class="ft-x"></i></a></li>
          						</ul>
          					</div>
          				</div>
				<div class="card-body collapse in">
					<div class="card-block">

						<div class="card-text">
							<p>Select shop and add menu for shop item.</p>
						</div>

						<form class="form" id="formAddMenu" action="javascript:addMenuItem();">
							<div class="row">
								<div class="col-md-6 offset-md-3">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">Select Shop</label>
                      <select class="select2 form-control" name="shop_id" required data-validation-required-message="This field is required">
                          <option value="">Select Shop</option>
                          <?php
                          foreach($shopList as $shop):
                          ?>
                          <option value="<?php echo $shop->owner_id; ?>" ><?php echo $shop->shop_name; ?></option>
                        <?php endforeach; ?>
                      </select>
										</div>

										<div class="form-group">
											<label for="eventInput2">Menu Item Name</label>
											<input type="text" id="eventInput2" class="form-control"  required data-validation-required-message="This field is required" placeholder="Menu Item Name" name="item_name">
										</div>

										<div class="form-group">
											<label for="eventInput3">Category</label>
                      <select class="select2 form-control"  name="item_category" required data-validation-required-message="This field is required">
                          <option value="">Select Category</option>
                          <?php
                          foreach($cateList as $cate):
                          ?>
                          <option value="<?php echo $cate->id; ?>"  ><?php echo $cate->cate_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
											<label for="eventInput3">Sub-Category</label>
                      <select class="select2 form-control"  name="sub_food_category" required data-validation-required-message="This field is required">
                          <option value="">Select Sub-Category</option>
                          <?php
                          foreach($subCateList as $cate):
                          ?>
                          <option value="<?php echo $cate->id; ?>"  ><?php echo $cate->sub_cat_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
									<label for="projectinput8">Description</label>
									<textarea id="projectinput8" rows="3" class="form-control" name="item_desc" placeholder="About menu item"  required data-validation-required-message="This field is required"></textarea>
								</div>

										<div class="form-group">
											<label for="eventInput4">Item Price</label>
											<input type="number" id="eventInput4" class="form-control" placeholder="Price" name="item_price"  required data-validation-required-message="This field is required">
										</div>

										<div class="form-group">
											<label for="eventInput5">Sell Price</label>
											<input type="number" id="eventInput5" class="form-control" name="item_sellprice"  required data-validation-required-message="This field is required" placeholder="Sell Price">
										</div>
                    <div class="form-group">
                      <label for="eventInput2">Packaging Charges (Rs)</label>
                      <input type="number" id="eventInput2" class="form-control"  placeholder="Packaging Charges (Rs)" name="pack_charg">
                    </div>
                    <div class="form-group">
                      <label for="eventInput2">Discount (%)</label>
                      <input type="number" id="eventInput2" class="form-control" placeholder="Discount (%)" name="discount">
                    </div>
                    <fieldset class="form-group">
                  <label for="file">Select image of item</label>
                  <label class="custom-file center-block block">
                  <input type="file" id="file" name="file" class="custom-file-input" required data-validation-required-message="This field is required">
                    <span class="custom-file-control"></span>

                    </label>

                      <img id="imageItem" name="imageItem"  required data-validation-required-message="This field is required" src="#" alt="your image" style="max-height:100px"/>
                    </fieldset>


									</div>
								</div>
							</div>

							<div class="form-actions center">
								<!--<button type="button" class="btn btn-warning mr-1">
									<i class="ft-x"></i> Cancel
								</button>-->
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-square-o"></i> Submit
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
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {

          var file = e.target;
      $('#imageItem').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#file").change(function() {
  readURL(this);
});
function addMenuItem() {
  var form = $('form#formAddMenu')[0];

      var data = new FormData(form);

  var regview;

     $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>/welcome/addMenuItem",
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
           $("form#formAddMenu")[0].reset();
    $('#imageItem').attr('src', "#");
            displaySuccessToast("Menu item success",obj.message);

         }
      else
        {
            displayDangerToast("Menu item failed",obj.message);
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
