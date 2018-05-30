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
          <!-- DOM - jQuery events table -->
<section id="dom">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users listinfo</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0"><!--
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>-->
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li><!--
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>-->
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <p class="card-text">Shops in SURFCITY.</p>
                        <form id="formCity">
                        <div class="form-group">
                            <div class="text-bold-600 font-medium-2">
                             Select City
                            </div>
                            <select class="select2 form-control" onchange="changeCity(this);" name="city">
                                <option value="0">All</option>
                                <?php
                                foreach($cityList as $city):
                                ?>
                                <option value="<?php echo $city->id; ?>" <?php if($citySelected ==$city->id) echo "selected"; ?> ><?php echo $city->city_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </form>
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Shop Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Status</th>
                                    <th>Add On Offer</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php foreach ($shopList as  $value) {
                                  # code...
                                  ?>
                                  <tr>
                                  <td ondblclick="javascript:rankEdit(this,<?php echo $value->owner_id; ?>)"><?php echo $value->rank; ?></td>
                                  <td><?php echo $value->shop_name; ?></td>
                                  <td><?php echo $value->shop_address; ?></td>
                                  <td><?php echo $value->city_name; ?></td>
                                  <td><?php echo $value->shop_phone; ?></td>
                                  <td><?php echo $value->shop_date; ?></td>
                                  <td> <img  width="100" height="50" <?php if($value->image_path){ ?> src="<?php echo base_url().$value->image_path; ?>" <?php } ?> ></td>
                                  <td><button type="button" onclick="editShopMenu(<?php echo $value->owner_id; ?>)" class="btn btn-danger btn-min-width mr-1 mb-1">Edit</a></td>
                                    <?php if ($value->is_active==1): ?>
                                      <td><button type="button" onclick="changeStatusShopMenuInActive(<?php echo $value->owner_id; ?>)" class="btn btn-success btn-block">Active</button></td>
                                    <?php else: ?>
                                      <td><button type="button" onclick="changeStatusShopMenuActive(<?php echo $value->owner_id; ?>)" class="btn btn-secondary btn-block">InActive</button></td>
                                    <?php endif; ?>
                                    <?php if ($value->is_on_offer==1): ?>
                                      <td><button type="button" onclick="statusRmOffer(<?php echo $value->owner_id; ?>)" class="btn btn-success btn-block">On Offer</button></td>
                                    <?php else: ?>
                                      <td><button type="button" onclick="statusAddToOffer(<?php echo $value->owner_id; ?>)" class="btn btn-secondary btn-block">Add On Offer</button></td>
                                    <?php endif; ?>
                                </tr>
                                  <?php
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>Rank</th>
                                  <th>Shop Name</th>
                                  <th>Address</th>
                                  <th>City</th>
                                  <th>Mobile</th>
                                  <th>Date</th>
                                  <th>Image</th>
                                  <th>Edit</th>
                                  <th>Status</th>
                                  <th>Add On Offer</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- DOM - jQuery events table -->

        </div>
      </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
<!--get List Of Table-->
<script>
function rankEdit(e,i) {
  var old_rank = e.innerText;
  e.innerHtml = '';
  var inp = document.createElement('input');
  inp.type = 'number';
  inp.min = 0;
  inp.value = old_rank;
  e.appendChild(inp);
  e.ondblclick = function () {};
  e.onkeyup = (function(){

    var ownr = i;
    var eventOld = e;
    return function (eb) {
    if (eb.keyCode == 13&&eb.currentTarget.childNodes[1].value>0) {
      var m = eb.currentTarget.childNodes[1].value;
      $.ajax({
             type: "POST",
             url: "<?php echo site_url(); ?>/welcome/getData",
             data: { 'owner_id' : ownr, 'rank' : m },
             dataType:"json",
             cache: "false",
             success: function(response)
             {
               if(response.success)
                  {
                    displaySuccessToast("Rank change success",response.message);
                    window.location.reload();
                  }
               else
                 {
                     displayDangerToast("Rank change failed",response.message);
                 }
              },
             error: function(jqXHR,textStatus,errorThrown){
                alert(jqXHR.result);
              }
            });
            eventOld.ondblclick = (function () {
              var t = eventOld;
              var id = m;
              return function () {
                rankEdit(t,id);
              };
            })();
      eventOld.lastChild.remove();
    }
  }
})();

}
function changeCity(obj){
  window.location.href = "<?php echo site_url(); ?>/welcome/shops?city="+obj.value;
}
function editShopMenu(id) {
  if (confirm("Are you really want to edit this user ?") == true) {
    window.location.href = "<?php echo site_url(); ?>/welcome/editShopMenu?owner_id="+id;
}

}

function statusAddToOffer(id) {
  if (confirm("Are you really want to Add Offer On this Food ?") == true) {
    $.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/welcome/updateStatusShopMenuItem",
           data: { 'owner_id' : id, 'is_on_offer' : 1 },
           dataType:"json",
           cache: "false",
           success: function(response)
           {
             if(response.success)
                {
                  displaySuccessToast("Menu item change success",response.message);
                  window.location.reload();
                }
             else
               {
                   displayDangerToast("Menu item change failed",response.message);
               }
            },
           error: function(jqXHR,textStatus,errorThrown){
              alert(jqXHR.result);
            }
          });
        }
}

function statusRmOffer(id) {
  if (confirm("Are you really want to Remove From Offer this Food ?") == true) {
    $.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/welcome/updateStatusShopMenuItem",
           data: { 'owner_id' : id, 'is_on_offer' : 0 },
           dataType:"json",
           cache: "false",
           success: function(response)
           {
             if(response.success)
                {
                  displaySuccessToast("Menu item success",response.message);
                  window.location.reload();
                }
             else
               {
                   displayDangerToast("Menu item failed",response.message);
               }
            },
           error: function(jqXHR,textStatus,errorThrown){
              alert(jqXHR.result);
            }
          });
        }
}
function changeStatusShopMenuActive(id) {
  if (confirm("Are you really want to Active this Food ?") == true) {
    $.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/welcome/updateStatusShopMenuItem",
           data: { 'owner_id' : id, 'is_active' : 1 },
           dataType:"json",
          cache: "false",
   success: function(response)
   {
       //var obj = JSON.parse(response);

    if(response.success)
        {

           displaySuccessToast("Menu item success",response.message);
           window.location.reload();

        }
     else
       {
           displayDangerToast("Menu item failed",response.message);
       }
    },
         error: function(jqXHR,textStatus,errorThrown){
         alert(jqXHR.result);
               }
             });
}
}

function changeStatusShopMenuInActive(id) {
  if (confirm("Are you really want to In-Active this Food ?") == true) {
    //window.location.href = "<?php echo site_url(); ?>/welcome/editMenu?itemId="+id;
    $.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/welcome/updateStatusShopMenuItem",
           data: { 'owner_id' : id, 'is_active' : 0 },
           dataType:"json",
          cache: "false",
   success: function(response)
   {
       //var obj = JSON.parse(response);

    if(response.success)
        {

           displaySuccessToast("Menu item success",response.message);
           window.location.reload();
        }
     else
       {
           displayDangerToast("Menu item failed",response.message);
       }
    },
         error: function(jqXHR,textStatus,errorThrown){
         alert(jqXHR.result);
               }
             });
}
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
