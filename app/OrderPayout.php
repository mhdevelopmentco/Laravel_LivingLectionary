<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayout extends Model {

    protected $table = "nm_order_payouts";
    protected $fillable = [
        'merchant_id', 'order_id', 'payout_amount', 'pay_status'
    ];

    protected $appends = [];

    

}
