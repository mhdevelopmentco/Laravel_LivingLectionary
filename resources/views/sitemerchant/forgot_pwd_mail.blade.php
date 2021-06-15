<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>Living Lectionary Admin Dashboard Template | Forgot Password Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
     <!-- PAGE LEVEL STYLES -->
     <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/login.css" />
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/magic/magic.css" />
<link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
     <!-- END PAGE LEVEL STYLES -->
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
      <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body style="background:url(assets/img/bg1.jpg) no-repeat center; background-position:cover" >

   <!-- PAGE CONTENT --> 
    <div class="container">
    <div class="text-center">
        <img src="<?php echo url('')?>/assets/img/logo~.png"  alt=" Logo" />
    </div>

    
    <div class="tab-content">
    
        <div id="login" class="tab-pane active"  >
        
   	{!! Form::open(array('url'=>'forgot_pwd_email_submit','class'=>'form-signin')) !!}


	@foreach($merchantdetails as $info)


<input type="hidden" value="<?php echo $info->mem_id;?>" name="merchant_id">
	@endforeach
<div id="error_msg"  style="color:#F00;font-weight:800"  > </div>        
 <p class="text-muted text-center btn-block  btn-primary    disabled">
                    MERCHANT PASSWORD RESET
                </p>
                <input type="password" class="form-control" placeholder="New Password" name="pwd" id="pwd"/>
                 <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpwd" id="confirmpwd"/>
               

		 <button id="updatepwd"   class="btn btn-warning btn-sm btn-grad" style="color:#fff"> Update</button>
            </form>
    @if (Session::has('error'))
		<div class="alert alert-danger alert-dismissable" align="center" style="height:50px;width:270px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{!! Session::get('error') !!}</div>
		@endif
        </div>
 
 
 
        
    </div>
    <div class="text-center ">
        <ul class="list-inline">
    
 		<li><a  href="<?php echo url('')?>/sitemerchant"    >Back To Login</a></li>
		 
        </ul>
    </div>


</div>

	  <!--END PAGE CONTENT -->     
	      
      <!-- PAGE LEVEL SCRIPTS -->
   <script src="<?php echo url('')?>/public/plugins/jquery-2.0.3.min.js"></script>

  <script>
   $(document).ready(function(){
		
var pwd= $('#pwd');
var confirmpwd= $('#confirmpwd');
	 $('#updatepwd').click(function() {
 
		 if(pwd.val()=="")
		{
			pwd.css('border', '1px solid red');
			confirmpwd.css('border', ''); 
			$('#error_msg').html('please provide new  password');
			pwd.focus();
			return false;
		}
		else if(confirmpwd.val()=="")
		{
			confirmpwd.css('border', '1px solid red');
			 pwd.css('border', ''); 
			$('#error_msg').html('please provide confirm password');
			confirmpwd.focus();
			return false;
		}
		else if(pwd.val() != confirmpwd.val())
		{
			confirmpwd.css('border', '1px solid red');
			pwd.css('border', '1px solid red');
			$('#error_msg').html('Both Passwords do not match');
			 
			return false;
		
		}
		 
		 
		

});
 });
   
   </script>

  
   <script src="<?php echo url('')?>/public/plugins/bootstrap/js/bootstrap.js"></script>
   <script src="<?php echo url('')?>/public/assets/js/login.js"></script>
      <!--END PAGE LEVEL SCRIPTS -->

</body>
    <!-- END BODY -->
</html>
