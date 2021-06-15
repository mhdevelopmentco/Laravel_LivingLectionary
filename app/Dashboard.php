<?php
namespace App;

use DB;
use Session;

use App\Order;
use App\OrderPayout;
use App\OrderShip;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use DateTime;

class Dashboard extends Model
{

    //get all merchant count
    public static function get_all_merchants_cnt()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_MERCHANT)->count();
    }

    //get active merchant count
    public static function get_active_merchants_cnt()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_MERCHANT)->where('mem_status', '=', 1)->count();
    }

    //get store count
    public static function get_all_stores_cnt()
    {
        return DB::table('nm_store')->count();
    }

    //get active store count
    public static function get_active_stores_cnt()
    {
        return DB::table('nm_store')->where('stor_status', 1)->count();
    }

    //get all members count
    public static function get_all_members_cnt()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_CUSTOMER)->count();
    }

    //get active members count
    public static function get_active_members_cnt()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_CUSTOMER)->where('mem_status', '=', 1)->count();
    }

    //get active members count
    public static function get_confirmed_members_cnt()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_CUSTOMER)
            ->where('mem_confirmed', '=', 1)->count();
    }

    //get all subscribers count
    public static function get_all_curators_cnt()
    {
        return DB::table('nm_curators')->count();
    }

    //get active subscribers count
    public static function get_active_curators_cnt()
    {
        return DB::table('nm_curators')->where('status', 1)->count();
    }

    //get all subscribers count
    public static function get_all_subscribers_cnt()
    {
        return DB::table('nm_subscribers')->count();
    }

    //get active subscribers count
    public static function get_active_subscribers_cnt()
    {
        return DB::table('nm_subscribers')->where('status', 1)->count();
    }

    //get newsletter subscribers count
    public static function get_all_newsletter_subscribers_cnt()
    {
        return DB::table('nm_newsletter_subscribers')->count();
    }

    //get active newsletter subscribers count
    public static function get_active_newsletter_subscribers_cnt()
    {
        return DB::table('nm_newsletter_subscribers')->where('status', 1)->count();
    }

    //get newsletter subscribers count
    public static  function get_member_newsletter_subscribers_cnt()
    {
        return DB::table('nm_newsletter_subscribers')->where('status', 1)->where('from_member', 1)->count();
    }

    //get all resources count
    public static function get_all_resource_cnt()
    {
        return DB::table('nm_product')->count();
    }

    //get active resources count
    public static function get_active_resources_cnt()
    {
        return DB::table('nm_product')->where('pro_status', '=', 1)->count();
    }



    //get blocked resources count
    public static function get_blocked_resources_cnt()
    {
        return DB::table('nm_product')->where('pro_status', '=', 0)->count();
    }

    //get approved resources count
    public static function get_approved_resources_cnt()
    {
        return DB::table('nm_product')->where('pro_approved_status', '=', Products::PRODUCT_STATUS_APPROVED)->count();
    }

    //get disapproved resources count
    public static function get_disapproved_resources_cnt()
    {
        return DB::table('nm_product')->where('pro_approved_status', '=', Products::PRODUCT_STATUS_NOT_APPROVED)->count();
    }

    //get active resources count
    public static function get_pending_resources_cnt()
    {
        return DB::table('nm_product')->where('pro_approved_status', '=', Products::PRODUCT_STATUS_PENDING)->count();
    }



    /* get transaction info */
    //get merchant's all orders by period
    public static function get_all_orders_by_period($from_date, $to_date)
    {
        $orders = $ships = [];

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $ships = OrderShip::where('created_at', '>=', $from_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::whereBetween('created_at', array($from_date, $to_date))->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date == '' && $to_date) {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('created_at', '=<', $to_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        }

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }

        return $orders;
    }

    //get merchant's all orders
    public static function get_all_orders()
    {
        $orders = Order::all();
        return $orders;
    }

    //get merchant's ship orders by period
    public static function get_ship_orders_by_period($from_date, $to_date)
    {
        $orders = $ships = [];

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $ships = OrderShip::where('ship_type', 1)->where('created_at', '>=', $from_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_type', 1)->whereBetween('created_at', array($from_date, $to_date))->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date == '' && $to_date) {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('ship_type', 1)->where('created_at', '=<', $to_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        }

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }

        return $orders;
    }

    //get needs to ship orders
    public static function get_ship_orders()
    {
        $orders = [];
        $ships = OrderShip::where('ship_type', 1)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get email orders
    public static function get_email_orders()
    {
        $orders = [];
        $all_orders = Order::all();
        foreach($all_orders as $order)
        {
            $ship_order_flag = false;
            $order_ships = $order->order_ships;
            foreach($order_ships as $order_ship)
            {
                if($order_ship->ship_type == "1")
                {
                    //this is shipping order
                    $ship_order_flag = true;
                    break;
                }
            }

            if(!$ship_order_flag)
            {
                $orders[] = $order;
            }
        }
        return $orders;
    }


    //get completed orders by period
    public static function get_completed_orders_by_period($from_date, $to_date)
    {
        $orders = $ships = [];

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $ships = OrderShip::where('created_at', '>=', $from_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::whereBetween('created_at', array($from_date, $to_date))->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        } elseif ($from_date == '' && $to_date) {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            $ships = OrderShip::where('created_at', '=<', $to_date)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
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
    public static function get_completed_orders()
    {
        $orders = [];
        $ships = OrderShip::GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
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
    public static function get_today_orders()
    {
        $orders = [];
        $today = (new DateTime("now"))->format('Y-m-d');

        $ships = OrderShip::where('created_at', '=', $today)->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get week orders
    public static function get_week_orders()
    {
        $orders = [];
        $today = new DateTime("now");

        $first_day = $today->modify('this week');
        $first_day = $first_day->format('Y-m-d');
        $last_day = $today->modify('this week +6 days');
        $last_day = $last_day->format('Y-m-d');


        $ships = OrderShip::whereBetween('created_at', array($first_day, $last_day))
            ->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get month orders
    public static function get_month_orders()
    {
        $orders = [];
        $today = new DateTime("now");
        $first_day = $today->modify('first day of this month');
        $first_day = $first_day->format('Y-m-d');
        $last_day = $today->modify('last day of this month');
        $last_day = $last_day->format('Y-m-d');

        $ships = OrderShip::whereBetween('created_at', array($first_day, $last_day))
            ->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();
        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }


    //get month orders
    public static function get_year_orders()
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');


        $ships = OrderShip::whereBetween('created_at', array($first_day, $last_day))
            ->GroupBy('order_id')->OrderBy('order_id', 'desc')->get();

        foreach ($ships as $ship) {
            $order_id = $ship->order_id;
            $order = Order::find($order_id);
            $orders[] = $order;
        }
        return $orders;
    }

    //get this year transaction chart details
    public static function get_this_year_transaction_charts()
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');


        $ships = OrderShip::whereBetween('created_at', array($first_day, $last_day))
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

    //get sold products
    public static function get_sold_products_by_period($from_date, $to_date)
    {

        if ($from_date != '' && $to_date == '') {
            $from_date = (new DateTime($from_date))->format('Y-m-d');

            OrderShip::where('created_at', '>=', $from_date )->orderBy('order_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {
            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            OrderShip::whereBetween('created_at', array( $from_date, $to_date))
                ->orderBy('order_id', 'DESC')->get();
        } elseif($from_date =='' && $to_date ) {
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            OrderShip::where('created_at', '<=', $to_date )->orderBy('order_id', 'DESC')->get();
        }
    }

    public static function get_sold_products()
    {
        //get product id from nm_order_ships
        return OrderShip::orderBy('order_id', 'DESC')->get();
    }

    //get sold products
    public static function get_sold_shipping_products_by_period($from_date, $to_date)
    {

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');

            return OrderShip::where('created_at', '>=', $from_date )->where('ship_type', Products::PRODUCT_TYPE_SHIP)->orderBy('order_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return OrderShip::whereBetween('created_at', array( $from_date, $to_date))->where('ship_type', Products::PRODUCT_TYPE_SHIP)
                ->orderBy('order_id', 'DESC')->get();
        } elseif($from_date =='' && $to_date ) {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');
            return OrderShip::where('created_at', '<=', $to_date )->where('ship_type', Products::PRODUCT_TYPE_SHIP)->orderBy('order_id', 'DESC')->get();
        }
    }

    public static function get_sold_shipping_products()
    {
        //get product id from nm_order_ships
        return OrderShip::where('ship_type', Products::PRODUCT_TYPE_SHIP)->get();
    }



    //get this year resource register chart details
    public static function get_resource_register_history_this_year_charts()
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');

        $products = Products::whereBetween('created_date', array($first_day, $last_day))->get();

        $register_history = [
            '1' => 0, '2' => 0, '3' => 0,
            '4' => 0, '5' => 0, '6' => 0,
            '7' => 0, '8' => 0, '9' => 0,
            '10' => 0, '11' => 0, '12' => 0,
        ];

        foreach ($products as $product) {
            $product_register_month = date('n', strtotime($product->created_date));
            if (array_key_exists($product_register_month, $register_history))
                $register_history[$product_register_month] = $register_history[$product_register_month] + 1;
            else
                $register_history[$product_register_month] = 1;
        }

        return array_values($register_history);
    }


    //get this year resource sold chart details
    public static function get_resource_sold_history_this_year_charts()
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');

        $solds = OrderShip::whereBetween('created_at', array($first_day, $last_day))->get();

        $sold_history = [
            '1' => 0, '2' => 0, '3' => 0,
            '4' => 0, '5' => 0, '6' => 0,
            '7' => 0, '8' => 0, '9' => 0,
            '10' => 0, '11' => 0, '12' => 0,
        ];

        foreach ($solds as $sold) {
            $resource_sold_month = date('n', strtotime($sold->created_at));
            if (array_key_exists($resource_sold_month, $sold_history))
                $sold_history[$resource_sold_month] = $sold_history[$resource_sold_month] + 1;
            else
                $sold_history[$resource_sold_month] = 1;
        }

        return array_values($sold_history);
    }


    //get all shipping count
    public static function get_ship_all_cnt()
    {
        return count(OrderShip::all());
    }

    //get shipping done count
    public static function get_ship_done_cnt()
    {
        return count(OrderShip::where('ship_status', 1)->get());
    }

    //get member register history
    public static function get_member_register_history_year()
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');

        $members = Member::where('mem_logintype', Member::MEMBER_LOGIN_CUSTOMER)->whereBetween('created_at', array($first_day, $last_day))->get();

        $registers = [
            '1' => 0, '2' => 0, '3' => 0,
            '4' => 0, '5' => 0, '6' => 0,
            '7' => 0, '8' => 0, '9' => 0,
            '10' => 0, '11' => 0, '12' => 0,
        ];

        foreach ($members as $member) {
            $created_date = $member->created_at;
            $created_month = date('n', strtotime($created_date));
            if (array_key_exists($created_month, $registers))
                $registers[$created_month] = $registers[$created_month] + 1;
            else
                $registers[$created_month] = 1;
        }

        return array_values($registers);
    }

    //get contributor register history
    public static function get_contributor_register_history_year()
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');

        $contributors = Member::where('mem_logintype', Member::MEMBER_LOGIN_MERCHANT)->whereBetween('created_at', array($first_day, $last_day))->get();

        $registers = [
            '1' => 0, '2' => 0, '3' => 0,
            '4' => 0, '5' => 0, '6' => 0,
            '7' => 0, '8' => 0, '9' => 0,
            '10' => 0, '11' => 0, '12' => 0,
        ];

        foreach ($contributors as $contributor) {
            $created_date = $contributor->created_at;
            $created_month = date('n', strtotime($created_date));
            if (array_key_exists($created_month, $registers))
                $registers[$created_month] = $registers[$created_month] + 1;
            else
                $registers[$created_month] = 1;
        }

        return array_values($registers);

    }

    //get contributor register history
    public static function get_curator_resource_check_history_year_data()
    {
        $today = new DateTime("now");
        $first_day = $today->modify('first day of january');
        $first_day = $first_day->format('Y-m-d');

        $last_day = $today->modify('last day of december');
        $last_day = $last_day->format('Y-m-d');

        $approves = Products::where('pro_approved_status', Products::PRODUCT_STATUS_APPROVED)->whereBetween('approved_at', array($first_day, $last_day))->get();

        $checked = [
            '1' => 0, '2' => 0, '3' => 0,
            '4' => 0, '5' => 0, '6' => 0,
            '7' => 0, '8' => 0, '9' => 0,
            '10' => 0, '11' => 0, '12' => 0,
        ];

        foreach ($approves as $approve) {
            $approved_date = $approve->approved_at;
            $approved_month = date('n', strtotime($approved_date));
            if (array_key_exists($approved_month, $checked))
                $checked[$approved_month] = $checked[$approved_month] + 1;
            else
                $checked[$approved_month] = 1;
        }

        return array_values($checked);

    }














    public static function get_charttransaction_details()
    {

        $chart_count = "";
        for ($i = 1; $i <= 12; $i++) {
            $results = DB::select(DB::raw("SELECT count(*) as count FROM nm_order WHERE MONTH( `order_date` ) = " . $i));
            $chart_count .= $results[0]->count . ",";
        }
        $chart_count1 = trim($chart_count, ",");
        return $chart_count1;
    }

    public static function get_inquires()
    {
        return DB::table('nm_inquiries')->count();

    }

    public static function get_blog()
    {
        return DB::table('nm_blog')->count();

    }

    public static function get_faq()
    {
        return DB::table('nm_faq')->count();

    }

    public static function get_category()
    {
        return DB::table('nm_maincategory')->count();

    }

    public static function get_chart_details()
    {
        $chart_count = "";
        for ($i = 1; $i <= 12; $i++) {
            $results = DB::select(DB::raw("SELECT count(*) as count FROM nm_member WHERE MONTH( `created_at` ) = " . $i));
            $chart_count .= $results[0]->count . ",";
        }
        $chart_count1 = trim($chart_count, ",");
        return $chart_count1;
    }




}

?>
