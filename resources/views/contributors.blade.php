@extends('includes/page_master')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <?php if ($cms_result) {
                foreach ($cms_result as $cms) {
                }
                $cms_desc = stripslashes($cms->ap_description);
            } else {
                $cms_desc = 'Yet To be Filled';
            } ?>
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('index');?>">Home</a></li>
                    <li><a href="<?php echo url('aboutus');?>">Contributors</a></li>
                </ul>


                <h3 style="text-transform: uppercase;"> <?php echo 'Contribute to the Living Lectionary'; ?>  </h3>
                <!--<hr class="soft"/> */ -->
                <div id="legalNotice">

                    <div style="float:left; padding-bottom:10px;padding-right:10px; width:30%; text-align:center;">
                        <a href="{{url('public/assets/docs/Living-Lectionary-Contributor-Packet.pdf')}} "
                           target="_blank"><img src="{{url('public/assets/images/contributor-packet.png')}}"
                                                alt="The Living Lectionary" align="center"
                                                style="padding-bottom:10px;"/></a><br/><a
                                href="{{url('public/assets/docs/Living-Lectionary-Contributor-Packet.pdf')}}"
                                target="_blank">Click to download the Contributor Packet</a>
                    </div>


                    <h4 style="text-align:left; line-height:25px;"><strong>Inspiring Voices. Groundbreaking Content.
                            Carefully Curated Resources.
                        </strong></h4>
                    <p>The San Francisco Theological Seminary Center for Innovation in Ministry and the Convergence
                        Network are calling all pastors, writers, artists, musicians, scholars and lay leaders to
                        participate in an exciting new project called the Living Lectionary.</p>
                    <p>The Living Lectionary is a new crowd-sourced, online, theme-based resource for pastors,
                        congregations and individuals. You can help shape this thoughtful and ever-evolving tool by
                        contributing resources you've created. Submit sermons, curriculum, music, articles, artwork and
                        more!<br/>
                        <br/>
                    </p>
                    <h4 style="text-align:left; line-height:25px;"><strong>Why Contribute?</strong></h4>

                    <p> Because the Living Lectionary is theme-based, users benefit not only from rich variety of
                        exegetical resources but a multitude of other intellectual and artistic resources that support a
                        particular theme, such as music, artwork, video clips, children's messages, small group
                        resources, and so on.</p>
                    <p> Churches following the LL have significant opportunities to engage parishioners not only in
                        worship, but in small group study as well. Given the 6-week thematic structure, each series
                        becomes an invitation to go deeper in a group setting, creating a context that nurtures the
                        growth of congregation's small group ministry. In this way, people become more intentional about
                        their faith and fellowship, which often results in higher attendance and fuller engagement.<br/>
                        <br/>
                    </p>
                    <h4 style="text-align:left; line-height:25px;"><strong>Get Paid for Your Content</strong></h4>
                    <p>As a Contributor to the Living Lectionary, you can choose to offer your resources for free or at
                        a cost to users. If you choose to charge for the resource, you will set your own price for each
                        resource. You will receive 50% of the price listed on the website, with the other 50% going to
                        support the Living Lectionary and its partners. </p>
                    <p>In order to offer resources for sale, you must be the the copyright holder and grant
                        non-exclusive rights to the material to those who purchase it.</p>
                    <p>The Living Lectionary processes payment through Paypal. If you would like to be paid for your
                        content, you will have the opportunity to add your paypal email address to your account in order
                        to receive payments automatically. If you choose not to add that information during the
                        registration process, you may choose to add you payment information in later via your
                        contributor admin console.<br/>
                        <br/>
                    </p>


                    <blockquote>


                        <h4 style="text-align:left; line-height:25px;"><strong>How to Get Started</strong><br/>
                            <br/>
                        </h4>

                        <h4 style="text-align:left; line-height:25px;">1. Create a Member Account</h4>
                        <p>Go to <a href="http://livinglectionary.org/Join">livinglectionary.org/Join</a> to create your
                            member account. After you have completed your registration, you be prompted to the next step
                            to become a contributor.
                        </p>
                        <p style="margin-top:20px;">
                            <span style="font-size:18px; line-height:22px; padding-left:25px; margin-top:20px;">
                                <strong>Watch a short demonstration about how to join the Living Lectionary:</strong>
                            </span>
                        </p>

                        <div style="position: relative; padding-top: 25px; padding-bottom: 15px; overflow: hidden !important; text-align: center;">

                            <iframe width="50%" height="350px" src="https://www.youtube.com/embed/qShBwJysusg"
                                    frameborder="0" allowfullscreen="allowfullscreen"></iframe>

                        </div>


                        <h4 style="text-align:left; line-height:25px;">2. Sign Up to Become a Contributor</h4>
                        <p>Once you are logged in as a member, click on &quot;Contribute&quot; or go to <a
                                    href="http://livinglectionary.org/Become_A_Contributor">click here to create your
                                contributor account</a>. During this step you can decide whether you want your content
                            to be available for sale or if you want to list it for free, and also enter your payment
                            information. </p>

                        <p style="margin-top:20px;">
                            <span style="font-size:18px; line-height:22px; padding-left:25px; margin-top:20px;">
                                <strong>Watch a short demonstration about how to become a contributor:</strong>
                            </span>
                        </p>

                        <div style="position: relative; padding-top: 25px; padding-bottom: 15px; overflow: hidden !important; text-align: center;">

                            <iframe width="50%" height="350px" src="https://www.youtube.com/embed/uCuloBl7gKQ"
                                    frameborder="0" allowfullscreen></iframe>

                        </div>


                        <h4 style="text-align:left; line-height:25px;">3. Add Your Content</h4>
                        <p>To begin adding content to the Living Lectionary, click the link to login to your new
                            contributor account from your account confirmation email. Once you are logged in as a
                            contributor, click &ldquo;Add a
                            Resource&rdquo; in your account console or go to <a
                                    href="{{url('add_my_resource')}}" target="_blank">the Add My
                                Content
                                page</a> to start adding your original content. Once your content is added, it will be
                            submitted to our curators for review.</p>

                        <p style="margin-top:20px;">
                            <span style="font-size:18px; line-height:22px; padding-left:25px; margin-top:20px;">
                                <strong>Watch a short demonstration about to add content:</strong>
                            </span>
                        </p>

                        <div style="position: relative; padding-top: 25px; padding-bottom: 15px; overflow: hidden !important; text-align: center;">
                            <iframe width="50%" height="350px" src="https://www.youtube.com/embed/xDa5dIm7JE4"
                                    frameborder="0" allowfullscreen></iframe>
                        </div>

                        <h4 style="text-align:left; line-height:25px;">4. Share </h4>
                        <p>The world is calling out for pastoral leaders to speak to these and other critical issues. We
                            need your voice Will you share it? </p>
                        <p>Let people know about your content and the Living Lectionary by posting a link or sharing a
                            meme on social media. Please consider adding #livinglectionary to your posts so we can see
                            them and share, them, too!</p>

                    </blockquote>


                    <h4 align="center"><strong> Below are some images for you to download and share. Right-click on each
                            image to save or download, and help us spread the word!</strong></h4>

                    <table width="auto" border="0" cellpadding="5" align="center">
                        <tr>
                            <td><img src="{{url('public/assets/images/memes/voices1.jpg')}}" width="300"
                                     alt="Inspiring Voices | The Living Lectionary"/></td>
                            <td><img src="{{url('public/assets/images/memes/resourcing.jpg')}}" width="300"
                                     alt="The Living Lectionary | Resourcing a More Just &amp; Generous World"/></td>
                        </tr>
                        <tr>
                            <td><img src="{{url('public/assets/images/memes/tools-for-leaders.jpg')}}"
                                     width="300" alt="Tools for Leaders | The Living Lectionary"/></td>
                            <td><img src="{{url('public/assets/images/memes/this-little-light.jpg')}}"
                                     width="300" alt="This Little Light of Mine | The Living Lectionary"/></td>
                        </tr>
                    </table>

                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <?php /* echo $cms_desc;*/ ?>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

