<?php
namespace App\Http\Controllers;

use App\Member;
use App\Http\Models;
use App\Products;
use App\Theme;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class ThemeController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */

    public function add_affirmation()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->get(array('pro_id', 'pro_title'))->all();

            $parent_theme_details = Theme::where('parent_theme', '0')->get()->all();

            return view('siteadmin.add_affirmation')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('products', $products)->with('parent_theme_details', $parent_theme_details);

        } else {
            return Redirect::to('siteadmin');
        }
    }


    public function add_affirmation_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $date = date('m/d/Y');

            $rule = array(
                'theme_name' => 'required',
                'theme_heading' => 'required',
                'file' => 'required',
                'theme_description' => 'required'
            );


            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_affirmation')->withErrors($validator->messages())->withInput();
            } else {

                $theme_name = Input::get('theme_name');

                $check_themename = Theme::check_themename($theme_name);

                if ($check_themename) {
                    return Redirect::to('add_affirmation')->with('message', "Already Theme Exists with same name.")->withInput();
                } else {

                    //upload theme banner image
                    $file = Input::file('file');
                    $filename = $file->getClientOriginalName();
                    $move_img = explode('.', $filename);
                    $filename = $move_img[0] . "." . $move_img[1];
                    $destinationPath = './public/assets/images/themes/';

                    $uploadSuccess = $file->move($destinationPath, $filename);


                    //upload theme gallery image
                    $file2 = Input::file('file2');
                    $filename2 = $file2->getClientOriginalName();
                    $move_img2 = explode('.', $filename2);
                    $filename2 = $move_img2[0] . "." . $move_img2[1];
                    $destinationPath2 = './public/assets/images/finalgalleryimage/';

                    $uploadSuccess2 = $file2->move($destinationPath2, $filename2);


                    $new_theme = new Theme();
                    $new_theme->theme_name = $theme_name;
                    $new_theme->theme_banner_title = Input::get('theme_banner_title');
                    $new_theme->theme_banner_img = $filename;
                    $new_theme->theme_gallery_img = $filename2;
                    $new_theme->theme_heading = Input::get('theme_heading');
                    $new_theme->theme_description = Input::get('theme_description');
                    $new_theme->theme_side = Input::get('theme_side');
                    $new_theme->parent_theme = 0;
                    $new_theme->save();

                    $tid = $new_theme->theme_id;

                    //update products
                    $select_product = Input::get('select_product');
                    $selected_products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->whereIn('pro_id', $select_product)->get()->all();
                    foreach ($selected_products as $sp) {
                        if ($sp) {
                            $sp->add_theme_id($tid);
                        }
                    }

                    return Redirect::to('manage_affirmation')->with('result', 'Theme Inserted Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }

    }


    public function add_sub_affirmation($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->get(array('pro_id', 'pro_title'))->all();

            $parent_theme = Theme::findOrFail($id);

            return view('siteadmin.add_sub_affirmation')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('products', $products)->with('parent_theme', $parent_theme);

        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_sub_affirmation_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $date = date('m/d/Y');

            $rule = array(
                'theme_name' => 'required',
                /*'theme_description' => 'required'*/
            );

            $parent_theme_id = Input::get('parent_theme_id');

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_affirmation')->withErrors($validator->messages())->withInput();
            } else {

                $theme_name = Input::get('theme_name');

                $check_themename = Theme::check_themename($theme_name);

                if ($check_themename) {

                    return Redirect::back()->with('message', "Already Sub Theme Exists with same name.")->withInput();

                } else {


                    /*$filename = "";
                    if(Input::has('file')){

                        $file = Input::file('file');
                        $filename = $file->getClientOriginalName();
                        $move_img = explode('.', $filename);
                        $filename = $move_img[0] . "." . $move_img[1];
                        $destinationPath = './public/assets/images/themes/';
                        $uploadSuccess = $file->move($destinationPath, $filename);
                    }

                    $new_theme = new Theme();
                    $new_theme->theme_name = $theme_name;
                    $new_theme->theme_banner_title = Input::get('theme_banner_title');
                    $new_theme->theme_banner_img = $filename;
                    $new_theme->theme_heading = Input::get('theme_heading');
                    $new_theme->theme_description = Input::get('theme_description');
                    $new_theme->theme_side = Input::get('theme_side');
                    $new_theme->parent_theme = $parent_theme_id;
                    $new_theme->save();*/

                    $new_theme = new Theme();
                    $new_theme->theme_name = $theme_name;
                    $new_theme->parent_theme = $parent_theme_id;
                    $new_theme->save();

                    $tid = $new_theme->theme_id;

                    //update products
                    $select_product = Input::get('select_product');
                    $selected_products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->whereIn('pro_id', $select_product)->get()->all();
                    foreach ($selected_products as $sp) {
                        if ($sp) {
                            $sp->add_theme_id($tid);
                        }
                    }

                    return Redirect::to('manage_affirmation')->with('result', 'Theme Inserted Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }

    }


    public function edit_affirmation($id)
    {
        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $theme_result = Theme::get_individual_theme_detail($id);
            $parent_theme_details = Theme::where('parent_theme', '0')->get()->all();

            if (count($theme_result) > 0) {
                $products = Theme::get_used_notused_product_list($id);

                $used_product = $products[0];
                $not_used_product = $products[1];

                $theme_result = $theme_result[0];

                return view('siteadmin.edit_affirmation')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                    ->with('adminfooter', $adminfooter)->with('theme_details', $theme_result)
                    ->with('used_product', $used_product)->with('not_used_product', $not_used_product)
                    ->with('parent_theme_details', $parent_theme_details);
            } else {
                return Redirect::to('manage_affirmation')->withErrors('Theme does not exist');
            }

        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function edit_affirmation_submit()
    {
        if (Session::has('userid')) {

            $theme_id = Input::get('theme_id');

            $data = Input::except(array(
                '_token'
            ));
            $date = date('m/d/Y');

            $rule = array(
                'theme_name' => 'required',
                'theme_heading' => 'required',
                'theme_description' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_affirmation/' . $theme_id)->withErrors($validator->messages())->withInput();
            } else {

                $theme_name = Input::get('theme_name');

                $check_themename = Theme::check_themename2($theme_id, $theme_name);

                if ($check_themename) {
                    return Redirect::to('edit_affirmation/' . $theme_id)->withErrors("Already Theme Exists with same name.")->withInput();
                } else {

                    //update theme banner image
                    $file = Input::file('file');
                    $file_old = Input::get('file_old');
                    $destinationPath = './public/assets/images/themes/';

                    if (!$file) {
                        $filename = $file_old;
                    } else {

                        if ($file_old) {
                            if (file_exists($destinationPath . $file_old)) {
                                unlink($destinationPath . $file_old);
                            }
                        }

                        $filename = $file->getClientOriginalName();
                        $move_img = explode('.', $filename);
                        $filename = $move_img[0] . "." . $move_img[1];
                        $uploadSuccess = $file->move($destinationPath, $filename);
                    }

                    //update theme gallery image
                    $file2 = Input::file('file2');
                    $file2_old = Input::get('file2_old');

                    $destinationPath2 = './public/assets/images/finalgalleryimage/';

                    if (!$file2) {
                        $filename2 = $file2_old;
                    } else {

                        if ($file2_old) {
                            if (file_exists($destinationPath2 . $file2_old)) {
                                unlink($destinationPath2 . $file2_old);
                            }
                        }

                        $filename2 = $file2->getClientOriginalName();
                        $move_img2 = explode('.', $filename2);
                        $filename2 = $move_img2[0] . "." . $move_img2[1];
                        $uploadSuccess2 = $file2->move($destinationPath2, $filename2);
                    }

                    //product select
                    $select_product = Input::get('select_product');

                    $all_products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->get()->all();

                    foreach ($all_products as $ap) {
                        if ($select_product) {
                            if ($ap->has_theme_id($theme_id) && (!in_array($ap->pro_id, $select_product))) {
                                $ap->remove_theme_id($theme_id);
                            } else if (!$ap->has_theme_id($theme_id) && in_array($ap->pro_id, $select_product)) {
                                $ap->add_theme_id($theme_id);
                            }
                        } else {
                            $ap->remove_theme_id($theme_id);
                        }
                    }

                    $parent_theme = Input::get('parent_theme_id');

                    $entry = array(
                        'theme_name' => $theme_name,
                        'theme_banner_title' => Input::get('theme_banner_title'),
                        'theme_banner_img' => $filename,
                        'theme_gallery_img' => $filename2,
                        'theme_heading' => Input::get('theme_heading'),
                        'theme_description' => Input::get('theme_description'),
                        'theme_side' => Input::get('theme_side'),
                        'parent_theme' => $parent_theme,
                    );

                    Theme::update_theme($theme_id, $entry);

                    return Redirect::to('manage_affirmation')->with('result', 'Theme Updated Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }

    }


    public function edit_sub_affirmation($id)
    {
        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $theme_result = Theme::get_individual_theme_detail($id);

            if (count($theme_result) > 0) {
                $products = Theme::get_used_notused_product_list($id);

                $used_product = $products[0];
                $not_used_product = $products[1];

                $theme_result = $theme_result[0];

                return view('siteadmin.edit_sub_affirmation')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                    ->with('adminfooter', $adminfooter)->with('theme_details', $theme_result)
                    ->with('used_product', $used_product)->with('not_used_product', $not_used_product);

            } else {
                return Redirect::to('manage_affirmation')->withErrors('Theme does not exist');
            }

        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function edit_sub_affirmation_submit()
    {
        if (Session::has('userid')) {

            $theme_id = Input::get('theme_id');

            $data = Input::except(array(
                '_token'
            ));
            $date = date('m/d/Y');

            $rule = array(
                'theme_name' => 'required',
                /*'theme_description' => 'required'*/
            );

            $parent_theme_id = Input::get('parent_theme_id');

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_affirmation/' . $theme_id)->withErrors($validator->messages())->withInput();
            } else {

                $theme_name = Input::get('theme_name');

                $check_themename = Theme::check_themename2($theme_id, $theme_name);

                if ($check_themename) {
                    return Redirect::to('edit_affirmation/' . $theme_id)->withErrors("Already Theme Exists with same name.")->withInput();
                } else {

                    $parent_theme = Input::get('parent_theme_id');

                    /*
                    $file = Input::file('file');

                    if (!$file) {
                        $filename = Input::get('file_old');
                    } else {
                        $filename = $file->getClientOriginalName();
                        $move_img = explode('.', $filename);
                        $filename = $move_img[0] . "." . $move_img[1];
                        $destinationPath = './public/assets/images/themes/';
                        $uploadSuccess = $file->move($destinationPath, $filename);
                    }

                    //product select
                    $select_product = Input::get('select_product');

                    $all_products = Products::where('pro_status', 1)->get()->all();

                    foreach ($all_products as $ap) {
                        if ($select_product) {
                            if ($ap->has_theme_id($theme_id) && (!in_array($ap->pro_id, $select_product))) {
                                $ap->remove_theme_id($theme_id);
                            } else if (!$ap->has_theme_id($theme_id) && in_array($ap->pro_id, $select_product)) {
                                $ap->add_theme_id($theme_id);
                            }
                        } else {
                            $ap->remove_theme_id($theme_id);
                        }
                    }

                    $entry = array(
                        'theme_name' => $theme_name,
                        'theme_banner_title' => Input::get('theme_banner_title'),
                        'theme_banner_img' => $filename,
                        'theme_heading' => Input::get('theme_heading'),
                        'theme_description' => Input::get('theme_description'),
                        'theme_side' => Input::get('theme_side'),
                        'parent_theme' => $parent_theme,
                    );*/

                    $entry = array(
                        'theme_name' => $theme_name,
                        'parent_theme' => $parent_theme,
                    );

                    Theme::update_theme($theme_id, $entry);

                    return Redirect::to('manage_sub_affirmations/' . $parent_theme_id)->with('result', 'Theme Updated Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }

    }


    public function manage_affirmations()
    {
        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $themeresult = ThemeController::get_affirmation_level_list();

            return view('siteadmin.manage_affirmation')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('themeresult', $themeresult);
        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function manage_sub_affirmations($id)
    {
        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $theme = Theme::findOrFail($id);
            $sub_themes = Theme::where('parent_theme', $theme->theme_id)->get()->all();

            return view('siteadmin.manage_sub_affirmation')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('parent_theme', $theme)->with('themeresult', $sub_themes);
        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function delete_affirmation($id)
    {
        if (Session::has('userid')) {

            $all_products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->get()->all();

            foreach ($all_products as $ap) {
                if ($ap->has_theme_id($id)) {
                    $ap->remove_theme_id($id);
                }
            }

            $return = Theme::delete_theme($id);

            return Redirect::to('manage_affirmation')->with('result', 'Theme Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function status_affirmation_submit($id, $status)
    {
        if (Session::has('userid')) {
            $return = Theme::status_theme($id, $status);
            return Redirect::to('manage_affirmation')->with('result', 'Theme Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public static function get_affirmation_level_list()
    {
        $level_list = [];
        $parent_themes = Theme::where('parent_theme', 0)->where('theme_status', '=', 1)->get();

        if ($parent_themes) {
            foreach ($parent_themes as $pt) {
                $pt_id = $pt->theme_id;
                $child_themes = Theme::where('parent_theme', $pt_id)->where('theme_status', '=', 1)->get();

                $level_list[$pt_id] = array($pt, $child_themes);
            }
        }

        return $level_list;

    }

    public function get_sub_affirmation()
    {
        $pid = $_GET['parent_theme_id'];
        $parent_theme = Theme::find($pid);
        if ($parent_theme) {
            $child_themes = Theme::where('parent_theme', $pid)->get()->all();
            return response()->json(['child_theme' => $child_themes]);
        } else {
            return response()->json(['child_theme' => []]);
        }
    }

}
