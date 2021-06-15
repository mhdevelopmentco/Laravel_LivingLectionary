<body>
	{!! $navbar !!}

<!-- Navbar ================================================== -->
	{!! $header !!}
<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<h4>Sold products</h4>
      <legend></legend>
<div class="row">
<?php if($get_store_product_by_id) { 
$sold_product_error = "";	?>	
     <?php foreach($get_store_product_by_id as $fetch_most_visit_pro) { 
	  if($fetch_most_visit_pro->pro_no_of_purchase >= $fetch_most_visit_pro->pro_qty) {
             $mcat = strtolower(str_replace(' ','-',$fetch_most_visit_pro->mc_name));
             $smcat = strtolower(str_replace(' ','-',$fetch_most_visit_pro->smc_name));
	     $sbcat = strtolower(str_replace(' ','-',$fetch_most_visit_pro->sb_name));
             $ssbcat = strtolower(str_replace(' ','-',$fetch_most_visit_pro->ssb_name)); 
	     $res = base64_encode($fetch_most_visit_pro->pro_id);
	   $sold_product_error = 1;	
	  $mostproduct_saving_price = $fetch_most_visit_pro->pro_price - $fetch_most_visit_pro->pro_price;
			 $mostproduct_discount_percentage = round(($mostproduct_saving_price/ $fetch_most_visit_pro->pro_price)*100,2);
			 $mostproduct_img = explode('/**/', $fetch_most_visit_pro->pro_Img);
	 ?>
        <div class="span3  thumbnail tab-sold-wid" style="width:240px;margin-bottom:20px">
        <span class="sold"></span>
        <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res!!}"><img alt="" src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $mostproduct_img[0]; ?>" height="215px"></a>
       <?php } ?>
       <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$res!!}" ><img alt="" src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $mostproduct_img[0]; ?>" height="215px"></a>
      <?php } ?>
      <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$res!!}" ><img alt="" src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $mostproduct_img[0]; ?>" height="215px"></a>
 <?php } ?>
        
  <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<h4><a class="s_detail" href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res!!}"><?php echo substr($fetch_most_visit_pro->pro_title,0,20);  ?>...</a></h4>
       <?php } ?>
       <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<h4><a class="s_detail" href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$res!!}"><?php echo substr($fetch_most_visit_pro->pro_title,0,20);  ?>...</a></h4>
      <?php } ?>
      <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<h4><a class="s_detail" href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$res!!}"><?php echo substr($fetch_most_visit_pro->pro_title,0,20);  ?>...</a></h4>
 <?php } ?>
        
       
                            
        </div>	
		<?php } } } else { ?>	
     <h5 style="color:#933;" >No records found under products.</h5>
        <?php } ?>
         <?php if($sold_product_error != 1) { ?>
          <h5 style="color:#933;" >No records found under deals.</h5>
          <?php } ?>
	  </div>
     
      
    
 <h4>Sold deals</h4>
      <legend></legend>
	  <div class="row">	
        <?php  if($get_store_deal_by_id) {
				
		$sold_deal_error = "";		 ?>
     <?php $date = date('Y-m-d H:i:s');
	  foreach($get_store_deal_by_id as $store_deal_by_id) { 
		
		 if($date > $store_deal_by_id->deal_end_date) {
		 $sold_deal_error = 1;
	  	 $dealdiscount_percentage = $store_deal_by_id->deal_discount_percentage;
		 $deal_img= explode('/**/', $store_deal_by_id->deal_image);
             $mcat = strtolower(str_replace(' ','-',$store_deal_by_id->mc_name));
             $smcat = strtolower(str_replace(' ','-',$store_deal_by_id->smc_name));
	     $sbcat = strtolower(str_replace(' ','-',$store_deal_by_id->sb_name));
             $ssbcat = strtolower(str_replace(' ','-',$store_deal_by_id->ssb_name)); 
	     $res = base64_encode($store_deal_by_id->deal_id);
	 ?>
        <div class="span3  thumbnail tab-sold-wid" style="width:240px;margin-bottom:20px">
        <i class="sold"></i>
<?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<a href="{!! url('dealview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res!!}"><img src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deal_img[0]; ?>" alt="" height="215px"></a>
       <?php } ?>
       <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<a href="{!! url('dealview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$res!!}" ><img src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deal_img[0]; ?>" alt="" height="215px"></a>
      <?php } ?>
      <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<a href="{!! url('dealview').'/'.$mcat.'/'.$smcat.'/'.$res!!}" ><img src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deal_img[0]; ?>" alt="" height="215px"></a>
 <?php } ?>
     
       <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
<h4> <a href="{!! url('dealview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res!!}" class="s_detail"><?php echo substr($store_deal_by_id->deal_title,0,20);  ?></a></h4>
       <?php } ?>
       <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
<h4> <a href="{!! url('dealview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$res!!}" class="s_detail"><?php echo substr($store_deal_by_id->deal_title,0,20);  ?></a></h4>
      <?php } ?>
      <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
<h4> <a href="{!! url('dealview').'/'.$mcat.'/'.$smcat.'/'.$res!!}" class="s_detail"><?php echo substr($store_deal_by_id->deal_title,0,20);  ?></a></h4>
 <?php } ?>
        
                    
        </div>	
        <?php } } } else { ?>
      <h5 style="color:#933;" >No records found under deals.</h5>
          <?php } ?>
          <?php  if($sold_deal_error != 1) { ?>
          <h5 style="color:#933;" >No records found under deals.</h5>
          <?php } ?>
	  </div>
</div>

</div>
</div>
<!-- Footer ================================================================== -->

	{!! $footer !!}
<!-- Placed at the end of the document so the pages load faster ============================================= -->

	
    
    
    <script src="plug-k/js/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="plug-k/demo/js/demo.js" type="text/javascript"></script>
	

<script type="text/javascript" src="<?php echo url(); ?>/themes/js/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="<?php echo url(); ?>/themes/js/scriptbreaker-multiple-accordion-1.js"></script>
    <script language="JavaScript">
    
    $(document).ready(function() {
        $(".topnav").accordion({
            accordion:false,
            speed: 500,
            closedSign: '<span class="icon-chevron-right"></span>',
            openedSign: '<span class="icon-chevron-down"></span>'
        });
    });
    
    </script>
</body>
</html>