{!! $navbar !!}
<!-- Navbar ================================================== -->
<body>

{!! $header !!}
<!-- Header End====================================================================== -->
<script src="<?php echo url('');?>/themes/js/jquery-1.10.0.min.js" type="text/javascript"></script>

<div id="carouselBl">
<div class="container">
<div class="row-fluid">
<div id="grids" style="width:24%;padding:10px;margin-bottom:20px;margin-right: 12px;background: linear-gradient(to bottom, rgba(249, 249, 249, 1) 0%, rgba(239, 239, 239, 1) 47%, rgba(220, 220, 220, 1) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);" class="span3 tab-res tab-land"  >
<ul id="myTab" class="nav nav-tabs">
  <li class="align_text active"><a data-toggle="tab"class="tab_text" href="#one">Resource</a></li>
  <li class="align_text"><a data-toggle="tab"class="tab_text" href="#two">Deals</a></li>
</ul>
 
<div class="tab-content" style="max-height:350px;overflow-x:hidden;overflow-y:scroll;">
  <div id="one" class="tab-pane active">
  
  <?php if($product_details) { 
  foreach($product_details as $product_det) { 
 $product_image = explode('/**/',$product_det->pro_Img);
 if($product_det->pro_no_of_purchase < $product_det->pro_qty) { 
$mcat = strtolower(str_replace(' ','-',$product_det->mc_name));
             $smcat = strtolower(str_replace(' ','-',$product_det->smc_name));
			  $sbcat = strtolower(str_replace(' ','-',$product_det->sb_name));
             $ssbcat = strtolower(str_replace(' ','-',$product_det->ssb_name)); 
			  $res = base64_encode($product_det->pro_id);
   ?>
  <div class="row-fluid" id="<?php echo $product_det->pro_id;?>">
	 <div class="span4">
<?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<a href="<?php echo url('');?>/productview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res; ?>"><img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $product_image[0]; ?>" alt="<?php echo $product_det->pro_title; ?>" style="width:80px;height:auto;"></a>
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<a href="<?php echo url('');?>/productview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$res; ?>"><img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $product_image[0]; ?>" alt="<?php echo $product_det->pro_title; ?>" style="width:80px;height:auto;"></a>
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<a href="<?php echo url('');?>/productview/<?php echo $mcat.'/'.$smcat.'/'.$res; ?>"><img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $product_image[0]; ?>" alt="<?php echo $product_det->pro_title; ?>" style="width:80px;height:auto;"></a>
<?php } ?>
       </div>
      <div class="span8">
<?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<h4><a href="<?php echo url('');?>/productview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res; ?>" class="near_text"><?php echo $product_det->pro_title; ?></a></h4>
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<h4><a href="<?php echo url('');?>/productview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$res; ?>" class="near_text"><?php echo $product_det->pro_title; ?></a></h4>
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<h4><a href="<?php echo url('');?>/productview/<?php echo $mcat.'/'.$smcat.'/'.$res; ?>" class="near_text"><?php echo $product_det->pro_title; ?></a></h4>
<?php } ?>
     
      <span class="dolor_text">$<?php echo $product_det->pro_price;  ?></span>
     </div>
  </div>
  <hr style="border:1px solid #aaaaaa;">
  <?php } } } else { ?>
  <div class="row-fluid">
	 <div class="span4">
     No Records Found...
     </div></div>
  <?php } ?> 
  
  </div>
  <div id="two" class="tab-pane">
  
  <?php if($deals_details) { 
  foreach($deals_details as $deals) { 
   $deals_discount_percentage = $deals->deal_discount_percentage;
   $deals_img = explode('/**/', $deals->deal_image);
 $mcat = strtolower(str_replace(' ','-',$deals->mc_name));
 $smcat = strtolower(str_replace(' ','-',$deals->smc_name));
 $sbcat = strtolower(str_replace(' ','-',$deals->sb_name));
 $ssbcat = strtolower(str_replace(' ','-',$deals->ssb_name)); 
 $res = base64_encode($deals->deal_id);
   ?>
  <div class="row-fluid" id="<?php echo $deals->deal_id;?>">
	 <div class="span4">
<?php  if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<a href="<?php echo url('');?>/dealview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res;?>"><img src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deals_img[0]; ?>" alt="<?php echo $deals->deal_title; ?>" style="width:80px;height:auto;"></a>
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<a href="<?php echo url('');?>/dealview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$res;?>"><img src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deals_img[0]; ?>" alt="<?php echo $deals->deal_title; ?>" style="width:80px;height:auto;"></a>
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<a href="<?php echo url('');?>/dealview/<?php echo $mcat.'/'.$smcat.'/'.$res;?>"><img src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deals_img[0]; ?>" alt="<?php echo $deals->deal_title; ?>" style="width:80px;height:auto;"></a>
<?php } ?>
       </div>
      <div class="span8">
<?php  if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<h4><a href="<?php echo url('');?>/dealview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res;?>" class="near_text"><?php echo $deals->deal_title; ?></a></h4>		
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<h4><a href="<?php echo url('');?>/dealview/<?php echo $mcat.'/'.$smcat.'/'.$sbcat.'/'.$res;?>" class="near_text"><?php echo $deals->deal_title; ?></a></h4>
<?php } ?>
<?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<h4><a href="<?php echo url('');?>/dealview/<?php echo $mcat.'/'.$smcat.'/'.$res;?>" class="near_text"><?php echo $deals->deal_title; ?></a></h4>
<?php } ?>

      <span class="dolor_text">$<?php echo $deals->deal_discount_price;  ?></span>
     </div>
  </div>
  <hr style="border:1px solid #aaaaaa;">
  <?php } } else { ?>
  <div class="row-fluid">
	 <div class="span4">
     No Records Found...
     </div></div>
  <?php } ?> 
  
  
  
  </div>
  

  
</div>
</div>
<div >
     <div id="map" style="height: 428px; width: 100%px;">
     </div>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB43AT_wikI5KDzqdfEJpwYgBn0hp8O5bY"></script>

    <script type="text/javascript">
    var locations = [
	 <?php foreach($get_store_all as $sg) { ?>				 
      ['<b>Store Name:</b>&nbsp;<?php echo $sg->stor_name; ?>,<br/><b>Address:</b>&nbsp;<?php echo $sg->stor_address1; ?>,<br/><?php echo $sg->stor_address2; ?>,<br/><b>Phone:</b>&nbsp;<?php echo $sg->stor_phone; ?>',  <?php echo $sg->stor_latitude; ?>, <?php echo $sg->stor_longitude; ?>, 4],
      <?php } ?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
	  <?php foreach($get_default_city as $gd) { ?>	
      center: new google.maps.LatLng(<?php echo $gd->ci_lati; ?>, <?php echo $gd->ci_long; ?>),
	  <?php } ?>
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</div>

</div>
</div>

</div>


<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->

	{!! $footer !!}
<!-- Placed at the end of the document so the pages load faster ============================================= -->

	<script type="text/javascript" src="themes/js/slider/jquery.easing.1.3.js"></script>
	<!-- the jScrollPane script -->
	<script type="text/javascript" src="themes/js/slider/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="themes/js/slider/jquery.contentcarousel.js"></script>
	<script type="text/javascript">
		$('#ca-container').contentcarousel();
	</script>

</body>
</html>