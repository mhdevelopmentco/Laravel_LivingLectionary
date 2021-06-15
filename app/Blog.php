<?php
namespace App;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Blog extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_blog';
    
    public static function get_category()
    {
        return DB::table('nm_maincategory')->where('mc_status', '=', 1)->get();
    }

    public static function insert_blog($entry)
    {
        return DB::table('nm_blog')->insert($entry);
        
    }

    public static function edit_blog($id, $entry)
    {
        return DB::table('nm_blog')->where('blog_id', '=', $id)->update($entry);
        
    }

    public static function insert_reply($entry)
    {
        return DB::table('nm_adminreply_comments')->insert($entry);
        
    }

    public static function block_blog_cmt($id, $status)
    {
        return DB::table('nm_blog_cus_comments')->where('cmt_id', '=', $id)->update(array('cmt_admin_approve' => $status));
        
    }

    public static function get_blogcmts_details($id)
    {
        
        return DB::table('nm_blog_cus_comments')->where('cmt_id', '=', $id)->get();
    }

    public static function update_blog_msgstatus()
    {
        return DB::table('nm_blog_cus_comments')->update(array('cmt_msg_status' => 1));
    }

    public static function blogcmnts_list()
    {
        return DB::table('nm_blog_cus_comments')->LeftJoin('nm_blog', 'nm_blog_cus_comments.cmt_blog_id', '=', 'nm_blog.blog_id')->get();
        
    }
    
    public static function check_blogtitle($title)
    {
        return DB::table('nm_blog')->where('blog_title', '=', $title)->get();
        
    }

    public static function get_manage_draft_category()
    {
        
        return DB::table('nm_blog')->where('blog_type', '=', '2')->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_blog.blog_catid')->get();
        
    }

    public static function get_manage_publish_category()
    {
        
        return DB::table('nm_blog')->where('blog_type', '=', '1')->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_blog.blog_catid')->get();
        
    }

    public static function block_blog($id, $status)
    {
        return DB::table('nm_blog')->where('blog_id', '=', $id)->update(array('blog_status' => $status));
        
    }

    public static function delete_blog_submit($id)
    {
        return DB::table('nm_blog')->where('blog_id', '=', $id)->delete();
    }

    public static function get_selected_blog($id)
    {
        return DB::table('nm_blog')->where('blog_id', '=', $id)->get();
        
    }

    public static function get_selected_blog_details($id)
    {
        return DB::table('nm_blog')->where('blog_id', '=', $id)->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_blog.blog_catid')->get();
        
    }

    public static function get_blog_settings()
    {
        return DB::table('nm_blogsetting')->where('bs_id', '=', 1)->get();
    }

    public static function edit_blog_settings($entry)
    {
        return DB::table('nm_blogsetting')->where('bs_id', '=', 1)->update($entry);
        
    }

    public static function get_msgcount()
    {
        return DB::table('nm_blog_cus_comments')->where('cmt_msg_status', '=', 0)->count();
    }
}

?>
