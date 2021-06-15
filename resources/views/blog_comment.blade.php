{!! $navbar !!}
<body>
<!-- Navbar ================================================== -->
{!! $header !!}
<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

	<div class="span9">
    <ul class="breadcrumb">
    <?php if($get_blog_list) { foreach($get_blog_list as $fetchblog_list) { } ?>
    <li><a href="<?php echo url(); ?>">Home</a></li>
    <li><a href="<?php echo url('blog'); ?>">BLOG</a></li>
    <li class="active"><?php echo $fetchblog_list->blog_title; ?></li>
    </ul>	
      @if (Session::has('success'))
		<div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
		@endif
    @if ($errors->any())
         <br>
		 <ul style="color:red;">
		<div class="alert alert-danger alert-dismissable">You Have Errors While Providing Comment.
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
		</ul>	
		@endif

<h4>CUSTOMER COMMENTS</h4>
    
    <?php foreach($get_blog_cus_cmt as $bolg_cmt) { ?>
	<div class="row-fluid">
    <div class="span2">
     <img src="<?php echo url(); ?>/themes/img/MemberAccounts.png" style="width:75px;height:70px;" >
     </div>
        <div class="span9">
     <h4><span style="color:#090;" ><?php  echo $bolg_cmt->cmt_name; ?></span><span style="font-size:13px;color:#ccc;padding-left:20px;"><?php echo $bolg_cmt->cmt_date; ?></span></h4>
    <p><?php  echo $bolg_cmt->cmt_msg; ?></p>
    </div>
    	
     <?php if($get_admin_reply[$bolg_cmt->cmt_id]) { 
	 $admin_reply_ans = explode("/@@/",$get_admin_reply[$bolg_cmt->cmt_id]);
	 ?>
     <div class="span9">
      <div class="span9">
    
    
    <h4> <i class="icon-user" style="padding-top:5px"></i><span style="color: #F00; font-size:12px; padding-left:5px;" >Admin</span><span style="font-size:13px;color:#ccc;padding-left:20px;"><?php echo $admin_reply_ans[1]; ?></span></h4>
     <p><?php  echo $admin_reply_ans[0]; ?></p>
    
     </div>
    
   
    </div>
    <?php } ?>
    
    </div>
    <br>
    <legend></legend>
    <?php } ?>
    
    
   
    <?php foreach($get_blog_comment_check as $check_comment_by_admin) 
	if($check_comment_by_admin->bs_allowcommt == 1) { ?>
    <div class="span9">
    <h5>Leave a Reply</h5>
    <div class="row">
    <div class="span6">
     {!! Form::open(array('url'=>'blog_comment_submit','class'=>'form-horizontal')) !!}<strong></strong>
      @if ($errors->any())
         <br>
		 <ul style="color:red;">
		<div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
		</ul>	
		@endif
      
    <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Name<span class="text-sub">*</span></label>

                    <div class="col-lg-8">
                    <input placeholder="" class="form-control span7" name="cmt_page" type="hidden" value="2">
                     <input placeholder="" class="form-control span7" name="cmt_id" type="hidden" value="<?php echo $fetchblog_list->blog_id; ?>">
                        <input placeholder="" class="form-control span7" type="text" name="name" value="{!! Input::old('name') !!}" >
                    </div>
                </div>
    </div>
    
    
    <div class="span6">
    	<div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Email<span class="text-sub">*</span></label>

                    <div class="col-lg-8">
                        <input placeholder="" class="form-control span7" type="text" name="email" value="{!! Input::old('email') !!}" >
                    </div>
                </div>
    </div>
    
    
    
    
    
    <div class="span6">
    	<div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Website</label>

                    <div class="col-lg-8">
                        <input placeholder="" class="form-control span7" type="text" name="website" value="{!! Input::old('website') !!}" >
                    </div>
                </div>
    </div>
    
    <div class="span6">
    <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Message<span class="text-sub">*</span></label>

                    <div class="col-lg-8">
                        <textarea  class="form-horizontal span7" rows="3" name="message" >{!! Input::old('message') !!}</textarea>
                    </div>
                </div>
    </div>
    
    
    <div class="span6">
    <button type="submit" class="btn btn-success large" > Submit comment </button>
    </div>
    </form>
    </div>
    <div class="row">
    </div>
    </div>
    <?php } } else { ?>
      <h4 style="color:#F00;">No Blogs Available...</h4>
    <?php } ?>
	</div>

<div class="span3" id="sidebar">


<div class="row">
    
    </div>
    
    <div class="clearfix"></div>
    
<div class="well well-small btn-warning" style="margin-top:10px;" ><strong>Categories</strong></div>
		<ul class="topnav">
    <?php foreach($getheader_category as $fetch_heder_category) {?>
	<li><a class="active" href="<?php echo url('blog_category/'.$fetch_heder_category->mc_id); ?>"><?php echo $fetch_heder_category->mc_name; ?></a></li>
    <?php } ?>
</ul>
		<br>
       
        <div class="row">
        <div class="span3 thumbnail">
        <h5>Popular Posts</h5>
        <legend></legend>
        <?php $count_popular= count($get_blog_list_popular);
		$pp = 1;
		 foreach($get_blog_list_popular as $fetch_popular_post){ 
		 ?>
        <a href="<?php echo url('blog_view/'.$fetch_popular_post->blog_id); ?>" style="color:#5AB45C;font-weight:700" ><?php echo $fetch_popular_post->blog_title; ?></a>
		<?php if($count_popular != $pp)
        { ?>
        <hr class="soft"/>
        <?php } ?>
       
        <?php $pp++; } ?>
        </div>
        </div>
       
	</div>
</div> </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->

	{!! $footer !!}

     <script type="text/javascript">
$(document).ready(function(){

$("#searchbox").keyup(function(e) 
{

var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;
if(searchbox=='')
{
$("#display").html("").hide();	
}
else
{
	var passData = 'searchword='+ searchbox;
	 $.ajax( {
			      type: 'GET',
				  data: passData,
				  url: '<?php echo url('autosearch'); ?>',
				  success: function(responseText){  
				  $("#display").html(responseText).show();	
}
});
}
return false;    

});
});
</script>
    <script src="<?php echo url(); ?>/public/plugins/plug-k/js/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo url(); ?>/public/plugins/plug-k/demo/js/demo.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo url(); ?>/themes/js/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="<?php echo url(); ?>/themes/js/scriptbreaker-multiple-accordion-1.js"></script>
    <script language="JavaScript">
    
    $(document).ready(function() {
        $(".topnav").accordion({
            accordion:true,
            speed: 500,
            closedSign: '<span class="icon-chevron-right"></span>',
            openedSign: '<span class="icon-chevron-down"></span>'
        });
    });
    
    </script>
</body>
</html>