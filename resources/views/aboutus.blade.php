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
                    <li><a href="<?php echo url('aboutus');?>">About Us</a></li>
                </ul>
                
                
                <h3 style="text-transform: uppercase;"> <?php echo 'About the Living Lectionary'; ?>  </h3>
               <!--<hr class="soft"/> */ -->
                <div id="legalNotice"><img src="<?php echo url('');?>/public/assets/email/loginemailbanner.jpg" alt="The Living Lectionary" width="60%" align="right" style="padding-left:15px; padding-bottom:10px;" />
                  
                  
                  <h4 style="text-align:left; line-height:25px;"><strong>What is the Living Lectionary?</strong></h4>
                  <p>                    The Living Lectionary (LL) is a theme-based lectionary used by churches, small groups, and individuals for worship and study.  Users follow a common set of twelve 6-week themes that engage some of the most compelling issues of our day over the course of three years (excluding Advent, Lent, and summer).  Users draw on scriptures of their own choosing, or suggested by others, to engage these themes.<br />
                    <br />
                  </p>
                  <h4 style="text-align:left; line-height:25px;"><strong>What are the benefits of the Living Lectionary?</strong></h4>
                  <p>                    By limiting the number themes, not the scriptures themselves, users may draw upon wisdom from the entire body of Scripture rather than a limited, pre-selected set of passages as is the case with other lectionaries.  Users choose the passages that speak most profoundly to their community, or follow scriptural routes suggested by others, through each 6-week theme. </p>
                  <p>                    Because the LL is theme-based, users benefit not only from rich variety of exegetical resources but a multitude of other intellectual and artistic resources that support a particular theme, such as music, artwork, video clips, children's messages, small group resources, and so on.</p>
                  <p>                    Churches following the LL have significant opportunities to engage parishioners not only in worship, but in small group study as well. Given the 6-week thematic structure, each series becomes an invitation to go deeper in a group setting, creating a context that nurtures the growth of congregation's small group ministry.  In this way, people become more intentional about their faith and fellowship, which often results in higher attendance and fuller engagement.</p>
                  <p>                    Resource-sharing among worship and small group leaders is also greatly enhanced over other lectionaries because resources may be contributed and shared that match not only a particular scripture but an overarching theme. <br />
                    <br />
                  </p>
                  <h4 style="text-align:left; line-height:25px;"><strong>What are the Living Lectionary's twelve themes?</strong></h4>
                  <p>                    The Living Lectionary draws its themes from the Phoenix Affirmations – a set of twelve ecumenically-developed affirmations concerning the Three Great Loves identified by Jesus and affirmed within all three Abrahamic faiths: love of God, love of neighbor, and love of self (Matthew 22:34-40//Mark 12:28-31//Luke 10:25-28).   Developed originally in 2005 by Christian clergy, laity, biblical scholars, and theologians across denominational lines, from around the United States, their purpose was to articulate the growing consensus among progressive Christians from a wide variety of backgrounds (mainline Protestant, evangelical, Roman Catholic, etc.) regarding the values of Jesus and how they may be lived robustly in today's world – a consensus that has steadily grown since their original creation.</p>
                  <p>                    The Phoenix Affirmations, which are named both after the city they originated from and an ancient Christian symbol of resurrection, are not a creed or test of faith.  The Affirmations make absolutely no attempt to define who is Christian and who is not.  Neither are the Affirmations meant to stand as a definitive statement for all time.  The original creators attached a version number on the Phoenix Affirmations – Version 3.8 – to indicate that they are the product of continual modification and may be amended in the future in light of new awareness and deeper understanding of God's call.  Permission has been given to anyone to freely reproduce and distribute the Phoenix Affirmations, in whole or in part, provided the wording is not changed from the original below.<br />
                    <br />
                  </p>
                  <h4 style="text-align:center;"><strong>The Phoenix Affirmations (Version 3.8)</strong></h4>
                  <h4 style="text-align:left; line-height:25px;">                    <em>Christian love of God includes:</em></h4>
                  <blockquote style="margin-left:5%; line-height:3;">
                    <p>1.  Walking fully in the path of Jesus, without denying the legitimacy of other paths that God may provide for humanity;</p>
                    <p>2.  Listening for God's Word which comes through daily prayer and meditation, studying the ancient testimonies which we call Scripture, and attending to God's present activity in the world;</p>
                    <p>3.  Celebrating the God whose Spirit pervades and whose glory is reflected in all of God's Creation, including the earth and its ecosystems, the sacred and secular, the Christian and non-Christian, the human and non-human;</p>
                    <p>4.  Expressing our love in worship that is as sincere, vibrant, and artful as it is scriptural.</p>
                    <p>Christian love of neighbor includes:</p>
                    <p>5.  Engaging people authentically, as Jesus did, treating all as creations made in God's very image, regardless of race, gender, sexual orientation, age, physical or mental ability, nationality, or economic class;</p>
                    <p>6.  Standing, as Jesus does, with the outcast and oppressed, the denigrated and afflicted, seeking peace and justice with or without the support of others;</p>
                    <p>7.  Preserving religious freedom and the church's ability to speak prophetically to government by resisting the commingling of church and state;</p>
                    <p>8.  Walking humbly with God, acknowledging our own shortcomings while honestly seeking to understand and call forth the best in others, including those who consider us their enemies;</p>
                    <p>Christian love of self includes:</p>
                    <p>9.  Basing our lives on the faith that in Christ all things are made new and that we, and all people, are loved beyond our wildest imagination – for eternity;</p>
                    <p>10.  Claiming the sacredness of both our minds and our hearts, and recognizing that faith and science, doubt and belief serve the pursuit of truth;</p>
                    <p>11.  Caring for our bodies and insisting on taking time to enjoy the benefits of prayer, reflection, worship, and recreation in addition to work;</p>
                    <p>12.  Acting on the faith that we are born with a meaning and purpose; a vocation and ministry that serve to strengthen and extend God's realm of love.</p>
                  </blockquote>
                  <h4 style="text-align:left; line-height:25px;"><strong>Who may contribute resources to the Living Lectionary?</strong></h4>
                  <p>                    The Living Lectionary is a curated, crowd-source project where anyone can post material to this website under each of the twelve themes.  Material might be sermon videos or manuscripts, music, video clips (including web links), exegetical material, artwork, etc.  Before the material is posted for a particular Affirmation, it is submitted to one of the Affirmation's curators who reviews the material simply to ensure that it fits the Affirmation and does not conflict with the other twelve.  Approval by the curator does not imply any valuation of the quality of the material submitted.  </p>
                  <p>&nbsp;</p>
<br />
                    <br />
                    <br />
                    <br />
<?php /* echo $cms_desc;*/ ?>  
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

