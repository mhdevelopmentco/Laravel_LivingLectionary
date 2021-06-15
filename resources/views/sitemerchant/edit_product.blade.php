@extends('sitemerchant.layout.merchant_master')
@section('title', 'Edit Product')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
    <link rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css"/>
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

        #sub_theme_selection {
            /*display:none;*/
        }

        .multiselect-native-select .btn-group, .multiselect {
            width: 100%;
        }

        .multiselect-container li.subtheme {
            padding-left: 30px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Edit Resources</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Resources</h5>

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

                <?php
                $title = $product->pro_title;
                $category_get = $product->pro_mc_id;
                $maincategory = $product->pro_smc_id;
                $subcategory = $product->pro_sb_id;
                $secondsubcategory = $product->pro_ssb_id;
                $pro_free = $product->pro_free;
                $originalprice = $product->pro_price;
                $shippingamt = $product->pro_shippamt;
                $description = $product->pro_desc;
                $shop = $product->pro_sh_id;
                $scripture = $product->pro_scripture;
                $file_get = $product->pro_Img;
                $img_count = $product->pro_image_count;
                $pro_content = $product->pro_content_kind;
                $pro_shippamt = $product->pro_shippamt;
                $pro_file_down = $product->pro_file_down;
                $pro_file_link = $product->pro_file_link;
                ?>

                <div id="div-1" class="accordion-body collapse in body">

                    {!! Form::open(array('url'=>'mer_edit_product_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                    <input type="hidden" name="product_edit_id" value="{{$product->pro_id}}"/>

                    <div id="error_msg" style="color:#F00;font-weight:800"></div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Resource Title<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="Product_Title" placeholder="" name="Product_Title" class="form-control" required
                                   type="text" value="<?php echo $title; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Choose Theme<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <select name="select_theme" id="select_theme"
                                    class="form-control" size="8"
                                    multiple="multiple">
                                @foreach($theme_details as $theme_group)
                                    <option value="{{$theme_group[0]->theme_id}}">{{$theme_group[0]->theme_name}}</option>
                                    @foreach($theme_group[1] as $sub_theme)
                                        <option value="{{$sub_theme->theme_id}}"
                                                class="subtheme">{{$sub_theme->theme_name}}</option>
                                    @endforeach
                                @endforeach

                            </select>
                            <input type="hidden" value="" name="selected_theme" id="selected_theme">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Product_Category" class="control-label col-md-2">Category<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">

                        <!--select class="form-control" name="category" id="Product_Category" required
                                    onChange="select_subcategory_from_category(1,  this.value, '<?php echo url('product_getmaincategory'); ?>', 'Product_Maincategory',  '{{$maincategory}}') "-->
                            <select class="form-control" name="category" id="Product_Category" required>
                                <option value="0">--- Select ---</option>
                                @forelse($productcategory as $catone)
                                    <option value="{{$catone->mc_id}}"
                                            @if($catone->mc_id == $category_get) selected @endif >
                                        {{$catone->mc_name}}
                                    </option>
                                @empty
                                    <option value="0">--- Select ---</option>
                                @endforelse
                            </select>

                        </div>
                    </div>

                <!--div class="form-group">
                        <label class="control-label col-md-2">Select Main Category</label>

                        <div class="col-md-8">
                            <select class="form-control" name="maincategory" id="Product_Maincategory"
                                    onChange="select_subcategory_from_category(2, this.value, '<?php echo url('product_getsubcategory'); ?>', 'Product_SubCategory',  '{{$subcategory}}' )">
                                <option value="0">--- Select ---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Select Sub Category</label>

                        <div class="col-md-8">
                            <select class="form-control" name="subcategory" id="Product_SubCategory"
                                    onChange="select_subcategory_from_category(3, this.value, '<?php echo url('product_getsecondsubcategory'); ?>', 'Product_SecondSubCategory', '{{$secondsubcategory}}' )">
                                <option value="0">--- Select ---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text2" class="control-label col-md-2">Select Second Sub Category</label>

                        <div class="col-md-8">
                            <select class="form-control" name="secondsubcategory" id="Product_SecondSubCategory">
                                <option value="0">--- Select ---</option>
                            </select>
                        </div>
                    </div-->

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2"> Resource Price<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <ul class="radio_ul">
                                <li>
                                    <input class="form-control product-price-choice" type="radio" id="free_price"
                                           name="product_price_free"
                                           value="1" <?php if ($pro_free == 1) echo 'checked';?> >
                                    <label for="free_price">Free</label>
                                </li>
                                <li>
                                    <input class="form-control product-price-choice" type="radio"
                                           id="no_free_price" name="product_price_free"
                                           value="0" <?php if ($pro_free != 1) echo 'checked';?>>
                                    <label for="no_free_price">Add price</label>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="form-group price_div">
                        <div class="col-md-8 col-md-offset-2">
                            <input placeholder="Numbers Only" class="form-control" type="text"
                                   id="Original_Price" value="<?php echo $originalprice; ?>"
                                   name="Original_Price">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Select Content Type<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <ul class="radio_ul product_content_ul">
                                <li>
                                    <input class="form-control product-content-choice" type="radio"
                                           id="download_product" name="product_content"
                                           value="2" <?php if ($pro_content == 2) echo 'checked';?>>
                                    <label for="download_product">A downloadable resource</label>
                                </li>

                                <li>
                                    <input class="form-control product-content-choice" type="radio" id="ship_product"
                                           name="product_content"
                                           value="1" <?php if ($pro_content == 1) echo 'checked';?>>
                                    <label for="ship_product">A tangible item to be shipped</label>
                                </li>

                                <li>
                                    <input class="form-control product-content-choice" type="radio" id="link_product"
                                           name="product_content"
                                           value="3" <?php if ($pro_content == 3) echo 'checked';?>>
                                    <label for="link_product">A link to content hosted on another site</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group product-content ship-product"
                         <?php if($pro_content != 1) { ?>style="display: none;" <?php }?> id="showshipselection">
                        <label for="text2" class="control-label col-md-2">Shipping Amount<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="radio" id="shipamt1" name="shipamt"
                                   onClick="show_element('shipamount_div', 'none');"
                                   value="1" <?php if ($pro_shippamt == 0) echo 'checked';?>> <label
                                    class="sample" for="shipamt1">Shipping Amount 0</label>
                            <input type="radio" id="shipamt2" name="shipamt"
                                   onClick="show_element('shipamount_div', 'inline');"
                                   value="2" <?php if ($pro_shippamt != 0) echo 'checked';?>><label for="shipamt2"
                                                                                                    class="sample">Amount</label>

                            <div id="shipamount_div" <?php if($pro_shippamt == '0'){ ?>style="display:none;"<?php } ?>>
                                <input placeholder="" class="form-control" type="text" id="Shipping_Amount"
                                       name="Shipping_Amount" value="{{$pro_shippamt}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group product-content down-product" id="downcontent_div"
                         <?php if($pro_content != 2) { ?>style="display: none;"<?php }?>>
                        <label class="control-label col-md-2" for="text1">Upload your content<br><span
                                    style="font-size: 12px;font-weight:normal;">(File Size must be {!! $max_file_size !!}
                                or less)</span><span class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <input type="hidden" id="file_down_origin" value="{{$pro_file_down}}"
                                   name="file_down_origin">

                            <?php if ($pro_content == 2) {
                            ?>
                            <label>Uploaded File:
                                <a href="{{url('download_product').'/'.$pro_file_down}}"> {{$pro_file_down}} </a>
                            </label>
                            <?php } ?>
                            <input type="file" id="file_down" name="file_down"
                                   style="background:none;width:185px;border:none;">
                        </div>
                    </div>

                    <div class="form-group product-content link-product" id="link_div"
                         <?php if($pro_content != 3) { ?>style="display: none;"<?php }?>>
                        <label for="text1" class="control-label col-md-2">Enter the full content link<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <input placeholder="" type="url" pattern="https?://.+" class="form-control"
                                   id="product_link" name="product_link" value="{{$pro_file_link}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Description" class="control-label col-md-2">Description<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                                    <textarea id="wysihtml5" class="form-control" rows="10" id="Description"
                                              name="Description"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Select_Shop" class="control-label col-md-2">Select Shop<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <select class="form-control" name="Select_Shop" id="Select_Shop">
                                @forelse($store_details as $store)
                                    <option value="{{$store->stor_id}}"
                                            @if($store->stor_id == $product->pro_sh_id) selected @endif>{{$store->stor_name}}</option>
                                @empty
                                    <option value="0">--- Select ---</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="Scripture">Scripture</label>

                        <div class="col-md-8">
                                    <textarea class="form-control" id="Scripture"
                                              name="Scripture"><?php echo $scripture; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Resource Image<span
                                    class="text-sub">*</span><br><span style="color:#999">(max 5)</span></label>
                        <div class="col-md-8" id="img_upload">

                            <?php if($img_count == 0) {?>
                            <input type="file" id="file0" name="file0" onchange="readURL(this)" data-fid="0"
                                   style="background:none;width:185px;border:none;">
                            <div id="divTxt">
                                <input type="hidden" id="x0">
                                <input type="hidden" id="y0">
                                <input type="hidden" id="w0">
                                <input type="hidden" id="h0">
                            </div>
                            <p><a onClick="addimgFormField();"
                                  style="cursor:pointer;color:#F60;width:84px;" id="add_img_btn">Add</a></p>
                            <input type="hidden" id="aid" name="aid" value="1">
                            <input type="hidden" id="count" name="count" value="0">
                            <?php } else {?>

                            <?php
                            $file_get_path = explode("/**/", $file_get);
                            ?>

                            <div class="col-md-3" id="row0">
                                <input type="hidden" name="file_new0" id="file_new0"
                                       value="<?php echo $file_get_path[0]; ?>"/>
                                <input type='file' id="file0" name='file0' onchange="readURL(this)" data-fid="0"
                                       style="background:none;width:95px;border:none;"/>
                                <img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $file_get_path[0]; ?>"
                                     class="edit_product_img">
                                <input type="hidden" id="x0" name="x0">
                                <input type="hidden" id="y0" name="y0">
                                <input type="hidden" id="w0" name="w0">
                                <input type="hidden" id="h0" name="h0">
                            </div>

                            <?php for($j = 1 ; $j < $img_count; $j++)
                            { ?>
                            <div class="col-md-3" id="row<?php echo $j; ?>">
                                <input type="hidden" name="file_more_new<?php echo $j; ?>"
                                       value="<?php echo $file_get_path[$j]; ?>">
                                <input type='file' data-fid="<?php echo $j; ?>" id="file_more<?php echo $j; ?>"
                                       name='file_more<?php echo $j; ?>'
                                       style="background:none;width:95px;border:none;" onChange="readURL(this)"/>
                                <img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $file_get_path[$j]; ?>"
                                     class="edit_product_img">
                                <a href="#" onClick="removeFormField('#row<?php echo $j; ?>'); return false;"
                                   style="color:#F60;"><i class='icon icon-trash'></i></a>
                                <input type="hidden" id="x<?php echo $j; ?>" name="x<?php echo $j; ?>">
                                <input type="hidden" id="y<?php echo $j; ?>" name="y<?php echo $j; ?>">
                                <input type="hidden" id="w<?php echo $j; ?>" name="w<?php echo $j; ?>">
                                <input type="hidden" id="h<?php echo $j; ?>" name="h<?php echo $j; ?>">
                            </div>
                            <?php
                            } ?>

                            <div id="divTxt"></div>
                            <p style="clear:both; padding-top: 20px;"><a onClick="addimgFormField();"
                                                                         style="cursor:pointer;color:#F60;"><i
                                            class="icon icon-plus-sign"></i>Add Resource Image</a></p>
                            <input type="hidden" id="aid" name="aid" value="<?php echo $img_count + 1; ?>">
                            <input type="hidden" id="count" name="count" value="<?php echo $img_count; ?>">
                            <?php } ?>
                        </div>


                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button class="btn btn-warning btn-sm btn-grad" id="submit_product"><a
                                        style="color:#fff">Update Resource</a></button>
                            <a href="<?php echo url('manage_product');?>"
                               class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel</a>

                        </div>

                    </div>

                    {!! Form :: close() !!}
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
    </div>
@endsection


@section('script')

    <script src="<?php echo url('')?>/public/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack.js"></script>
    <script src="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url('')?>/public/plugins/Markdown.Editor-hack.js"></script>

    <script src="<?php echo url(); ?>/public/plugins/cropimage/js/jquery.Jcrop.min.js"></script>

    <script src="<?php echo url('')?>/public/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

    <script type="text/javascript">

        <?php echo 'var used_theme =' . json_encode($used_theme) . ';';?>

        var max_file_size = '<?php echo $max_file_size?>';
        max_file_size = parseFloat(max_file_size);

        var cropimage = jQuery('#cropimage');
        var image_modal = jQuery('#img_modal');
        var imageType = /image.*/;

        var reader = new FileReader();

        function readURL(input) {
            var fid = jQuery(input).data('fid');
            jQuery('#current_fid').val(fid);

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
                                    var fid = jQuery('#current_fid').val();
                                    jQuery('#x' + fid).val(c.x);
                                    jQuery('#y' + fid).val(c.y);
                                    jQuery('#w' + fid).val(c.w);
                                    jQuery('#h' + fid).val(c.h);
                                },
                                setSelect: [515, 515, 0, 0],
                                boxWidth: limit_width,
                                boxHeight: limit_height,
                                allowSelect: true,
                                allowMove: true,
                                allowResize: true,
                                aspectRatio: 1
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
                alert('Please Choose Valid Image for Resource');
                input.value = "";
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

            if (count_id < 3) {
                document.getElementById('count').value = parseInt(count_id) + 1;
                jQuery.noConflict();
                jQuery("#divTxt").append("<div class='imgrow' id='row" + id + "'><dd><input type='file' onChange='readURL(this)' data-fid=" + id + " id='file_more" + id + "'  name='file_more" + id + "' /></dd><dd>&nbsp;&nbsp<a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;' style='color:#F60;' ><i class='icon icon-trash'></i></a></dd> \ " +
                        "<input type='hidden' id= 'x" + id + "' name='x" + id + "'><input type='hidden' id= 'y" + id + "'  name='y" + id + "'><input type='hidden' id= 'w" + id + "'  name='w" + id + "'><input type='hidden' id= 'h" + id + "'  name='h" + id + "'></div>");
                jQuery('#row' + id).fadeIn({speed: 1000});
                id = (id - 1) + 2;
                document.getElementById("aid").value = id;
            }
        }


        function removeFormField(id) {
            var count_id = document.getElementById("count").value;
            document.getElementById('count').value = parseInt(count_id) - 1;
            jQuery(id).remove();
        }


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;

        }

        function show_element(id, visibility) {
            document.getElementById(id).style.display = visibility;
        }

        // Onload to get selected category
        $(document).ready(function () {

            $('#select_theme').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: true,
                disableIfEmpty: true
            });

            $('#wysihtml5').wysihtml5();

            <?php if($pro_free == 0)  {?>
                $('.price_div').show();
            <?php }?>

            //trigger the category
            $('#Product_Category').trigger('change');

            $('#Select_Merchant').trigger('change');

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

            var title = $('#Product_Title');
            var category = $('#Product_Category');
            var maincategory = $('#Product_Maincategory');
            var subcategory = $('#Product_SubCategory');
            var secondsubcategory = $('#Product_SecondSubCategory');
            var originalprice = $('#Original_Price');
            var shippingamt = $('#Shipping_Amount');
            var description = $('#Description');
            var wysihtml5 = $('#wysihtml5');
            var merchant = $('#Select_Merchant');
            var shop = $('#Select_Shop');
            var scripture = $('#Scripture');
            var file = $('#file');

            var counter = 2;
            $('#del_file').hide();
            $('img#add_file').click(function () {
                $('#file_tools').before('<br><div class="col-md-8" id="f' + counter + '"><input name="file[]" type="file"></div>');
                $('#del_file').fadeIn(0);
                counter++;
            });

            $('img#del_file').click(function () {
                if (counter == 3) {
                    $('#del_file').hide();
                }
                counter--;
                $('#f' + counter).remove();
            });


            $('#select_theme').multiselect('select', used_theme);
        });

        jQuery(function ($) {
            $('#submit_product').click(function () {

                var title = $('#Product_Title');
                var category = $('#Product_Category');
                var maincategory = $('#Product_Maincategory');
                var subcategory = $('#Product_SubCategory');
                var secondsubcategory = $('#Product_SecondSubCategory');
                var originalprice = $('#Original_Price');
                var shippingamt = $('#Shipping_Amount');
                var description = $('#Description');
                var wysihtml5 = $('#wysihtml5');
                var merchant = $('#Select_Merchant');
                var shop = $('#Select_Shop');
                var file = $('#file');

                var shipamtchecked = $('input:radio[name=shipamt]:checked').val();

                if ($.trim(title.val()) == "") {
                    title.css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Title');
                    title.focus();
                    return false;
                } else {
                    title.css('border', '');
                    $('#error_msg').html('');
                }

                var selected_options = $('#select_theme option:selected').length;
                if (selected_options == 0) {
                    $('#select_theme').focus();
                    $('#error_msg').html('Please Select theme');
                    return false;
                }

                $('#selected_theme').val($('#select_theme').val());

                if (category.val() == 0) {
                    category.css('border', '1px solid red');
                    $('#error_msg').html('Please Select Category');
                    category.focus();
                    return false;
                } else {
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
                                $('.product_content_ul').css('border', '');
                                shippingamt.css('border', '');
                                $('#error_msg').html('');
                            }
                        } else {
                            $('.product_content_ul').css('border', '');
                            shippingamt.css('border', '');
                            $('#error_msg').html('');
                        }
                    } else if (product_content == 2) {

                        var file_down = document.getElementById('file_down');

                        var origin = $('file_down_origin').val();

                        if (origin == "") {
                            //check first file image is empty
                            if (!$(file_down).val()) {
                                $(file_down).css('border', '1px solid red');
                                $('#error_msg').html('Please choose file');
                                return false;
                            } else {
                                $(file_down).css('border', '');
                                $('#error_msg').html('');
                            }

                            var file_size = file_down.files[0].size;

                            if (file_size > max_file_size) {
                                $(file_down).css('border', '1px solid red');
                                $('#error_msg').html('File is too big. Please choose other file.');
                                return false;
                            }
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
                            $('.product_content_ul').css('border', '');
                        }
                    }
                }

                if ($.trim(wysihtml5.val()) == '') {
                    wysihtml5.css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Description');
                    wysihtml5.focus();
                    return false;
                } else {
                    wysihtml5.css('border', '');
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

                //check more images in div TXT
                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

                var count_images = $('#count').val();
                if (count_images == 0) {
                    $('#error_msg').html('Please choose image');
                    $('#img_upload').focus();
                    $('#img_upload').css('border', '1px solid red');
                    return false;
                } else {

                }

                //check file0
                if ($('#file0').val() != "" && $.inArray($('#file0').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#file0').css('border', '1px solid red');
                    $('#error_msg').html('Please choose valid image');
                    return false;
                }

                for (var j = 1; j < count_images; j++) {

                    if ($('#file_more_new' + j).val() == "" && !$('#file_more' + j).val()) {
                        //choose image
                        $('#file_more' + j).focus();
                        $('#file_more' + j).css('border', '1px solid red');
                        $('#error_msg').html('Please choose image');
                        return false;

                    } else if ($('#file_more' + j).val()) {

                        if ($.inArray($('#file_more' + j).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            $('#file_more' + j).focus();
                            $('#file_more' + j).css('border', '1px solid red');
                            $('#error_msg').html('Please choose valid image');
                            return false;
                        } else {
                            $('#error_msg').html('');
                        }
                    }
                }
            });
        })


    </script>
@endsection
