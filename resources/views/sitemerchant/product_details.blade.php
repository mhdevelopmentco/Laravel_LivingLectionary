@extends('sitemerchant.layout.merchant_master')
@section('title', 'Resources Detail s')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
    <link rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css"/>
    <style>
        ul.wysihtml5-toolbar {
            display: none;
        }

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
    <style>
        .control-label {
            text-align: right;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Resource details</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Resource details</h5>
                </header>
                <div class="row">
                    <div class="col-md-12 panel_marg">

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Resource Title</label>
                                <div class="col-md-9">
                                    <?php echo $product->pro_title; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Resource Theme</label>
                                <div class="col-md-9 row">
                                    @if(count($used_theme)>0)

                                        @foreach($used_theme as $theme)
                                            <div class="col-sm-3">
                                                <label>{{$theme->theme_name}}</label>
                                                <img class="img-responsive"
                                                     src="{{url('public/assets/images/themes/'.$theme->theme_banner_img)}}"/>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class=" panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Category</label>
                                <div class="col-md-9">
                                    <?php echo $product->mc_name; ?>
                                </div>
                            </div>
                        </div>
                    <!--div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Main Category</label>
                                <div class="col-md-9">
                                    <?php echo $product->smc_name; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Sub Category</label>
                            <div class="col-md-9">
                                <?php echo $product->sb_name; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Second Sub Category</label>
                            <div class="col-md-9">
                                <?php echo $product->ssb_name; ?>
                            </div>
                        </div>
                    </div-->

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2"> Resource Price</label>
                                <div class="col-md-9">
                                    <?php if ($product->pro_price > 0) {
                                        echo $product->pro_price;

                                        if ($product->pro_inctax) {
                                            echo ' :Included Tax';
                                        }

                                    } else {
                                        echo 'Free';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="text1" class="control-label col-md-2">Content Type</label>

                                <div class="col-md-9">
                                    <?php if ($product->pro_content_kind == 1) {
                                        echo 'A tangible item to be shipped';

                                        if ($product->pro_shippamt > 0) {
                                            echo '<br><br>Shipping Amount: <strong>' . $product->pro_shippamt . '</strong>';
                                        } else {
                                            echo '<br><br>Shipping Not Required';
                                        }
                                    } else if ($product->pro_content_kind == 2) {
                                        echo 'A downloadable resource';
                                        echo '<br><br>Download URL: <strong>' . $product->pro_file_down . '</strong>';

                                    } else {
                                        echo 'A link to content hosted on another site';
                                        echo '<br><br>Link URL: <strong>' . $product->pro_file_link . '</strong>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Shipping Amount</label>
                                <div class="col-md-9">
                                    <?php echo $product->pro_shippamt; ?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="wysihtml5">Resource Description</label>
                                <div class="col-md-9">
                                        <textarea id="wysihtml5" class="form-control"
                                                  rows="10" id="Description" aria-readonly="true"
                                                  readonly><?php echo $product->pro_desc; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="text1" class="control-label col-md-2">Shop</label>

                                <div class="col-md-9">
                                    {{ $product->stor_name }}
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="Meta_Description">Scripture</label>

                                <div class="col-md-9">
                                    <textarea class="form-control" id="Meta_Description" readonly
                                              name="Meta_Description"><?php echo $product->pro_scripture; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Resource Image</label>
                                <div class="col-md-9">
                                    <?php
                                    $file_get_path = explode('/**/', $product->pro_Img);

                                    for($i = 0; $i < $product->pro_image_count; $i++){
                                    ?>
                                    <div class="col-sm-3">
                                        <img class="img-responsive"
                                             src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $file_get_path[$i]; ?>">
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <a style="color:#fff" href="<?php echo url('mer_manage_product'); ?>"
                                       class="btn btn-success btn-md btn-grad">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

    <script src="<?php echo url('')?>/public/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

    <script>
        $(document).ready(function () {
            $('#wysihtml5').wysihtml5();
        });
    </script>
@endsection

