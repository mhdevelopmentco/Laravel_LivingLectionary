<?php
namespace App\Http\Controllers;

use App\Theme;
use App\Category;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use DB;
use Session;

class CategoryController extends Controller
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
    public function add_category()
    {
        if (Session::has('userid')) {
            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter    = view('siteadmin.includes.admin_footer');


            return view('siteadmin.add_category')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);

        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function manage_category()
    {
        if (Session::has('userid')) {
            $adminheader       = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus    = view('siteadmin.includes.admin_left_menus');
            $adminfooter       = view('siteadmin.includes.admin_footer');
            $maincatg_list     = Category::maincatg_list();
            $maincatg_sub_list = Category::maincatg_sub_list($maincatg_list);
            return view('siteadmin.manage_categories')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('maincatg_list', $maincatg_list)->with('maincatg_sub_list', $maincatg_sub_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function add_category_submit()
    {
        if (Session::has('userid')) {
            $data      = Input::except(array(
                '_token'
            ));
            $rule      = array(
                'catg_name' => 'required',
                'catg_status' => 'required',
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_category')->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();

                $file   = Input::file('file');
                $file2  = Input::file('file2');
                $destinationPath = './public/assets/images/category/';

                $deal   = '1,1,1';

                if ($file != '' && $file2 != '') {

                    $filename        = $file->getClientOriginalName();
                    $move_img        = explode('.', $filename);
                    $filename        = $move_img[0] . "." . $move_img[1];
                    $filename2        = $file2->getClientOriginalName();
                    $move_img2        = explode('.', $filename2);
                    $filename2        = $move_img2[0] . "." . $move_img2[1];

                    $uploadSuccess  = $file->move($destinationPath, $filename);
                    $uploadSuccess2  = $file2->move($destinationPath, $filename2);

                    $entry           = array(
                        'mc_name' => Input::get('catg_name'),
                        'mc_desc' => Input::get('catg_desc'),
                        'mc_type' => $deal,
                        'mc_img' => $filename,
                        'mc_img2' => $filename2,
                        'mc_status' => Input::get('catg_status')
                    );

                    $return          = Category::save_category($entry);
                    return Redirect::to('manage_category')->with('success', 'Category Inserted Successfully');
                } else {
                    return Redirect::to('add_category')->with('error', 'Image field Required')->withInput();
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function edit_category($id)
    {
        if (Session::has('userid')) {
            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter    = view('siteadmin.includes.admin_footer');
            $catg_details   = Category::selectedcatg_list($id);

            return view('siteadmin.edit_category')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('catg_details', $catg_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function edit_category_submit()
    {
        if (Session::has('userid')) {
            $data      = Input::except(array(
                '_token'
            ));
            $id        = Input::get('catg_id');
            $rule      = array(
                'catg_name' => 'required',
                'catg_status' => 'required',
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_category/' . $id)->withErrors($validator->messages());
            } else {
                $inputs = Input::all();
                $deal   = '1,1,1';
                $id     = Input::get('catg_id');

                $file   = Input::file('file');
                $file2  = Input::file('file2');
                $destinationPath = './public/assets/images/category/';

                if ($file != '' || $file2 != '') {

                    if($file!="" && $file2 =="")
                    {
                        $filename        = $file->getClientOriginalName();
                        $move_img        = explode('.', $filename);
                        $filename        = $move_img[0] . "." . $move_img[1];
                        $uploadSuccess   = $file->move($destinationPath, $filename);
                        $entry           = array(
                            'mc_name' => Input::get('catg_name'),
                            'mc_desc' => Input::get('catg_desc'),
                            'mc_type' => $deal,
                            'mc_img' => $filename,
                            'mc_status' => Input::get('catg_status')
                        );
                    } else if($file == '' && $file2 !='')
                    {
                        $filename        = $file2->getClientOriginalName();
                        $move_img        = explode('.', $filename);
                        $filename        = $move_img[0] . "." . $move_img[1];
                        $uploadSuccess   = $file2->move($destinationPath, $filename);
                        $entry           = array(
                            'mc_name' => Input::get('catg_name'),
                            'mc_desc' => Input::get('catg_desc'),
                            'mc_type' => $deal,
                            'mc_img2' => $filename,
                            'mc_status' => Input::get('catg_status')
                        );
                    } else {

                        $filename        = $file->getClientOriginalName();
                        $move_img        = explode('.', $filename);
                        $filename        = $move_img[0] . "." . $move_img[1];
                        $filename2        = $file2->getClientOriginalName();
                        $move_img2        = explode('.', $filename2);
                        $filename2        = $move_img2[0] . "." . $move_img2[1];

                        $uploadSuccess  = $file->move($destinationPath, $filename2);
                        $uploadSuccess2  = $file2->move($destinationPath, $filename2);

                        $entry           = array(
                            'mc_name' => Input::get('catg_name'),
                            'mc_desc' => Input::get('catg_desc'),
                            'mc_type' => $deal,
                            'mc_img' => $filename,
                            'mc_img2' => $filename2,
                            'mc_status' => Input::get('catg_status')
                        );
                    }

                } else {
                    $entry = array(
                        'mc_name' => Input::get('catg_name'),
                        'mc_desc' => Input::get('catg_desc'),
                        'mc_type' => $deal,
                        'mc_status' => Input::get('catg_status')
                    );
                }
                $return = Category::update_category_detail($entry, $id);
                return Redirect::to('manage_category')->with('success', 'Category Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public static function status_category_submit($id, $status)
    {
        if (Session::has('userid')) {
            $return = Category::status_category_submit($id, $status);
            return Redirect::to('manage_category')->with('success', 'Category Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public static function delete_category($id)
    {
        if (Session::has('userid')) {
            $return = Category::delete_category($id);
            return Redirect::to('manage_category')->with('success', 'Category Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function add_main_category($id)
    {
        if (Session::has('userid')) {
            $adminheader           = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus        = view('siteadmin.includes.admin_left_menus');
            $adminfooter           = view('siteadmin.includes.admin_footer');
            $add_main_catg_details = Category::selectedcatg_list($id);
            return view('siteadmin.add_maincategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('add_main_catg_details', $add_main_catg_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function add_main_category_submit()
    {
        if (Session::has('userid')) {
            $data      = Input::except(array(
                '_token'
            ));
            $rule      = array(
                'main_catg_name' => 'required',
                'catg_status' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_main_category/' . Input::get('catg_id'))->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();
                $entry  = array(
                    'smc_name' => Input::get('main_catg_name'),
                    'smc_status' => Input::get('catg_status'),
                    'smc_mc_id' => Input::get('catg_id')
                );
                $return = Category::save_main_category($entry);
                return Redirect::to('manage_category')->with('success', 'Category Inserted Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function manage_main_category($catg_id)
    {
        if (Session::has('userid')) {
            $adminheader        = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus     = view('siteadmin.includes.admin_left_menus');
            $adminfooter        = view('siteadmin.includes.admin_footer');
            $sub_maincatg_list  = Category::sub_maincatg_list($catg_id);
            $subcatg_count_list = Category::subcatg_count_list($sub_maincatg_list);
            return view('siteadmin.manage_maincategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('sub_maincatg_list', $sub_maincatg_list)->with('subcatg_count_list', $subcatg_count_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function edit_main_category($id)
    {
        if (Session::has('userid')) {
            $adminheader            = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus         = view('siteadmin.includes.admin_left_menus');
            $adminfooter            = view('siteadmin.includes.admin_footer');
            $edit_main_catg_details = Category::edit_main_catg_details($id);
            return view('siteadmin.edit_maincategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('edit_main_catg_details', $edit_main_catg_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function edit_main_category_submit()
    {
        if (Session::has('userid')) {
            $data         = Input::except(array(
                '_token'
            ));
            $catg_id      = Input::get('catg_id');
            $main_catg_id = Input::get('main_catg_id');
            $rule         = array(
                'main_catg_name' => 'required',
                'catg_status' => 'required'
            );
            $validator    = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_main_category')->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();
                $entry  = array(
                    'smc_name' => Input::get('main_catg_name'),
                    'smc_status' => Input::get('catg_status')
                );
                $return = Category::save_edit_main_category($entry, $main_catg_id);
                return Redirect::to('manage_main_category/' . $catg_id)->with('success', 'Category Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function add_sub_main_category($sub_id)
    {
        if (Session::has('userid')) {
            $adminheader          = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus       = view('siteadmin.includes.admin_left_menus');
            $adminfooter          = view('siteadmin.includes.admin_footer');
            $add_sub_catg_details = Category::add_sub_catg_details($sub_id);
            return view('siteadmin.add_subcategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('add_sub_catg_details', $add_sub_catg_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function add_sub_category_submit()
    {
        if (Session::has('userid')) {
            $data      = Input::except(array(
                '_token'
            ));
            $id        = Input::get('catg_id');
            $main_id   = Input::get('main_catg_id');
            $rule      = array(
                'main_catg_name' => 'required',
                'catg_status' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_sub_main_category/' . $id)->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();
                $entry  = array(
                    'sb_name' => Input::get('main_catg_name'),
                    'sb_status' => Input::get('catg_status'),
                    'mc_id' => Input::get('main_catg_id'),
                    'sb_smc_id' => Input::get('catg_id')
                );
                $return = Category::save_sub_category($entry);
                return Redirect::to('manage_main_category/' . $main_id)->with('success', 'Category Inserted Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public static function status_main_category_submit($id, $mc_id, $status)
    {
        if (Session::has('userid')) {
            $return = Category::status_main_category_submit($id, $status);
            return Redirect::to('manage_main_category/' . $mc_id)->with('success', 'Category Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public static function delete_main_category($id, $mc_id)
    {
        if (Session::has('userid')) {
            $return = Category::delete_main_category($id);
            $remain = Category::sub_maincatg_list($mc_id);

            if(count($remain) == 0)
            {
                return Redirect::to('manage_category');
            } else {
                return Redirect::to('manage_main_category/' . $mc_id)->with('success', 'Category Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function manage_sub_category($catg_id)
    {
        if (Session::has('userid')) {
            $adminheader           = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus        = view('siteadmin.includes.admin_left_menus');
            $adminfooter           = view('siteadmin.includes.admin_footer');
            $sub_catg_list         = Category::sub_catg_list($catg_id);
            $secsubcatg_count_list = Category::secsubcatg_count_list($sub_catg_list);
            return view('siteadmin.manage_subcategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('sub_catg_list', $sub_catg_list)->with('secsubcatg_count_list', $secsubcatg_count_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function add_secsub_main_category($sub_id)
    {
        if (Session::has('userid')) {
            $adminheader              = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus           = view('siteadmin.includes.admin_left_menus')->with("routemenu", "settings");
            $adminfooter              = view('siteadmin.includes.admin_footer');
            $add_secsub_main_category = Category::add_secsub_main_category($sub_id);
            return view('siteadmin.add_secsubcategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('add_secsub_main_category', $add_secsub_main_category);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function add_secsub_main_category_submit()
    {
        if (Session::has('userid')) {
            $data      = Input::except(array(
                '_token'
            ));
            $id        = Input::get('catg_id');
            $main_id   = Input::get('main_catg_id');
            $rule      = array(
                'main_catg_name' => 'required',
                'catg_status' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_secsub_main_category/' . $id)->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();
                $entry  = array(
                    'ssb_name' => Input::get('main_catg_name'),
                    'ssb_status' => Input::get('catg_status'),
                    'ssb_sb_id' => Input::get('catg_id'),
                    'ssb_smc_id' => Input::get('top_catg_id'),
                    'mc_id' => Input::get('main_catg_id')
                );
                $return = Category::save_secsub_category($entry);
                return Redirect::to('manage_sub_category/' . $main_id)->with('success', 'Category Inserted Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function edit_secsub_main_category($id)
    {
        if (Session::has('userid')) {
            $adminheader              = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus           = view('siteadmin.includes.admin_left_menus');
            $adminfooter              = view('siteadmin.includes.admin_footer');
            $edit_secsub_catg_details = Category::edit_secsub_catg_details($id);
            return view('siteadmin.edit_secsubcategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('edit_secsub_catg_details', $edit_secsub_catg_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public function edit_secsub_category_submit()
    {
        if (Session::has('userid')) {
            $data         = Input::except(array(
                '_token'
            ));
            $catg_id      = Input::get('catg_id');
            $main_catg_id = Input::get('main_catg_id');
            $rule         = array(
                'main_catg_name' => 'required',
                'catg_status' => 'required'
            );
            $validator    = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_secsub_main_category/' . $catg_id)->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();
                $entry  = array(
                    'sb_name' => Input::get('main_catg_name'),
                    'sb_status' => Input::get('catg_status')
                );
                $return = Category::save_editsecsub_main_category($entry, $catg_id);
                return Redirect::to('manage_sub_category/' . $main_catg_id)->with('success', 'Category Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
    
    public static function status_subsec_category_submit($id, $mc_id, $status)
    {
        if (Session::has('userid')) {
            $return = Category::status_subsec_category_submit($id, $status);
            return Redirect::to('manage_sub_category/' . $mc_id)->with('success', 'Category Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public static function delete_subsec_category($id, $smc_id, $mc_id)
    {
        if (Session::has('userid')) {
            $return = Category::delete_subsec_category($id);
            $remain = Category::sub_catg_list($smc_id);

            if(count($remain) == 0)
            {
                return Redirect::to('manage_main_category/' . $mc_id);
            } else {
                return Redirect::to('manage_sub_category/' . $smc_id)->with('success', 'Category Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_secsubmain_category($catg_id)
    {
        if (Session::has('userid')) {
            $adminheader      = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus   = view('siteadmin.includes.admin_left_menus');
            $adminfooter      = view('siteadmin.includes.admin_footer');
            $secsub_catg_list = Category::secsub_catg_list($catg_id);
            
            return view('siteadmin.manage_secsubcategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('secsub_catg_list', $secsub_catg_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public static function status_secsub_category_submit($id, $mc_id, $status)
    {
        if (Session::has('userid')) {
            $return = Category::status_secsub_category_submit($id, $status);
            return Redirect::to('manage_secsubmain_category/' . $mc_id)->with('success', 'Category Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public static function delete_secsub_category($id, $sb_id, $smc_id)
    {
        if (Session::has('userid')) {
            $return = Category::delete_secsub_category($id);
            $remain = Category::secsub_catg_list($sb_id);
            if(count($remain) == 0)
            {
                return Redirect::to('manage_main_category/' . $smc_id);
            } else {
                return Redirect::to('manage_sub_category/' . $sb_id)->with('success', 'Category Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_sec1sub_main_category($id)
    {
        if (Session::has('userid')) {
            $adminheader               = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus            = view('siteadmin.includes.admin_left_menus');
            $adminfooter               = view('siteadmin.includes.admin_footer');
            $edit_sec1sub_catg_details = Category::edit_sec1sub_catg_details($id);
            
            return view('siteadmin.edit_sec1subcategory')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('edit_sec1sub_catg_details', $edit_sec1sub_catg_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_sec1sub_category_submit()
    {
        if (Session::has('userid')) {
            $data         = Input::except(array(
                '_token'
            ));
            $catg_id      = Input::get('catg_id');
            $main_catg_id = Input::get('main_catg_id');
            $rule         = array(
                'main_catg_name' => 'required',
                'catg_status' => 'required'
                
            );
            
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_sec1sub_main_category/' . $catg_id)->withErrors($validator->messages())->withInput();
                
            } else {
                $inputs = Input::all();
                
                $entry  = array(
                    'ssb_name' => Input::get('main_catg_name'),
                    'ssb_status' => Input::get('catg_status')
                    
                );
                $return = Category::save_editsec1sub_main_category($entry, $catg_id);
                return Redirect::to('manage_secsubmain_category/' . $main_catg_id)->with('success', 'Category Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function  select_category_from_theme()
    {
        $theme_id = $_GET['theme_id'];
        $cats = Category::where('mc_parent_theme', $theme_id)->get();
        return response()->json(['categories'=>$cats]);
    }
    
}
