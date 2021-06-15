<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use App\Member;
use DateTime;
use App\Order;
use App\OrderShip;
use App\OrderPayout;

class Merchant extends Member
{
    protected $table = 'nm_member';
    protected $primaryKey = "mem_id";

    protected $appends = ['avail_withdraw_amount'];

    public static function check_oldpwd($mem_id, $oldpwd)
    {
        return DB::table('nm_member')->where('mem_id', '=', $mem_id)->where('mem_password', '=', $oldpwd)->get();

    }

    public static function update_newpwd($mem_id, $confirmpwd)
    {
        return DB::table('nm_member')->where('mem_id', '=', $mem_id)->update(array(
            'mem_password' => $confirmpwd
        ));

    }


    //get contributors all resources
    public static function get_mer_all_resources_count($mer_id)
    {
        return DB::table('nm_product')->where('pro_mr_id', '=', $mer_id)->count();
    }

    //get active products of contributors
    public static function get_mer_active_resources_count($id)
    {
        return DB::table('nm_product')->where('pro_status', '=', 1)->where('pro_mr_id', '=', $id)->count();
    }

    //get approved products of contributors
    public static function get_mer_approved_resources_count($id)
    {
        return DB::table('nm_product')->where('pro_approved_status', Products::PRODUCT_STATUS_APPROVED)->where('pro_mr_id', '=', $id)->count();
    }

