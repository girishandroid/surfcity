<!DOCTYPE html>
<html> 
<head>
		<meta charset="utf-8" />
		<title>Surfcity</title>
		<meta name="keywords" content="HTML5,CSS3,Template" />
		<meta name="description" content="" />
		<!--<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />-->

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- REVOLUTION SLIDER -->
		<link href="assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/layout.css" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="assets/css/header-1.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
		
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<style>

.frmSearch {border: 1px solid #F0F0F0;background-color:#C8EEFD;margin: 2px 0px;padding:40px;}
#country-list{float:center;list-style:none;margin:0;padding:0;width:190px;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid; width:50%;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}

body, html {
    height: 100%;
}

</style>
		
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89958688-1', 'auto');
  ga('send', 'pageview');

</script>
		
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "search.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}

</script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3590339527424462",
    enable_page_level_ads: true
  });
</script>
		
	</head>

	
	<body >

		<div style="height:inherit">
			<a href="https://play.google.com/store/apps/details?id=surfcity.wavexito.android.surfcity" title="SurfCity Mobile Application" target="_blank" ><div class="shell" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url('imgs_banner/html page.jpg'); background-repeat: no-repeat; background-size: cover;height: 0%;">
            
          </div></a>
	</div>
			<!-- /REVOLUTION SLIDER -->
				<div style="height:0">
		<a href="https://play.google.com/store/apps/details?id=surfcity.wavexito.android.surfcity" title="SurfCity Mobile Application" target="_blank" ><div class="shell" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url('imgs_banner/app page.jpg'); background-repeat: no-repeat; background-size: cover;height: 100%;">
            
          </div></a>
		</div>

			<!-- INFO BAR -->
			<div style="height:auto">
			<section class="info-bar info-bar-clean">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<i class="glyphicon glyphicon-home"></i>
							<h3>ADDRESS</h3>
							<p>1333, Limayewadi,Solapur</p>
						</div>

						<div class="col-sm-6">
							<i class="glyphicon glyphicon-earphone"></i>
							<h3>Contact At:</h3>
							<p>+917517970971</p>
						</div>

				
					</div>
			  </div>
			</section>
			</div>
			<!-- /INFO BAR -->

 

			



			
			
			
			



			
			
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = 'assets/plugins/index.html';</script>
		<script type="text/javascript" src="assets/plugins/jquery/jquery-2.2.3.min.js"></script>


		
		<!-- STYLESWITCHER - REMOVE -->
		
		<!-- REVOLUTION SLIDER -->
		<script type="text/javascript" src="assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="assets/js/view/demo.revolution_slider.js"></script>
		

	</body>


</html>