<?php namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Theme;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;


class Curator extends Model
{

    protected $table = 'nm_curators';
    protected $fillable = ['curator_name', 'curator_email', 'curator_userid', 'curator_pwd', 'curator_theme', 'curator_img', 'status'];

    protected $appends = ['curator_theme_name', 'curator_theme_name_list',
        'disapproved_products', 'approved_products', 'all_products', 'pending_products'];

    public function getCuratorThemeNameAttribute()
    {
        $theme_names = "";

        $theme_list = $this->curator_theme;
        $theme_list = explode(':', $theme_list);
        foreach ($theme_list as $theme_id) {
            $theme = Theme::find($theme_id);
            if ($theme) {
                $theme_names .= $theme->theme_name . ', ';
            }
        }

        $theme_names = rtrim($theme_names, ', ');

        return $theme_names;

    }

    public function getCuratorThemeNameListAttribute()
    {
        $theme_names = [];

        $theme_list = $this->curator_theme;
        $theme_list = explode(':', $theme_list);
        foreach ($theme_list as $theme_id) {
            $theme = Theme::find($theme_id);
            if ($theme) {
                $theme_names []= $theme->theme_name;
            }
        }
        return $theme_names;
    }



    public static function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    //get approved products
    public function getApprovedProductsAttribute()
    {
        //find product that has not approved, by this curator from product table
        return Products::where('pro_checked_by', $this->id)->where('pro_approved_status', Products::PRODUCT_STATUS_APPROVED)->get()->all();
    }

    //get approved products
    public function getDisapprovedProductsAttribute()
    {
        //find product that has not approved, by this curator from product table
        return Products::where('pro_checked_by', $this->id)->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)->get()->all();
    }

    //get pending products
    public function getPendingProductsAttribute()
    {

        $curator_theme = $this->curator_theme;
        $curator_theme_ids = explode(':', $curator_theme);

        $all_products = Products::where('pro_checked_by', -1)->where('pro_approved_status', Products::PRODUCT_STATUS_PENDING)->get();

        $pending_products = [];

        foreach($all_products as $product)
        {
            $product_theme_ids = $product->pro_theme_ids;
            $product_theme_ids = explode(':', $product_theme_ids);
            $inter_arr = array_intersect($curator_theme_ids, $product_theme_ids);
            if(count($inter_arr)  > 0)
            {
                $pending_products [] = $product;
            }
        }

        return $pending_products;
    }

    public function getAllProductsAttribute()
    {
        //find product that has not approved, by this curator from product table
        $checked_products = Products::where('pro_checked_by', $this->id)->get()->all();
        $pending_products = $this->pending_products;
        $all_products = array_merge($checked_products, $pending_products);
        return $all_products;

    }

    public static function used_theme($id)
    {
        $current_theme = DB::table('nm_curators')->where('id', $id)->get(array('curator_theme'));
        $curator_theme_ids = $current_theme[0]->curator_theme; //null or string
        if ($curator_theme_ids) {
            $ctids = explode(':', $curator_theme_ids);
            $cts = DB::table('nm_theme')->whereIn('theme_id', $ctids)->where('theme_status', '=', 1)->get(array('theme_id', 'theme_name', 'theme_banner_img', 'parent_theme'));
            return $cts;
        } else {
            return null;
        }

    }

    public function has_theme_in_charge($tids)
    {
        $theme_list = $this->curator_theme;
        $theme_list = explode(':', $theme_list);

        $search_this = explode(':', $tids);

        $containsSearch = count(array_intersect($search_this, $theme_list));

        if($containsSearch > 0)
            return true;
        else
            return false;
    }

}
