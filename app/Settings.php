<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Settings extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_generalsetting';
    
    public static function view_general_setting()
    {
        return DB::table('nm_generalsetting')->get();
    }

    public static function view_language_list()
    {
        return DB::table('nm_language')->get();
    }

    public static function view_theme_list()
    {
        return DB::table('nm_theme')->get();
    }
    
    public static function insert_logo($entry)
    {
        return DB::table('nm_imagesetting')->insert($entry);
    }

    public static function insert_noimage($entry)
    {
        return DB::table('nm_imagesetting')->insert($entry);
        
    }

    public static function insert_favicon($entry)
    {
        return DB::table('nm_imagesetting')->insert($entry);
        
    }

    public static function get_logo_details()
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 1)->get();
    }

    public static function get_inverse_logo_details()
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 4)->get();
    }

    public static function get_favicon_details()
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 2)->get();
    }

    public static function get_noimage_details()
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 3)->get();
    }

    public static function update_logo($filename)
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 1)->update(array(
            'imgs_name' => $filename
        ));
    }

    public static function update_logo2($filename)
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 4)->update(array(
            'imgs_name' => $filename
        ));
    }

    public static function view_email_settings()
    {
        return DB::table('nm_emailsetting')->get();
    }

    public static function view_smtp_settings()
    {
        return DB::table('nm_smtp')->where('sm_id', '=', '1')->get();
    }

    public static function update_favicon($filename)
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 2)->update(array(
            'imgs_name' => $filename
        ));
    }

    public static function update_noimage($filename)
    {
        return DB::table('nm_imagesetting')->where('imgs_type', '=', 3)->update(array(
            'imgs_name' => $filename
        ));
    }
    
    public static function view_send_settings()
    {
        return DB::table('nm_smtp')->where('sm_id', '=', '2')->get();
    }

    public static function save_general_set($entry)
    {
        return DB::table('nm_generalsetting')->where('gs_id', '=', '1')->update($entry);
    }

    public static function save_email_set($entry)
    {
        return DB::table('nm_emailsetting')->where('es_id', '=', '1')->update($entry);
    }

    public static function save_smtp_set($entry)
    {
        return DB::table('nm_smtp')->where('sm_id', '=', '1')->update($entry);
    }

    public static function save_send_set($entry)
    {
        return DB::table('nm_smtp')->where('sm_id', '=', '2')->update($entry);
    }

    public static function save_smtp_set_def()
    {
        return DB::table('nm_smtp')->update(array(
            'sm_isactive' => 0
        ));
    }
    
    public static function social_media_settings()
    {
        return DB::table('nm_social_media')->where('sm_id', '=', '1')->get();
    }
    
    public static function update_social_media_settings($entry)
    {
        return DB::table('nm_social_media')->where('sm_id', '=', '1')->update($entry);
    }
    

    public static function get_country_value_ajax($id)
    {
        return DB::table('nm_country')->where('co_id', '=', $id)->get();
    }
    
    public static function get_pay_settings()
    {
        return DB::table('nm_paymentsettings')->where('ps_id', '=', '1')->get();
    }

    public static function update_payment_settings($entry)
    {
        return DB::table('nm_paymentsettings')->where('ps_id', '=', '1')->update($entry);
    }


    public static function update_modul_settings($entry)
    {
        return DB::table('nm_modulesettings')->where('ms_id', '=', '1')->update($entry);
    }
    
    public static function get_newsletter_subscribers()
    {
        return DB::table('nm_newsletter_subscribers')->get();
    }
    
    public static function edit_newsletter_subs_status($id, $status)
    {
        return DB::table('nm_newsletter_subscribers')->where('id', '=', $id)->update(array(
            'status' => $status
        ));
    }
    
    public static function delete_newsletter_subs($id)
    {
        return DB::table('nm_newsletter_subscribers')->where('id', '=', $id)->delete();
    }

}
?>