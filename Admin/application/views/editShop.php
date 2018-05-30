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
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>services2/app-assets/css/plugins/forms/validation/form-validation.css">

<style>
.drop-area{
    width:100px;
    height:25px;
    border: 1px solid #999;
    text-align: center;
    padding:10px;
    cursor:pointer;
}
#thumbnail img{
    width:100px;
    height:100px;
    margin:5px;
}
canvas{
    border:1px solid red;
}
</style>
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-body">

        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" id="basic-layout-form-center">Edit Shop Menu</h4>
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
          <p>Edit shop and add menu for shop item.</p>
        </div>

        <form class="form" id="formUpdateShop" action="javascript:updateShopNew();">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-body">
                <div class="form-group">
                  <label for="eventInput1">Select City</label>
                  <select class="select2 form-control" disabled required data-validation-required-message="This field is required" >
                      <option value="">Select City</option>
                      <?php
                      foreach($cityList as $city):
                      ?>
                      <?php if ($menuItemList[0]->shop_city==$city->id): ?>
                        <option selected value="<?php echo $city->id; ?>"  ><?php echo $city->city_name; ?></option>
                      <?php else: ?>
                        <option value="<?php echo $city->id; ?>"  ><?php echo $city->city_name; ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                  <select class="select2 form-control" style="display:none" name="shop_city" >
                      <option value="">Select City</option>
                      <?php print_r($menuItemList);
                      print_r($menuItemImagesList);
                      foreach($cityList as $city):
                      ?>
                      <?php if ($menuItemList[0]->shop_city==$city->id): ?>
                        <option selected value="<?php echo $city->id; ?>"  ><?php echo $city->city_name; ?></option>
                      <?php else: ?>
                        <option value="<?php echo $city->id; ?>"  ><?php echo $city->city_name; ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group" style="display:none">
                  <label for="eventInput2">Menu Item Name</label>
                  <input type="text" id="eventInput2" class="form-control"  value="<?php echo $menuItemList[0]->owner_id ?>" placeholder="Menu Item Name" name="owner_id">
                </div>

                <div class="form-group">
                  <label for="eventInput2">Owner Name</label>
                  <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->owner_name; ?>"  required data-validation-required-message="This field is required" placeholder="Menu Item Name" name="owner_name">
                </div>
                <div class="form-group">
                  <label for="eventInput2">Shop Name</label>
                  <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->shop_name; ?>" required data-validation-required-message="This field is required" placeholder="Menu Item Name" name="shop_name">
                </div>

                <div class="form-group">
                  <label for="eventInput3">Category</label>
                  <select class="select2 form-control"  name="food_category" required data-validation-required-message="This field is required">
                      <option value="">Select Category</option>
                      <?php
                      foreach($cateList as $cate):
                      ?>
                      <?php if ($menuItemList[0]->food_category==$cate->id): ?>
                        <option selected value="<?php echo $cate->id; ?>"  ><?php echo $cate->cate_name; ?></option>
                      <?php else: ?>
                        <option value="<?php echo $cate->id; ?>"  ><?php echo $cate->cate_name; ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                </div>

              <div class="form-group">
                  <label for="eventInput2">Delivery Charges</label>
                  <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->delivery_charges; ?>" required data-validation-required-message="This field is required" placeholder="Delivery Charges" name="delivery_charges">
              </div>
                <div class="form-group">
                  <label for="eventInput2">Opening to closing time</label>
                  <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->opening; ?>" required data-validation-required-message="This field is required" placeholder="Menu Item Name" name="opening">
                </div>

                <div class="form-group">
              <label for="projectinput8">Shop Address</label>
              <textarea id="projectinput8" rows="3" class="form-control" name="shop_address" placeholder="About menu item"  required data-validation-required-message="This field is required"><?php echo $menuItemList[0]->shop_address; ?></textarea>
            </div>
            <div class="form-group">
              <label for="eventInput2">Shop Landmark</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->shop_landmark; ?>" required data-validation-required-message="This field is required" placeholder="Shop Landmark" name="shop_landmark">
            </div>

            <div class="form-group">
              <label for="eventInput2">Shop Description</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->shop_desc; ?>" required data-validation-required-message="This field is required" placeholder="Menu Description" name="shop_desc">
            </div>
            <div class="form-group">
              <label for="eventInput2">Shop Mobile</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->shop_phone; ?>" required data-validation-required-message="This field is required" placeholder="Mobile Number" name="shop_phone">
            </div>
            <div class="form-group">
              <label for="eventInput2">Shop Mobile 2</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->shop_phone2; ?>" required data-validation-required-message="This field is required" placeholder="Mobile Number" name="shop_phone2">
            </div>
            <div class="form-group">
              <label for="eventInput2">Comment</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->comment; ?>" placeholder="Comment" name="comment">
            </div>
            <div class="form-group">
              <label for="eventInput2">Delivery Time</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->delivery_time; ?>" placeholder="Delivery Time" name="delivery_time">
            </div>
            <div class="form-group">
              <label for="eventInput2">Gst In (%)</label>
              <input type="number" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->gst_per; ?>" placeholder="Gst In (%)" name="gst_per">
            </div>
            <div class="form-group">
              <label for="eventInput2">Packaging Charges (Rs)</label>
              <input type="number" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->pack_charg; ?>" placeholder="Packaging Charges (Rs)" name="pack_charg">
            </div>
            <div class="form-group">
              <label for="eventInput2">Discount (%)</label>
              <input type="number" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->discount; ?>" placeholder="Discount (%)" name="discount">
            </div>
            <div class="form-group">
              <label for="eventInput2">Latitude</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->lat; ?>" placeholder="Latitude" name="lat">
            </div>
            <div class="form-group">
              <label for="eventInput2">Longitude</label>
              <input type="text" id="eventInput2" class="form-control" value="<?php echo $menuItemList[0]->lng; ?>" placeholder="Longitude" name="lng">
            </div>
            <div class="form-group">
                  <label for="eventInput3">Tag</label>
                  <select class="select2 form-control"  name="tag" required data-validation-required-message="This field is required">
                      <option value="">Select Tag</option>
                      <?php
                      foreach ($typeList as $type) :
                      ?>
                      <?php if ($menuItemList[0]->tag == $type->id) : ?>
                        <option selected value="<?php echo $type->id; ?>"  ><?php echo $type->type_name; ?></option>
                      <?php else : ?>
                        <option value="<?php echo $type->id; ?>"  ><?php echo $type->type_name; ?></option>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </select>
                </div>
            <div class="form-group">
              <label for="eventInput2">Shop Email</label>
              <input type="text" class="form-control" value="<?php echo $menuItemList[0]->shop_email; ?>" name="shop_email" placeholder="Email Address" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="Enter Valid Email" aria-invalid="false">
            </div>


                <fieldset class="form-group">
              <label for="file">Select image of item(Show On First Page)</label>
              <label class="custom-file center-block block">
              <input type="file" id="file" name="file" class="custom-file-input" >
                <span class="custom-file-control"></span>

                </label>

                  <img id="imageItem" name="imageItem" src="<?php echo base_url().$menuItemList[0]->image_path ?>" required data-validation-required-message="This field is required" alt="your image" style="max-height:100px"/>
                </fieldset>

                <fieldset class="form-group">
              <label for="file">Only New Images Will be Displayed (Ignore Preview) Select Multiple Images of item(On Slider)</label>
              <label class="custom-file center-block block">
              <input type="file" id="filesUpload" name="userFiles[]" multiple="multiple" class="custom-file-input" >
                <span class="custom-file-control"></span>

                </label>

                  <div id="thumbnail">
                    <?php foreach ($menuItemImagesList as $key => $value): ?>
                      <img id="imageItem" name="imageItem" src="<?php echo base_url().$value->image_path ?>" />
                    <?php endforeach; ?>

                  </div>
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
function updateShopNew() {
var form = $('form#formUpdateShop')[0];

  var data = new FormData(form);

var regview;

 $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>/welcome/updateShopNew",
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
       $("form#formUpdateShop")[0].reset();
$('#imageItem').attr('src', "#");
        displaySuccessToast("Menu item success",obj.message);
        window.location.reload();

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


//Multiple image Preview Script Start

jQuery(function($){
var fileInput = document.getElementById("filesUpload");
console.log(fileInput);
fileInput.addEventListener("change",function(e){
var files = this.files

showThumbnail(files)
},false)


function showThumbnail(files){
for(var i=0;i<files.length;i++){
var file = files[i]
var imageType = /image.*/
if(!file.type.match(imageType)){
  console.log("Not an Image");
  continue;
}

var image = document.createElement("img");
// image.classList.add("")
var thumbnail = document.getElementById("thumbnail");

image.file = file;

thumbnail.appendChild(image)

var reader = new FileReader()
reader.onload = (function(aImg){
  return function(e){
    aImg.src = e.target.result;
  };
}(image))
var ret = reader.readAsDataURL(file);
var canvas = document.createElement("canvas");
ctx = canvas.getContext("2d");
image.onload= function(){
  ctx.drawImage(image,100,100)
}
}
}
      });

      //Multiple Image Preview End
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
<script src="<?php echo base_url(); ?>services2/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>services2/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
</body>
</html>
