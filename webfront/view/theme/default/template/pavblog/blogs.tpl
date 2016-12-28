<?php  echo $header; ?>
<section id="main_container">
    <div class="container mar_top45">
        <section id="blog" class="blog">
        <div class="row">
            <div class="col-md-12">
                <h1>Blog</h1>
            </div>
            <?php foreach($allBlogs as $blog){   //print_r($blog['title']);exit; ?>
            <div class="col-md-4" style="height:420px; margin-bottom:10px;">
                <div class="blog_col">
                    <img src="<?=$blog['thumb']?>" alt="" title="">
                    <p class="date"><?=$blog['date']?></p>
                    <h3><a href="<?=$blog['link']?>" title="How to discover good spa while travelling abroad"><?=$blog['title']?></a></h3>
                    <p class="desc"><?=$blog['description']?></p>
                    <div class="read_more"><a href="<?=$blog['link']?>" title="read more">read more</a></div>
                </div>
            </div>
            <?php }?> 
             
        </div>
        </section>
    </div>
</section>

 <!-- End Div Container -->
<?php echo $footer; ?>