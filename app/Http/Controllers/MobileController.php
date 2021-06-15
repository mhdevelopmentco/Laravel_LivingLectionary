<?php 
namespace App\Http\Controllers;
class MobileController extends BaseController {
	// HOme page sample api for client
	public function home_page_details()
	{
		
		$getbannerimagedetails    = Home::getbannerimagedetails();
		$most_visited_product     = Home::get_most_visited_product();
		$product_details          = Home::get_product_details();

		echo "<pre>";
		$banner = array();
		if(count($getbannerimagedetails) >0) {
			foreach($getbannerimagedetails as $bn) {
				$banner[] = array("bn_id"=>$bn->bn_id,"bn_title"=>$bn->bn_title,"bn_img"=>url()."/public/assets/images/bannerimage/".$bn->bn_img);
			}
		} else {
			$banner =array();
		}
		if(count($most_visited_product) >0) {
			foreach($most_visited_product as $mvp) {
				$product_img = explode('/**/', $mvp->pro_Img);
				$product_saving_price = $mvp->pro_price - $mvp->pro_price;
				$product_discount_percentage = round(($product_saving_price/ $mvp->pro_price)*100,2);
				$most_view_products[] = array("product_id"=>$mvp->pro_id,"product_title"=>strip_tags($mvp->pro_title),"product_original_price"=>$mvp->pro_price,"product_description"=>strip_tags($mvp->pro_desc),"product_image"=>url()."/public/assets/images/product/".$product_img[0]);
			}
		} else {
			$most_view_products =array();
		}
		if(count($product_details) >0) {
			foreach($product_details as $p) {
				if($p->pro_no_of_purchase < $p->pro_qty) {  
					$product_img = explode('/**/', $p->pro_Img);
					$product_saving_price = $p->pro_price - $p->pro_price;
					$product_discount_percentage = round(($product_saving_price/ $p->pro_price)*100,2);
				$products[] = array("product_id"=>$p->pro_id,"product_title"=>strip_tags($p->pro_title),"product_original_price"=>$p->pro_price,"product_discount_percentage"=>substr($product_discount_percentage,0,2),"product_image"=>url()."/public/assets/images/product/".$product_img[0]);
				}
			}
		} else {
			$products =array();
		}
		
		echo json_encode(array("status"=>1,"message"=>"Success","banner_details"=>$banner,"most_view_products"=>$most_view_products,"product_details"=>$products));
		exit;
	}

	public function home_page_banner_image()
	{
		
      	 $get_banner_img_details  = MobileModel::get_banner_img_details();
	
		
	}
	
	
	public function all_main_category_list()
	{
		$get_main_category_list  = MobileModel::get_all_category_list();
		/*$i=0;
		$json=array("result"=>"Success");
		$result_arr['Maincategory_List'] = array();
		foreach($get_main_category_list as $data)
		{
		$result[$i]['mc_id']=$data->mc_id;
		$result[$i]['mc_name'] = strip_tags($data->mc_name);		
		$result[$i]['mc_img']   = url()."/public/assets/images/category/".$data->mc_img;
		
		$i++;
		}
		array_push($result_arr['Maincategory_List'],$result);
		$encode = array_merge($json,$result_arr);
		return Response::make(json_encode($encode, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");*/
	}
	
	public function sub_category_list($mc_id)
	{
		$get_sub_category_list = MobileModel::get_sub_category_list($mc_id);
	}
	
	

	public function home_page()
	{

      	 $product_details  = MobileModel::get_product_details();
	
		
	}
	
	public function product_mobile_category_list($id)
	{
		//echo $id;exit;
		//$product_details  = MobileModel::get_category_product_details($id);
		$product_details  = MobileModel::get_selected_product_details($id);//print_r($product_details);exit;
		$product_detail_view  = MobileModel::get_category_product_detail_view($product_details);

	}
	
	
	public function product_detail_page_image_list($id)
	{
		$product_details  = MobileModel::get_selected_product_detail_image($id);//print_r($product_details);exit;
		

	}
	
