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
            <div class="card" >
                <div class="card-header" >
                    <h4 class="card-title">Discover Item List</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    
                </div>
                <div class="card-body collapse in" >
                    <div class="card-block card-dashboard" >
                        
                        <table class="table table-striped table-bordered dom-jQuery-events" style="overflow-y: scroll;">
                            <thead >
                                <tr>
                                    <th>Item Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Add Items</th>
                                    <th>Item List</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php foreach ($discoverLists as  $value) {
                                  # code...
                                  ?>
                                  <tr>
                                  <td><?php echo $value->name; ?></td>
                                  <td> <img width="100" height="50" <?php if($value->image_path){ ?> src="<?php echo base_url().$value->image_path; ?>" <?php } ?> ></td>
                                    <?php if ($value->is_active==1): ?>
                                      <td><button type="button" onclick="changeStatusMenuInActive(<?php echo $value->id; ?>)" class="btn btn-success btn-block">Active</button></td>
                                    <?php else: ?>
                                      <td><button type="button" onclick="changeStatusMenuActive(<?php echo $value->id; ?>)" class="btn btn-secondary btn-block">InActive</button></td>
                                    <?php endif; ?>
                                  <td><button type="button" onclick="btnClick(<?php echo $value->id; ?>)" class="btn btn-danger btn-min-width mr-1 mb-1">Add Items</a></td>
                                  <td><button type="button" onclick="btnClick2(<?php echo $value->id; ?>)" class="btn btn-danger btn-min-width mr-1 mb-1">Item List</a></td>
                                </tr>
                                  <?php
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Add Items</th>
                                    <th>Item List</th>
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
function btnClick(id) {
  window.location.href = "<?php echo site_url(); ?>/welcome/discoverItems?itemId="+id;
}

function btnClick2(id) {
  window.location.href = "<?php echo site_url(); ?>/welcome/discoverItemList?itemId="+id;
}

function changeStatusMenuActive(id) {
  if (confirm("Are you really want to Active this Food ?") == true) {
    $.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/welcome/discoverListStatus",
           data: { 'item_id' : id, 'is_active' : 1 },
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

function changeStatusMenuInActive(id) {
  if (confirm("Are you really want to In-Active this Food ?") == true) {
    $.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/welcome/discoverListStatus",
           data: { 'item_id' : id, 'is_active' : 0 },
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
