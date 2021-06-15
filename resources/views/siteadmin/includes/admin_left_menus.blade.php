<?php $current_route = Route::getCurrentRoute()->getPath();?>

<div id="left">
    <div class="media user-media well-small">
        <!-- <a class="user-link" href="#">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />
        </a> -->

        <div class="media-body">
            <h5 class="media-heading">SETTINGS</h5>
        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <li <?php if( $current_route == "general_setting" ) { ?> class="panel active" <?php } else {
            echo 'class="panel"';
        }?>>
            <a href="<?php echo url('general_setting'); ?>">
                <i class="icon-cog"></i>&nbsp;General</a>
        </li>
        <li <?php if( $current_route == "email_setting" ) { ?> class="panel active" <?php } else {
            echo 'class="panel"';
        }?>>
            <a href="<?php echo url('email_setting'); ?>">
                <i class="icon-envelope"></i>&nbsp;Email & Contact
            </a>
        </li>
    <!--li <?php //if( $current_route == "smtp_setting" ) //{ ?> class="panel active"  <?php //} else { echo 'class="panel"';  }?>>
                    <a href="<?php //echo url('smtp_setting'); ?>" >
                        <i class="icon-mail-reply"></i>&nbsp;SMTP Mailer Settings
                   </a>                   
                </li-->
        <li <?php if( $current_route == "social_media_settings" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="<?php echo url('social_media_settings'); ?>">
                <i class="icon-facebook"></i>&nbsp;Social Media
            </a>
        </li>
        <li <?php if( $current_route == "payment_settings" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="<?php echo url('payment_settings'); ?>">
                <i class="icon-credit-card"></i>&nbsp;Payment
            </a>
        </li>
        <?php /*?> <li  <?php if( $current_route == "module_settings" ) { ?> class="panel active"  <?php } else { echo 'class="panel"';  }?>>
                    <a href="<?php echo url('module_settings'); ?>" >
                        <i class="icon-table"></i>&nbsp;Modules Setting
                   </a>                   
                </li><?php */?>

        <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle"
               data-target="#component_nav">
                <i class="icon-picture"> </i> Image
                <span class="pull-right">
                          <i class="icon-angle-right"></i>
                        </span>
                <!--&nbsp; <span class="label label-default">3</span>&nbsp;-->
            </a>
            <ul <?php if( $current_route == "img_settings" || $current_route == "add_banner_image" || strpos($current_route, "edit_banner") !== false || $current_route == "manage_banner_image") { ?> class="in"
                <?php  } else { ?> class="collapse" <?php } ?> id="component_nav">
                <li <?php if( $current_route == "img_settings" ) { ?> class="active" <?php }?> >
                    <a href="<?php echo url('img_settings'); ?>">
                        <i class="icon-angle-right"></i> Logo, Favicon, No Image
                    </a>
                </li>
                <li <?php if( $current_route == "add_banner_image" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('add_banner_image'); ?>"><i class="icon-angle-right"></i> Add Banner Image
                    </a></li>
                <li <?php if( $current_route == "manage_banner_image" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_banner_image'); ?>"><i class="icon-angle-right"></i> Manage Banner
                        Images </a></li>
            </ul>
        </li>

        <li <?php if( $current_route == "add_country" || $current_route == "manage_country" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?> >


            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#country_nav">
                <i class=" icon-globe"></i> Countries

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
            </a>

            <ul <?php if( $current_route == "add_country" || $current_route == "manage_country" || strpos($current_route, "edit_country") !== false) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="country_nav">

                <li <?php if( $current_route == "add_country" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('add_country'); ?>"><i class="icon-angle-right"></i>Add Country </a></li>
                <li <?php if( $current_route == "manage_country" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_country'); ?>"><i class="icon-angle-right"></i> Manage Country </a>
                </li>
                <!--  <li><a href="#"><i class="icon-angle-right"></i> Demo Link 4 </a></li> -->
            </ul>
        </li>
        <li <?php if( $current_route == "add_state" || $current_route == "manage_state" || strpos($current_route, "edit_state" )!== false ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#state_nav">
                <i class="icon-star"></i> States

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
            </a>
            <ul <?php if( $current_route == "add_state" || $current_route == "manage_state" ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="state_nav">

                <li <?php if( $current_route == "add_state" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a
                            href="<?php echo url('add_state'); ?>"><i class="icon-angle-right"></i>Add State </a></li>
                <li <?php if( $current_route == "manage_state" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_state'); ?>"><i class="icon-angle-right"></i> Manage States </a>
                </li>
                <!--  <li><a href="#"><i class="icon-angle-right"></i> Demo Link 4 </a></li> -->
            </ul>
        </li>
        <li <?php if( $current_route == "add_city" || $current_route == "manage_city" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#city_nav">
                <i class=" icon-building"></i> Cities

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
            </a>
            <ul <?php if( $current_route == "add_city" || $current_route == "manage_city" || strpos($current_route, "edit_city" )!== false) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="city_nav">

                <li <?php if( $current_route == "add_city" ) { ?> class="active" <?php } else { echo 'class=""';  }?>><a
                            href="<?php echo url('add_city'); ?>"><i class="icon-angle-right"></i>Add City </a></li>
                <li <?php if( $current_route == "manage_city" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_city'); ?>"><i class="icon-angle-right"></i> Manage Cities </a></li>
                <!--  <li><a href="#"><i class="icon-angle-right"></i> Demo Link 4 </a></li> -->
            </ul>
        </li>

        <li <?php if( $current_route == "add_tax" || $current_route == "manage_tax" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#tax_nav">
                <i class="icon-money"></i> Taxes
                <span class="pull-right"><i class="icon-angle-right"></i></span>
            </a>
            <ul <?php if( $current_route == "add_tax" || $current_route == "manage_tax" || strpos($current_route, "edit_tax" )!== false) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?>  id="tax_nav">

                <li <?php if( $current_route == "add_tax" ) { ?> class="active" <?php } else { echo 'class=""';  }?>><a
                            href="<?php echo url('add_tax'); ?>"><i class="icon-angle-right"></i>Add Tax </a></li>
                <li <?php if( $current_route == "manage_tax" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_tax'); ?>"><i class="icon-angle-right"></i> Manage Tax </a></li>
            </ul>
        </li>

        <li <?php if( $current_route == "add_category" || $current_route == "manage_category" || strpos($current_route, "edit_category" )!== false ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#category_nav">
                <i class="icon-plus"></i> Category

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>

            </a>
            <ul <?php if( $current_route == "add_category" || $current_route == "manage_category" ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="category_nav">
                <li <?php if( $current_route == "add_category" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('add_category'); ?>"><i class="icon-angle-right"></i> Add Category </a></li>
                <li <?php if( $current_route == "manage_category" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_category'); ?>"><i class="icon-angle-right"></i> Manage Categories
                    </a></li>
            </ul>
        </li>

        <li <?php if( $current_route == "add_affirmation" || $current_route == "manage_affirmation" || strpos($current_route, "edit_affirmation") !== false ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#theme_nav">
                <i class="icon-th-large"></i> Affirmation
                <span class="pull-right"><i class="icon-angle-right"></i></span>
            </a>
            <ul <?php if( $current_route == "add_affirmation" || $current_route == "manage_affirmation" || strpos($current_route, "edit_affirmation") !== false  ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="theme_nav">
                <li <?php if( $current_route == "add_affirmation" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('add_affirmation'); ?>"><i class="icon-apple"></i> Add Affirmation </a></li>
                <li <?php if( $current_route == "manage_affirmation" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_affirmation'); ?>"><i class="icon-th-list"></i> Manage Affirmation
                    </a>
                </li>
            </ul>
        </li>

        <li <?php if( $current_route == "add_cms_page" || $current_route == "manage_cms_page" || $current_route == "aboutus_page" || $current_route == "terms" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#cms_nav">
                <i class="icon-pencil"></i> CMS

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
                &nbsp; <span class="label label-danger"></span>&nbsp;
            </a>
            <ul <?php if( $current_route == "add_cms_page" || $current_route == "manage_cms_page" || $current_route == "aboutus_page" || $current_route == "terms" || $current_route == "privacy" ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?>  id="cms_nav">

                <li <?php if( $current_route == "add_cms_page" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('add_cms_page'); ?>"><i class="icon-angle-right"></i> Add Page</a></li>
                <li <?php if( $current_route == "manage_cms_page" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_cms_page'); ?>"><i class="icon-angle-right"></i> Manage CMS
                        Pages</a></li>
                <li <?php if( $current_route == "aboutus_page" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('aboutus_page'); ?>"><i class="icon-angle-right"></i> About Us</a></li>
                <li <?php if( $current_route == "terms" ) { ?> class="active" <?php } else { echo 'class=""';  }?>><a
                            href="<?php echo url('terms'); ?>"><i class="icon-angle-right"></i> Terms & Conditions</a>
                </li>
                <li <?php if( $current_route == "privacy" ) { ?> class="active" <?php } else { echo 'class=""';  }?>><a
                            href="<?php echo url('privacy'); ?>"><i class="icon-angle-right"></i> Privacy Policy</a>
                </li>
            </ul>
        </li>
        <li <?php if( $current_route == "add_ad" || $current_route == "manage_ad" ||  strpos($current_route, "edit_ad") !== false ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?> >
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#ad_nav">
                <i class="icon-external-link-sign"></i> Ads

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
                &nbsp; <span class="label label-danger"></span>&nbsp;
            </a>
            <ul class="collapse <?php if( $current_route == "add_ad" || $current_route == "manage_ad" ||  strpos($current_route, "edit_ad") !== false ) { ?> in <?php } ?>"
                id="ad_nav">
                <li <?php if( $current_route == "add_ad" ) { ?> class="active" <?php } ?> ><a
                            href="<?php echo url('add_ad'); ?>"><i class="icon-angle-right"></i> Add Ads</a></li>
                <li <?php if( $current_route == "manage_ad" ) { ?> class="active" <?php } ?> ><a
                            href="<?php echo url('manage_ad'); ?>"><i class="icon-angle-right"></i> Manage Ads</a></li>
            </ul>
        </li>
        <li <?php if( $current_route == "add_faq" || $current_route == "manage_faq"  ||  strpos($current_route, "edit_faq") !== false ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?> >
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#faq_nav">
                <i class="icon-question-sign"></i> FAQ

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
                &nbsp; <span class="label label-danger"></span>&nbsp;
            </a>
            <ul <?php if( $current_route == "add_faq" || $current_route == "manage_faq" ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="faq_nav">
                <li <?php if( $current_route == "add_faq" ) { ?> class="active" <?php } else { echo 'class=""';  }?>><a
                            href="<?php echo url('add_faq'); ?>"><i class="icon-angle-right"></i> Add FAQ</a></li>
                <li <?php if( $current_route == "add_manage_faq" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_faq'); ?>"><i class="icon-angle-right"></i> Manage FAQ</a></li>
            </ul>
        </li>
        <li <?php if( $current_route == "add_secq" || $current_route == "manage_secq" ||  strpos($current_route, "edit_secq") !== false ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?> >
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#secq_nav">
                <i class="icon icon-tags"></i> Security Questions

                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
                &nbsp; <span class="label label-danger"></span>&nbsp;
            </a>
            <ul <?php if( $current_route == "add_secq" || $current_route == "manage_secq" ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="secq_nav">
                <li <?php if( $current_route == "add_secq" ) { ?> class="active" <?php } else { echo 'class=""';  }?>><a
                            href="<?php echo url('add_secq'); ?>"><i class="icon-angle-right"></i> Add Security Question</a>
                </li>
                <li <?php if( $current_route == "manage_secq" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('manage_secq'); ?>"><i class="icon-angle-right"></i> Manage Security
                        Questions</a></li>
            </ul>
        </li>
        <li <?php if( $current_route == "manage_newsletter_subscribers" || $current_route == "send_newsletter" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?> >
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#news_nav">
                <i class="icon-signin"></i> News Letter
                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
                &nbsp; <span class="label label-danger"></span>&nbsp;
            </a>
            <ul <?php if( $current_route == "manage_newsletter_subscribers" || $current_route == "send_newsletter" ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="news_nav">
                <li <?php if( $current_route == "send_newsletter" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('send_newsletter'); ?>"><i class="icon-angle-right"></i> Send Newsletter</a>
                </li>
            </ul>
        </li>

        <li <?php if( $current_route == "admin_settings" || $current_route == "admin_profile" ) { ?> class="panel active" <?php } else { echo 'class="panel"';  }?> >
            <a data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#admin_nav">
                <i class="icon-signin"></i> Admin Settings
                <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
                &nbsp; <span class="label label-danger"></span>&nbsp;
            </a>
            <ul <?php if( $current_route == "admin_settings" || $current_route == "admin_profile" ) { ?> class="in"
                <?php } else { echo 'class="collapse"';  }?> id="admin_nav">
                <li <?php if( $current_route == "admin_settings" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('admin_settings'); ?>"><i class="icon-angle-right"></i> Admin Settings</a>
                </li>
                <li <?php if( $current_route == "admin_profile" ) { ?> class="active" <?php } else { echo 'class=""';  }?>>
                    <a href="<?php echo url('admin_profile'); ?>"><i class="icon-angle-right"></i>
                        Admin Profile</a></li>
            </ul>
        </li>

    </ul>
</div>