	public function deal_detail_page_image_list($id)
	{
		$product_details  = MobileModel::get_selected_deal_detail_image($id);//print_r($product_details);exit;
		

	}
	
	
	
	/*public function product_category_list_detail_view($id)
	{
		$product_details  = MobileModel::get_selected_product_details($id);
		$product_detail_view  = MobileModel::get_category_product_detail_view($product_details);
	}*/


	

	public function country_list()
	{
	$country_list  = MobileModel::get_country_list();	
	}

	public function mobile_city_list()
	{
	$city_list  = MobileModel::get_mobile_city_list();	
	}
	
	public function country_selected_city($id)
	{
	$city_list  = MobileModel::get_selected_coutry_list($id);	
	}


	public function user_signup($name,$email,$password,$country,$city)
	{
		
		$signup_details  = MobileModel::user_signup_check($name,$email,$password,$country,$city);
		
		
	}
	
	
	public function facebook_login($name,$email)
	{
		
		$facebook_login  = MobileModel::facebook_login($name,$email);
		
		
	}
	
	
	public function user_login($email,$password)
	{
		
		$login_check = MobileModel::user_login_check($email,$password);
	}
	
	
	public function shipping_address_detail($mem_id,$cust_name,$cust_address1,$cust_mobile,$cust_country,$cust_city,$zip_code)
	{
		$insert_shipping_detail=MobileModel::insert_shipping_address($mem_id,$cust_name,$cust_address1,$cust_mobile,$cust_country,$cust_city,$zip_code);
	}
	
	
	
	public function product_my_buys($id)
	{
	$product_buying_list  = MobileModel::product_my_buys($id);	
	}

	
	public function shipping_delivery($mem_id,$cust_name,$cust_address,$cust_mobile,$cust_city,$cust_country,$cust_zip)
	{
		
		
		$insert_shipping_detail=MobileModel::insert_shipping_details($mem_id,$cust_name,$cust_address,$cust_mobile,$cust_city,$cust_country,$cust_zip);
		
		//$shippingdetails=MobileModel::get_shipping_details();
	}
	
	public function purchase_cod_order_list($mem_id,$pro_id,$cod_qty,$cod_amt,$cod_pro_color_id,$cod_pro_size_id,$order_type,$ship_addr,$token_id)
	{
		$shippingdetails=MobileModel::get_pruchase_cod_order_details($mem_id,$pro_id,$cod_qty,$cod_amt,$cod_pro_color_id,$cod_pro_size_id,$order_type,$ship_addr,$token_id);
	}
	
		public function paypal($mem_id,$pro_id,$cod_qty,$cod_amt,$cod_pro_color_id,$cod_pro_size_id,$order_type,$ship_addr,$token_id)
	{
		$shippingdetails=MobileModel::insert_paypal($mem_id,$pro_id,$cod_qty,$cod_amt,$cod_pro_color_id,$cod_pro_size_id,$order_type,$ship_addr,$token_id);
	}
	
	
	public function products()
	{
		
		
		$product_details  = MobileModel::get_product_detail_list();		
		
	}	
	


	public function mobile_bid_payment($bid_auc_id,$oa_cus_id,$oa_cus_name,$oa_cus_email,$oa_cus_address,$oa_bid_amt,$oa_bid_shipping_amt,$oa_original_bit_amt)
	{
		
		
		$get_acution_details  = MobileModel::get_action_details_by_id($bid_auc_id,$oa_cus_id,$oa_cus_name,$oa_cus_email,$oa_cus_address,$oa_bid_amt,$oa_bid_shipping_amt,$oa_original_bit_amt);
	}
	
	public function update_user_profile($mem_id,$name,$email,$phone,$country_id,$city_id)
	{
		
		$update_details  = MobileModel::update_user_profile($mem_id,$name,$email,$phone,$country_id,$city_id);	
	}
	
	
	public function profile_image_submit($mem_id)
	{
		
		
		   $file_path = "assets/profileimage/";
		  $file = $_FILES['uploaded_file']['name'];
     
   $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
   if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
	   $updateimage=Member::update_profileimage($mem_id,$file);
       echo "success";
   } else{
       echo "fail";
   }
		