    //get disapproved products of contributors
    public static function get_mer_disapproved_resources_count($id)
    {
        return DB::table('nm_product')->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)->where('pro_mr_id', '=', $id)->count();
    }

    //get pending products of contributors
    public static function get_mer_pending_resource_count($id)
    {
        return DB::table('nm_product')->where('pro_approved_status', Products::PRODUCT_STATUS_PENDING)->where('pro_mr_id', '=', $id)->count();
    }

    //get sold products list of contributors
    public static function get_mer_sold_resources($mer_id)
    {
        $order_ships = OrderShip::where('ship_mer_id', $mer_id)->orderBy('order_id', 'DESC')->get();
        return $order_ships;
    }

    //get sold products of contributors
    public static function get_mer_sold_resources_count($mer_id)
    {
        $count = 0;
        $order_ships = OrderShip::where('ship_mer_id', $mer_id)->orderBy('order_id', 'DESC')->get();
        foreach ($order_ships as $order_ship) {
            $count += $order_ship->product_quantity;
        }

        return $count;
    }

    public static function get_mer_sold_products_by_period($mer_id, $from_date, $to_date)
    {

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');
            return OrderShip::where('ship_mer_id', $mer_id)->where('created_at', '>', $from_date)->orderBy('order_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return OrderShip::where('ship_mer_id', $mer_id)->whereBetween('created_at', array($from_date, $to_date))
                ->orderBy('order_id', 'DESC')->get();
        } elseif ($from_date == '' && $to_date != '') {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return OrderShip::where('ship_mer_id', $mer_id)->where('created_at', '<', $to_date)->orderBy('order_id', 'DESC')->get();
        }
    }


    //Shops of Contributor
    public static function get_mer_all_shop_count($id)
    {
        return DB::table('nm_store')->where('stor_merchant_id', '=', $id)->count();
    }


    //get active shop of contributor
    public static function get_mer_active_shop_count($id)
    {
        return DB::table('nm_store')->where('stor_merchant_id', '=', $id)->where('stor_status', 1)->count();
    }


    //get yearly transaction history
    public static function get_mer_year_transaction_chart_data($mer_id)
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');

        $ships = OrderShip::where('ship_mer_id', $mer_id)->whereBetween('created_at', array($first_day, $last_day))
            ->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        $orders = [
            '1' => 0, '2' => 0, '3' => 0,
            '4' => 0, '5' => 0, '6' => 0,
            '7' => 0, '8' => 0, '9' => 0,
            '10' => 0, '11' => 0, '12' => 0,
        ];

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $order_date = $order->created_at;
            $order_month = date('n', strtotime($order_date));
            if (array_key_exists($order_month, $orders))
                $orders[$order_month] = $orders[$order_month] + 1;
            else
                $orders[$order_month] = 1;
        }

        return array_values($orders);
    }

    //get merchant all transactions count
    public static function get_mer_transaction_count($mer_id)
    {
        return count(Merchant::get_all_orders($mer_id));
    }




















    public static function merchant_productrep($from_date, $to_date, $merchant_id)
    {
        if ($from_date != '' && $to_date == '') {

            return DB::table('nm_product')->where('nm_product.pro_mr_id', '=', $merchant_id)->where('nm_product.created_date', $from_date)->where('nm_product.pro_status', '=', 1)->orderBy('nm_product.pro_id', 'DESC')->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->get();

        } elseif ($from_date != '' && $to_date != '') {

            return DB::table('nm_product')->where('nm_product.pro_mr_id', '=', $merchant_id)->whereBetween('nm_product.created_date', array(
                $from_date,
                $to_date
            ))->where('nm_product.pro_status', '=', 1)->orderBy('nm_product.pro_id', 'DESC')->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->get();
        } else {

        }

    }

    public static function allprod_reports($from_date, $to_date, $merchant_id)
    {

        if ($from_date != '' && $to_date == '') {

            return DB::table('nm_product')->where('nm_product.pro_mr_id', '=', $merchant_id)->where('nm_product.created_date', $from_date)->orderBy('nm_product.pro_id', 'DESC')->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->get();
        } elseif ($from_date != '' && $to_date != '') {

            return DB::table('nm_product')->where('nm_product.pro_mr_id', '=', $merchant_id)->whereBetween('nm_product.created_date', array(
                $from_date,
                $to_date
            ))->orderBy('nm_product.pro_id', 'DESC')->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->get();
        } else {

        }

    }

    public static function merchant_soldreports($from_date, $to_date, $id)
    {

        if ($from_date != '' && $to_date == '') {

            return DB::table('nm_product')->where('nm_product.pro_mr_id', '=', $id)->where('nm_product.created_date', $from_date)->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->get();

        } elseif ($from_date != '' && $to_date != '') {

            return DB::table('nm_product')->where('nm_product.pro_mr_id', '=', $id)->whereBetween('nm_product.created_date', array(
                $from_date,
                $to_date
            ))->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->get();
        } else {

        }

    }

    public static function get_order_details()
    {
        return DB::table('nm_order')->where('order_type', '=', 1)->get();
    }

    public static function delete_product($id)
    {

        return DB::table('nm_product')->where('pro_id', '=', $id)->delete();

    }


    //get merchant's all orders by period
    public static function get_all_orders_by_period($mer_id, $from_date, $to_date)
    {
        $orders = $ships = [];

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $ships = OrderShip::where('ship_mer_id', $mer_id)->where('created_at', '>=', $from_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_mer_id', $mer_id)->whereBetween('created_at', array($from_date, $to_date))->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date == '' && $to_date) {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_mer_id', $mer_id)->where('created_at', '=<', $to_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        }

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }

        return $orders;
    }

    //get merchant's all orders
    public static function get_all_orders($mer_id)
    {
        $orders = [];
        $ships = OrderShip::where('ship_mer_id', $mer_id)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get merchant's ship orders by period
    public static function get_ship_orders_by_period($mer_id, $from_date, $to_date)
    {
        $orders = $ships = [];

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $ships = OrderShip::where('ship_mer_id', $mer_id)->where('ship_type', 1)->where('created_at', '>=', $from_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_mer_id', $mer_id)->where('ship_type', 1)->whereBetween('created_at', array($from_date, $to_date))->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date == '' && $to_date) {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_mer_id', $mer_id)->where('ship_type', 1)->where('created_at', '=<', $to_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        }

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }

        return $orders;
    }

    //get merchant's ship orders
    public static function get_ship_orders($mer_id)
    {
        $orders = [];
        $ships = OrderShip::where('ship_mer_id', $mer_id)->where('ship_type', 1)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }

        return $orders;
    }


    //get merchant's completed orders by period
    public static function get_completed_orders_by_period($mer_id, $from_date, $to_date)
    {
        $orders = $ships = [];

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $ships = OrderShip::where('ship_mer_id', $mer_id)->where('created_at', '>=', $from_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_mer_id', $mer_id)->whereBetween('created_at', array($from_date, $to_date))->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date == '' && $to_date) {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_mer_id', $mer_id)->where('created_at', '=<', $to_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        }

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            if ($order->order_status == 1) {
                $orders[] = $order;
            }
        }

        return $orders;
    }

    //get merchant's completed orders
    public static function get_completed_orders($mer_id)
    {
        $orders = [];
        $ships = OrderShip::where('ship_mer_id', $mer_id)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            if ($order->order_status == 1) {
                $orders[] = $order;
            }
        }
        return $orders;
    }

    //get today orders
    public static function get_today_orders($mer_id)
    {
        $orders = [];
        $today = (new DateTime("now"))->format('Y-m-d');

        $ships = OrderShip::where('ship_mer_id', $mer_id)->where('created_at', '=', $today)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get week orders
    public static function get_week_orders($mer_id)
    {
        $orders = [];
        $today = new DateTime("now");

        $first_day = $today->modify('this week');
        $first_day = $first_day->format('Y-m-d');
        $last_day = $today->modify('this week +6 days');
        $last_day = $last_day->format('Y-m-d');


        $ships = OrderShip::where('ship_mer_id', $mer_id)->whereBetween('created_at', array($first_day, $last_day))
            ->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get month orders
    public static function get_month_orders($mer_id)
    {
        $orders = [];
        $today = new DateTime("now");
        $first_day = $today->modify('first day of this month');
        $first_day = $first_day->format('Y-m-d');
        $last_day = $today->modify('last day of this month');
        $last_day = $last_day->format('Y-m-d');

        $ships = OrderShip::where('ship_mer_id', $mer_id)->whereBetween('created_at', array($first_day, $last_day))
            ->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get this year transaction chart details
    public static function get_this_year_transaction_charts($mer_id)
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');


        $ships = OrderShip::where('ship_mer_id', $mer_id)->whereBetween('created_at', array($first_day, $last_day))
            ->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        $orders = [
            '1' => 0, '2' => 0, '3' => 0,
            '4' => 0, '5' => 0, '6' => 0,
            '7' => 0, '8' => 0, '9' => 0,
            '10' => 0, '11' => 0, '12' => 0,
        ];

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $order_date = $order->created_at;
            $order_month = date('n', strtotime($order_date));
            if (array_key_exists($order_month, $orders))
                $orders[$order_month] = $orders[$order_month] + 1;
            else
                $orders[$order_month] = 1;
        }

        return array_values($orders);
    }

    public function getAvailWithdrawAmountAttribute()
    {
        return OrderPayout::where('merchant_id', $this->mem_id)->where('pay_status', 0)->get()->sum('payout_amount');
    }
}

?>
