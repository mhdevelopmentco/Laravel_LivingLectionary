<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Theme extends Model
{
    protected $table = 'nm_theme';
    protected $primaryKey = 'theme_id';

    protected $fillable = [
        'theme_name',
        'theme_banner_title',
        'theme_banner_img',
        'theme_heading',
        'theme_description',
        'theme_side',
        'theme_status',
        'parent_theme',
    ];

    protected $appends = ['sub_theme_count'];

    public function getSubThemeCountAttribute()
    {

        return Theme::where('parent_theme', $this->theme_id)->count();
    }

    public static function insert_theme($entry)
    {
        return DB::table('nm_theme')->insert($entry);
    }

    public static function update_theme($id, $entry)
    {
        return DB::table('nm_theme')->where('theme_id', '=', $id)->update($entry);
    }

    public static function delete_theme($id)
    {
        //delete child theme first
        DB::table('nm_theme')->where('parent_theme', $id)->delete();

        return DB::table('nm_theme')->where('theme_id', '=', $id)->delete();
    }

    public static function status_theme($id, $status)
    {
        return DB::table('nm_theme')->where('theme_id', '=', $id)->update(array('theme_status' => $status));
    }


    public static function check_themename($name)
    {
        return DB::table('nm_theme')->where('theme_name', '=', $name)->get();
    }

    public static function check_themename2($id, $name)
    {
        return DB::table('nm_theme')->where('theme_id', '!=', $id)->where('theme_name', '=', $name)->get();
    }

    public static function get_theme_list()
    {
        return DB::table('nm_theme')->get();
    }

    public static function get_top_theme_list()
    {
        return DB::table('nm_theme')->where('theme_status', '=', 1)->where('parent_theme', '=', 0)->get();
    }

    public static function get_theme_normal_list()
    {
        return DB::table('nm_theme')->where('theme_status', '=', 1)->get();
    }

    public static function get_individual_theme_detail($id)
    {
        return DB::table('nm_theme')->where('theme_id', '=', $id)->get();
    }

    public static function get_individual_theme_detail_not_blocked($id)
    {
        return DB::table('nm_theme')->where('theme_id', '=', $id)->where('theme_status', '=', 1)->get();
    }

    public static function get_used_notused_product_list($id)
    {
        $used_products = [];
        $not_used_products = [];

        $products = DB::table('nm_product')->where('pro_status', 1)->get();

        foreach ($products as $product) {
            $pro_theme_ids = $product->pro_theme_ids;

            if ($pro_theme_ids) {
                $ptids = explode(':', $pro_theme_ids);
                if (in_array($id, $ptids)) {
                    $used_products[] = [$product->pro_id, $product->pro_title];
                } else {
                    $not_used_products[] = [$product->pro_id, $product->pro_title];
                }

            } else {
                $not_used_products[] = [$product->pro_id, $product->pro_title];
            }
        }

        return [$used_products, $not_used_products];
    }

    public function get_theme_trending_products()
    {
        $trending_products = [];
        $all_products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->where('pro_approved_status', Products::PRODUCT_STATUS_APPROVED)->where('pro_theme_ids', '!=', '')->get()->all();
        foreach ($all_products as $ap) {
            if ($ap->has_theme_id($this->theme_id)) {
                $trending_products[] = $ap;
            }
        }
        return $trending_products;
    }
}

?>