		/*$base=$_REQUEST['image'];echo $base;
		$name = $_POST['imname'];echo $name;
		$binary=base64_decode($base);
		header('Content-Type: bitmap; charset=utf-8');
		$file = fopen("/assets/profileimage/".$name.".jpg", 'w');
		fwrite($file, $binary);
		fclose($file);
		echo 'Image upload complete!!';*/

		
		
 		
			/*$filename = $file->getClientOriginalName();
			$move_img = explode('.',$filename);
			$filename = $move_img[0].str_random(8).".".$move_img[1];
			$destinationPath = './assets/profileimage/';
			
			$uploadSuccess = $file->move($destinationPath,$filename);
			
			$updateimage=Member::update_profileimage($mem_id,$file);*/
			
	}	 
	
	
	public function bidding_history($mem_id)
	{
		$bidding_history  = MobileModel::get_profile_bidhistory($mem_id);	
	}
	
	
	public function near_me_map_products()
	{
		$near_me_map_products  = MobileModel::near_me_map_products();	
	}
	

	public function near_me_map_auction()
	{
		$near_me_map_acution  = MobileModel::near_me_map_acution();	
	}
	
	
	public function stores_list()
	{
		$stores_list  = MobileModel::stores_list();	
		$get_stores_deal_count = MobileModel::get_stores_deal_count($stores_list);
	}
	
	public function get_profile_image($mem_id)
	{
		$get_image_detail  = MobileModel::get_profile_image($mem_id);	
	}
	
	
		public function terms_condition()
	{
		$termconditiondetails=MobileModel::terms_condition();
	}
	
	public function related_product_details($pid)
	{
		
		$product_details  = MobileModel::get_related_selected_product_details($pid);
		$product_detail_view  = MobileModel::get_related_category_product_detail_view($product_details);

	}
	

	public function add_position()
	{
		$addsdetails=MobileModel::add_position();
	}
	
	public function add_pages()
	{
		$addsdetails=MobileModel::add_pages();
	}
	
	
	public function request_for_advertisment($add_title,$ads_position,$ads_pages,$url)
	{
		
		 $updateimage=MobileModel::insert_adds($add_title,$ads_position,$ads_pages,$url);
		
		   $file_path = "assets/adimage/";
		  $file = $_FILES['uploaded_file']['name'];
		 
	   $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
	   if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
		   
		   echo "success";
	   } else{
		   echo "fail";
	   }
   
	}
	
	
	public function store_dealview_detail_by_id($storeid)
	{
		
		$store_details  = MobileModel::store_dealview_detail_by_id($storeid);
		//$store_detail_view  = MobileModel::get_related_category_product_detail_view($store_details);

	}
	
	
	public function store_productview_detail_by_id($storeid)
	{
		
		$store_details  = MobileModel::store_productview_detail_by_id($storeid);
	}
	
	public function forgot_password_check($user_email)
	{
		$encode_email = base64_encode(base64_encode(base64_encode(($user_email))));

		$check_valid_email=Userlogin::checkvalidemail($user_email);
		if($check_valid_email)
		{
			
		 $customername=$check_valid_email[0]->mem_name;
			 include('library/SMTP/Send_Mail.php');
			 $subject="Password Link.....";
			 $emailsubject="PAssword Link.....";
 			 ob_start();
			 include('/app/views/forgotpassword.php');
			 $body=ob_get_contents();
			 ob_clean();
		 
		 
			 Send_Mail($user_email,$subject,$body);;		
			 
 			echo $json='{ "result" : "Please check your email for further instructions"}';	
		}
    
			
		else
		{
			 echo $json='{ "result" : "Fail"}';	

		}
		
		
	}
	
	
}

?>
