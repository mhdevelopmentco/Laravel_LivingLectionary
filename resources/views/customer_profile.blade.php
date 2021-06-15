@extends('includes/page_master')
@section('title', 'Member Profile')
@section('css')
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
    <style>
        .text-for {
            cursor: pointer;
        }

        .tab-pane input:not([type='reset']):not([type='submit']):not([type='radio']):not([type='checkbox']), .tab-pane select {
            width: 100%;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url();?>">Home</a></li>
                    <li class="active">My Settings</li>
                </ul>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif

                <div id="grids">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="<?php if(Route::getCurrentRoute()->getPath() == 'settings') {?>active<?php } ?>">
                            <a data-toggle="tab" href="#one">Account</a></li>
                        <?php if($customer_info->mem_logintype == \App\Member::MEMBER_LOGIN_MERCHANT){?>
                        <li class="<?php if(Route::getCurrentRoute()->getPath() == 'my_store') {?>active<?php } ?>">
                            <a data-toggle="tab" href="#seven">Store Details</a></li>
                        <?php }?>
                        <li class="<?php if(Route::getCurrentRoute()->getPath() == 'my_shipinfo') {?>active<?php } ?>">
                            <a data-toggle="tab" href="#two">Shipping Address</a></li>

                        <li class="<?php if(Route::getCurrentRoute()->getPath() == 'my_buys') {?>active<?php } ?>"><a
                                    data-toggle="tab" href="#four">Selected & Purchased Resources</a></li>
                        <li class="<?php if(Route::getCurrentRoute()->getPath() == 'my_wishlist') {?>active<?php } ?>">
                            <a data-toggle="tab" href="#five">Wish List</a></li>
                        <!--li class=""><a data-toggle="tab" href="#seven">My Bid History</a></li-->
                    </ul>

                    <div class="tab-content">
                        <div id="one"
                             class="tab-pane  <?php if(Route::getCurrentRoute()->getPath() == 'settings') {?>active<?php }?> ">
                            <div class="row-fluid">
                                <div class="col-md-6 hero-unit">

                                    <div class="form-horizontal">
                                        <label style="float:left"><strong>Account Type</strong></label>
                                        <div class="pull-right"><?php  if ($customer_info->mem_logintype == \App\Member::MEMBER_LOGIN_MERCHANT) {
                                                echo "Contributor";
                                            } else {
                                                echo "Cusotmer";
                                            }?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-horizontal">
                                        <label class="text-left"><strong>Name</strong></label>
                                        <div>
                                            <label class="pull-right" id="toggleDiv">
                                                <a><strong class="text_for">Edit</strong></a>
                                            </label>
                                            <div id="cusname"> <?php echo $customer_info->mem_fname . ' ' . $customer_info->mem_lname;?></div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>


                                    <div class="span11 edit_div" id="username_div">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                   placeholder="<?php echo $customer_info->mem_fname;  ?>"
                                                   id="username1" value="">
                                            <input type="text" class="form-control"
                                                   placeholder="<?php echo $customer_info->mem_lname;  ?>"
                                                   id="username2" value="">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" style="color:#fff" id="update_username"
                                                   value="update" class="btn btn-success btn-sm btn-grad" \>
                                            <input type="reset" style="color:#000" id="cancel_username"
                                                   value="cancel" class="btn btn-default btn-sm btn-grad" \>
                                            <br>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="control-label text-left"
                                               for="text1"><strong>Email</strong></label>
                                        <div>
                                            <?php echo $customer_info->mem_email;?>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-horizontal">
                                        <label style="float:left"><strong>User ID</strong></label>
                                        <label class="pull-right" id="toggleDiv8"><a><strong class="text_for"
                                                >Edit</strong></a></label>
                                        <div class="clearfix"></div>
                                        <div id="userid">{{$customer_info->mem_userid}}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="span11 edit_div" id="userid_div">
                                        <div class="form-group">
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control"
                                                       placeholder="Enter Your New UserID" id="new_user_id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-8">
                                                <input type="submit" style="color:#fff" id="update_userid"
                                                       value="update" class="btn btn-success btn-sm btn-grad" \>
                                                <input type="reset" style="color:#000" id="cancel_userid"
                                                       value="cancel" class="btn btn-default btn-sm btn-grad" \>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>

                                    <div class="form-horizontal">
                                        <label style="float:left"><strong>Password</strong></label>
                                        <label class="pull-right" id="toggleDiv1"><a><strong class="text_for"
                                                >Edit</strong></a></label>
                                        <div class="clearfix"></div>
                                        <div style="color:#f00"><strong>**********</strong></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="span11 edit_div" id="password_div">
                                        <div class="form-group">
                                            <div class="col-lg-8">
                                                <input type="password" class="form-control"
                                                       placeholder="Enter Your Old password" id="oldpwd">
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="password" class="form-control"
                                                       placeholder="Enter Your New password" id="pwd">
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="password" class="form-control"
                                                       placeholder="Enter Confirm Password" id="confirmpwd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" style="color:#fff" id="update_password"
                                                   value="update" class="btn btn-success btn-sm btn-grad" \>
                                            <input type="reset" style="color:#000" id="cancel_password"
                                                   value="cancel" class="btn btn-default btn-sm btn-grad" \>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>

                                    <div class="form-horizontal">
                                        <label style="float:left"><strong>Profile images</strong></label>
                                        <label class="pull-right">
                                            <a href="#upload_pic" role="button" data-toggle="modal"
                                               style="padding-right:0">
                                                <strong class="text_for">Edit</strong></a>
                                        </label>
                                        <br>
                                        <?php if ($customer_info->mem_pic != '') {
                                            $imgpath = "public/assets/images/profile/" . $customer_info->mem_pic;
                                        } else {
                                            $imgpath = "public/assets/images/profile/man.png";
                                        }
                                        ?>
                                        <img src="<?php echo $imgpath;?>" alt="" width="100px" height="auto">
                                    </div>


                                    <div class="span11 edit_div" id="MyDiv7">
                                        <div class="form-group">
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Fruit ball"
                                                       id="filetext" name="filetext">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success btn-sm btn-grad"><a
                                                        style="color:#fff">Update</a>
                                            </button>
                                            <button class="btn btn-default btn-sm btn-grad"><a
                                                        style="color:#000">Cancel</a>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="col-md-6 hero-unit">
                                    <div class="form-horizontal">
                                        <label style="float:left"><strong>Phone number</strong></label>
                                        <label class="pull-right" id="toggleDiv2"><a><strong class="text_for"
                                                >Edit</strong></a></label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="cusphone"> <?php echo $customer_info->mem_phone;?></div>
                                    <div class="span11 edit_div" id="phonenumber_div">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                   pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                                   placeholder="Enter your phone number" id="phonenum">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" style="color:#fff" id="update_phonenumber"
                                                   value="update" class="btn btn-success btn-sm btn-grad">
                                            <input type="reset" style="color:#000" id="cancel_phonenumber"
                                                   value="cancel" class="btn btn-default btn-sm btn-grad">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>


                                    <div class="form-horizontal">
                                        <label style="float:left"><strong>Address (Country & State &
                                                City)</strong></label>
                                        <label class="pull-right" id="toggleDiv3"><a><strong class="text_for"
                                                >Edit</strong></a></label>
                                        <br>
                                        <div class="clearfix"></div>
                                        <label id="cuscountry">Country: <?php echo $customer_info->co_name;?></label>
                                        <label id="cusstate">State: <?php echo $customer_info->st_name;?></label>
                                        <label id="cuscity">City: <?php echo $customer_info->ci_name;?></label>
                                        <label id="address1">Address1: <?php echo $customer_info->mem_address1;?></label>
                                        <label id="address2">Address2: <?php echo $customer_info->mem_address2;?></label>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="span11 edit_div" style="display:none" id="address_div">
                                        <div class="form-group">

                                            <div class="span12" style="margin-left: 2.564102564102564%;">
                                                <label class="span4">Country</label>
                                                <div class="span8">
                                                    <select class="form-control" id="select_country"
                                                            onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_state', '<?php echo $customer_info->mem_state;?>')">
                                                        <option value="0">--- Select ---</option>
                                                        @foreach ($country_details as $country)
                                                            <option value="<?php echo $country->co_id;?>"
                                                                    @if($country->co_id == $customer_info->mem_country)
                                                                    selected
                                                                    @elseif ((!$customer_info->mem_country) and $country->co_default == 1)
                                                                    selected
                                                            @else
                                                                    @endif >
                                                                {!!$country->co_name!!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="span12">
                                                <label class="span4">State</label>
                                                <div class="span8">
                                                    <select class="form-control" id="select_state"
                                                            onchange="select_city_from_state(this.value,'<?php echo url('select_city_by_state'); ?>', 'select_city', '<?php echo $customer_info->mem_city;?>')">
                                                        <option value="0">--- Select ---</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="span12">
                                                <label class="span4">City</label>
                                                <div class="span8">
                                                    <input type="text" class="form-control typeahead" id="select_city"
                                                           value=""
                                                           required/>
                                                </div>
                                            </div>

                                            <div class="span12">
                                                <label class="span4">Address1</label>
                                                <div class="span8">
                                                    <input type="text" class="form-control"
                                                           value="<?php echo $customer_info->mem_address1;?>"
                                                           placeholder="Provide address1 " id="addr1">
                                                </div>
                                            </div>

                                            <div class="span12">
                                                <label class="span4">Address2</label>
                                                <div class="span8">
                                                    <input type="text" class="form-control"
                                                           value="<?php echo $customer_info->mem_address2;?>"
                                                           placeholder="provide address2" id="addr2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-2" for="pass1"><span
                                                        class="text-sub"></span></label>
                                            <div class="col-lg-8">
                                                <input type="submit" style="color:#fff" id="update_address"
                                                       value="update" class="btn btn-success btn-sm btn-grad">
                                                <input type="reset" style="color:#000" id="cancel_address"
                                                       value="cancel" class="btn btn-default btn-sm btn-grad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>

                        <div id="two"
                             class="tab-pane <?php if(Route::getCurrentRoute()->getPath() == 'my_shipinfo') {?>active<?php } ?>">

                            <div class="row-fluid">

                                <div class="col-md-6 hero-unit">

                                    <div class="span12 hidden"></div>
                                    <div class="span12">
                                        <label class="control-label span4" for="ship_name"><strong>Full
                                                Name*</strong></label>

                                        <div class="span8">
                                            <input type="text" class="form-control" placeholder="Enter your name"
                                                   name="ship_name" id="ship_name" required
                                                   value="<?php if ($shipinfo) {
                                                       echo $shipinfo->ship_name;
                                                   }?>">
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_email"><strong>Email*</strong></label>

                                        <div class="span8">
                                            <input type="email" class="form-control"
                                                   placeholder="Enter your Ship Email Id" required
                                                   name="ship_email" id="ship_email" value="<?php if ($shipinfo) {
                                                echo $shipinfo->ship_email;
                                            }?>"/>
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_phone"><strong>Phone*</strong></label>

                                        <div class="span8">
                                            <input type="text" class="form-control"
                                                   placeholder="Enter your phone number" name="ship_phone"
                                                   id="ship_phone" required
                                                   data-tooltip="xxx-xxx-xxxx or (xxx) xxx xxxx"
                                                   pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                                   value="<?php if ($shipinfo) {
                                                       echo $shipinfo->ship_phone;
                                                   }?>"/>
                                        </div>
                                    </div>


                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_country"><strong>Country</strong><span
                                                    class="text-sub">*</span></label>

                                        <div class="span8">
                                            <select class="form-control" id="ship_country" required
                                                    onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'ship_state', '<?php if ($shipinfo) {
                                                        echo $shipinfo->ship_state;
                                                    } ?>' )">
                                                <option value="0">--- Select ---</option>
                                                @foreach ($country_details as $country)
                                                    <option value="<?php echo $country->co_id;?>"
                                                            <?php if($shipinfo) {
                                                            if ($country->co_id == $shipinfo->ship_country)
                                                            { ?>selected<?php } }?>>{!!$country->co_name!!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_state"><strong>State*</strong></label>
                                        <div class="span8">
                                            <select class="form-control" name="ship_state" id="ship_state" required
                                                    onchange="select_city_from_state(this.value,'<?php echo url('select_city_by_state'); ?>', 'ship_city', '<?php if ($shipinfo) {
                                                        echo $shipinfo->ship_city;
                                                    } ?>')">
                                                <option value="0">--- Select ---</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_city"><strong>City*</strong></label>
                                        <div class="span8">
                                            <input type="text" class="form-control typeahead" id="ship_city"
                                                   name="ship_city" required value="<?php if ($shipinfo) {
                                                echo $shipinfo->ci_name;
                                            } ?>"/>
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_addr1"><strong>Address1*</strong></label>

                                        <div class="span8">
                                            <input type="text" class="form-control" placeholder="Enter your address"
                                                   name="ship_addr1" id="ship_addr1" required
                                                   value="<?php if ($shipinfo) {
                                                       echo $shipinfo->ship_address1;
                                                   }?>">
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_addr2"><strong>Address2</strong></label>

                                        <div class="span8">
                                            <input type="text" class="form-control" placeholder="Enter your address"
                                                   name="ship_addr2" id="ship_addr2"
                                                   value="<?php if ($shipinfo) {
                                                       echo $shipinfo->ship_address2;
                                                   }?>">
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <label class="control-label span4"
                                               for="ship_zipcode"><strong>Zipcode*</strong></label>

                                        <div class="span8">
                                            <input type="text" class="form-control"
                                                   placeholder="Enter your zip code"
                                                   name="ship_zipcode" id="ship_zipcode" required
                                                   pattern=""
                                                   value="<?php if ($shipinfo) {
                                                       echo $shipinfo->ship_zipcode;
                                                   }?>">
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <input type="submit" style="color:#fff" id="update_ship_info"
                                               value="update" class="btn btn-success btn-sm btn-grad">
                                        <input type="reset" style="color:#000" id="cancel_ship_info"
                                               value="cancel" class="btn btn-default btn-sm btn-grad">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="four"
                             class="tab-pane <?php if(Route::getCurrentRoute()->getPath() == 'my_buys') {?>active<?php } ?>">
                            <div class="row-fluid">
                                <ul class="text_tab">
                                    <div class="row-fluid">
                                        <div class="col-lg-12 panel_marg">
                                            <table class="table table-bordered table-sieve">
                                                <thead style="background:#4a994c; color:#fff;">
                                                <tr>
                                                    <th class="text-center">P.NO</th>
                                                    <th class="text-center">Resource Name</th>
                                                    <th class="text-center">Resource Type</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Amount(/Ship)</th>
                                                    <th class="text-center">Purchased Date</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 1;?>
                                                @foreach($order_products as $product)
                                                    <tr>
                                                        <td class="text-center"><?php echo $i;?></td>
                                                        <td class="text-center">{{$product->product_name}}</td>
                                                        <td class="text-center">
                                                            @if( $product->product_content_kind == \App\Products::PRODUCT_TYPE_DOWNLOAD )
                                                                <a href="{{url('download_product').'/'.$product->pro_file_down}}"
                                                                   class="link">
                                                                    {{$product->product_type}}
                                                                </a>
                                                            @elseif( $product->product_content_kind == \App\Products::PRODUCT_TYPE_LINK )
                                                                <a href="{{$product->pro_file_link}}" class="link"
                                                                   target="_blank"> {{$product->product_type}}</a>
                                                            @else
                                                                {{$product->product_type}}
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{$product->product_quantity}}</td>
                                                        @if($product->ship_type == \App\Products::PRODUCT_TYPE_SHIP)
                                                            <td class="text-center">${{$product->product_subtotal}} /
                                                                ${{$product->ship_amt}}</td>
                                                        @else
                                                            <td class="text-center">${{$product->product_subtotal}}</td>
                                                        @endif
                                                        <td class="text-center">{{$product->created_at}}</td>
                                                        <td class="text-center">
                                                            @if($product->ship_status == 1)
                                                                <i class="glyphicon glyphicon-home"></i>
                                                            @else
                                                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                                            @endif
                                                            {{$product->ship_status_string}}
                                                        </td>
                                                    </tr>
                                                    <?php $i = $i + 1;?>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </ul>
                            </div>
                        </div>

                        <div id="five"
                             class="tab-pane  <?php if(Route::getCurrentRoute()->getPath() == 'my_wishlist') {?>active<?php } ?>">
                            <div class="row-fluid">
                                <ul class="text_tab">
                                    <div class="row-fluid">
                                        <div class="col-lg-12 panel_marg">
                                            <table class="table table-bordered table-sieve">
                                                <thead style="background:#4a994c; color:#fff;">
                                                <tr>
                                                    <th class="text-center" class="text-center">SNO</th>
                                                    <th class="text-center">Resource Names</th>
                                                    <th class="text-center">Resource Price</th>
                                                    <th class="text-center">Image</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 1;
                                                foreach($wishlistdetails as $order_product) {
                                                $product_img = explode('/**/', trim($order_product->pro_Img, "/**/"));
                                                $res = base64_encode($order_product->pro_id);
                                                ?>
                                                <tr>
                                                    <td class="text-center"
                                                        class="text-center"><?php echo $i;?></td>
                                                    <td class="text-center" class="text-center">
                                                        <a href="{!! url('productview').'/'.$res!!}"
                                                           style="color:#ff8400;"><?php echo $order_product->pro_title;?></a>
                                                        <br>
                                                    </td>
                                                    <td class="text-center" class="text-center">
                                                        $<?php echo $order_product->pro_price;?></td>
                                                    <td class="text-center">
                                                        <img src="{!! url('public/assets/images/product').'/'.$product_img[0]!!}"
                                                             class="img-responsive"
                                                             style="max-width: 83px;    margin: 0 auto;"/></td>
                                                    <td>
                                                        <div style="text-align:center;">
                                                            {!! Form :: open(array('url' => 'add_to_cart','class'=>'form-horizontal qtyFrm','enctype'=>'multipart/form-data')) !!}
                                                            <button type="submit" class="btn btn-small btn-warning"
                                                                    id="add_to_cart_session"> Add to Cart <i
                                                                        class=" icon-shopping-cart"></i>
                                                            </button>
                                                            <input type="hidden" name="addtocart_pro_id"
                                                                   value="<?php echo $order_product->pro_id; ?>"/>
                                                            <input type="hidden" name="addtocart_qty" value="1"/>
                                                            <input type="hidden" name="pro_id"
                                                                   value="<?php echo $order_product->pro_id; ?>">
                                                            <input type="hidden" name="wish_id"
                                                                   value="<?php echo $order_product->ws_id; ?>">
                                                            <input type="hidden" name="from" value="wish">
                                                            {!! Form::close() !!}

                                                            <a href="{{url('remove_product_from_wishlist').'/'.$order_product->ws_id }}">
                                                                <button class="btn btn-small btn-danger"> Remove
                                                                    <i class="icon-trash "></i></button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr> <?php $i = $i + 1; } ?>                      </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>

                        <?php if($customer_info->mem_logintype == \App\Member::MEMBER_LOGIN_MERCHANT )
                        {
                        ?>

                        <div id="seven"
                             class="tab-pane <?php if(Route::getCurrentRoute()->getPath() == 'my_store') {?>active<?php } ?>">

                            <div class="col-md-10">
                                <div class="panel panel-body">
                                    <h4 class="col-md-12">Your Store Information</h4>

                                    <?php foreach($store_infos as $store_info) {?>
                                    <div class="one_store">
                                        <h5 style="text-decoration: underline">{!! $store_info->stor_name !!}</h5>
                                        {!! Form::open(array('url'=>'update_store_info_of_contributor','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                                        <input type="hidden" name="store_id" value="{!!$store_info->stor_id!!}">
                                        <input type="hidden" name="store_merchant_id"
                                               value="{!!$store_info->stor_merchant_id!!}">

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_name">Display Name*:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="store_name" name="store_name"
                                                       class="form-control"
                                                       required placeholder="" value="{{$store_info->stor_name}}"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_org">Organization:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="store_org" name="store_org" class="form-control"
                                                       placeholder="" value="{{$store_info->stor_org}}"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_title">Title:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="store_title" name="store_title" placeholder=""
                                                       class="form-control" value="{{$store_info->stor_title}}">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_web">Web Address:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="url" id="store_web" name="store_web" placeholder=""
                                                       class="form-control"
                                                       value="{{$store_info->stor_website}}">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="select_country">Country<span
                                                            class="text-sub">*</span></label>
                                            </div>

                                            <div class="col-md-8">
                                                <select class="form-control" name="select_store_country"
                                                        id="select_store_country"
                                                        required
                                                        onchange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_store_state', '<?php echo $store_info->stor_state; ?>')">
                                                    <option value="">---Select---</option>
                                                    <?php foreach($country_details as $country_fetch){ ?>
                                                    <option value="<?php echo $country_fetch->co_id; ?>"
                                                            <?php if($country_fetch->co_id == $store_info->stor_country){?> selected <?php } ?>><?php echo $country_fetch->co_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="select_store_state">State<span
                                                            class="text-sub">*</span></label>
                                            </div>

                                            <div class="col-md-8">
                                                <select class="validate[required] form-control"
                                                        id="select_store_state"
                                                        name="select_store_state" required
                                                        onChange="select_city_from_state(this.value, '<?php echo url('select_city_by_state'); ?>', 'select_city')">
                                                    <option value="">---Select---</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="select_city">City<span
                                                            class="text-sub">*</span></label>
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control typeahead" id="select_store_city"
                                                       name="select_store_city" required
                                                       value="{{$store_info->ci_name}}"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_add_one">Street Address 1<span
                                                            class="text-sub">*</span></label>
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder=""
                                                       id="store_add_one" name="store_add_one" required
                                                       value="{{$store_info->stor_address1}}">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_add_two">Street Address 2</label>
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder=""
                                                       id="store_add_two" name="store_add_two"
                                                       value="{{$store_info->stor_address2}}"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_zipcode">Zipcode<span
                                                            class="text-sub">*</span></label>
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder=""
                                                       id="store_zipcode"
                                                       name="store_zipcode" required
                                                       pattern="\d{5}([\-]\d{4})?"
                                                       title="xxxxx or xxxxx-xxxx"
                                                       value="{{$store_info->stor_zipcode}}">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_zipcode" style="font-style: italic">Would you like you
                                                    or
                                                    your organization to be displayed on a map?</label>
                                            </div>
                                            <div class="col-md-8">
                                                <label style="display: inline-block;">
                                                    <input type="radio" style="margin-left:10px;" name="show_map"
                                                           value="1"
                                                           <?php if ($store_info->stor_show_map == 1) {?> checked<?php } ?>
                                                    />Yes
                                                </label>
                                                <label style="display: inline-block;">
                                                    <input type="radio" style="margin-left:10px;" name="show_map"
                                                           value="0"
                                                           <?php if ($store_info->stor_show_map == 0) {?> checked<?php } ?>
                                                    />No
                                                </label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_phone">Phone <span
                                                            class="text-sub">*</span></label>
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="" id="store_phone"
                                                       name="store_phone" required
                                                       pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                                       value="{{$store_info->stor_phone}}"
                                                       title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="meta_keyword">Meta keywords</label>
                                            </div>

                                            <div class="col-md-8">
                                                <textarea class="form-control" name="meta_keyword"
                                                          id="meta_keyword">{{$store_info->stor_metakeywords}}</textarea>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-12">
                                                <label for="store_orgdesc">Description of yourself or
                                                    your organization</label>
                                        <textarea id="store_orgdesc" name="store_orgdesc"
                                                  class="form-control">{{$store_info->stor_orgdesc}}</textarea>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="col-md-4">
                                                <label for="store_img">Store Image*</label>
                                            </div>
                                            <?php
                                            $storimgpath = "public/assets/images/storeimage/" . $store_info->stor_img;
                                            ?>
                                            <div class="col-md-4">
                                                <img class="img-responsive" src="<?php echo $storimgpath; ?>"/>
                                                <input type="hidden" name="store_old_image"
                                                       val="<?php echo $storimgpath; ?>"/>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="file" id="file" name="store_img" title="Store Image"
                                                       onchange="readURL(this)">
                                                <input type="hidden" id="x" name="x">
                                                <input type="hidden" id="y" name="y">
                                                <input type="hidden" id="w" name="w">
                                                <input type="hidden" id="h" name="h">
                                                <label>Image upload size 570 X 362</label>
                                            </div>
                                        </div>

                                        <div class="control-group text-right">
                                            <button class="btn btn-success" type="submit">update</button>
                                            <button class="btn btn-secondary" type="reset">cancel</button>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>
                        <?php } ?>
                    </div>

                    <div class="alert alert-danger alert-dismissable" id="error_result" align="center"
                         style="display:none;">
                    </div>
                    <div class="alert alert-success alert-dismissable" id="suc_result" align="center"
                         style="display:none;">
                    </div>
                </div>
            </div>
        </div>

        <div id="upload_pic" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false"
             style="height:auto;display:none; background:white; bottom: 50%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Change Profile Picture</h3>
            </div>
            <div class="modal-body">
                <div style="float:left">
                    {!! Form::open(array('url'=>'profile_image_submit','class'=>'form-horizontal
                    loginFrm','enctype'=>'multipart/form-data')) !!}
                    <div id='err_msg'></div>
                    <div class="controls">
                        <input type="file" class="input-file" name="imgfile" id="imgfile" required>
                    </div>
                    <br>
                    <span>image upload size 1[MB]</span><br><br>
                    <input type="submit" id="file_submit" class="btn btn-success" value="Upload"/>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div id="img_modal" class="modal fade in img_edit_modal" tabindex="-1" role="dialog"
             aria-hidden="false" style="height:auto;display:none; background:white;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Edit Store Image</h3>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <img src="" id="cropimage">
                </div>
                <input type="button" style="color:#fff" id="reset_img" value="Done" data-dismiss="modal"
                       class="btn btn-success"/>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="<?php echo url('')?>/public/plugins/tagsinput/typeahead.js"></script>
    <script src="<?php echo url('')?>/themes/js/common.js"></script>
    <script src="<?php echo url();?>/themes/js/jquery.sieve.min.js" type="text/javascript"></script>
    <script src="<?php echo url(); ?>/public/plugins/cropimage/js/jquery.Jcrop.min.js"></script>
    <script>
        var cropimage = jQuery('#cropimage');
        var image_modal = jQuery('#img_modal');
        var imageType = /image.*/;

        var reader = new FileReader();

        function readURL(input) {
            var file = input.files[0];
            var image = new Image();

            if (file.type.match(imageType)) {

                reader.onload = function (e) {

                    image.src = e.target.result;

                    image.onload = function () {
                        if (this.width > 1500 || this.height > 1500) {
                            alert('This image is too large. Please try again with an image less than 1500 pixels square.');
                            input.value = "";
                        } else {
                            cropimage.attr('src', image.src);
                            var limit_width = jQuery(image_modal).width();
                            var limit_height = jQuery(image_modal).height();
                            if (cropimage.data('Jcrop')) {
                                cropimage.data('Jcrop').destroy();
                            }
                            cropimage.Jcrop({
                                onSelect: function (c) {
                                    jQuery('#x').val(c.x);
                                    jQuery('#y').val(c.y);
                                    jQuery('#w').val(c.w);
                                    jQuery('#h').val(c.h);
                                },
                                setSelect: [570, 362, 0, 0],
                                boxWidth: limit_width,
                                boxHeight: limit_height,
                                allowSelect: true,
                                allowMove: true,
                                allowResize: true
                            });
                            jQuery('#img_modal').modal('show');
                        }
                    };
                };

                reader.onabort = function () {
                    input.value = "";
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please Choose Valid Image for Profile');
                input.value = "";
            }
        }
    </script>

    <script>
        var searchTemplate = "<div class='row form-inline'><label class='pull-right'>Search: <input type='text' class='form-control' placeholder='keywords'></label></div>"
        $(".table-sieve").sieve({searchTemplate: searchTemplate});
        searchTemplate = "<div class='row form-inline'><label style='float: right;'>Find a Quote: <input type='text' class='form-control' placeholder='(try typing &quot;einstein&quot;)'></label></div>"
        $(".p-sieve").sieve({searchTemplate: searchTemplate, itemSelector: "p"});
    </script>

    <script>
        $(document).ready(function () {

            $('#toggleDiv').click(function () {
                $('#username_div').toggle();
            });

            $('#toggleDiv1').click(function () {
                $('#password_div').toggle();
            });

            $('#toggleDiv2').click(function () {
                $('#phonenumber_div').toggle();
            });

            $('#toggleDiv3').click(function () {
                $('#address_div').toggle();
            });

            $('#toggleDiv7').click(function () {
                $('#MyDiv7').toggle();
            });

            $('#toggleDiv8').click(function () {
                $('#userid_div').toggle();
            });
        });

        var err_result = $('#error_result');

        var suc_result = $('#suc_result');

        //User name change
        $(document).ready(function () {

            var fname = $('#username1');
            var lname = $('#username2');
            var udiv = $('#username_div');

            $('#cancel_username').click(function () {
                udiv.hide();
            });

            $('#update_username').click(function () {
                var fn = fname.val();
                var ln = lname.val();

                if (fname.val() == '' || lname.val() == '') {
                    udiv.css('border', '1px solid red');
                    udiv.focus();
                    return false;
                } else {

                    udiv.css('border', '');
                    var passdata = {'fname': fn, 'lname': ln};

                    $.ajax({
                        type: 'get',
                        data: passdata,
                        url: '<?php echo url('update_username_ajax'); ?>',
                        success: function (responseText) {
                            if (responseText == "success") {
                                suc_result.show();
                                suc_result.html('Name Updated Successfully');
                                suc_result.fadeOut(3000);
                                udiv.hide();
                                $('#cusname').html(fn + ' ' + ln);
                            }
                        }
                    });
                }
            });

        });//document ready

        //User ID change
        $(document).ready(function () {

            var new_user_id = $('#new_user_id');

            var userdiv = $('#userid_div');

            $('#cancel_userid').click(function () {
                userdiv.hide();
            });

            $('#update_userid').click(function () {
                var nuid = new_user_id.val();

                if (nuid == '') {
                    new_user_id.css('border', '1px solid red');
                    new_user_id.focus();
                    return false;
                } else {

                    new_user_id.css('border', '');
                    var data = {'newuserid': nuid};

                    $.ajax({
                        type: 'get',
                        data: data,
                        url: '<?php echo url('update_userid_ajax'); ?>',
                        success: function (responseText) {
                            if (responseText == "success") {
                                suc_result.show();
                                suc_result.html('UserID Updated Successfully');
                                suc_result.fadeOut(3000);
                                userdiv.hide();
                                $('#userid').html(nuid);
                            } else if (responseText == 'fail_dup') {
                                err_result.show();
                                err_result.html('Same UserID Exist');
                                err_result.fadeOut(3000);
                            } else {
                                err_result.show();
                                err_result.html('UserID update failed');
                                err_result.fadeOut(3000);
                            }
                        }
                    });
                }
            });

        });//document ready

        //Password change
        $(document).ready(function () {

            var pwdiv = $('#password_div');
            var oldpwdo = $('#oldpwd');
            var pwdo = $('#pwd');
            var confirmedo = $('#confirmpwd');

            $(document).on('click', '#cancel_password', function () {
                pwdiv.hide();
            });

            $('#update_password').click(function () {
                var oldpwd = oldpwdo.val();
                var pwd = pwdo.val();
                var confirmedpwd = confirmedo.val();

                if (oldpwd == "") {
                    oldpwdo.css('border', '1px solid red');
                    oldpwdo.focus();
                    return false;
                } else if (pwd == "") {
                    oldpwdo.css('border', '');
                    pwdo.css('border', '1px solid red');
                    pwdo.focus();
                    return false;
                } else if (confirmedpwd == "") {
                    pwdo.css('border', '');
                    confirmedo.css('border', '1px solid red');
                    confirmedo.focus();
                    return false;
                } else if (confirmedpwd != pwd) {
                    pwdo.css('border', '');
                    confirmedo.css('border', '1px solid red');
                    confirmedo.focus();
                } else {
                    confirmedo.css('border', '');

                    var passdata = 'oldpwd=' + oldpwd + "&newpwd=" + pwd;

                    $.ajax({
                        type: 'post',
                        data: passdata,
                        url: '<?php echo url('update_password_ajax'); ?>',
                        success: function (responseText) {
                            //alert(responseText);
                            if (responseText == "success") {
                                suc_result.show();
                                suc_result.html('Password changed Successfully');
                                suc_result.fadeOut(3000);
                                pwdiv.hide();
                            } else {
                                err_result.show();
                                err_result.html('Old Password does not match');
                                err_result.fadeOut(3000);
                            }
                        }
                    });
                }
            });
        });

        //Profile picture change
        $(document).ready(function () {

            var imgfile = $('#imgfile');
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

            $('#file_submit').click(function () {
                if (imgfile.val() == '') {
                    imgfile.css('border', '1px solid red');
                    imgfile.focus();
                    return false;
                } else if ($.inArray(imgfile.val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    imgfile.css('border', '1px solid red');
                    imgfile.focus();
                    $('#err_msg').html('Please choose valid image');
                    return false;
                }
            });
        });

        //Phone number change
        $(document).ready(function () {

            var phone_num = $('#phonenum');

            $('#cancel_phonenumber').click(function () {
                $('#phonenumber_div').hide();
            });

            $('#update_phonenumber').click(function () {

                var phonenumber = phone_num.val();

                var regphone = /^\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})$/;
                var match = regphone.test(phonenumber);

                if (phonenumber == "") {
                    err_result.show();
                    err_result.html('Please provide phone number');
                    err_result.fadeOut(3000);
                    phone_num.css('border', '1px solid red');
                    phone_num.focus();
                    return false;
                } else if (!match) {

                    err_result.show();
                    err_result.html('Please provide valid phone number: xxx-xxx-xxxx or (xxx)-xxx-xxxx');
                    err_result.fadeOut(3000);
                    phone_num.css('border', '1px solid red');
                    phone_num.focus();
                    return false;

                } else {
                    phone_num.css('border', '');
                    err_result.html('');

                    var passdata = 'phonenum=' + phonenumber;

                    $.ajax({
                        type: 'get',
                        data: passdata,
                        url: '<?php echo url('update_phonenumber_ajax'); ?>',
                        success: function (responseText) {
                            if (responseText == "success") {
                                suc_result.show();
                                suc_result.html('Phone number changed Successfully');
                                suc_result.fadeOut(3000);
                                $('#phonenumber_div').hide();
                                $('#cusphone').html(phonenumber);
                            } else {
                                err_result.show();
                                err_result.html('Phone number Change Failed.');
                                err_result.fadeOut(3000);
                            }

                        }
                    });
                }
            });

        });//document ready

        //Account Address change
        $(document).ready(function () {

            $('#select_country').trigger('change');
            $('#select_store_country').trigger('change');

            $('#cancel_address').click(function () {
                $('#address_div').hide();
            });

            $('#update_address').click(function () {

                var select_country = $('#select_country');
                var country = select_country.val();
                if (country == 0) {
                    select_country.css('border', '1px solid red');
                    return false;
                } else {
                    select_country.css('border', '');
                }

                var select_state = $('#select_state');
                var state = select_state.val();
                if (state == 0) {
                    select_state.css('border', '1px solid red');
                    return false;
                } else {
                    select_state.css('border', '');
                }

                var select_city = $('#select_city');
                var city = select_city.val();
                if (city == "") {
                    select_city.css('border', '1px solid red');
                    return false;
                } else {
                    select_city.css('border', '');
                }

                var select_addr1 = $('#addr1');
                var select_addr2 = $('#addr2');

                var addr1 = select_addr1.val();
                var addr2 = select_addr2.val();

                if (addr1 == "") {
                    select_addr1.css('border', '1px solid red');
                    return false;
                } else {
                    select_addr1.css('border', '');

                    var passdata = 'country=' + country + '&state=' + state + '&city=' + city + '&addr1=' + addr1 + "&addr2=" + addr2;
                    $.ajax({
                        type: 'get',
                        data: passdata,
                        url: '<?php echo url('update_address_ajax'); ?>',
                        success: function (responseText) {
                            if (responseText == "success") {
                                suc_result.show();
                                suc_result.html('Address changed Successfully');
                                suc_result.fadeOut(3000);
                                $('#address_div').hide();

                                location.reload();

                            } else {

                                err_result.show();
                                err_result.html('Address Change Failed.');
                                err_result.fadeOut(3000);
                            }
                        },
                        error: function (responseText) {
                            err_result.show();
                            err_result.html('Address Change Failed.');
                            err_result.fadeOut(3000);
                        }
                    });
                }
            });

        });//document ready

        //Ship info change
        $(document).ready(function () {

            <?php if($shipinfo) {?>
                $('#ship_country').trigger('change');
            <?php } ?>

            $('#update_ship_info').click(function () {


                var ship_name = $('#ship_name');
                var name = ship_name.val();
                if (name == "") {
                    ship_name.css('border', '1px solid red');
                    return false;
                } else {
                    ship_name.css('border', '');
                }

                var ship_email = $('#ship_email');
                var email = ship_email.val();
                if (!email) {
                    ship_email.css('border', '1px solid red');
                    return false;
                } else {
                    ship_email.css('border', '');
                }

                var ship_phone = $('#ship_phone');
                var phone = ship_phone.val();

                var regphone = /^\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})$/;
                var match = regphone.test(phone);

                if (phone == "") {
                    ship_phone.css('border', '1px solid red');
                    return false;
                } else if (!match) {
                    ship_phone.css('border', '1px solid red');
                    return false;
                } else {
                    ship_phone.css('border', '');
                }


                var ship_country = $('#ship_country');
                var country = ship_country.val();
                if (country == 0) {
                    ship_country.css('border', '1px solid red');
                    return false;
                } else {
                    ship_country.css('border', '');
                }

                var ship_state = $('#ship_state');
                var state = ship_state.val();
                if (state == 0) {
                    ship_state.css('border', '1px solid red');
                    return false;
                } else {
                    ship_state.css('border', '');
                }

                var ship_city = $('#ship_city');
                var city = ship_city.val();
                if (city == "") {
                    ship_city.css('border', '1px solid red');
                    return false;
                } else {
                    ship_city.css('border', '');
                }

                var ship_addr1 = $('#ship_addr1');
                var addr1 = ship_addr1.val();

                var ship_addr2 = $('#ship_addr2');
                var addr2 = ship_addr2.val();

                if (addr1 == "") {
                    ship_addr1.css('border', '1px solid red');
                    return false;
                } else {
                    ship_addr1.css('border', '');
                }


                var ship_zipcode = $('#ship_zipcode');
                var zipcode = ship_zipcode.val();

                if (zipcode == "") {
                    ship_zipcode.css('border', '1px solid red');
                    return false;
                } else {
                    ship_zipcode.css('border', '');
                }

                var passdata = {
                    'name': name, 'email': email, 'phone': phone, 'country': country,
                    'state': state, 'city': city, 'address1': addr1, 'address2': addr2, 'zipcode': zipcode
                };

                $.ajax({
                    type: 'get',
                    data: passdata,
                    url: '<?php echo url('update_shipinfo'); ?>',
                    success: function (responseText) {
                        if (responseText == "success") {
                            suc_result.show();
                            suc_result.html('Ship Info changed Successfully');
                            suc_result.fadeOut(3000);

                        } else {
                            err_result.show();
                            err_result.html('Ship Info Change Failed.');
                            err_result.fadeOut(3000);
                        }
                    },
                    error: function (responseText) {
                        err_result.show();
                        err_result.html('Ship Info Change Failed.');
                        err_result.fadeOut(3000);
                    }
                });
            });
        });//document ready
    </script>
@endsection
