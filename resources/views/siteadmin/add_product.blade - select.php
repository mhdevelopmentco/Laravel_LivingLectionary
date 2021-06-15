﻿@extends('siteadmin.layout.admin_master')
@section('title', 'Add Resource')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
    <style>
        ul.wysihtml5-toolbar > li {
            position: relative;
        }

        .imgrow {
            margin-top: 10px;
        }

        .imgrow dd {
            display: inline-block;
        }

        .price_div {
            display: none;
        }
    </style>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a>Home</a></li>
                <li class="active"><a>Add Resource</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Resources</h5>

                </header>
                @if ($errors->any())
                    <br>
                    <ul class="alert alert-danger alert-dismissable">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </ul>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-danger alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif

                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'add_product_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                    <div id="error_msg" style="color:#F00;font-weight:800"></div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Resource Title<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="Product_Title" placeholder="" name="Product_Title" class="form-control"
                                   type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Choose Theme<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <div class="col-xs-5">
                                <select name="from[]" id="js_multiselect_from_1"
                                        class="js-multiselect1 form-control" size="8"
                                        multiple="multiple">
                                    @foreach($theme_details as $theme_group)
                                        <option value="{{$theme_group[0]->theme_id}}">{{$theme_group[0]->theme_name}}</option>
                                        @if(count($theme_group[1])>0)
                                            <optgroup label="---">
                                                @foreach($theme_group[1] as $sub_theme)
                                                    <option value="{{$sub_theme->theme_id}}">{{$sub_theme->theme_name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2">
                                <button type="button" id="js_right_All_1" class="btn btn-block">
                                    <i class="glyphicon glyphicon-forward"></i>
                                </button>
                                <button type="button" id="js_right_Selected_1"
                                        class="btn btn-block">
                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                </button>
                                <button type="button" id="js_left_Selected_1" class="btn btn-block">
                                    <i class="glyphicon glyphicon-chevron-left"></i>
                                </button>
                                <button type="button" id="js_left_All_1" class="btn btn-block">
                                    <i class="glyphicon glyphicon-backward"></i>
                                </button>
                            </div>

                            <div class="col-xs-5">
                                <select name="select_theme[]" id="js_multiselect_to_1" class="form-control"
                                        size="8" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2">Category<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <select class="form-control" id="Product_Category" name="Product_Category"
                                    onChange="select_subcategory_from_category(1, this.value, '<?php echo url('product_getmaincategory'); ?>', 'Product_MainCategory')"
                                    required>
                                <option value="0">--- Select ---</option>
                                <?php foreach($productcategory as $product_mc)  { ?>
                                <option value="<?php echo $product_mc->mc_id; ?>"><?php echo $product_mc->mc_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Select Main Category<span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <select class="form-control" id="Product_MainCategory" name="Product_MainCategory"
                                    onChange="select_subcategory_from_category(2, this.value, '<?php echo url('product_getsubcategory'); ?>', 'Product_SubCategory')">
                                <option value="0">--- Select ---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Select Sub Category<span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <select class="form-control" id="Product_SubCategory" name="Product_SubCategory"
                                    onChange="select_subcategory_from_category(3, this.value, '<?php echo url('product_getsecondsubcategory'); ?>', 'Product_SecondSubCategory')">
                                <option value="0">--- Select ---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text2" class="control-label col-md-2">Select Second Sub Category</label>

                        <div class="col-md-8">
                            <select class="form-control" id="Product_SecondSubCategory"
                                    name="Product_SecondSubCategory">
                                <option value="0">--- Select ---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Resource Price<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <ul class="radio_ul">
                                <li>
                                    <input class="form-control product-price-choice" type="radio" id="free_price"
                                           name="product_price_free" value="1" checked>
                                    <label for="free_price">Free</label>
                                </li>
                                <li>
                                    <input class="form-control product-price-choice" type="radio"
                                           id="no_free_price" name="product_price_free" value="0">
                                    <label for="no_free_price">Add price</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group price_div">
                        <div class="col-md-8 col-md-offset-2">
                            <input class="form-control" type="text"
                                   id="Original_Price" name="Original_Price">
                        </div>
                    </div>
                    <div class="form-group  price_div">
                        <div class="col-md-8  col-md-offset-2">
                            <input type="checkbox"
                                   onclick="if(this.checked){$('#inctax').show();}else{$('#inctax').hide();$('#inctax').val(0)}">
                            ( Including tax amount )
                            <input style="display:none;" class="form-control"
                                   type="text" id="inctax" name="inctax">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Select Content Type<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <ul class="radio_ul product_content_ul">
                                <li>
                                    <input class="form-control product-content-choice" type="radio" id="ship_product"
                                           name="product_content" value="1" checked>
                                    <label for="ship_product">A tangible item to be shipped</label>
                                </li>
                                <li>
                                    <input class="form-control product-content-choice" type="radio"
                                           id="download_product" name="product_content" value="2">
                                    <label for="download_product">A downloadable resource</label>
                                </li>
                                <li>
                                    <input class="form-control product-content-choice" type="radio" id="link_product"
                                           name="product_content" value="3">
                                    <label for="link_product">A link to content hosted on another site</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group product-content ship-product" style="" id="showshipselection">
                        <label for="text2" class="control-label col-md-2">Shipping Amount<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="radio" id="shipamt1" name="shipamt"
                                   onClick="show_element('shipamount_div', 'none');" value="1" checked>
                            <label class="sample" for="shipamt1">Shipping Not Required</label>

                            <input type="radio" id="shipamt2" name="shipamt"
                                   onClick="show_element('shipamount_div', 'inline');" value="2">
                            <label class="sample" for="shipamt2">Amount</label>

                            <div id="shipamount_div" style="display:none;">
                                <input placeholder="" class="form-control" type="text" id="Shipping_Amount"
                                       name="Shipping_Amount">
                            </div>
                        </div>
                    </div>


                    <div class="form-group product-content down-product" id="downcontent_div" style="display:none;">
                        <label class="control-label col-md-2" for="text1">Upload your content<br><span
                                    style="font-size: 12px;font-weight:normal;">(File Size must be 10MB
                            or less)</span><span
                                    class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <input type="file" id="file_down" name="file_down"
                                   style="background:none;width:185px;border:none;">
                        </div>
                    </div>

                    <div class="form-group product-content link-product" id="link_div" style="display:none;">
                        <label for="text1" class="control-label col-md-2">Enter the full content link<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <input placeholder="" type="url" pattern="https?://.+" class="form-control"
                                   id="product_link"
                                   name="product_link">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Description<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8" id="descdiv">
                              <textarea id="wysihtml5" class="form-control" rows="10" id="Description"
                                        name="Description"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Select Merchant<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <select class="form-control" name="Select_Merchant" id="Select_Merchant"
                                    onchange="select_shop_from_merchant(this.value, '<?php echo url('product_getmerchantshop_ajax'); ?>', 'Select_Shop');"
                                    required>
                                <option value="0">--Select Merchant--</option>
                                @foreach ($merchantdetails as $merchant)
                                    <option value="<?php echo $merchant->mem_id;?>">{!!$merchant->mem_fname.' '.$merchant->mem_lname!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Select Shop<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <select class="form-control" name="Select_Shop" id="Select_Shop">
                                <option value="0">--Select Shop--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Meta keywords</label>

                        <div class="col-md-8">
                            <textarea class="form-control" id="Meta_Keywords" name="Meta_Keywords"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="text1">Meta description</label>

                        <div class="col-md-8">
                                    <textarea class="form-control" id="Meta_Description"
                                              name="Meta_Description"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="text1">Resource Image <span
                                    class="text-sub">*</span></label>


                        <div class="col-md-8" id="img_upload">
                            <input type="file" id="file0" name="file" onchange="readURL(this)" data-fid="0"
                                   style="background:none;width:185px;border:none;">
                            <input type="hidden" id="x0"  name="x0">
                            <input type="hidden" id="y0"  name="y0">
                            <input type="hidden" id="w0"  name="w0">
                            <input type="hidden" id="h0"  name="h0">

                            <div id="divTxt">
                            </div>

                            <p style="clear:both; padding-top: 20px;"><a onClick="addproductimageFormField(); return false;"
                                  style="cursor:pointer;color:#F60;width:84px;" id="add_img_btn"><i class="icon icon-plus-sign"></i>Add Resource Image</a></p>
                            <input type="hidden" id="aid" name="aid" value="1">
                            <input type="hidden" id="count" name="count" value="0">
                        </div>


                    </div>


                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button class="btn btn-success btn-sm btn-grad" id="submit_product"><a
                                        style="color:#fff">Add Resource</a></button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                Reset
                            </button>

                        </div>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>

            <div id="img_modal" class="modal fade in" tabindex="-1" role="dialog"
                 aria-hidden="false" style="height:auto;display:none; background:white;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3>Edit Image</h3>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <img src="" id="cropimage">
                    </div>
                    <input type="button" style="color:#fff" id="reset_img" value="Done" data-dismiss="modal"
                           class="btn btn-success"/>
                </div>
            </div>
            <input type="hidden" id="current_fid">

        </div>
    </div>
@endsection
@section('script')
    <script src="<?php echo url('')?>/public/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack.js"></script>
    <script src="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url('')?>/public/plugins/Markdown.Editor-hack.js"></script>

    <script src="<?php echo url('')?>/public/plugins/multiselect/multiselect.min.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/cropimage/js/jquery.Jcrop.min.js"></script>

    <script>

        var cropimage = $('#cropimage');
        var image_modal = $('#img_modal');

        function readURL(input) {

            var fid = jQuery(input).data('fid');
            jQuery('#current_fid').val(fid);

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                    var image = new Image();
                    image.src = e.target.result;

                    cropimage.attr('src', image.src);

                    var originalImageWidth = image.width;
                    var originalImageHeight = image.height;

                    var limit_width = $(image_modal).width();
                    var limit_height = $(image_modal).height();

                    if (cropimage.data('Jcrop')) {
                        cropimage.data('Jcrop').destroy();
                    }

                    cropimage.Jcrop({
                        onSelect: function(c){
                            var fid = jQuery('#current_fid').val();
                            console.log(fid);
                            jQuery('#x'+fid).val(c.x);
                            jQuery('#y'+fid).val(c.y);
                            jQuery('#w'+fid).val(c.w);
                            jQuery('#h'+fid).val(c.h);
                        },
                        setSelect: [515, 386, 0, 0],
                        boxWidth: limit_width,
                        boxHeight: limit_height,
                        allowSelect: true,
                        allowMove: true,
                        allowResize: true
                    });

                    jQuery('#img_modal').modal('show');
                };


                reader.readAsDataURL(input.files[0]);
            }
        }

        function addproductimageFormField() {
            //check previous file selected
            var id = document.getElementById("aid").value;
            var count_id = document.getElementById("count").value;

            if (id == 1 && (!jQuery('#file0').val())) {
                return;
            } else {
                var last_file = jQuery('#divTxt').find('input[type="file"]').last();
                if (id != 1) {
                    if (!jQuery(last_file).val() && last_file.length > 0) {
                        return;
                    }
                }
            }

            if (count_id < 4) {
                document.getElementById('count').value = parseInt(count_id) + 1;
                jQuery.noConflict();
                jQuery("#divTxt").append("<div class='imgrow' id='row" + id + "'><dd><input type='file' onChange='readURL(this)' data-fid=" + id + " id='file_more" + id + "'  name='file_more" + id + "' /></dd><dd>&nbsp;&nbsp<a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;' style='color:#F60;' ><i class='icon icon-trash'></i></a></dd> \ " +
                        "<input type='hidden' id= 'x"+ id+ "' name='x"+ id+ "'><input type='hidden' id= 'y"+ id+ "'  name='y"+ id+ "'><input type='hidden' id= 'w"+ id+ "'  name='w"+ id+ "'><input type='hidden' id= 'h"+ id+ "'  name='h"+ id+ "'></div>");
                jQuery('#row' + id).fadeIn({speed: 1000});
                id = (id - 1) + 2;
                document.getElementById("aid").value = id;
            }
        }

        function removeFormField(id) {
            //alert(id);
            var count_id = document.getElementById("count").value;
            document.getElementById('count').value = parseInt(count_id) - 1;

            jQuery(id).remove();
        }

        function show_element(id, visibility) {
            document.getElementById(id).style.display = visibility;

        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;

        }

        $(document).ready(function () {

            $('.js-multiselect1').multiselect({
                left: "#js_multiselect_from_1",
                right: '#js_multiselect_to_1',
                rightAll: '#js_right_All_1',
                rightSelected: '#js_right_Selected_1',
                leftSelected: '#js_left_Selected_1',
                leftAll: '#js_left_All_1'
            });

            $('#wysihtml5').wysihtml5();

            $('.product-content-choice').click(function () {
                if ($(this).attr('value') == "1") {
                    $('.product-content').not('.ship-product').hide();
                    $('.ship-product').show();
                }

                if ($(this).attr('value') == "2") {
                    $('.product-content').not('.down-product').hide();
                    $('.down-product').show();
                }

                if ($(this).attr('value') == "3") {
                    $('.product-content').not('.link-product').hide();
                    $('.link-product').show();
                }
            })

            $('.product-price-choice').click(function () {
                if ($(this).attr('value') == "0") {
                    $('.price_div').show();
                } else {
                    $('.price_div').hide();
                }
            })

        });

        jQuery(function ($) {
            $('#submit_product').click(function () {


                var title = $('#Product_Title');
                var category = $('#Product_Category');
                var maincategory = $('#Product_MainCategory');
                var subcategory = $('#Product_SubCategory');
                var secondsubcategory = $('#Product_SecondSubCategory');
                var originalprice = $('#Original_Price');
                var inctax = $('#inctax');

                var description = $('#Description');
                var wysihtml5 = $('#wysihtml5');
                var merchant = $('#Select_Merchant');
                var shop = $('#Select_Shop');

                var metakeyword = $('#Meta_Keywords');
                var metadescription = $('#Meta_Description');
                var file = $('#file0');
                var counti = $('#count');

                var divtxt = $('#divTxt');


                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];


                //Title
                if ($.trim(title.val()) == "") {
                    title.css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Title');
                    title.focus();
                    return false;
                }
                else {
                    title.css('border', '');
                    $('#error_msg').html('');
                }


                //Theme
                $('#js_multiselect_to_1').find('option').prop('selected', true);
                var select_theme = $('#js_multiselect_to_1').val();

                if (!select_theme) {
                    $('#js_multiselect_to_1').focus();
                    $('#error_msg').html('Please Select theme');
                    return false;
                }


                //Category
                if (category.val() == 0) {
                    category.css('border', '1px solid red');
                    $('#error_msg').html('Please Select Category');
                    category.focus();
                    return false;
                }
                else {
                    category.css('border', '');
                    $('#error_msg').html('');
                }

                if ($('#free_price').prop('checked') == false) {
                    if (originalprice.val() == 0) {
                        originalprice.css('border', '1px solid red');
                        $('#error_msg').html('Please Enter  Resource Price');
                        originalprice.focus();
                        return false;
                    }
                    else if (isNaN(originalprice.val()) == true) {
                        originalprice.css('border', '1px solid red');
                        $('#error_msg').html('Numbers Only Allowed');
                        originalprice.focus();
                        return false;
                    } else {
                        originalprice.css('border', '');
                        $('#error_msg').html('');
                    }
                } else {
                    originalprice.css('border', '');
                    $('#error_msg').html('');
                }

                //Product content
                var product_content = $('input:radio[name=product_content]:checked').val();
                if (!product_content) {
                    $('.product_content_ul').css('border', '1px solid red');
                    $('#error_msg').html('Please Choose Content Type');
                    return false;
                } else {
                    if (product_content == 1) {
                        var shipamtchecked = $('input:radio[name=shipamt]:checked').val();
                        var shippingamt = $('#Shipping_Amount');

                        if (shipamtchecked == 2) {
                            if (shippingamt.val() == "") {
                                shippingamt.css('border', '1px solid red');
                                $('#error_msg').html('Please Provide Shipping Amount');
                                shippingamt.focus();
                                return false;
                            }
                            else {
                                shippingamt.css('border', '');
                                $('#error_msg').html('');
                            }
                        } else {
                            shippingamt.css('border', '');
                            $('#error_msg').html('');
                        }
                    } else if (product_content == 2) {
                        var file_down = $('#file_down');

                        //check first file image is empty
                        if (!$(file_down).val()) {
                            $(file_down).css('border', '1px solid red');
                            $('#error_msg').html('Please choose file');
                            return false;
                        } else {
                            $(file_down).css('border', '');
                            $('#error_msg').html('');
                        }
                    } else {
                        var product_link = $('#product_link');
                        if (!$(product_link).val()) {
                            $(product_link).css('border', '1px solid red');
                            $('#error_msg').html('Please Input Product Link');
                            return false;
                        } else {
                            $(product_link).css('border', '');
                            $('#error_msg').html('');
                        }
                    }
                }

                if ($.trim(wysihtml5.val()) == '') {
                    $('#descdiv').css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Description');
                    $('#descdiv').focus();
                    return false;
                }
                else {
                    $('#descdiv').css('border', '');
                    $('#error_msg').html('');
                }


                if (merchant.val() == 0) {
                    merchant.css('border', '1px solid red');
                    $('#error_msg').html('Please Select Merchant');
                    merchant.focus();
                    return false;
                } else {
                    merchant.css('border', '');
                    $('#error_msg').html('');
                }

                if (shop.val() == 0) {
                    shop.css('border', '1px solid red');
                    $('#error_msg').html('Please Select Shop');
                    shop.focus();
                    return false;
                } else {
                    shop.css('border', '');
                    $('#error_msg').html('');
                }


                //check first file image is empty
                if (!$('#file0').val()) {
                    $('#file0').css('border', '1px solid red');
                    $('#error_msg').html('Please choose valid image');
                    return false;
                } else {
                    $('#file0').css('border', '');
                    $('#error_msg').html('');
                }


                //check more images in div TXT

                var count_images = $('#count').val();

                for (var i = 0; i <= count_images; i++) {
                    if ($('#file_more' + i).val() == "") {
                        $('#file_more' + i).focus();
                        $('#file_more' + i).css('border', '1px solid red');
                        $('#error_msg').html('Please choose image');
                        return false;
                    }
                    else if ($.inArray($('#file_more' + i).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        $('#file_more' + i).focus();
                        $('#file_more' + i).css('border', '1px solid red');
                        $('#error_msg').html('Please choose valid image');
                        return false;
                    }
                    else {
                        $('#error_msg').html('');
                    }
                }
            });
        });

    </script>

@endsection