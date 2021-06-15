<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Footer extends Model
{
    
    protected $guarded = array('id');
    protected $table = 'nm_cms_pages';
    
    public static function fetch_front_cms_details($id)
    {
        return DB::table('nm_cms_pages')->where('cp_id', $id)->get();
    }
    
    public static function get_faq_details()
    {
        return DB::table('nm_faq')->where('faq_status', 1)->get();
    }

    public static function get_help_details()
    {
        return DB::table('nm_cms_pages')->where('cp_status', 1)->get();
    }


    public static function get_social_media_url()
    {
        return DB::table('nm_social_media')->where('sm_id', 1)->get();
    }
    
    public static function insert_newsletter_submit($email)
    {
        return DB::table('nm_newsletter_subscribers')->insert(array(
            'email_id' => $email
        ));
    }
    
    public static function insert_inquires_submit($entry)
    {
        return DB::table('nm_inquiries')->insert($entry);
    }

    public static function get_blog_list_popular()
    {
        return DB::table('nm_blog')->where('blog_status', 0)->where('blog_type', 1)->orderBy(DB::raw('RAND()'))->take(5)->get();
    }

    public static function get_blog_list()
    {
        return DB::table('nm_blog')->where('blog_status', 0)->where('blog_type', 1)->get();
    }

    public static function get_blog_list_count($query)
    {
        $check_approve = DB::table('nm_blogsetting')->get();
        foreach ($check_approve as $admin_approve) {
            $adm_status = $admin_approve->bs_radminapproval;
        }
        foreach ($query as $blog) {
            if ($adm_status == 1) {
                $blog_result = DB::table('nm_blog_cus_comments')->where('cmt_blog_id', '=', $blog->blog_id)->where('cmt_admin_approve', '=', 1)->get();
            } else {
                $blog_result = DB::table('nm_blog_cus_comments')->where('cmt_blog_id', '=', $blog->blog_id)->get();
            }
            $result[$blog->blog_id] = count($blog_result);
        }
        if (isset($result)) {
            return $result;
        }
    }

    public static function get_blog_list_cat_name($query)
    {
        foreach ($query as $blog) {
            $blog_result = DB::table('nm_maincategory')->where('mc_id', '=', $blog->blog_catid)->get();
            if ($blog_result) {
                foreach ($blog_result as $cat_name) {
                }
                $result[$blog->blog_catid] = $cat_name->mc_name;
            } else {
                $result[$blog->blog_catid] = "";
            }
        }
        if (isset($result)) {
            return $result;
        }
    }

    public static function get_blog_list_by_category($id)
    {
        return DB::table('nm_blog')->where('blog_status', 0)->where('blog_type', 1)->where('blog_catid', $id)->get();
    }
    
    public static function get_blog_list_by_id($id)
    {
        return DB::table('nm_blog')->where('blog_status', 0)->where('blog_type', 1)->where('blog_id', $id)->get();
    }
    
    public static function get_blog_comment_check()
    {
        return DB::table('nm_blogsetting')->get();
    }
    
    public static function insert_blog_cmt($entry)
    {
        return DB::table('nm_blog_cus_comments')->insert($entry);
    }
    
    public static function get_blog_cus_cmt($id)
    {
        $check_approve = DB::table('nm_blogsetting')->get();
        foreach ($check_approve as $admin_approve) {
            $adm_status = $admin_approve->bs_radminapproval;
        }
        if ($adm_status == 1) {
            return DB::table('nm_blog_cus_comments')->where('cmt_blog_id', '=', $id)->where('cmt_admin_approve', '=', 1)->get();
        } else {
            return DB::table('nm_blog_cus_comments')->where('cmt_blog_id', '=', $id)->get();
        }
    }
    
    public static function get_admin_reply()
    {
        $result        = "";
        $check_approve = DB::table('nm_blogsetting')->get();
        foreach ($check_approve as $admin_approve) {
            $adm_status = $admin_approve->bs_radminapproval;
        }
        if ($adm_status == 1) {
            $adm_result = DB::table('nm_blog_cus_comments')->where('cmt_admin_approve', '=', 1)->get();
        } else {
            $adm_result = DB::table('nm_blog_cus_comments')->get();
        }
        
        foreach ($adm_result as $reply) {
            $blog_result = DB::table('nm_adminreply_comments')->where('reply_cmt_id', '=', $reply->cmt_id)->get();
            if ($blog_result) {
                foreach ($blog_result as $adm_reply) {
                    $result[$reply->cmt_id] = $adm_reply->reply_msg . "/@@/" . $adm_reply->reply_date;
                }
            } else {
                $result[$reply->cmt_id] = "";
            }
            
        }
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
        
    }
    
    public static function get_contact_details()
    {
        return DB::table('nm_emailsetting')->get();
    }
/* GET ABOUTUS DETAILS */
	 public static function get_aboutus_details()
    {
        return DB::table('nm_aboutus')->get();
    }
    
}

?>
