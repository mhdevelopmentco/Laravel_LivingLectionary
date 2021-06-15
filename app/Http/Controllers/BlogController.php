<?php
namespace App\Http\Controllers;

use App\Blog;
use App\Http\Models;
use App\Member;
use App\Country;
use App\City;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class BlogController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */

    public function add_blog()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $categoryresult = Blog::get_category();
            return view('siteadmin.add_blog')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('categoryresult', $categoryresult);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_customer($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_customer');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $countryresult = Country::get_country_list();
            $customerresult = Member::get_member($id);
            return view('siteadmin.edit_customer')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('countryresult', $countryresult)->with('customerresult', $customerresult);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_blogcomments()
    {
        if (Session::has('userid')) {
            Session::put('blogcmtcount', 0);
            Blog::update_blog_msgstatus();
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $get_blogcmts_details = Blog::blogcmnts_list();
            return view('siteadmin.manage_blogcomments')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('blog_comments', $get_blogcmts_details);
        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function status_blogcmt_submit($cmtid, $status)
    {
        if (Session::has('userid')) {
            $return = Blog::block_blog_cmt($cmtid, $status);
            if ($status == 1) {
                return Redirect::to('manage_blogcmts')->with('success', 'Comments Approved Successfully');
            } else {
                return Redirect::to('manage_blogcmts')->with('success', 'Comments Unapproved Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function reply_blogcmts($cmtid)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $cmtsdetails = Blog::get_blogcmts_details($cmtid);
            return view('siteadmin.reply_blog')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('cmtsdetails', $cmtsdetails);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function admin_blogreply_submit()
    {
        if (Session::has('userid')) {
            $cmtid = Input::get('cmt_id');
            $entry = array(
                'reply_blog_id' => Input::get('blog_id'),
                'reply_cmt_id' => Input::get('cmt_id'),
                'reply_msg' => Input::get('blog_reply'),
            );
            $return = Blog::insert_reply($entry);
            return Redirect::to('manage_blogcmts')->with('success', 'Reply Saved Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function customer_edit_getcity()
    {
        $id = $_GET['city_id'];
        $selectcity = Member::get_member_city($id);
        if ($selectcity) {
            $return = "";
            foreach ($selectcity as $selectcity_ajax) {
                $return = "<option value='" . $selectcity_ajax->ci_id . "' selected> " . $selectcity_ajax->ci_name . " </option>";
            }
            echo $return;
        } else {
            echo $return = "<option value='0'> No Datas Found </option>";
        }
    }

    public function add_blog_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $rule = array(
                'blog_title' => 'required',
                'blog_description' => 'required',
                'blog_category' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'tags' => 'required',
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_blog')->withErrors($validator->messages())->withInput();
            } else {
                $blogtitle = Input::get('blog_title');
                $checkblogtitle = Blog::check_blogtitle($blogtitle);
                if ($checkblogtitle) {
                    return Redirect::to('add_blog')->withMessage("Already Blog Title Exists")->withInput();
                } else {
                    $blog_comments = Input::get('allow_comments');
                    if (!$blog_comments) {
                        $blog_comments = 0;
                    }
                    $file = Input::file('file');
                    if ($file != '') {
                        $file = Input::file('file');
                        $filename = $file->getClientOriginalName();
                        $move_img = explode('.', $filename);
                        $filename = $move_img[0] . str_random(8) . "." . $move_img[1];
                        $destinationPath = './public/assets/images/blogimage/';
                        $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
                        $entry = array(
                            'blog_title' => Input::get('blog_title'),
                            'blog_desc' => Input::get('blog_description'),
                            'blog_catid' => Input::get('blog_category'),
                            'blog_image' => $filename,
                            'blog_metatitle' => Input::get('meta_title'),
                            'blog_metadesc' => Input::get('meta_description'),
                            'blog_metakey' => Input::get('meta_keywords'),
                            'blog_tags' => Input::get('tags'),
                            'blog_comments' => $blog_comments,
                            'blog_type' => Input::get('blogstatus'),
                            'blog_status' => 0,
                        );
                        $return = Blog::insert_blog($entry);
                        if (Input::get('blogstatus') == 1) {
                            return Redirect::to('manage_publish_blog')->with('success', 'Record Inserted Successfully');
                        } else {
                            return Redirect::to('manage_draft_blog')->with('success', 'Record Inserted Successfully');
                        }
                    } else {
                        return Redirect::to('add_blog')->withMessage("Please upload Blog Image")->withInput();
                    }
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_customer_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $customerid = Input::get('customer_edit_id');
            $rule = array(
                'customer_first_name' => 'required',
                'customer_Email' => 'required|email',
                'customem_phone' => 'required|numeric',
                'customem_address1' => 'required',
                'customem_address2' => 'required',
                'select_customer_country' => 'required',
                'select_customer_city' => 'required',
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_customer/' . $customerid)->withErrors($validator->messages())->withInput();
            } else {
                $emailaddr = Input::get('customer_Email');
                $checkemailaddr = Member::check_emailaddress_edit($emailaddr, $customerid);
                if ($checkemailaddr) {
                } else {
                    return Redirect::to('edit_customer/' . $customerid)->withMessage('Specification Name Exist')->withInput();

                    $entry = array(
                        'mem_name' => Input::get('customer_first_name'),
                        'mem_email' => Input::get('customer_Email'),
                        'mem_phone' => Input::get('customem_phone'),
                        'mem_address1' => Input::get('customem_address1'),
                        'mem_address2' => Input::get('customem_address2'),
                        'mem_country' => Input::get('select_customer_country'),
                        'mem_city' => Input::get('select_customer_city'),
                    );
                    
                    $return = Member::insert_member($entry);
                    return Redirect::to('add_customer');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_draft_blog()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $get_manage_draft_category = Blog::get_manage_draft_category();
            return view('siteadmin.manage_draft_blog')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('blog_details', $get_manage_draft_category);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_publish_blog()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $get_manage_publish_category = Blog::get_manage_publish_category();
            return view('siteadmin.manage_publish_blog')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('blog_details', $get_manage_publish_category);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function block_blog($id, $status, $blog_type)
    {
        if (Session::has('userid')) {
            $return = Blog::block_blog($id, $status);
            if ($blog_type == 1) {
                return Redirect::to('manage_publish_blog')->with('success', 'Record Updated Successfully');
            } else {
                return Redirect::to('manage_draft_blog')->with('success', 'Record Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_blog_submit($id, $blog_type)
    {
        if (Session::has('userid')) {
            $return = Blog::delete_blog_submit($id);
            if ($blog_type == 1) {
                return Redirect::to('manage_publish_blog')->with('success', 'Record Deleted Successfully');
            } else {
                return Redirect::to('manage_draft_blog')->with('success', 'Record Deleted Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_blog($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $categoryresult = Blog::get_category();
            $get_selected_blog = Blog::get_selected_blog($id);
            return view('siteadmin.edit_blog')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('categoryresult', $categoryresult)->with('selected_blog', $get_selected_blog);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_blog_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $id = Input::get('blog_id');
            $rule = array(
                'blog_title' => 'required',
                'blog_description' => 'required',
                'blog_category' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'tags' => 'required',
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_blog/' . $id)->withErrors($validator->messages())->withInput();
            } else {
                $blog_comments = Input::get('allow_comments');
                if (!$blog_comments) {
                    $blog_comments = 0;
                }
                $file = Input::file('file');
                if ($file != '') {
                    $file = Input::file('file');
                    $filename = $file->getClientOriginalName();
                    $move_img = explode('.', $filename);
                    $filename = $move_img[0] . str_random(8) . "." . $move_img[1];
                    $destinationPath = './public/assets/images/blogimage/';
                    $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
                    $entry = array(
                        'blog_title' => Input::get('blog_title'),
                        'blog_desc' => Input::get('blog_description'),
                        'blog_catid' => Input::get('blog_category'),
                        'blog_image' => $filename,
                        'blog_metatitle' => Input::get('meta_title'),
                        'blog_metadesc' => Input::get('meta_description'),
                        'blog_metakey' => Input::get('meta_keywords'),
                        'blog_tags' => Input::get('tags'),
                        'blog_comments' => $blog_comments,
                        'blog_type' => Input::get('blogstatus'),
                        'blog_status' => 0,
                    );
                } else {
                    $entry = array(
                        'blog_title' => Input::get('blog_title'),
                        'blog_desc' => Input::get('blog_description'),
                        'blog_catid' => Input::get('blog_category'),
                        'blog_metatitle' => Input::get('meta_title'),
                        'blog_metadesc' => Input::get('meta_description'),
                        'blog_metakey' => Input::get('meta_keywords'),
                        'blog_tags' => Input::get('tags'),
                        'blog_comments' => $blog_comments,
                        'blog_type' => Input::get('blogstatus'),
                        'blog_status' => 0,
                    );
                }
                $return = Blog::edit_blog($id, $entry);
                if (Input::get('blogstatus') == 1) {
                    return Redirect::to('manage_publish_blog')->with('success', 'Record Updated Successfully');
                } else {
                    return Redirect::to('manage_draft_blog')->with('success', 'Record Updated Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function blog_details($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $blog_list = Blog::get_selected_blog_details($id);
            return view('siteadmin.blog_details')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('blog_list', $blog_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function blog_settings()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "blog");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_blog');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $blog_settings = Blog::get_blog_settings();
            return view('siteadmin.blog_settings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('blog_settings', $blog_settings);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function blog_settings_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $id = Input::get('blog_id');
            $rule = array(
                'allow_comments' => 'required',
                'admin_approval' => 'required',
                'post_per_page' => 'required',
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('blog_settings')->withErrors($validator->messages())->withInput();
            } else {
                $entry = array(
                    'bs_allowcommt' => Input::get('allow_comments'),
                    'bs_radminapproval' => Input::get('admin_approval'),
                    'bs_postsppage' => Input::get('post_per_page'),
                );
                $return = Blog::edit_blog_settings($entry);
                return Redirect::to('blog_settings')->with('success', 'Record Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }
}
