<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Living Lectionary | Attributes Manage Sizes</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
   <!-- GLOBAL STYLES -->
  <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link href="<?php echo url('');?>/public/plugins/dataTables/css/dataTables.bootstrap.css" rel="stylesheet" />

     <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/theme.css" />
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/Font-Awesome/css/font-awesome.css" />
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
		<div></div>

         <!--PAGE CONTENT -->
        <div id="content">
           
                <div class="inner">
                    <div class="row">
                    <div class="col-lg-12">
                        	<ul class="breadcrumb">
                            	<li class=""><a >Home</a></li>
                                <li class="active"><a>Manage Sizes</a></li>
                            </ul>
                    </div>
                </div>
            <div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-edit"></i></div>
            <h5>Manage Sizes</h5>
            
        </header>
   
   
 <div class="row">
   	
    <div class="col-lg-11 panel_marg">
     @if ($errors->any())
         <br>
		 <ul style="color:red;">
		{!! implode('', $errors->all('<li>:message</li>')) !!}
		</ul>	
		@endif
    
          @if (Session::has('insert_result'))
		  <div class="alert alert-success alert-dismissable"> {!! Session::get('insert_result') !!}
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
		@endif
    	 @if (Session::has('delete_result'))
		  <div class="alert alert-success alert-dismissable"> {!! Session::get('delete_result') !!}
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
		@endif
        @if (Session::has('update_result'))
		  <div class="alert alert-success alert-dismissable"> {!! Session::get('update_result') !!}
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
		@endif
    	<table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width:10%;">S.No</th>
                  <th>Size</th>
				  <th class="text-center">Edit</th>
				  <th class="text-center">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php  $i = 1  ;
                 foreach ($size_result as $info) 
				 {
				 ?>
                <tr>
                  <td><?php echo $i; ?></td>
                
                  <td> {!!$info->si_name!!} </td>
				     
				   <td class="text-center"><a href="<?php echo url('mer_edit_size')."/".$info->si_id; ?>"><i class="icon icon-edit icon-2x"></i></a></td>
				    <td class="text-center"><a href="<?php echo url('mer_delete_size')."/".$info->si_id; ?>"><i class="icon icon-trash icon-2x"></i></a></td>
					
                </tr><?php 
                 $i++;
				 }
 				?>                    
              </tbody>
            </table>
    </div>
   
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
