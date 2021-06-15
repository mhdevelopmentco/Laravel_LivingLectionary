<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use App\Merchant;

class Withdraw extends Model
{
    protected $table = 'nm_withdraws';

    protected $fillable = ['merchant_id', 'payout_batch_id',  'amount', 'status', 'status_msg'];

    protected $appends = ['contributor_name', 'status_message'];

    const WITHDRAW_STATUS_REQUEST = 1;
    const WITHDRAW_STATUS_DISALLOWED = 2;
    const WITHDRAW_STATUS_SUCCESS = 3;
    const WITHDRAW_STATUS_FAILED = 4;

    public  function getContributorNameAttribute()
    {
        $merchant = Merchant::find($this->merchant_id);
        return $merchant->name;
    }

    public function getStatusMessageAttribute()
    {
        if($this->status == Withdraw::WITHDRAW_STATUS_FAILED || $this->status == Withdraw::WITHDRAW_STATUS_SUCCESS)
        {
            return $this->status_msg;
        } else if($this->status == Withdraw::WITHDRAW_STATUS_DISALLOWED)
        {
            return "Disallowed";
        } else {
            return "Request";
        }
    }
}

?>
