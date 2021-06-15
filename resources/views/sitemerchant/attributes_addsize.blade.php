<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Living Lectionary | Attributes Add Size</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link href="<?php echo url('');?>/public/plugins/dataTables/css/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/theme.css" />
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/Font-Awesome/css/font-awesome.css" />
     <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <!--END GLOBAL STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
      <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->

</head>
     <!-- END HEAD -->

     <!-- BEGIN BODY -->
<body class="padTop53 " >

    <!-- MAIN WRAPPER -->
    <div id="wrap">


         <!-- HEADER SECTION -->
        {!! $merchantheader !!}
        <!-- END HEADER SECTION -->
        <!-- MENU SECTION -->
      {!! $merchantleftmenus !!}
        <!--END MENU SECTION -->

		<div></div>

         <!--PAGE CONTENT -->
        <div id="content">
           
                <div class="inner">
                    <div class="row">
                    <div class="col-lg-12">
                        	<ul class="breadcrumb">
                            	<li class=""><a >Home</a></li>
                                <li class="active"><a >Add Size</a></li>
                            </ul>
                    </div>
                </div>
            <div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-edit"></i></div>
            <h5>Add Size</h5>            
            
        </header>
         @if ($errors->any()) 
		<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
		@endif
        @if (Session::has('exist_result'))
		 <div class="alert alert-danger alert-dismissable">{!! Session::get('exist_result') !!}
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         </div>
		@endif
        <div id="div-1" class="accordion-body collapse in body">
		
            {!! Form::open(array('url'=>'mer_addsize_submit','class'=>'form-horizontal')) !!}
			

                <div class="form-group">
        
                    <label for="text1" class="control-label col-lg-1">Size <span class="text-sub">*</span></label>

                    <div class="col-lg-3">
                        <input id="text1" placeholder="Size" name="file_size" class="form-control" type="text" value="{!! Input::old('si_name') !!}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass1" class="control-label col-lg-1"><span  class="text-sub"></span></label>
                    <div class="col-lg-8">
                     <button class="btn btn-warning btn-sm btn-grad"  type="submit" style="color:#fff">Save</a></button>
                     <button class="btn btn-default btn-sm btn-grad" type="reset" style="color:#000">Reset</a></button>
                    </div>
					  
                </div>

                
        {!! Form::close() !!}
        </div>
    </div>
</div>
   
    </div>
                    
                    </div>
                    
                    
                    

                </div>
            <!--END PAGE CONTENT -->
 
        </div>
    
     <!--END MAIN WRAPPER -->

    <!-- FOOTER -->
   {!! $merchantfooter !!}
    <!--END FOOTER -->


     <!-- GLOBAL SCRIPTS -->
    <script src="<?php echo url()."/"; ?>assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="<?php echo url()."/"; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo url()."/"; ?>assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->   
     
</body>
     <!-- END BODY -->
</html>
