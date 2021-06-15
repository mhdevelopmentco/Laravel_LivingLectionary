@extends('includes/page_master')
@section('title', 'Become A Contributor')
@section('css')
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
    <style>
        textarea {
            width: 100%;
            box-sizing: border-box;
        }

        .panel {
            -webkit-box-shadow: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row-fluid">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('/'); ?>">Home</a></li>
                    <li class="active">Register as Contributor</li>
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

                <h3>Become a Contributor</h3><h4 style="font-style: italic">Join the Living Lectionary</h4>

                <div class="content">

                    {!! Form::open(array('url'=>'register_as_contributor_submit','id'=>'register_form', 'class'=>'form-horizontal loginFrm', 'enctype'=>'multipart/form-data')) !!}

                    <fieldset class="personal-data"><br/>
                        <!-- <h4 style="padding:10px;background:#eee;">Create your store</h4> -->
                        <div class="row-fluid">
                            <div class="col-md-6">
                                <div class="panel panel-body">
                                    <h4 class="col-md-12">Your Store Information</h4>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="store_name">Display Name*:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="store_name" name="store_name" class="form-control"
                                                   required placeholder="" value="{!! Input::old('store_name') !!}"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="store_org">Organization:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="store_org" name="store_org" class="form-control"
                                                   placeholder="" value="{!! Input::old('store_org') !!}"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="store_title">Title:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="store_title" name="store_title" placeholder=""
                                                   class="form-control" value="{!! Input::old('store_title') !!}">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="store_web">Web Address:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="url" id="store_web" name="store_web" placeholder=""
                                                   class="form-control"
                                                   value="{!! Input::old('store_web') !!}">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="select_country">Country<span
                                                        class="text-sub">*</span></label>
                                        </div>

                                        <div class="col-md-8">
                                            <select class="form-control" name="select_country" id="select_country"
                                                    required
                                                    onchange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_state')">
                                                <option value="">--select--</option>
                                                @foreach ($country_details as $country)
                                                    <option value="<?php echo $country->co_id;?>"
                                                            @if ($country->co_default == 1)
                                                            selected
                                                            @endif >
                                                        {!!$country->co_name!!}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="select_state">State<span
                                                        class="text-sub">*</span></label>
                                        </div>

                                        <div class="col-md-8">
                                            <select class="validate[required] form-control"
                                                    id="select_state"
                                                    name="select_state" required
                                                    onChange="select_city_from_state(this.value, '<?php echo url('select_city_by_state'); ?>', 'select_city')"
                                            >
                                                <option value="">--select--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="select_city">City<span
                                                        class="text-sub">*</span></label>
                                        </div>

                                        <div class="col-md-8">
                                            <input type="text" class="form-control typeahead" id="select_city"
                                                   name="select_city" required
                                                   value="{!! Input::old('select_city') !!}"/>
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
                                                   value="{!! Input::old('store_add_one') !!}">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="store_add_two">Street Address 2</label>
                                        </div>

                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder=""
                                                   id="store_add_two" name="store_add_two"
                                                   value="{!! Input::old('store_add_two') !!}"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="store_zipcode">Zipcode<span
                                                        class="text-sub">*</span></label>
                                        </div>

                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="" id="store_zipcode"
                                                   name="store_zipcode" required
                                                   pattern="\d{5}([\-]\d{4})?"
                                                   title="xxxxx or xxxxx-xxxx"
                                                   value="{!! Input::old('store_zipcode') !!}">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="store_zipcode" style="font-style: italic">Would you like you or
                                                your organization to be displayed on a map?</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label style="display: inline-block;">
                                                <input type="radio" style="margin-left:10px;" name="show_map"
                                                       value="1" checked
                                                       title="For Profit"/>Yes
                                            </label>
                                            <label style="display: inline-block;">
                                                <input type="radio" style="margin-left:10px;" name="show_map"
                                                       value="0"
                                                       title="Non Profit"/>No
                                            </label>
                                        </div>
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
                                                   value="{!! Input::old('store_phone') !!}"
                                                   title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"/>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-4">
                                            <label for="meta_keyword">Meta keywords</label>
                                        </div>

                                        <div class="col-md-8">
                                                <textarea class="form-control" name="meta_keyword"
                                                          id="meta_keyword">{!! Input::old('meta_keyword') !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="col-md-12">
                                            <label for="store_orgdesc">Please give us a short description of yourself or
                                                your organization</label>
                                        <textarea id="store_orgdesc" name="store_orgdesc"
                                                  class="form-control">{!! Input::old('store_orgdesc') !!}</textarea>
                                        </div>
                                    </div>


                                    <div class=control-group>
                                        <div class="col-md-4">
                                            <label for="store_img">Store Image*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" id="file" name="store_img" title="Store Image"
                                                   onchange="readURL(this)">
                                            <input type="hidden" id="x" name="x" value="0">
                                            <input type="hidden" id="y" name="y" value="0">
                                            <input type="hidden" id="w" name="w" value="0">
                                            <input type="hidden" id="h" name="h" value="0">
                                            <label>Image upload size 570 X 362</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-body">
                                    <h4 class="">Payment Information</h4>
                                    <p style="font-style:italic;">To receive payment for your content, please fill out
                                        the information below. If you
                                        do not wish to charge for your content, please select that option below and
                                        proceed.
                                        If you would like to enter your payment information later, please indicate that
                                        before proceeding.</p>
                                    <div class="control-group">
                                        <label for="store_name">The Living Lectionary processes payments via Paypal.
                                            Please enter your PayPal email:</label>
                                        <!--div class="row-fluid">
                                            <label class="col-md-4">
                                                <input type="radio" id="pay_with_paypal" name="store_payment"
                                                       class="form-control pay_info"
                                                       style="" checked
                                                       placeholder="" value="1"/> Paypal
                                            </label>
                                            <label class="col-md-4">
                                                <input type="radio" id="pay_with_stripe" name="store_payment"
                                                       class="form-control pay_info"
                                                       style=""
                                                       placeholder="" value="2"/> Stripe
                                            </label>
                                        </div-->
                                        <div id="paypal_info">
                                            <div class="col-md-4">
                                                <label>Paypal Email:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="email" name="paypal_email" title="Paypal Email"/>
                                            </div>
                                        </div>
                                        <div class="hidden" id="stripe_info">
                                            <div class="col-md-4">
                                                <label>Stripe Email:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="email" name="stripe_email" title="Stripe Email"/>
                                            </div>
                                        </div>
                                        <label>
                                            <input type="radio" name="store_payment" class="form-control pay_info"
                                                   style="width: auto;" value="3"/>
                                            I will enter my payment information later.
                                        </label>
                                        <label>
                                            <input type="radio" name="store_payment" class="form-control pay_info"
                                                   style="width: auto;" value="4"/>I do not plan to charge for my
                                            content.
                                        </label>
                                    </div>
                                </div>

                                <div class="panel panel-body" id="tax_div">
                                    <h5>Tax Info:</h5>
                                    <div class="row-fluid control-group">
                                        <label>I am a:</label>
                                        <label style="display: inline-block;">
                                            <input type="radio" style="margin-left:10px;" name="tax_profit"
                                                   value="1" checked
                                                   title="For Profit"/>For Profit
                                        </label>
                                        <label style="display: inline-block;">
                                            <input type="radio" style="margin-left:10px;" name="tax_profit"
                                                   value="2"
                                                   title="Non Profit"/>Non-Profit
                                        </label>
                                        <label style="display: inline-block;">
                                            <input type="radio" style="margin-left:10px;" name="tax_profit"
                                                   value="3"
                                                   title="For Profit"/>Individual
                                        </label>
                                    </div>

                                    <h5>Tax Information for US Residents Only:</h5>
                                    <div class="row-fluid">
                                        <label>
                                            <input type="radio" name="tax_us_resident" value="1" class="tax_us_resident"
                                                   title="For US citizen" id="tax_us_res_1" checked/>
                                            I am a United States citizen, US Green Card holder, or US resident
                                        </label>
                                        <div class="control-group" id="tax_us_1">
                                            <div class="row-fluid" style="margin-bottom:10px;">
                                                <div class="col-md-4">
                                                    <label for="social_security">Social Security *:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="social_security" title="Social Security"
                                                           id="social_security" required/>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="col-md-6">
                                                    <label for="full_name_on_tax">Full name as it appears on your tax
                                                        records *:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="full_name_on_tax" title="Full name on Tax"
                                                           id="full_name_on_tax" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <label>
                                            <input type="radio" name="tax_us_resident" value="2" class="tax_us_resident"
                                                   title="For US corporation" id="tax_us_res_2"/>
                                            I am a US corporation, partnership or other business
                                        </label>
                                        <div class="control-group" id="tax_us_2">
                                            <div class="row-fluid" style="margin-bottom:10px;">
                                                <div class="col-md-4">
                                                    <label for="fed_tax_id">Federal Tax ID *:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="fed_tax_id" title="Federal Tax ID"
                                                           id="fed_tax_id" disabled required/>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="col-md-6">
                                                    <label for="business_name_on_tax">Business name as it appears on
                                                        your tax records *:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="business_name_on_tax"
                                                           title="Business name on Tax" disabled required
                                                           id="business_name_on_tax"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-style: italic;">
                                        Note: To receive any payment without applying US backup withholding, you must
                                        <span>
                                            <a href="https://www.irs.gov/pub/irs-pdf/fw9.pdf"
                                               target="_blank" style="text-decoration: underline;color:#ff8400;">submit a completed W-9</a>
                                        </span>. Please use this link to access the W-9. Fill it out and
                                        submit it via email to contact@livinglectionary.org.
                                    </p>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="control-group">
                            <h4>Terms and Conditions</h4>
                            <?php if (isset($term)) {
                                $content = stripslashes($term->tr_description);
                            } else {
                                $content = 'Yet To be Filled';
                            } ?>
                            <div id="terms_div"><?php echo $content;?></div>
                        </div>

                        <div class="control-group">
                            <label><input type="checkbox" name="newsletter" id="news"
                                          data-toggle="tooltip"
                                          title="You need to figure out if you want to signup for multiple newsletters."
                                          checked>Yes,
                                sign me up to receive updates, devotions and promotions.</label>
                        </div>

                        <div class="control-group text-center">
                            <input type="submit" id="register_submit" class="btn btn-warning input-auto-width" disabled
                                   value="Agree and Create Your Contributor Account"/>
                        </div>
                    </fieldset>
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
                                allowResize: true,
                                aspectRatio: 570 / 362
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
                alert('Please Choose Valid Image for Store');
                input.value = "";
            }
        }

    </script>

    <script>
        $(document).ready(function () {

            if ($('#select_country').val() != 0)
                $('#select_country').trigger('change');

            $('.close').click(function () {
                $('.alert').hide();
            });

            $('#register_submit').click(function () {
                var file = $('#file');
                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                if (file.val() == "") {
                    file.focus();
                    file.css('border', '1px solid red');
                    return false;
                }
                else if ($.inArray($('#file').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    file.focus();
                    file.css('border', '1px solid red');
                    return false;
                }
                else {
                    file.css('border', '');
                }
            });

            $('.pay_info').click(function () {
                var cur_val = $(this).val();
                if (cur_val == 1) {
                    $('#paypal_info').removeClass('hidden');
                    $('#stripe_info').addClass('hidden');
                    $('#tax_div').removeClass('hidden');

                    $('#tax_us_res_1').prop('checked', true);
                    $('#social_security').prop('disabled', false);
                    $('#full_name_on_tax').prop('disabled', false);
                    $('#fed_tax_id').prop('disabled', true);
                    $('#business_name_on_tax').prop('disabled', true);

                } else if (cur_val == 2) {
                    $('#stripe_info').removeClass('hidden');
                    $('#paypal_info').addClass('hidden');
                    $('#tax_div').removeClass('hidden');

                    $('#tax_us_res_1').prop('checked', true);
                    $('#social_security').prop('disabled', false);
                    $('#full_name_on_tax').prop('disabled', false);
                    $('#fed_tax_id').prop('disabled', true);
                    $('#business_name_on_tax').prop('disabled', true);

                } else {
                    $('#tax_div').addClass('hidden');
                    $('#stripe_info').addClass('hidden');
                    $('#paypal_info').addClass('hidden');

                    $('#social_security').prop('disabled', true);
                    $('#full_name_on_tax').prop('disabled', true);
                    $('#fed_tax_id').prop('disabled', true);
                    $('#business_name_on_tax').prop('disabled', true);
                }
            })

            $('.tax_us_resident').click(function () {
                var cur_val = $(this).val();
                if (cur_val == 1) {
                    $('#social_security').prop('disabled', false);
                    $('#full_name_on_tax').prop('disabled', false);
                    $('#fed_tax_id').prop('disabled', true);
                    $('#business_name_on_tax').prop('disabled', true);
                } else {
                    $('#social_security').prop('disabled', true);
                    $('#full_name_on_tax').prop('disabled', true);
                    $('#fed_tax_id').prop('disabled', false);
                    $('#business_name_on_tax').prop('disabled', false);
                }
            })

            $('#news').click(function () {
                var cur_val = $(this).prop('checked');
                if (!cur_val) {
                    $(this).tooltip('show');
                } else {
                    $(this).tooltip('hide');
                }
            })

            $('#terms_div').scroll(function () {
                var scrolltop = $(this).scrollTop();
                var height = $(this).css('height');
                console.log(height);
                if (scrolltop > 1300) {
                    $('#register_submit').prop('disabled', false);
                }
            });
        });
    </script>
@endsection