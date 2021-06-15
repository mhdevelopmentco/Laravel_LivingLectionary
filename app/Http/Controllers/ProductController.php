<?php
namespace App\Http\Controllers;

use App\Curator;
use App\Dashboard;
use App\Home;
use App\Http\Models;
use App\Member;
use App\Merchant;
use App\Order;
use App\OrderShip;
use App\Products;
use App\Theme;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Session;

class ProductController extends Controller
{


    /*
    
    |--------------------------------------------------------------------------
    
    | Default Home Controller
    
    |--------------------------------------------------------------------------
    
    |
    
    | You may wish to use controllers instead of, or in addition to, Closure
    
    | based routes. That's great! Here is an example controller method to
    
    | get you started. To route to this controller, just add the route:
    
    |
    
    |	Route::get('/', 'HomeController@showWelcome');
    
    |
    
    */


    public function manage_pending_approved_product()
    {
        if (Session::has('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');
            if ($from_date || $to_date) {
                $products = Products::pending_approved_products_by_period($from_date, $to_date);
            } else {
                $products = Products::pending_approved_products();
            }

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');

            $adminfooter = view('siteadmin.includes.admin_footer');


            return view('siteadmin.manage_product')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('products', $products)->with('type', 1);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function manage_disapproved_product()
    {
        if (Session::has('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');
            if ($from_date || $to_date) {
                $products = Products::disapproved_products_by_period($from_date, $to_date);
            } else {
                $products = Products::disapproved_products();
            }

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');
            $adminfooter = view('siteadmin.includes.admin_footer');

            return view('siteadmin.manage_product')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('products', $products)->with('type', 0);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function add_product()
    {

        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');

            $adminfooter = view('siteadmin.includes.admin_footer');

            $productcategory = Products::get_product_category();

            $merchantdetails = Products::get_merchant_details();

            $theme_details = ThemeController::get_affirmation_level_list();

            $max_file_size = ProductController::max_file_upload_in_bytes();

            $max_file_size_str = ProductController::formatSizeUnits($max_file_size);

            return view('siteadmin.add_product')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('productcategory', $productcategory)->with('merchantdetails', $merchantdetails)
                ->with('theme_details', $theme_details)->with('max_file_size', $max_file_size)->with('max_file_size_str', $max_file_size_str);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function add_product_submit()
    {

        if (Session::has('userid')) {

            $max_file_size = ProductController::max_file_upload_in_bytes();

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            $data = Input::except(array(
                '_token'
            ));

            $Product_Title = Input::get('Product_Title');

            //theme select
            $theme_selection = Input::get('selected_theme');

            $themeids = explode(',', $theme_selection);
            $new_theme_ids = explode(',', $theme_selection);


            foreach ($themeids as $theme_id) {

                $theme = Theme::find($theme_id);

                if ($theme) {
                    $parent_theme_id = $theme->parent_theme;

                    if ($parent_theme_id != 0) {
                        //check whether parent theme exist
                        if (!in_array($parent_theme_id, $new_theme_ids)) {
                            array_push($new_theme_ids, $parent_theme_id);
                        }
                    }
                }
            }

            $theme_selection = implode(',', $new_theme_ids);

            $select_theme = str_replace(',', ':', $theme_selection);

            $select_theme = rtrim($select_theme, ':');

            $Product_Category = Input::get('Product_Category');

            /*$Product_MainCategory = Input::get('Product_MainCategory');

            $Product_SubCategory = Input::get('Product_SubCategory');

            $Product_SecondSubCategory = Input::get('Product_SecondSubCategory');*/


            $price_free = Input::get('product_price_free');

            if ($price_free == 1) {
                $Original_Price = 0;
            } else {
                $Original_Price = Input::get('Original_Price');
            }

            $Description = Input::get('Description');

            $scripture = Input::get('Scripture');

            $Select_Merchant = Input::get('Select_Merchant');

            $Select_Shop = Input::get('Select_Shop');

            $postfb = Input::get('postfb');

            $product_content = Input::get('product_content');


            $Shipping_Amount = 0;
            $filename_down = $product_link = "";

            if ($product_content == 1) {
                //product content = 1
                $Shipping_Amount = Input::get('Shipping_Amount');

                if ($Shipping_Amount == "") {
                    $Shipping_Amount = 0;
                }
            } else if ($product_content == 2) {
                //product content =2

                $file_down = Input::file('file_down');
                if ($file_down) {

                    $dest_dir = './public/assets/images/product/download';

                    if (!file_exists($dest_dir))
                        $result = File::makeDirectory($dest_dir, 0777, true);

                    $filedownname = $file_down->getClientOriginalName();
                    $ext = pathinfo($filedownname, PATHINFO_EXTENSION);

                    $filename_down = str_replace(array(' ', '?', '<', '>', '&', '{', '}', '*'), array('_'), $filedownname);
                    $uploadSuccess2 = Input::file('file_down')->move($dest_dir, $filename_down);
                }
            } else if ($product_content == 3) {
                //product content 3
                $product_link = Input::get('product_link');
            }

            $check_store = Products::check_store($Product_Title, $Select_Shop);

            if ($check_store) {
                return Redirect::to('add_product')->with('message', 'The Product Already exist in the Store');
            } else {

                //upload file product images
                $count = Input::get('count');
                $aid = Input::get('aid');

                $filename_new_get = "";
                $destination_path = './public/assets/images/product/';

                $first = true;
                for ($i = 1; $i < $aid; $i++) {

                    if (Input::file('file_more' . $i)) {
                        $file_more = Input::file('file_more' . $i);
                        $filename_new = ImageEditController::save_image_edited($file_more, Input::get('x' . $i), Input::get('y' . $i), Input::get('w' . $i), Input::get('h' . $i), $destination_path);

                        if ($first) {
                            $filename_new_get .= $filename_new;
                            $first = false;
                        } else {
                            $filename_new_get .= "/**/" . $filename_new;
                        }

                    }
                }

                $filename = "";
                if (Input::file('file')) {
                    $file = Input::file('file');
                    $filename = ImageEditController::save_image_edited($file, Input::get('x0'), Input::get('y0'), Input::get('w0'), Input::get('h0'), $destination_path);
                    $file_name_insert = $filename . "/**/" . $filename_new_get;
                } else {
                    $file_name_insert = $filename_new_get;
                }


                $curators = Curator::get()->all();
//                if ($curator) {
//                    $curator_id = $curator->id;
//                } else {
//                    //there is no curator for this theme.
//                    //then add to this to admin
//                    $curator_id = -1;
//                }

                $merchant = Member::find($Select_Merchant);
                $merchant_email = $merchant->mem_email;
                $merchant_name = $merchant->mem_fname . ' ' . $merchant->mem_lname;

                $merchant_self = $merchant->mer_self;
                $pro_approved_status = ($merchant_self) ? Products::PRODUCT_STATUS_APPROVED : Products::PRODUCT_STATUS_PENDING;
                $pro_checked_by = ($merchant_self) ? 0 : -1;

                $entry = array(


                    'pro_title' => $Product_Title,

                    'pro_mc_id' => $Product_Category,

                    /*'pro_smc_id' => $Product_MainCategory,

                    'pro_sb_id' => $Product_SubCategory,

                    'pro_ssb_id' => $Product_SecondSubCategory,*/

                    'pro_free' => $price_free,

                    'pro_price' => $Original_Price,

                    'pro_content_kind' => $product_content,

                    'pro_shippamt' => $Shipping_Amount,

                    'pro_file_down' => $filename_down,

                    'pro_file_link' => $product_link,

                    'pro_desc' => $Description,

                    'pro_mr_id' => $Select_Merchant,

                    'pro_sh_id' => $Select_Shop,

                    'pro_scripture' => $scripture,

                    'pro_Img' => $file_name_insert,

                    'pro_image_count' => $count + 1,

                    'pro_theme_ids' => $select_theme,

                    'pro_checked_by' => $pro_checked_by,

                    'pro_approved_status' => $pro_approved_status,

                    'pro_status' => Products::PRODUCT_STATUS_ACTIVATED,

                    'created_date' => $date

                );

                $productid = Products::insert_product($entry);


                //if curator exist, send info to curator

                if ($_SERVER['HTTP_HOST'] != 'localhost') {


                    //send mail to merchant : $Product_Title, $productid
                    Mail::send('emails.merchant_product_upload', array('merchant_name' => $merchant_name, 'product_title' => $Product_Title, 'product_id' => $productid),
                        function ($message) use ($merchant_email) {
                            $message->to($merchant_email)->subject("Your resource has been submitted successfully");
                        });

                    //send mail to curator
                    if ($curators) {
                        foreach ($curators as $curator) {
                            if ($curator && $curator->has_theme_in_charge($select_theme)) {
                                $curator_email = $curator->curator_email;
                                $curator_name = $curator->curator_name;
                                $curator_product_id = base64_encode($productid);
                                Mail::send('emails.curator_product_upload_inform', array('curator_name' => $curator_name, 'merchant_name' => $merchant_name, 'product_title' => $Product_Title, 'product_id' => $curator_product_id),
                                    function ($message) use ($curator_email) {
                                        $message->to($curator_email)->subject("New content is ready for review at This We Affirm");
                                    });
                            }
                        }
                    }
                }
            }
            return Redirect::to('manage_pending_approved_product')->with('message', "New Product Uploaded");

        } else {
            return Redirect::to('siteadmin');

        }
    }

    public function edit_product($id)
    {

        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');

            $adminfooter = view('siteadmin.includes.admin_footer');

            $category = Products::get_product_category();

            $product = Products::get_product($id);
            $product = $product[0];

            $merchantdetails = Products::get_merchant_details();

            $theme_details = ThemeController::get_affirmation_level_list();

            $max_file_size = ProductController::max_file_upload_in_bytes();
            $max_file_size = ProductController::formatSizeUnits($max_file_size);

            //used_theme
            $used_array = [];
            $used_theme = Products::used_theme($id);
            foreach ($used_theme as $ut) {
                $used_array[] = $ut->theme_id;
            }
            //not used theme
            $not_used_theme = Products::not_used_theme($id);

            return view('siteadmin.edit_product')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('category', $category)->with('theme_details', $theme_details)
                ->with('product', $product)->with('merchantdetails', $merchantdetails)
                ->with('used_theme', $used_array)->with('not_used_theme', $not_used_theme)
                ->with('max_file_size', $max_file_size);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function edit_product_submit()
    {

        if (Session::has('userid')) {

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            $id = Input::get('product_edit_id');

            $origin_product = Products::find($id);

            //theme select
            $theme_selection = Input::get('selected_theme');

            $themeids = explode(',', $theme_selection);
            $new_theme_ids = explode(',', $theme_selection);

            foreach ($themeids as $theme_id) {

                $theme = Theme::find($theme_id);

                if ($theme) {

                    $parent_theme_id = $theme->parent_theme;
                    if ($parent_theme_id != 0) {
                        //check whether parent theme exist
                        if (!in_array($parent_theme_id, $new_theme_ids)) {
                            array_push($new_theme_ids, $parent_theme_id);
                        }
                    }
                }

            }

            $theme_selection = implode(',', $new_theme_ids);

            $select_theme = str_replace(',', ':', $theme_selection);

            $select_theme = rtrim($select_theme, ':');

            $img_count = Input::get('count');

            $aid = Input::get('aid');

            $filename_new_get = "";

            $dest_path = './public/assets/images/product/';

            //add new file image from divTXT
            $first = true;

            for ($i = 0; $i < $aid; $i++) {

                $file_more = Input::file('file_more' . $i);

                $file_more_new = Input::get('file_more_new' . $i);

                if ($file_more && $file_more_new) {

                    $file_name_new = ImageEditController::save_image_edited($file_more, Input::get('x' . $i), Input::get('y' . $i), Input::get('w' . $i), Input::get('h' . $i), $dest_path);

                    $file_old = $file_more_new;
                    if ($file_old) {
                        $file_old_name = $dest_path . $file_old;
                        unlink($file_old_name);
                    }

                    if ($first) {
                        $first = false;
                        $filename_new_get = $file_name_new;
                        continue;
                    } else {
                        $filename_new_get .= "/**/" . $file_name_new;
                    }

                } else if (!$file_more && $file_more_new) {
                    $file_name_new = $file_more_new;

                    if ($first) {
                        $first = false;
                        $filename_new_get = $file_name_new;
                        continue;
                    } else {
                        $filename_new_get .= "/**/" . $file_name_new;
                    }
                } else if ($file_more && !$file_more_new) {

                    $file_name_new = ImageEditController::save_image_edited($file_more, Input::get('x' . $i), Input::get('y' . $i), Input::get('w' . $i), Input::get('h' . $i), $dest_path);

                    if ($first) {
                        $first = false;
                        $filename_new_get = $file_name_new;
                        continue;
                    } else {
                        $filename_new_get .= "/**/" . $file_name_new;
                    }

                }

            }

            //First image
            $file = Input::file('file0');

            if ($file == "") {

                $filename = Input::get('file_new0');

            } else {

                $filename = ImageEditController::save_image_edited($file, Input::get('x0'), Input::get('y0'), Input::get('w0'), Input::get('h0'), $dest_path);
            }

            $file_name_insert = $filename . "/**/" . $filename_new_get;

            $id = Input::get('product_edit_id');

            $Product_Title = Input::get('Product_Title');

            $Product_Category = Input::get('category');

            /*$Product_MainCategory = Input::get('maincategory');

            $Product_SubCategory = Input::get('subcategory');

            $Product_SecondSubCategory = Input::get('secondsubcategory');*/

            $price_free = Input::get('product_price_free');

            if ($price_free == 1) {
                $Original_Price = 0;
            } else {
                $Original_Price = Input::get('Original_Price');
            }

            $Shipping_Amount = Input::get('Shipping_Amount');

            if ($Shipping_Amount == "") {

                $Shipping_Amount = 0;

            }

            $Description = Input::get('Description');

            $scripture = Input::get('Scripture');

            $Select_Merchant = Input::get('Select_Merchant');

            $Select_Shop = Input::get('Select_Shop');

            $postfb = Input::get('postfb');

            $img_count = Input::get('count');

            $product_content = Input::get('product_content');

            //product content = 1
            if ($product_content == 1) {
                $Shipping_Amount = Input::get('Shipping_Amount');

                if ($Shipping_Amount == "") {
                    $Shipping_Amount = 0;
                }
            } else {
                $Shipping_Amount = 0;
            }


            $filename_down = $origin_product->pro_file_down;

            if ($product_content == 2) {
                //product content =2
                $file_down = Input::file('file_down');
                if ($file_down) {
                    $dest_dir = './public/assets/images/product/download';

                    if (!file_exists($dest_dir))
                        $result = File::makeDirectory($dest_dir, 0777, true);

                    $filedownname = $file_down->getClientOriginalName();
                    $ext = pathinfo($filedownname, PATHINFO_EXTENSION);

                    $filename_down = str_replace(array(' ', '?', '<', '>', '&', '{', '}', '*'), array('_'), $filedownname);
                    $uploadSuccess2 = Input::file('file_down')->move($dest_dir, $filename_down);
                }
            }


            //product content 3
            if ($product_content == 3) {
                $product_link = Input::get('product_link');
            } else {
                $product_link = "";
            }


            $entry = array(

                'pro_title' => $Product_Title,

                'pro_mc_id' => $Product_Category,

                /*'pro_smc_id' => $Product_MainCategory,

                'pro_sb_id' => $Product_SubCategory,

                'pro_ssb_id' => $Product_SecondSubCategory,*/

                'pro_free' => $price_free,

                'pro_price' => $Original_Price,

                'pro_content_kind' => $product_content,

                'pro_shippamt' => $Shipping_Amount,

                'pro_file_down' => $filename_down,

                'pro_file_link' => $product_link,

                'pro_desc' => $Description,

                'pro_mr_id' => $Select_Merchant,

                'pro_sh_id' => $Select_Shop,

                'pro_scripture' => $scripture,

                'pro_Img' => $file_name_insert,

                'pro_image_count' => $img_count,

                'pro_theme_ids' => $select_theme,

                'updated_at' => $date

            );

            $return = Products::edit_product($entry, $id);

            $product = Products::find($id);
            if ($product->pro_approved_status == Products::PRODUCT_STATUS_NOT_APPROVED) {
                return Redirect::to('manage_disapproved_product')->with('message', 'Product Updated Successfully');
            } else {
                return Redirect::to('manage_pending_approved_product')->with('message', 'Product Updated Successfully');
            }
        } else {

            return Redirect::to('siteadmin');

        }


    }

    public function delete_product($id)
    {

        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $del_pro = Products::delete_product($id);
            return Redirect::back()->with('message', 'Product Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function block_product($id, $status)
    {

        if (Session::has('userid')) {

            $entry = array(

                'pro_status' => $status

            );

            Products::block_product_status($id, $entry);

            if ($status == 1) {

                return Redirect::back()->with('message', 'Product unblocked');

            } else if ($status == 0) {

                return Redirect::back()->with('message', 'Product Blocked');

            }

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function set_trending_product($id, $status)
    {

        if (Session::has('userid')) {

            $entry = array(
                'pro_trending' => $status
            );

            Products::set_product_status($id, $entry);

            if ($status == 1) {
                return Redirect::back()->with('message', 'Product Set as Trending');
            } else if ($status == 0) {

                return Redirect::back()->with('message', 'Product Set as No Trending');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function set_present_product($id, $status)
    {

        if (Session::has('userid')) {

            $entry = array(
                'pro_present' => $status
            );

            Products::set_product_status($id, $entry);

            if ($status == 1) {
                return Redirect::back()->with('message', 'Product Set as Present Free for Subscriber');
            } else if ($status == 0) {

                return Redirect::back()->with('message', 'Product Set as No Present Free for Subscriber');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function product_details($id)
    {
        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $id = base64_decode($id);

            $get_product = Products::get_product_view($id);
            if (count($get_product) > 0) {
                $product = $get_product[0];
            } else {
                return Redirect::to('siteadmin_dashboard')->withError("That product doesn't exist");
            }

            $used_theme = Products::used_theme($id);

            return view('siteadmin.product_details')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('product', $product)->with('used_theme', $used_theme);
        } else {

            return Redirect::to('siteadmin');

        }

    }

    //show sold products
    public function sold_product()
    {
        if (Session::has('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date)
                $sold_products = Dashboard::get_sold_products_by_period($from_date, $to_date);
            else
                $sold_products = Dashboard::get_sold_products();

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');
            $adminfooter = view('siteadmin.includes.admin_footer');

            return view('siteadmin.sold_products')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('sold_products', $sold_products);

        } else {
            return Redirect::to('siteadmin');
        }
    }

    //show shipping and delivery status
    public function manage_product_shipping_details()
    {
        if (Session::has('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date)
                $sold_products = Dashboard::get_sold_shipping_products_by_period($from_date, $to_date);
            else
                $sold_products = Dashboard::get_sold_shipping_products();

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');
            $adminfooter = view('siteadmin.includes.admin_footer');

            return view('siteadmin.shipping_list')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('sold_products', $sold_products);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    //merchant: product controll
    public function mer_manage_pending_approved_product()
    {
        if (Session::has('merchantid')) {
            $merchant_id = Session::get('merchantid');

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $products = Products::get_merchant_pending_approved_products_by_period($from_date, $to_date, $merchant_id);
            } else {
                $products = Products::get_merchant_pending_approved_products($merchant_id);
            }


            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "product");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_product');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            return view('sitemerchant.manage_product')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('products', $products)->with('type', 1);

        } else {
            return Redirect::to('sitemerchant');
        }

    }

    //merchant: product controll
    public function mer_manage_disapproved_product()
    {
        if (Session::has('merchantid')) {
            $merchant_id = Session::get('merchantid');

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $products = Products::get_merchant_disapproved_products_by_period($from_date, $to_date, $merchant_id);
            } else {
                $products = Products::get_merchant_disapproved_products($merchant_id);
            }

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "product");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_product');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            return view('sitemerchant.manage_product')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('products', $products)->with('type', 0);

        } else {
            return Redirect::to('sitemerchant');
        }

    }

    public function mer_add_product()
    {
        if (Session::has('merchantid')) {

            $merchantid = Session::get('merchantid');

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "product");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_product');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $productcategory = Products::get_product_category();
            $storedetails = Merchant::get_store_from_merchant($merchantid);
            $theme_details = ThemeController::get_affirmation_level_list();

            $max_file_size = ProductController::max_file_upload_in_bytes();
            $max_file_size_str = ProductController::formatSizeUnits($max_file_size);

            return view('sitemerchant.add_product')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('productcategory', $productcategory)->with('store_details', $storedetails)
                ->with('theme_details', $theme_details)->with('max_file_size', $max_file_size)
                ->with('max_file_size_str', $max_file_size_str);
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function mer_add_product_submit()
    {

        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');

            $max_file_size = ProductController::max_file_upload_in_bytes();

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            $data = Input::except(array(
                '_token'
            ));

            $Product_Title = Input::get('Product_Title');

            //theme select
            $theme_selection = Input::get('selected_theme');


            $themeids = explode(',', $theme_selection);
            $new_theme_ids = explode(',', $theme_selection);


            foreach ($themeids as $theme_id) {

                $theme = Theme::find($theme_id);

                if ($theme) {

                    $parent_theme_id = $theme->parent_theme;
                    if ($parent_theme_id != 0) {
                        //check whether parent theme exist
                        if (!in_array($parent_theme_id, $new_theme_ids)) {
                            array_push($new_theme_ids, $parent_theme_id);
                        }
                    }
                }

            }

            $theme_selection = implode(',', $new_theme_ids);

            $select_theme = str_replace(',', ':', $theme_selection);

            $select_theme = rtrim($select_theme, ':');

            $Product_Category = Input::get('Product_Category');

            /*$Product_MainCategory = Input::get('Product_MainCategory');

            $Product_SubCategory = Input::get('Product_SubCategory');

            $Product_SecondSubCategory = Input::get('Product_SecondSubCategory');*/


            $price_free = Input::get('product_price_free');

            if ($price_free == 1) {
                $Original_Price = 0;
            } else {
                $Original_Price = Input::get('Original_Price');
            }

            $Description = Input::get('Description');

            $Scripture = Input::get('Scripture');

            $Select_Shop = Input::get('Select_Shop');

            $postfb = Input::get('postfb');

            $product_content = Input::get('product_content');

            $Shipping_Amount = 0;
            $filename_down = $product_link = "";

            if ($product_content == 1) {
                //product content = 1
                $Shipping_Amount = Input::get('Shipping_Amount');

                if ($Shipping_Amount == "") {
                    $Shipping_Amount = 0;
                }
            } else if ($product_content == 2) {
                //product content =2

                $file_down = Input::file('file_down');
                if ($file_down) {

                    $dest_dir = './public/assets/images/product/download';

                    if (!file_exists($dest_dir))
                        $result = File::makeDirectory($dest_dir, 0777, true);

                    $filedownname = $file_down->getClientOriginalName();
                    $ext = pathinfo($filedownname, PATHINFO_EXTENSION);

                    $filename_down = str_replace(array(' ', '?', '<', '>', '&', '{', '}', '*'), array('_'), $filedownname);
                    $uploadSuccess2 = Input::file('file_down')->move($dest_dir, $filename_down);
                }
            } else if ($product_content == 3) {
                //product content 3
                $product_link = Input::get('product_link');
            }

            $check_store = Products::check_store($Product_Title, $Select_Shop);

            if ($check_store) {
                return Redirect::to('mer_add_product')->with('message', 'The Product Already exist in the Store');
            } else {

                //upload file product images
                $count = Input::get('count');
                $aid = Input::get('aid');

                $filename_new_get = "";
                $destination_path = './public/assets/images/product/';

                $first = true;
                for ($i = 1; $i < $aid; $i++) {

                    if (Input::file('file_more' . $i)) {
                        $file_more = Input::file('file_more' . $i);
                        $filename_new = ImageEditController::save_image_edited($file_more, Input::get('x' . $i), Input::get('y' . $i), Input::get('w' . $i), Input::get('h' . $i), $destination_path);

                        if ($first) {
                            $filename_new_get .= $filename_new;
                            $first = false;
                        } else {
                            $filename_new_get .= "/**/" . $filename_new;
                        }

                    }
                }

                $filename = "";
                if (Input::file('file')) {
                    $file = Input::file('file');
                    $filename = ImageEditController::save_image_edited($file, Input::get('x0'), Input::get('y0'), Input::get('w0'), Input::get('h0'), $destination_path);
                    $file_name_insert = $filename . "/**/" . $filename_new_get;
                } else {
                    $file_name_insert = $filename_new_get;
                }


                $curators = Curator::get()->all();

//                if ($curator) {
//                    $curator_id = $curator->id;
//                } else {
//                    //there is no curator for this theme.
//                    //then add to this to admin
//                    $curator_id = -1;
//                }

                $merchant = Member::find($merchant_id);
                $merchant_email = $merchant->mem_email;
                $merchant_name = $merchant->mem_fname . ' ' . $merchant->mem_lname;

                $merchant_self = $merchant->mer_self;

                $pro_approved_status = ($merchant_self) ? Products::PRODUCT_STATUS_APPROVED : Products::PRODUCT_STATUS_PENDING;
                $pro_checked_by = ($merchant_self) ? 0 : -1;

                $entry = array(

                    'pro_title' => $Product_Title,

                    'pro_mc_id' => $Product_Category,

                    /*'pro_smc_id' => $Product_MainCategory,

                    'pro_sb_id' => $Product_SubCategory,

                    'pro_ssb_id' => $Product_SecondSubCategory,*/

                    'pro_free' => $price_free,

                    'pro_price' => $Original_Price,

                    'pro_content_kind' => $product_content,

                    'pro_shippamt' => $Shipping_Amount,

                    'pro_file_down' => $filename_down,

                    'pro_file_link' => $product_link,

                    'pro_desc' => $Description,

                    'pro_mr_id' => $merchant_id,

                    'pro_sh_id' => $Select_Shop,

                    'pro_scripture' => $Scripture,

                    'pro_Img' => $file_name_insert,

                    'pro_image_count' => $count + 1,

                    'pro_theme_ids' => $select_theme,

                    'pro_checked_by' => $pro_checked_by,

                    'pro_approved_status' => $pro_approved_status,

                    'pro_status' => Products::PRODUCT_STATUS_ACTIVATED,

                    'created_date' => $date

                );

                $productid = Products::insert_product($entry);


                //if curator exist, send info to curator

                if ($_SERVER['HTTP_HOST'] != 'localhost') {

                    //send mail to merchant : $Product_Title, $productid
                    Mail::send('emails.merchant_product_upload', array('merchant_name' => $merchant_name, 'product_title' => $Product_Title, 'product_id' => $productid),
                        function ($message) use ($merchant_email) {
                            $message->to($merchant_email)->subject("Your resource has been submitted successfully");
                        });

                    //send mail to curator
                    if ($curators && !$merchant_self) {
                        foreach ($curators as $curator) {
                            if ($curator && $curator->has_theme_in_charge($select_theme)) {
                                $curator_email = $curator->curator_email;
                                $curator_name = $curator->curator_name;
                                $curator_product_id = base64_encode($productid);
                                Mail::send('emails.curator_product_upload_inform', array('curator_name' => $curator_name, 'merchant_name' => $merchant_name, 'product_title' => $Product_Title, 'product_id' => $curator_product_id),
                                    function ($message) use ($curator_email) {
                                        $message->to($curator_email)->subject("New content is ready for review at This We Affirm");
                                    });
                            }
                        }
                    }
                }
            }

            return Redirect::to('mer_manage_pending_approved_product')->with('message', 'New Product Uploaded');

        } else {
            return Redirect::to('sitemerchant');

        }
    }

    public function mer_edit_product($id)
    {
        if (Session::has('merchantid')) {

            $merchantid = Session::get('merchantid');

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "product");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_product');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $productcategory = Products::get_product_category();
            $storedetails = Merchant::get_store_from_merchant($merchantid);
            $theme_details = ThemeController::get_affirmation_level_list();

            $max_file_size = ProductController::max_file_upload_in_bytes();
            $max_file_size_str = ProductController::formatSizeUnits($max_file_size);

            $product = Products::findOrFail($id);

            //used_theme
            $used_array = [];
            $used_theme = Products::used_theme($id);
            foreach ($used_theme as $ut) {
                $used_array[] = $ut->theme_id;
            }
            //not used theme
            $not_used_theme = Products::not_used_theme($id);

            return view('sitemerchant.edit_product')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('productcategory', $productcategory)->with('store_details', $storedetails)
                ->with('theme_details', $theme_details)->with('max_file_size', $max_file_size)
                ->with('used_theme', $used_array)->with('not_used_theme', $not_used_theme)
                ->with('max_file_size_str', $max_file_size_str)->with('product', $product);
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function mer_edit_product_submit()
    {

        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            $id = Input::get('product_edit_id');

            $origin_product = Products::find($id);

            //theme select
            $theme_selection = Input::get('selected_theme');


            $themeids = explode(',', $theme_selection);
            $new_theme_ids = explode(',', $theme_selection);


            foreach ($themeids as $theme_id) {

                $theme = Theme::find($theme_id);

                if ($theme) {

                    $parent_theme_id = $theme->parent_theme;
                    if ($parent_theme_id != 0) {
                        //check whether parent theme exist
                        if (!in_array($parent_theme_id, $new_theme_ids)) {
                            array_push($new_theme_ids, $parent_theme_id);
                        }
                    }
                }

            }

            $theme_selection = implode(',', $new_theme_ids);

            $select_theme = str_replace(',', ':', $theme_selection);

            $select_theme = rtrim($select_theme, ':');

            $img_count = Input::get('count');

            $aid = Input::get('aid');

            $filename_new_get = "";

            $dest_path = './public/assets/images/product/';

            //add new file image from divTXT
            $first = true;
            for ($i = 1; $i < $aid; $i++) {

                if (Input::file('file_more' . $i) && Input::get('file_more_new' . $i)) {

                    $file_more = Input::file('file_more' . $i);

                    $file_name_new = ImageEditController::save_image_edited($file_more, Input::get('x' . $i), Input::get('y' . $i), Input::get('w' . $i), Input::get('h' . $i), $dest_path);

                    $file_old = Input::get('file_more_new' . $i);
                    if ($file_old) {
                        $file_old_name = $dest_path . $file_old;
                        unlink($file_old_name);
                    }

                    if ($first) {
                        $first = false;
                        $filename_new_get = $file_name_new;
                        continue;
                    } else {
                        $filename_new_get .= "/**/" . $file_name_new;
                    }

                } else if (!Input::file('file_more' . $i) && Input::get('file_more_new' . $i)) {
                    $file_name_new = Input::get('file_more_new' . $i);

                    if ($first) {
                        $first = false;
                        $filename_new_get = $file_name_new;
                        continue;
                    } else {
                        $filename_new_get .= "/**/" . $file_name_new;
                    }
                } else if (Input::file('file_more' . $i) && !Input::get('file_more_new' . $i)) {
                    $file_more = Input::file('file_more' . $i);

                    $file_name_new = ImageEditController::save_image_edited($file_more, Input::get('x' . $i), Input::get('y' . $i), Input::get('w' . $i), Input::get('h' . $i), $dest_path);

                    if ($first) {
                        $first = false;
                        $filename_new_get = $file_name_new;
                        continue;
                    } else {
                        $filename_new_get .= "/**/" . $file_name_new;
                    }

                }

            }

            //First image
            $file = Input::file('file0');

            if ($file == "") {

                $filename = Input::get('file_new0');

            } else {

                $filename = ImageEditController::save_image_edited($file, Input::get('x0'), Input::get('y0'), Input::get('w0'), Input::get('h0'), $dest_path);
            }

            $file_name_insert = $filename . "/**/" . $filename_new_get;

            $id = Input::get('product_edit_id');

            $Product_Title = Input::get('Product_Title');

            $Product_Category = Input::get('category');

            /*$Product_MainCategory = Input::get('maincategory');

            $Product_SubCategory = Input::get('subcategory');

            $Product_SecondSubCategory = Input::get('secondsubcategory');*/

            $price_free = Input::get('product_price_free');

            if ($price_free == 1) {
                $Original_Price = 0;
            } else {
                $Original_Price = Input::get('Original_Price');
            }

            $Shipping_Amount = Input::get('Shipping_Amount');

            if ($Shipping_Amount == "") {

                $Shipping_Amount = 0;

            }

            $Description = Input::get('Description');

            $scripture = Input::get('Scripture');

            $Select_Shop = Input::get('Select_Shop');

            $postfb = Input::get('postfb');

            $img_count = Input::get('count');

            $product_content = Input::get('product_content');

            //product content = 1
            if ($product_content == 1) {
                $Shipping_Amount = Input::get('Shipping_Amount');

                if ($Shipping_Amount == "") {
                    $Shipping_Amount = 0;
                }
            } else {
                $Shipping_Amount = 0;
            }


            $filename_down = $origin_product->pro_file_down;

            if ($product_content == 2) {
                //product content =2
                $file_down = Input::file('file_down');
                if ($file_down) {
                    $dest_dir = './public/assets/images/product/download';

                    if (!file_exists($dest_dir))
                        $result = File::makeDirectory($dest_dir, 0777, true);

                    $filedownname = $file_down->getClientOriginalName();
                    $ext = pathinfo($filedownname, PATHINFO_EXTENSION);

                    $filename_down = str_replace(array(' ', '?', '<', '>', '&', '{', '}', '*'), array('_'), $filedownname);
                    $uploadSuccess2 = Input::file('file_down')->move($dest_dir, $filename_down);
                }
            }


            //product content 3
            if ($product_content == 3) {
                $product_link = Input::get('product_link');
            } else {
                $product_link = "";
            }


            $entry = array(

                'pro_title' => $Product_Title,

                'pro_mc_id' => $Product_Category,

                /*'pro_smc_id' => $Product_MainCategory,

                'pro_sb_id' => $Product_SubCategory,

                'pro_ssb_id' => $Product_SecondSubCategory,*/

                'pro_free' => $price_free,

                'pro_price' => $Original_Price,

                'pro_content_kind' => $product_content,

                'pro_shippamt' => $Shipping_Amount,

                'pro_file_down' => $filename_down,

                'pro_file_link' => $product_link,

                'pro_desc' => $Description,

                'pro_mr_id' => $merchant_id,

                'pro_sh_id' => $Select_Shop,

                'pro_scripture' => $scripture,

                'pro_Img' => $file_name_insert,

                'pro_image_count' => $img_count,

                'pro_theme_ids' => $select_theme,

                'updated_at' => $date,
            );

            $return = Products::edit_product($entry, $id);

            $product = Products::find($id);
            if ($product->pro_approved_status == Products::PRODUCT_STATUS_NOT_APPROVED) {
                return Redirect::to('mer_manage_disapproved_product')->with('message', 'Product Updated Successfully');
            } else {
                return Redirect::to('mer_manage_pending_approved_product')->with('message', 'Product Updated Successfully');
            }

        } else {

            return Redirect::to('sitemerchant');

        }

    }

    public function mer_delete_product($id)
    {
        if (Session::has('merchantid')) {

            $del_pro = Products::delete_product($id);

            return Redirect::back()->with('message', 'Product Deleted Successfully');

        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function mer_block_product($id, $status)
    {
        if (Session::has('merchantid')) {
            $entry = array(
                'pro_status' => $status
            );
            Products::block_product_status($id, $entry);
            if ($status == 1) {
                return Redirect::back()->with('message', 'Product unblocked');
            } else if ($status == 0) {
                return Redirect::back()->with('message', 'Product Blocked');
            }
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function mer_set_trending_product($id, $status)
    {
        if (Session::has('merchantid')) {
            $entry = array(
                'pro_trending' => $status
            );
            Products::set_product_status($id, $entry);
            if ($status == 1) {
                return Redirect::back()->with('message', 'Product Set as Trending');
            } else if ($status == 0) {
                return Redirect::back()->with('message', 'Product Set as No Trending');
            }
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function mer_set_present_product($id, $status)
    {
        if (Session::has('merchantid')) {
            $entry = array(
                'pro_present' => $status
            );
            Products::set_product_status($id, $entry);
            if ($status == 1) {
                return Redirect::back()->with('message', 'Product Set as Present Free for Subscriber');
            } else if ($status == 0) {
                return Redirect::back()->with('message', 'Product Set as No Present Free for Subscriber');
            }
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function mer_product_details($id)
    {

        if (Session::has('merchantid')) {

            $merchantid = Session::get('merchantid');

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "product");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_product');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $id = base64_decode($id);

            $get_product = Products::get_product_view($id);
            if (count($get_product) > 0) {
                $product = $get_product[0];
            } else {
                return Redirect::back()->withError("That product doesn't exist");
            }

            $used_theme = Products::used_theme($id);

            return view('sitemerchant.product_details')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('product', $product)->with('used_theme', $used_theme);
        } else {

            return Redirect::to('sitemerchant');

        }

    }

    public function mer_sold_product()
    {
        if (Session::has('merchantid')) {

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "product");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_product');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $merchant_id = Session::get('merchantid');
            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date)
                $sold_products = Merchant::get_mer_sold_products_by_period($merchant_id, $from_date, $to_date);
            else
                $sold_products = Merchant::get_mer_sold_resources($merchant_id);


            return view('sitemerchant.sold_products')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('sold_products', $sold_products);

        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function mer_manage_product_shipping_details()
    {

        if (Session::has('merchantid')) {

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "product");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_product');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $merid = Session::get('merchantid');

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date)
                $sold_products = Merchant::get_mer_sold_products_by_period($merid, $from_date, $to_date);
            else
                $sold_products = Merchant::get_mer_sold_resources($merid);

            return view('sitemerchant.shipping_list')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('sold_products', $sold_products);


        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function report_as_delivered($sold_product_id)
    {
        $sold_product = OrderShip::find($sold_product_id);
        if ($sold_product) {
            $sold_product->update(array('ship_status' => OrderShip::ORDERSHIP_STATUS_DELIVERED));

            //check order's status
            $order_id = $sold_product->order_id;
            $order = Order::find($order_id);
            $order->check_order_status();
        }
        return Redirect::to('mer_manage_product_shipping_details');
    }

    //get category <->subcategory
    public function product_getmaincategory()
    {

        $categoryid = $_GET['id'];

        $main_category = Products::load_maincategory_ajax($categoryid);

        return response()->json(['subcategories' => $main_category]);
    }

    public function product_getsubcategory()
    {

        $categoryid = $_GET['id'];

        $sub_category = Products::load_subcategory_ajax($categoryid);

        return response()->json(['subcategories' => $sub_category]);
    }

    public function product_getsecondsubcategory()
    {

        $categoryid = $_GET['id'];

        $secondsub_category = Products::get_second_sub_category_ajax($categoryid);

        return response()->json(['subcategories' => $secondsub_category]);

    }

    public function product_getsubcategory_list($level)
    {
        $categoryid = $_GET['id'];

        $sub_category = [];

        if ($level == 1) {
            $sub_category = Products::load_maincategory_ajax($categoryid);
        } else if ($level == 2) {
            $sub_category = Products::load_subcategory_ajax($categoryid);
        } else if ($level == 3) {
            $sub_category = Products::get_second_sub_category_ajax($categoryid);
        }

        return $sub_category;
    }

    public function Product_edit_getsecondsubcategory()
    {

        $id = $_GET['edit_second_sub_id'];

        $main_cat = Products::get_second_sub_category_ajax_edit($id);

        if ($main_cat) {

            $return = "";

            foreach ($main_cat as $main_cat_ajax) {

                $return = "<option value='" . $main_cat_ajax->ssb_id . "' selected> " . $main_cat_ajax->ssb_name . " </option>";

            }

            echo $return;

        } else {

            echo $return = "<option value='0'> No datas found </option>";

        }

    }

    //get product shop details
    public function product_getmerchantshop()
    {
        $id = $_GET['id'];
        $shop_det = Member::get_store_from_merchant($id);
        return response()->json(['shops' => $shop_det]);
    }

    //zipcode
    public function add_estimated_zipcode()
    {

        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menus');

            $adminfooter = view('siteadmin.includes.admin_footer');

            $zipcode = Products::get_zipcode();

            return view('siteadmin.add_estimated_zipcode')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('zipcode', $zipcode);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function add_estimated_zipcode_submit()
    {

        if (Session::has('userid')) {

            $data = Input::except(array(
                '_token'
            ));

            $rule = array(

                'zip_code' => 'required|numeric',

                'zip_code2' => 'required|numeric',

                'delivery_days' => 'required|numeric'

            );

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {

                return Redirect::to('add_estimated_zipcode')->withErrors($validator->messages())->withInput();

            } else {

                $check1 = Products::check_zip_code(Input::get('zip_code'));

                if ($check1) {

                    return Redirect::to('add_estimated_zipcode')->with('success', 'Start code already exist')->withInput();

                } else {

                    $check2 = Products::check_zip_code(Input::get('zip_code2'));

                    if ($check2) {

                        return Redirect::to('add_estimated_zipcode')->with('success', 'End code already exist')->withInput();

                    } else {

                        $check3 = Products::check_zip_code_range(Input::get('zip_code'), Input::get('zip_code2'));

                        if ($check3) {

                            return Redirect::to('add_estimated_zipcode')->with('success', 'The Range Overlaps')->withInput();

                        } else {

                            $entry = array(

                                'ez_code_series' => Input::get('zip_code'),

                                'ez_code_series_end' => Input::get('zip_code2'),

                                'ez_code_days' => Input::get('delivery_days')

                            );

                            $return = Products::save_zip_code($entry);

                            return Redirect::to('estimated_zipcode')->with('success', 'Record Updated Successfully');

                        }

                    }

                }

            }

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function estimated_zipcode()
    {

        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menus');

            $adminfooter = view('siteadmin.includes.admin_footer');

            $zipcode = Products::get_zipcode();

            return view('siteadmin.estimated_zipcode')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('zipcode', $zipcode);


        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function edit_zipcode($id)
    {

        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menus');

            $adminfooter = view('siteadmin.includes.admin_footer');

            $zipcode = Products::edit_zip_code($id);

            return view('siteadmin.edit_estimated_zipcode')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('zipcode', $zipcode);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function edit_estimated_zipcode_submit()
    {

        if (Session::has('userid')) {

            $data = Input::except(array(
                '_token'
            ));

            $rule = array(

                'zip_code' => 'required|numeric',

                'zip_code2' => 'required|numeric',

                'delivery_days' => 'required|numeric'

            );

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {

                return Redirect::to('edit_zipcode/' . Input::get('id'))->withErrors($validator->messages())->withInput();


            } else {

                $check = Products::check_zip_code_edit(Input::get('id'), Input::get('zip_code'));

                if ($check) {

                    return Redirect::to('edit_zipcode/' . Input::get('id'))->with('success', 'Start code already exist')->withInput();

                } else {

                    $check1 = Products::check_zip_code_edit(Input::get('id'), Input::get('zip_code2'));

                    if ($check1) {

                        return Redirect::to('edit_zipcode/' . Input::get('id'))->with('success', 'End code already exist')->withInput();

                    } else {

                        $check2 = Products::check_zip_code_edit_range(Input::get('id'), Input::get('zip_code'), Input::get('zip_code2'));

                        if ($check2) {

                            return Redirect::to('edit_zipcode/' . Input::get('id'))->with('success', 'The Range Overlaps')->withInput();

                        } else {

                            $entry = array(

                                'ez_code_series' => Input::get('zip_code'),

                                'ez_code_series_end' => Input::get('zip_code2'),

                                'ez_code_days' => Input::get('delivery_days')

                            );


                            $return = Products::update_zip_code($entry, Input::get('id'));

                            return Redirect::to('estimated_zipcode')->with('message', 'ZipCode Updated Successfully');

                        }

                    }

                }


            }

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function block_zipcode($id, $status)
    {

        if (Session::has('userid')) {

            Products::block_zip_code($id, $status);

            if ($status == 1) {

                return Redirect::to('estimated_zipcode')->with('message', 'ZipCode Activated Successfully');
            } else {

                return Redirect::to('estimated_zipcode')->with('message', 'ZipCode Blocked Successfully');

            }

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function remove_zipcode($id)
    {
        if (Session::has('userid')) {
            Products::remove_zip_code($id);
            return Redirect::to('estimated_zipcode')->with('message', 'ZipCode Removed Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    //Product Review: only for admin
    public function manage_review()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');

            $adminfooter = view('siteadmin.includes.admin_footer');

            $get_review = Products::get_product_review();

            return view('siteadmin.manage_review')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('get_review', $get_review);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_review($id)
    {

        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");

            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');

            $adminfooter = view('siteadmin.includes.admin_footer');

            $result = Products::edit_review($id);

            return view('siteadmin.edit_review')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('result', $result);

        } else {

            return Redirect::to('siteadmin');

        }

    }

    public function edit_review_submit()
    {
        if (Session::has('userid')) {
            $now = date('Y-m-d H:i:s');

            $inputs = Input::all();
            $review_id = Input::get('comment_id');
            $review_title = Input::get('review_title');
            $review_comment = Input::get('review_comment');

            $entry = array(
                'title' => $review_title,
                'comments' => $review_comment,
            );
            $return = Products::update_review($entry, $review_id);
            return Redirect::to('manage_review');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_review($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $del_review = Products::delete_review($id);
            return Redirect::to('manage_review')->with('product Deleted', 'Review Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function block_review($id, $status)
    {

        if (Session::has('userid')) {

            $entry = array(

                'status' => $status

            );

            Products::block_review_status($id, $entry);

            if ($status == 0) {

                return Redirect::to('manage_review')->with('block_message', 'Product unblocked');

            } else if ($status == 1) {

                return Redirect::to('manage_review')->with('block_message', 'Product Blocked');

            }

        } else {

            return Redirect::to('siteadmin');

        }

    }

    //Save Resource Image After Cropeed
    public function save_product_image_edited($file, $x, $y, $w, $h, $path)
    {
        $filename_new_get = "";

        $file_more_name = $file->getClientOriginalName();
        $move_more_img = explode('.', $file_more_name);
        $filename_new = $move_more_img[0] . str_random(8) . "." . $move_more_img[1];


        $filename_new_get .= $filename_new;

        if ($file->move($path, $filename_new)) {
            $save_file = $path . $filename_new;
            $extension = File::extension($save_file);

            if ($extension == "png") {
                $quality = 1;
                $img = imagecreatefrompng($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagepng($dest, $save_file, $quality);
            } else if ($extension == "jpg" || $extension == "jpeg") {
                $quality = 90;
                $img = imagecreatefromjpeg($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagejpeg($dest, $save_file, $quality);
            } else if ($extension == "gif") {

                $img = imagecreatefromgif($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagegif($dest, $save_file);
            } else {
                //
            }
        }

        return $filename_new_get;
    }

    //search by product name
    public function instant_search_by_name()
    {
        $key = $_GET['product_name'];
        $products = Home::get_product_list_search($key);
        $products = $products->get();

        if ($products) {
            $return = "";

            foreach ($products as $product) {
                $return .= "<option value='" . $product->pro_id . "'> " . $product->pro_title . " </option>";
            }
            echo $return;
        } else {
            echo $return = "";
        }

    }

    //product upload size
    public function return_bytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $val;
    }

    public function max_file_upload_in_bytes()
    {
        //select maximum upload size
        $max_upload = ProductController::return_bytes(ini_get('upload_max_filesize'));
        //select post limit
        $max_post = ProductController::return_bytes(ini_get('post_max_size'));
        //select memory limit
        $memory_limit = ProductController::return_bytes(ini_get('memory_limit'));
        // return the smallest of them, this defines the real limit
        return min($max_upload, $max_post, $memory_limit);
    }

    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }

    //download pdf file
    public function download_product_file($filename)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = './public/assets/images/product/download/' . $filename;
        return Response::download($file);
    }

}
