<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderPayout;

class Order extends Model {

    protected $table = "nm_orders";

    protected $fillable = [
        'order_cus_id', 'order_cus_email', 'order_amount', 'order_product_amount', 'order_ship_amount', 'order_tax',
        'order_type', 'payment_id', 'payment_type', 'get_paid_status',
        'order_shipping_status', 'payout_to_merchant_status', 'order_status',
        'order_cus_name'
    ];

    protected $appends=['payouts', 'type_name', 'order_products', 'order_ships'];

    const ORDER_TYPE_FREE = 0;
    const ORDER_TYPE_PAYPAL = 1;
    const ORDER_TYPE_OTHER = 2;

    const ORDER_GET_PAID_SUCCESS_STATUS = 1 ;


    public function getCustomerNameAttribute()
    {
        $cus_id = $this->order_cus_id;
        if($cus_id)
        {
            $customer = Member::find($cus_id);
            return $customer->name;
        } else {
            //guest
            return "Guest";
        }
    }


    public function getTypeNameAttribute()
    {
        if($this->order_type == 0)
        {
            return "Free";
        } else {
            return "Paid";
        }
    }

    public function getPayoutsAttribute()
    {
        return OrderPayout::where('order_id', $this->id)->get();
    }

    public function getOrderShipsAttribute()
    {
        return OrderShip::where('order_id', $this->id)->get();
    }



    public function payout_to_merchant($mer_id)
    {
        return OrderPayout::where('order_id', $this->id)->where('merchant_id', $mer_id)->get();
    }

    public function get_payout_status_merchant($mer_id)
    {
        if( $this->payout_to_merchant_status == 1)
        {
            return true;
        }

        $paid = true;
        $payouts = $this->payout_to_merchant($mer_id);
        foreach($payouts as $payout)
        {
            if($payout->pay_status == 0)
            {
                $paid = false;
                break;
            }
        }
        return $paid;
    }

    public function get_shipping_status_merchant($mer_id)
    {
        if( $this->order_shipping_status == 1)
        {
            return true;
        }

        $order_ships = OrderShip::where('order_id', $this->id)->where('ship_mer_id', $mer_id)->get();

        $shipped = true;

        foreach($order_ships as $order_ship)
        {
            if($order_ship->ship_status == 0)
            {
                $shipped = false;
                break;
            }
        }

        return $shipped;
    }

    public function get_products_by_merchant($mer_id)
    {
        $order_ships = OrderShip::where('order_id', $this->id)->where('ship_mer_id', $mer_id)->get();
        return $order_ships;
    }


    public function getOrderProductsAttribute()
    {
        $order_ships = OrderShip::where('order_id', $this->id)->get();
        return $order_ships;
    }

    public function check_order_status()
    {
        //check shop status
        $order_ship_status = 1;
        $order_ships = $this->order_ships;
        foreach($order_ships as $order_ship)
        {
            if($order_ship->ship_status == 0)
            {
                $order_ship_status = 0;
                break;
            }
        }
        $this->order_shipping_status = $order_ship_status;

        //check payout_to_merchant_status and Order_shipping_status(get_paid_status)
        $payouts = $this->payouts;

        $payout_to_merchant_status = 1;
        foreach($payouts as $payout)
        {
            if($payout->pay_status == 0)
            {
                $payout_to_merchant_status = 0;
                break;
            }
        }

        $this->payout_to_merchant_status = $payout_to_merchant_status;

        if($this->payout_to_merchant_status == 1 && $this->order_shipping_status == 1 && $this->get_paid_status == 1)
        {
            $this->order_status = 1;
        }

        $this->save();
    }

}
