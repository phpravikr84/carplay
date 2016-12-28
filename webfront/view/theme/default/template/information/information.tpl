<?php echo $header; ?>
<section id="detail">
	<div class="container blog_detail">
    	<div class="row">
        <div class="col-md-12">
        <div class="pad20">
        <div class="col-md-4">
        <div class="detail_right contact_left">
        	<h4><?php echo $heading_title;?></h4>
            <ul>
            	<li <?php if($information_id == 7){?>class="active"<?php }?> ><a href="<?php echo $href;?>&information_id=7" title="contact us">contact us</a></li>
                <li <?php if($information_id == 4){?>class="active"<?php }?> ><a href="<?php echo $href;?>&information_id=4" title="about us">about us</a></li>
                <li><a href="<?php echo $faq;?>" title="faq">faq</a></li>
                <li <?php if($information_id == 9){?>class="active"<?php }?> ><a href="<?php echo $href;?>&information_id=9" title="press release">press release</a></li>
                <li <?php if($information_id == 8){?>class="active"<?php }?> > <a href="<?php echo $href;?>&information_id=8" title="career">career</a></li>
                <li <?php if($information_id == 5){?>class="active"<?php }?>><a href="<?php echo $href;?>&information_id=5" title="terms and conditions">terms and conditions</a></li>
                <li <?php if($information_id == 3){?>class="active"<?php }?>><a href="<?php echo $href;?>&information_id=3" title="privacy policy">privacy policy</a></li>
            </ul>
        </div>
        <div class="detail_right contact_left mar20">
            <p>customer service</p>
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <h2>need help?</h2>
            <h2>can't reservation restaurant?</h2>
            <h2>got some question?</h2>
            <p class="send_email">please send mail to</p>
            <h5>got some question?</h5>
        </div>
        </div>
        <div class="col-md-8">
            	<div class="detail_left contact_right">
                <div class="full_cont">
                	<div class="detail_left_cont">
                		<h4><?php echo $heading_title;?> </h4>
                </div>
                <?php echo $description;?>
            </div>
            </div>
        	</div>
        </div>
        </div>
    </div>
    </div>
</section>
<?php echo $footer; ?>
