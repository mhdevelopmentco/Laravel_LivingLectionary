<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Member;
use App\Products;

class OrderShip extends Model
{

    protected $table = "nm_order_ships";
    protected $fillable = [
        'order_id', 'cus_id', 'customer_name', 'order_cus_email', 'ship_mer_id', 'product_id', 'product_quantity',
        'product_subtotal', 'ship_amt', 'ship_email', 'ship_country', 'ship_state', 'ship_city',
        'ship_addr1', 'ship_addr2', 'ship_type', 'ship_status',
    ];

    protected $appends = [
        'product', 'product_name', 'product_img', 'contributor_name', 'store_name',
        'product_content_kind', 'product_type', 'ship_status_string', 'pro_file_link', 'pro_file_down',
    ];

    const ORDERSHIP_STATUS_NOT_DELIVERED = 0;
    const ORDERSHIP_STATUS_DELIVERED = 1;

    //get order product
    public function getProductAttribute()
    {
        $product_id = $this->product_id;
        if ($product_id) {
            $product = Products::find($product_id);
            return $product;
        }
        return null;
    }

    //get product name
    public function getProductNameAttribute()
    {
        $product = $this->product;
        if ($product) {
            return $product->pro_title;
        }
        return '';
    }

    //get product name
    public function getProductTypeAttribute()
    {
        $product = $this->product;
        if ($product) {
            return $product->product_type;
        }
        return '';
    }

    //get product content kind
    public function getProductContentKindAttribute()
    {
        $product = $this->product;
        if ($product) {
            return $product->pro_content_kind;
        }
        return '';
    }

    //get product link
    public  function getProFileLinkAttribute()
    {
        $product = $this->product;
        if ($product) {
            return $product->pro_file_link;
        }
        return '';
    }

    //get product download link
    public  function getProFileDownAttribute()
    {
        $product = $this->product;
        if ($product) {
            return $product->pro_file_down;
        }
        return '';
    }

    //get product img
    public function getProductImgAttribute()
    {
        $product = $this->product;
        if ($product) {
            $pro_imgs = explode('/**/', $product->pro_Img);
            return $pro_imgs[0];
        }

        return '';
    }

    //get customer name
    public function getContributorNameAttribute()
    {
        $customer_id = $this->ship_mer_id;
        $contributor = Member::find($customer_id);

        if ($contributor)
            return $contributor->name;
        return '';
    }


    //get customer name
    public function getStoreNameAttribute()
    {
        $product = $this->product;
        if ($product)
            return $product->store_name;

        return '';
    }

    //get shipping status string
    public function getShipStatusStringAttribute()
    {
        if($this->ship_status == 1)
        {
            return "Delivered";
        } else
        {
            return "Not Yet";
        }
    }

}
