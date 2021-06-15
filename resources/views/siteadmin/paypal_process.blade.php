<?php
$p = new paypal_class;             // initiate an instance of the class
		$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
		//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
            
		// setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
		$this_script = url();

		// if there is not action variable, set the default action of 'process'
		
 
 
     $product_amount   = $amt;
     $item_name        = "Paying fund to".$name;
     $product_quantity = $_POST['quantity'];
     $custom           = $id;
	 $item_number      = $id;
    

	 $payment_email = $paymail;
 	 $product_quantity = 1;	  
	  
      $p->add_field('business', $payment_email);
      $p->add_field('return', $this_script.'/paypal_submit/success');
      $p->add_field('cancel_return', $this_script.'/paypal_cancel');
      $p->add_field('notify_url', $this_script.'/paypal_submit/ipn');
      $p->add_field('item_name', $item_name);
      $p->add_field('amount', $product_amount);
	  $p->add_field('quantity', $product_quantity);
	  $p->add_field('custom', $custom);
	  $p->add_field('item_number', $item_number);
	  $p->add_field('currency_code', 'USD');
      $p->submit_paypal_post();
?>