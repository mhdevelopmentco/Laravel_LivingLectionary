<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\State;
use App\Member;


class Tax extends Model
{

    protected $primaryKey = "tax_id";
    protected $table = "nm_tax";

    protected $fillable = ['tax_co_id', 'tax_st_id', 'tax_amount', 'tax_status'];
    protected $appends = ['co_name', 'st_name'];

    public function getCoNameAttribute()
    {
        $country_id = $this->tax_co_id;
        if ($country_id) {
            $country = Country::find($country_id);
            if ($country) {
                return $country->co_name;
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public function getStNameAttribute()
    {
        $state_id = $this->tax_st_id;
        if ($state_id) {
            $state = State::find($state_id);
            if ($state) {
                return $state->st_name;
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public static function get_tax_by_customer($cus_id)
    {
        $customer = Member::find($cus_id);
        if($customer)
        {
            $tax = Tax::where('tax_co_id', $customer->mem_country)->where('tax_st_id', $customer->mem_state)->where('tax_status', 1)->get()->first();
            if($tax)
            {
                return $tax->tax_amount;
            }
        }

        return 0;
    }
}
