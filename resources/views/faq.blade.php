@extends('includes/page_master')
@section('title', 'FAQ')
@section('css')
@endsection
@section('content')
    <div class="container">
        <br>
        <div style="padding-left:15px; padding-right:15px;">
        <h1 style="margin:0px;">FAQ</h1>
        <hr class="soften"/>
        <br>
        
        <h4>What is the Living Lectionary?</h4>
        
       <p> The Living Lectionary is a theme-based lectionary used by churches, small groups, and individuals for worship and study. Users follow a common set of twelve 6-week themes that engage some of the most compelling issues of our day over the course of three years (excluding Advent, Lent, and summer). Users draw on scriptures of their own choosing, or suggested by others, to engage these themes.</p>
       
       
       <h4>What are the Benefits of the Living Lectionary?</h4>
        
       <p>By limiting the number themes, not the scriptures themselves, users may draw upon wisdom from the entire body of Scripture rather than a limited, pre-selected set of passages as is the case with other lectionaries. Users choose the passages that speak most profoundly to their community, or follow scriptural routes suggested by others, through each 6-week theme.</p>
       
       <h4>How Can I Get Started Sharing My Content?</h4>
        
       <p> To add your content, you must first join the Living Lectionary and become a contributor. Once you are contributor, you can add your unique content and manage it via a custom contributor console. <a href="http://livinglectionary.org/contributors" style="color:#150e42;"><strong>Click here for more information about how to get started.</strong></a></p>
       
       <h4>Can I Get Paid For My Content?</h4>
        
       <p> Contributors to the Living Lectionary can choose to offer their resources for free or at a cost to users. If you choose to charge for your resources, you will set your own price for each resource. You will receive 50% of the price listed on the website, with the other 50% going to support the Living Lectionary and its partners.</p>
       <p>In order to offer resources for sale, you must be the the copyright holder and grant non-exclusive rights to the material to those who purchase it.
         
         The Living Lectionary processes payment through Paypal. If you would like to be paid for your content, you will have the opportunity to add your paypal email address to your account in order to receive payments automatically. If you choose not to add that information during the registration process, you may choose to add you payment information in later via your contributor admin console. <a href="http://livinglectionary.org/contributors" style="color:#150e42;"><strong>Click here for more information about how to get started.</strong></a></p>   
        
        
  <!--     
  <div class="accordion" id="accordion2">
            <?php $i = 1; foreach($faq_result as $faq) { ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <h4><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2"
                           href="#collapse<?php echo $i; ?>">
                            <?php echo $faq->faq_name; ?>
                        </a></h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <?php echo $faq->faq_ans; ?>
                    </div>
                </div>
            </div>
            <?php $i++;} ?>
        </div>
        -->
    </div>
    </div>
@endsection

