<?php namespace App\Http\Controllers;

use App\Curator;
use App\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Member;
use App\Products;
use App\Theme;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class CuratorController extends Controller
{

    /**
     * dashboard
     * */
    
    //show all curators from admin dashboard
    public function manage_curator()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "curator");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_curator');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $curators = Curator::get()->all();
            $themes = Theme::get_theme_normal_list();

            return view('siteadmin.manage_curator')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('curators', $curators)->with('themes', $themes);

        } else {
            return Redirect::to('siteadmin');
        }
    }

    //show add curator page from admin dashboard
    public function add_curator()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "curator");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_curator');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $themes = ThemeController::get_affirmation_level_list();

            return view('siteadmin.add_curator')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('theme_details', $themes);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    //add curator from admin dashboard
    public function add_curator_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));

            $rule = array(
                'curator_name' => 'required',
                'curator_email' => 'required|email',
                'curator_userid' => 'required',
                'selected_curator_theme' => 'required',
                'curator_pwd' => 'required'
            );

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {

                return Redirect::to('add_curator')->withErrors($validator->messages())->withInput();

            } else {
                $curator_email = Input::get('curator_email');
                $check_curator_id = Curator::where('curator_email', $curator_email)->get();

                $curator_userid = Input::get('curator_userid');
                $check_curator_userid = Curator::where('curator_userid', $curator_userid)->get();

                if (count($check_curator_id) > 0) {
                    return Redirect::to('add_curator')->withErrors('Same Email Exist')->withInput();
                } else if (count($check_curator_userid) > 0) {
                    return Redirect::to('add_curator')->withErrors("Already Curator Id Exists")->withInput();
                } else {

                    $filename = "";
                    $path = './public/assets/images/curator/';

                    if (!file_exists($path))
                        $result = File::makeDirectory($path, 0777, true);

                    $file = Input::file('file');

                    //upload curator image
                    if ($file) {
                        $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $path);
                    }

                    $curator_name = Input::get('curator_name');


                    $curator_theme = Input::get('selected_curator_theme');
                    $selected_theme = str_replace(',', ':', $curator_theme);
                    $selected_theme = rtrim($selected_theme, ':');


                    $curator_password = Input::get('curator_pwd');
                    $encrypt_pwd = md5($curator_password);

                    date_default_timezone_set("America/New_York");
                    $date = date('Y-m-d H:i:s');

                    //Insert Curator
                    $curator_entry = array(
                        'curator_name' => $curator_name,
                        'curator_email' => $curator_email,
                        'curator_userid' => $curator_userid,
                        'curator_pwd' => $encrypt_pwd,
                        'curator_theme' => $selected_theme,
                        'curator_img' => $filename,
                        'status' => 1,
                        'created_at' => $date,
                        'updated_at' => $date,
                    );

                    $inserted_curator = Curator::create($curator_entry);

                    $curator_id = $inserted_curator->curator_id;

//                    //update all product curator info: selected_theme
//                    $products = Products::all();
//                    foreach ($products as $product) {
//                        if ($product->has_theme_id($curator_theme)) {
//                            $product->pro_checked_by = $curator_id;
//                            $product->save();
//                        }
//                    }

                    $send_mail_data = array(
                        'curator_name' => $curator_name,
                        'curator_email' => $curator_email,
                        'curator_userid' => $curator_userid,
                        'password' => $curator_password,
                        'curator_img' => $filename,
                    );

                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.curator_register_email', $send_mail_data, function ($message) use ($curator_email) {
                            $message->to($curator_email)->subject('Curator Account Created Successfully');
                        });
                    }

                    return Redirect::to('manage_curator')->with('success', 'Curator Inserted Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    //edit curator from admin dashbaord
    public function edit_curator($id)
    {
        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "curator");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_curator');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $curator = Curator::findOrFail($id);
            $themes = ThemeController::get_affirmation_level_list();

            //used_theme
            $used_array = [];
            $used_theme = Curator::used_theme($id);
            foreach ($used_theme as $ut) {
                $used_array[] = $ut->theme_id;
            }

            return view('siteadmin.edit_curator')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('curator', $curator)->with('theme_details', $themes)->with('used_theme', $used_array);

        } else {
            return Redirect::to('siteadmin');
        }
    }

    //submit edit curator from admin dashboard
    public function edit_curator_submit()
    {
        if (Session::has('userid')) {

            $data = Input::except(array(
                '_token'
            ));

            $curator_id = Input::get('curator_id');
            $curator = Curator::find($curator_id);

            $selected_theme = $curator->curator_theme;

            $rule = array(
                'curator_name' => 'required',
                'curator_email' => 'required|email',
                'curator_userid' => 'required',
                'selected_curator_theme' => 'required',
            );

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {

                return Redirect::to('edit_curator/'.$curator_id)->withErrors($validator->messages())->withInput();

            } else {

                $curator_email = Input::get('curator_email');
                $check_curator_id = Curator::where('curator_email', $curator_email)->where('id', '!=', $curator_id)->get();

                $curator_userid = Input::get('curator_userid');
                $check_curator_userid = Curator::where('curator_userid', $curator_userid)->where('id', '!=', $curator_id)->get();

                if (count($check_curator_id) > 0) {
                    return Redirect::to('edit_curator/' . $curator_id)->withErrors('Same Email Exist')->withInput();
                } else if (count($check_curator_userid) > 0) {
                    return Redirect::to('edit_curator/' . $curator_id)->withErrors("Already Curator ID Exists")->withInput();
                } else {

                    $filename = $curator->curator_img;
                    //upload curator image
                    $path = './public/assets/images/curator/';

                    if (!file_exists($path))
                        $result = File::makeDirectory($path, 0777, true);

                    $file = Input::file('file');

                    //upload curator image
                    if ($file) {
                        //remove old image
                        if (file_exists($path . $filename))
                            unlink($path . $filename);

                        $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $path);
                    }

                    $curator_name = Input::get('curator_name');

                    $get_curator_theme = Input::get('selected_curator_theme');
                    if($get_curator_theme)
                    {
                        $selected_theme = str_replace(',', ':', $get_curator_theme);
                        $selected_theme = rtrim($selected_theme, ':');
                    }

                    date_default_timezone_set("America/New_York");
                    $date = date('Y-m-d H:i:s');

                    $password = $curator->curator_pwd;
                    $reset_password = Input::get('curator_pwd');
                    if($reset_password)
                    {
                        $password = md5($reset_password);
                    }

                    //update Curator
                    $curator_entry = array(
                        'curator_name' => $curator_name,
                        'curator_email' => $curator_email,
                        'curator_userid' => $curator_userid,
                        'curator_theme' => $selected_theme,
                        'curator_img' => $filename,
                        'curator_pwd' => $password,
                        'updated_at' => $date,
                    );

                    //update curator
                    $curator->update($curator_entry);

//                    //update all product curator info
//                    $products = Products::all();
//                    foreach ($products as $product) {
//                        if ($product->has_theme_id($old_curator_theme)) {
//                            $product->pro_checked_by = -1;
//                            $product->save();
//                        }
//
//                        if ($product->has_theme_id($curator_theme)) {
//                            $product->pro_checked_by = $curator_id;
//                            $product->save();
//                        }
//                    }

                    //show curator theme in charge
                    $theme_name_list = [];
                    $theme_list = explode(':', $selected_theme);
                    foreach($theme_list as $theme_id)
                    {
                        $theme = Theme::find($theme_id);
                        $theme_name_list[] = $theme->theme_name;
                    }

                    if($reset_password)
                    {
                        $send_mail_data = array(
                            'curator_name' => $curator_name,
                            'curator_email' => $curator_email,
                            'curator_userid' => $curator_userid,
                            'curator_password' => $reset_password,
                            'curator_img' => $filename,
                            'curator_theme' => $theme_name_list,
                        );
                    } else {
                        $send_mail_data = array(
                            'curator_name' => $curator_name,
                            'curator_email' => $curator_email,
                            'curator_userid' => $curator_userid,
                            'curator_img' => $filename,
                            'curator_theme' => $theme_name_list,
                        );
                    }


                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.curator_update_email', $send_mail_data, function ($message) use ($curator_email) {
                            $message->to($curator_email)->subject('Curator Account updated Successfully');
                        });
                    }

                    return Redirect::to('manage_curator')->with('success', 'Curator Updated Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    //delete curator from admin dashboard
    public function delete_curator($id)
    {
        if (Session::has('userid')) {
            $curator = Curator::findOrFail($id);
            $curator->delete();
            return Redirect::to('manage_curator')->with('success', 'Curator Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    //update curator from admin dashboard
    public function update_curator($id, $status)
    {
        if (Session::has('userid')) {
            $curator = Curator::findOrFail($id);
            $curator->status = $status;
            $curator->save();

            return Redirect::to('manage_curator')->with('success', 'Curator Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }





    /*For one curator: One curator Dashboard*/
    //show sitecurator login page
    public function sitecurator()
    {
        if (Session::has('curator_id')) {
            return Redirect::to('one_curator_dashboard')->with('login_success', 'Login Success');
        } else {
            return view('sitecurator.curator_login');
        }
    }



    //curator login
    public function curator_login_check()
    {
        $uname = Input::get('curator_name');
        $password = md5(Input::get('curator_pass'));

        $check = Curator::where('curator_pwd', $password)->where(function ($query) use ($uname) {
            $query->where('curator_userid', $uname);
            $query->orwhere('curator_email', $uname);
        })->get()->first();

        if ($check) {

            Session::put('curator_id', $check->id);
            Session::put('curator_name', $check->curator_name);

            return Redirect::to('one_curator_dashboard')->with('login_success', 'Login Success');

        } else {
            return Redirect::to('sitecurator')->with('login_error', 'Invalid Username and Password');
        }
    }

    //curator logout
    public  function curator_logout(){
        Session::forget('curator_id');
        Session::forget('curator_name');
        return Redirect::to('sitecurator');
    }

    //show curator dashboard for one curator
    public function one_curator_dashboard()
    {
        if (Session::has('curator_id')) {
            $date = date('Y-m-d H:i:s');
            $curator_id = Session::get('curator_id');
            $curator = Curator::findorFail($curator_id);

            $curator_header = view('sitecurator.includes.curator_header')->with('routemenu', 'one_curator_dashboard');
            $curator_footer = view('sitecurator.includes.curator_footer');

            $all_products = count($curator->all_products);
            $approved_products = count($curator->approved_products);
            $pending_products = count($curator->pending_products);
            $disapproved_products = count($curator->disapproved_products);

            return view('sitecurator.one_curator_dashboard')->with('curator_header', $curator_header)
                ->with('curator_footer', $curator_footer)
                ->with('all_products', $all_products)
                ->with('approved_products', $approved_products)
                ->with('disapproved_products', $disapproved_products)
                ->with('pending_products', $pending_products);


        } else {
            return Redirect::to('sitecurator');
        }
    }

    //show curator profile page for one curator
    public function curator_profile()
    {
        if (Session::has('curator_id')) {

            $curator_id = Session::get('curator_id');
            $curator = Curator::findorFail($curator_id);


            $used_theme = Curator::used_theme($curator_id);

            $used_theme_list = [];
            // parent_theme_id =>[parent_theme, child_theme_array]
            foreach($used_theme as $theme)
            {
                if($theme->parent_theme == 0)
                {
                    //parent theme
                    $used_theme_list[$theme->theme_id] = ['parent_theme'=>$theme, 'child_themes'=>[]];
                } else {
                    //child theme
                    $parent_theme_id = $theme->parent_theme;
                    if(array_key_exists($parent_theme_id, $used_theme_list))
                    {
                        $parent_theme = $used_theme_list[$parent_theme_id];
                        $child_themes = $parent_theme['child_themes'];
                        array_push($child_themes, $theme);
                        $used_theme_list[$parent_theme_id]['child_themes'] = $child_themes;
                    } else {
                        $used_theme_list[$parent_theme_id] = ['parent_theme'=>null, 'child_themes'=>[$theme]];
                    }
                }
            }

            $curator_header = view('sitecurator.includes.curator_header')->with('routemenu', 'curator_profile');
            $curator_footer = view('sitecurator.includes.curator_footer');
            $curator_leftmenu = view('sitecurator.includes.curator_left_menu');

            return view('sitecurator.curator_profile')->with('curator_header', $curator_header)->with('curator_left_menu', $curator_leftmenu)
                ->with('curator_footer', $curator_footer)->with('curator', $curator)->with('charge_in_theme', $used_theme_list);

        } else {
            return Redirect::to('sitecurator');
        }
    }

    //update curator profile for one curator
    public function update_curator_profile_submit()
    {
        if (Session::has('curator_id')) {

            $data = Input::except(array(
                '_token'
            ));

            $curator_id = Input::get('curator_id');
            $curator = Curator::find($curator_id);

            $rule = array(
                'curator_name' => 'required',
                'curator_email' => 'required|email',
                'curator_userid' => 'required',
            );

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {

                return Redirect::to('curator_profile')->withErrors($validator->messages())->withInput();

            } else {

                $curator_email = Input::get('curator_email');
                $check_curator_id = Curator::where('curator_email', $curator_email)->where('id', '!=', $curator_id)->get();

                $curator_userid = Input::get('curator_userid');
                $check_curator_userid = Curator::where('curator_userid', $curator_userid)->where('id', '!=', $curator_id)->get();

                if (count($check_curator_id) > 0) {
                    return Redirect::to('curator_profile')->withErrors('Same Email Exist')->withInput();

                } else if (count($check_curator_userid) > 0) {
                    return Redirect::to('curator_profile')->withErrors("Already Curator ID Exists")->withInput();

                } else {


                    $current_password = Input::get('current_password');
                    $new_password = Input::get('new_password');

                    if(!$current_password && $new_password)
                    {
                        return Redirect::to('curator_profile')->withErrors("Please input your current password")->withInput();
                    } else if($current_password && !$new_password)
                    {
                        return Redirect::to('curator_profile')->withErrors("Please input new password")->withInput();
                    } else if($current_password && $new_password)
                    {
                        $cp = md5($current_password);
                        if($cp != $curator->curator_pwd)
                        {
                            return Redirect::to('curator_profile')->withErrors("Wrong Password")->withInput();
                        }
                    }

                    $filename = $curator->curator_img;
                    //upload curator image
                    $path = './public/assets/images/curator/';

                    if (!file_exists($path))
                        $result = File::makeDirectory($path, 0777, true);

                    $file = Input::file('file');

                    //upload curator image
                    if ($file) {
                        //remove old image
                        if (file_exists($path . $filename))
                            unlink($path . $filename);

                        $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $path);
                    }

                    $curator_name = Input::get('curator_name');

                    date_default_timezone_set("America/New_York");
                    $date = date('Y-m-d H:i:s');

                    $password = $curator->curator_pwd;
                    if($new_password)
                    {
                        $password = md5($new_password);
                    }

                    //update Curator
                    $curator_entry = array(
                        'curator_name' => $curator_name,
                        'curator_email' => $curator_email,
                        'curator_userid' => $curator_userid,
                        'curator_pwd'=>$password,
                        'curator_img' => $filename,
                        'updated_at' => $date,
                    );

                    $update_curator_id = $curator->update($curator_entry);

                    $send_mail_data = array(
                        'curator_name' => $curator_name,
                        'curator_email' => $curator_email,
                        'curator_userid' => $curator_userid,
                        'curator_img' => $filename,
                    );

                    if($new_password)
                    {
                        $send_mail_data = array(
                            'curator_name' => $curator_name,
                            'curator_email' => $curator_email,
                            'curator_userid' => $curator_userid,
                            'curator_img' => $filename,
                            'curator_password'=>$new_password,
                        );
                    }

                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.curator_update_email', $send_mail_data, function ($message) use ($curator_email) {
                            $message->to($curator_email)->subject('Curator Account updated Successfully');
                        });
                    }

                    return Redirect::to('curator_profile')->with('success', 'Curator Updated Successfully');
                }
            }
        } else {
            return Redirect::to('sitecurator');
        }
    }

    //show approved products by this curator
    public function curator_approved_resource()
    {
        if (Session::has('curator_id')) {

            $curator_id = Session::get('curator_id');
            $curator = Curator::findorFail($curator_id);

            $curator_header = view('sitecurator.includes.curator_header')->with('routemenu', 'curator_approved_product');
            $curator_footer = view('sitecurator.includes.curator_footer');
            $curator_leftmenu = view('sitecurator.includes.curator_left_menu');

            $approved_products = $curator->approved_products;

            return view('sitecurator.approved_product')->with('curator_header', $curator_header)
                ->with('curator_left_menu', $curator_leftmenu)->with('curator_footer', $curator_footer)
                ->with('curator', $curator)->with('products', $approved_products);

        } else {
            return Redirect::to('sitecurator');
        }
    }

    //show unapproved products by this contributor
    public function curator_disapproved_resource()
    {
        if (Session::has('curator_id')) {

            $curator_id = Session::get('curator_id');
            $curator = Curator::findorFail($curator_id);

            $unapproved_products = $curator->disapproved_products;

            $curator_header = view('sitecurator.includes.curator_header')->with('routemenu', 'curator_disapproved_resource');
            $curator_footer = view('sitecurator.includes.curator_footer');
            $curator_leftmenu = view('sitecurator.includes.curator_left_menu');

            return view('sitecurator.unapproved_product')->with('curator_header', $curator_header)
                ->with('curator_left_menu', $curator_leftmenu)->with('curator_footer', $curator_footer)
                ->with('curator', $curator)->with('products', $unapproved_products)
                ->with('type', Products::PRODUCT_STATUS_NOT_APPROVED);

        } else {
            return Redirect::to('sitecurator');
        }
    }

    //show unchecked products by this contributor
    public function curator_pending_resource()
    {
        if (Session::has('curator_id')) {

            $curator_id = Session::get('curator_id');
            $curator = Curator::findorFail($curator_id);

            $unchecked_products = $curator->pending_products;

            $curator_header = view('sitecurator.includes.curator_header')->with('routemenu', 'curator_unchecked_product');
            $curator_footer = view('sitecurator.includes.curator_footer');
            $curator_leftmenu = view('sitecurator.includes.curator_left_menu');

            return view('sitecurator.unapproved_product')->with('curator_header', $curator_header)
                ->with('curator_left_menu', $curator_leftmenu)->with('curator_footer', $curator_footer)
                ->with('curator', $curator)->with('products', $unchecked_products)
                ->with('type', Products::PRODUCT_STATUS_PENDING);

        } else {
            return Redirect::to('sitecurator');
        }
    }

    //show product details from curator dashboard
    public function curator_resource_details($pro_id)
    {
        if (Session::has('curator_id')) {

            $curator_header = view('sitecurator.includes.curator_header');
            $curator_footer = view('sitecurator.includes.curator_footer');
            $curator_leftmenu = view('sitecurator.includes.curator_left_menu');

            $id = base64_decode($pro_id);

            $get_product = Products::get_product_view($id);
            if (count($get_product) > 0) {
                $product = $get_product[0];
            } else {
                return Redirect::to('one_curator_dashboard')->withError("That product doesn't exist");
            }

            $used_theme = Products::used_theme($id);

            return view('sitecurator.product_details')->with('curator_header', $curator_header)
                ->with('curator_left_menu', $curator_leftmenu)->with('curator_footer', $curator_footer)
                ->with('product', $product)->with('used_theme', $used_theme)->with('target', 'view');

        } else {

            return Redirect::to('siteadmin');

        }
    }

    //show product from curator dashboard to approve-upapprove
    public function curator_check_resource($pro_id)
    {
        if (Session::has('curator_id')) {

            $curator_id = Session::get('curator_id');
            $curator = Curator::find($curator_id);

            $pid = base64_decode($pro_id);
            $product = Products::get_product_view($pid);
            if(count($product) >0)
                $product = $product[0];
            else
                return Redirect::to('curator_disapproved_resource')->with('message', 'That product does not exist');

            $used_theme = Products::used_theme($pid);

            $used_theme_list = [];
            // parent_theme_id =>[parent_theme, child_theme_array]
            foreach($used_theme as $theme)
            {
                if($theme->parent_theme == 0)
                {
                    //parent theme
                    $used_theme_list[$theme->theme_id] = ['parent_theme'=>$theme, 'child_themes'=>[]];
                } else {
                    //child theme
                    $parent_theme_id = $theme->parent_theme;
                    if(array_key_exists($parent_theme_id, $used_theme_list))
                    {
                        $parent_theme = $used_theme_list[$parent_theme_id];
                        $child_themes = $parent_theme['child_themes'];
                        array_push($child_themes, $theme);
                        $used_theme_list[$parent_theme_id]['child_themes'] = $child_themes;
                    } else {
                        $used_theme_list[$parent_theme_id] = ['parent_theme'=>null, 'child_themes'=>[$theme]];
                    }
                }
            }

            $curator_header = view('sitecurator.includes.curator_header');
            $curator_footer = view('sitecurator.includes.curator_footer');
            $curator_leftmenu = view('sitecurator.includes.curator_left_menu');

            return view('sitecurator.product_details')->with('curator_header', $curator_header)
                ->with('curator_left_menu', $curator_leftmenu)->with('curator_footer', $curator_footer)
                ->with('product', $product)->with('used_theme', $used_theme_list)->with('target', 'check')
                ->with('curator_id', $curator_id);

        } else {

            return Redirect::to('one_curator_dashboard');

        }
    }

    //submit curator result
    public function submit_check_result_by_curator()
    {

        $data = Input::except(array(
            '_token'
        ));

        $curator_id = Input::get('curator_id');
        $product_id = Input::get('product_id');
        $encoded_product_id = base64_encode($product_id);

        $curator = Curator::find($curator_id);
        if (!$curator) {
            return Redirect::to('curator_check_resource/' . $encoded_product_id)->withErrors("Curator doesn't exist");
        }

        $product = Products::find($product_id);
        if (!$product) {
            return Redirect::to('curator_check_resource/' . $encoded_product_id)->withErrors("Product doesn't exist");
        }

        $merchant_id = $product->pro_mr_id;
        $merchant = Member::find($merchant_id);
        if (!$merchant) {
            return Redirect::to('curator_check_resource/' . $encoded_product_id)->withErrors("The Contributor of this product doesn't exist");
        }

        //now all condition: product, curator, merchant exists
        $curator_name = $curator->curator_name;
        $curator_email = $curator->curator_email;
        $merchant_email = $merchant->mem_email;
        $merchant_name = $merchant->mem_fname . ' ' . $merchant->mem_lname;
        $store = $merchant->get_store_from_merchant($merchant_id);
        $store_id =base64_encode(base64_encode(base64_encode($store[0]->stor_id)));

        $product_name = $product->pro_title;

        $rule = array(
            'approve' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {

            return Redirect::to('curator_check_resource/' . $encoded_product_id)->withErrors($validator->messages())->withInput();

        } else {

            $approve = Input::get('approve');
            $reason = Input::get('reason');

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            if ($approve == Products::PRODUCT_STATUS_APPROVED) {
                $entry = array(
                    'pro_approved_status' =>  Products::PRODUCT_STATUS_APPROVED,
                    'pro_checked_by'=>$curator_id,
                    'approved_at' => $date,
                    'updated_at' => $date,
                );

                Products::edit_product($entry, $product_id);

                //send email to merchant about this approved status
                $send_mail_data = array(
                    'merchant_name' => $merchant_name,
                    'merchant_id' => $merchant_id,
                    'curator_name' => $curator_name,
                    'product_name' => $product_name,
                    'product_id' => $encoded_product_id,
                    'store_id' => $store_id,
                );

                if ($_SERVER['HTTP_HOST'] != 'localhost') {
                    Mail::send('emails.curator_approved_email', $send_mail_data, function ($message) use ($merchant_email) {
                        $message->to($merchant_email)->subject('Your resource has been added to the Living Lectionary!');
                    });
                }

                //go to approved list
                return Redirect::to('curator_approved_resource')->with('message', "Product Approved Successfully");

            } else {
                $entry = array(
                    'pro_approved_status' => $approve,
                    'pro_checked_by'=>$curator_id,
                    'approved_at' => $date,
                    'updated_at' => $date,
                );
                Products::edit_product($entry, $product_id);

                //send email to merchant about this unapproved status
                $send_mail_data = array(
                    'merchant_name' => $merchant_name,
                    'merchant_id' => $merchant_id,
                    'curator_name' => $curator_name,
                    'product_name' => $product_name,
                    'product_id' => $product_id,
                    'reason' => $reason,
                );

                if ($_SERVER['HTTP_HOST'] != 'localhost') {
                    Mail::send('emails.curator_unapproved_email', $send_mail_data, function ($message) use ($merchant_email) {
                        $message->to($merchant_email)->subject('Information about your content');
                    });
                }

                //go to unapproved list
                return Redirect::to('curator_disapproved_resource')->with('message', "Product Unapproved");
            }

        }

    }

    //send reset password for one curator
    public function forgot_check_curator()
    {
        $email = Input::get('curator_email');
        $forgot_check = DB::table('nm_curators')->where('curator_email', '=', $email)->get();

        if (count($forgot_check) > 0) {
            $email = $forgot_check[0]->curator_email;
            $encode_email = base64_encode(base64_encode(base64_encode($email)));
            $send_mail_data = array('name' => $forgot_check[0]->curator_name, 'encode_email' => $encode_email);
            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                Mail::send('emails.curator_password_recovery_email', $send_mail_data, function ($message) use ($email) {
                    $message->to($email, 'Curator')->subject('[Living Lectionary] Curator Password Recovery Details');
                });
            }
            return Redirect::to('sitecurator')->with('forgot_success', 'Mail Send Successfully');
        } else {
            return Redirect::to('sitecurator')->with('forgot_error', 'Invalid Email');
        }
    }

    //reset curator password
    public function sitecurator_reset_pwd($encoded_curator_email)
    {
        $curator_email = base64_decode(base64_decode(base64_decode($encoded_curator_email)));
        Session::put('reset_curator_email', $curator_email);
        return view('sitecurator.curator_login');
    }

    public function reset_curator_password_submit()
    {
        $curator_email = Session::get('reset_curator_email');

        $pwd = Input::get('curator_pwd');
        $cpwd = Input::get('curator_confirm_pwd');

        if($pwd != $cpwd)
        {
            return Redirect::back()->with('reset_curator_password_error', 'Password Mismatch');
        }

        $curator = Curator::where('curator_email', $curator_email)->get();

        if ($curator) {
            $curator = $curator[0];
            $curator->curator_pwd = md5($pwd);
            $curator->save();
            Session::forget('reset_curator_email');
            return Redirect::back()->with('reset_curator_password_success', 'Password Reset Success');
        } else {
            return Redirect::back()->with('reset_curator_password_error', 'Curator Does not exist');
        }
        
    }

    //edit product by curator
    public function edit_product_by_curator($encoded_product_id)
    {
        if (Session::has('curator_id')) {

            $curator_id = Session::get('curator_id');

            $product_id = base64_decode($encoded_product_id);
            $product = Products::get_product_view($product_id);

            if(count($product) >0)
                $product = $product[0];
            else
                return Redirect::to('curator_pending_resource')->with('message', 'That product does not exist');


            $used_theme = Products::used_theme($product_id);

            $used_theme_list = [];
            // parent_theme_id =>[parent_theme, child_theme_array]
            foreach($used_theme as $theme)
            {
                if($theme->parent_theme == 0)
                {
                    //parent theme
                    $used_theme_list[$theme->theme_id] = ['parent_theme'=>$theme, 'child_themes'=>[]];
                } else {
                    //child theme
                    $parent_theme_id = $theme->parent_theme;
                    if(array_key_exists($parent_theme_id, $used_theme_list))
                    {
                        $parent_theme = $used_theme_list[$parent_theme_id];
                        $child_themes = $parent_theme['child_themes'];
                        array_push($child_themes, $theme);
                        $used_theme_list[$parent_theme_id]['child_themes'] = $child_themes;
                    } else {
                        $used_theme_list[$parent_theme_id] = ['parent_theme'=>null, 'child_themes'=>[$theme]];
                    }
                }
            }

            $used_array = [];
            foreach ($used_theme as $ut) {
                $used_array[] = $ut->theme_id;
            }

            $theme_details = ThemeController::get_affirmation_level_list();

            $curator_header = view('sitecurator.includes.curator_header');
            $curator_footer = view('sitecurator.includes.curator_footer');
            $curator_leftmenu = view('sitecurator.includes.curator_left_menu');

            return view('sitecurator.edit_product_details')->with('curator_header', $curator_header)
                ->with('curator_left_menu', $curator_leftmenu)->with('curator_footer', $curator_footer)
                ->with('product', $product)->with('used_theme', $used_theme_list)
                ->with('used_theme_arr', $used_array)->with('target', 'check')
                ->with('curator_id', $curator_id)->with('theme_details', $theme_details);

        } else {

            return Redirect::to('one_curator_dashboard');

        }
    }

    public function edit_product_submit_by_curator()
    {
        if (Session::has('curator_id')) {

            //description and selected_theme
            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            $id = Input::get('product_edit_id');
            $encoded_product_id = base64_encode($id);

            //theme select
            $theme_selection = Input::get('selected_theme');
            $select_theme = str_replace(',', ':', $theme_selection);
            $select_theme = rtrim($select_theme, ':');

            $Description = Input::get('Description');

            $entry = array(
                'pro_desc' => $Description,
                'pro_theme_ids' => $select_theme,
                'updated_at' => $date
            );

            Products::edit_product($entry, $id);

            //go to approved list
            return Redirect::to('curator_check_resource'.'/'.$encoded_product_id)->with('success', "Product Updated Successfully");

        } else {

            return Redirect::to('one_curator_dashboard');

        }

    }
}
