<?php  echo $header; ?>
<section id="detail">
    <div class="container blog_detail mar_top45">
        <div class="row">
                <div class="col-md-12">
                    <h1>Blog</h1>
                </div>
            <div class="col-md-8">
                <div class="detail_left">
                <div class="full_cont">
                    <div class="detail_left_cont">
                        <h3><?php echo $blog_title;?></h3> 
                        <div style="clear:both"></div>
                        <p class="date1"><?=$blog_date?>   <?=$author?></p>
                </div>
                <div class="flex-container">
                    <img src="<?=$thumb?>" class="lazy img-responsive" alt="" title="" />
                </div>
                <p><?=$description?></p>
            </div>
            </div>
                 <h3>Share with us: </h3>
                <div class="social_col">
                <div id="shareIcons"></div>
                    <!-- <ul>
                        <li><a href="#" title="share on facebook" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>share on facebook</a></li>
                        <li><a href="#" title="share on google plus" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i>share on google plus</a></li>
                        <li><a href="#" title="share on twitter" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i>share on twitter</a></li>
                    </ul> -->
                </div>
                <div class="comment">
                <h3>comments</h3>
                <div class="facebook_comment">
                    <iframe src="http://www.facebook.com/plugins/like.php?href=http://eatigo.com/home/th/en/blog/act/detail/id/149&amp;width&amp;layout=button_count&amp;action=recommend&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=1551875601701798" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
                </div>
                <div class="g-plusone"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 90px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 20px;" tabindex="0" vspace="0" width="100%" id="I0_1465233899976" name="I0_1465233899976" src="https://apis.google.com/u/0/se/0/_/+1/fastbutton?usegapi=1&amp;size=medium&amp;origin=https%3A%2F%2Fwordpress.org&amp;url=https%3A%2F%2Fplus.google.com%2F%2BWordPress&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.en.r7BGQ0tneTo.O%2Fm%3D__features__%2Fam%3DAQ%2Frt%3Dj%2Fd%3D1%2Frs%3DAGLTcCMxjwyvwd0Wy93lpXVQgQwk5Fbhuw#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh%2Conload&amp;id=I0_1465233899976&amp;parent=https%3A%2F%2Fwordpress.org&amp;pfname=&amp;rpctoken=48845239" data-gapiattached="true" title="+1"></iframe></div>
                <div class="twitter_col">
                    <a class="twitter-share-button">
                      <iframe id="twitter-widget-4" scrolling="no" frameborder="0" allowtransparency="true" class="twitter-follow-button twitter-follow-button-rendered" title="Twitter Follow Button" src="https://platform.twitter.com/widgets/follow_button.c5094533286f08172435cb9c1efe2915.en.html#dnt=false&amp;id=twitter-widget-4&amp;lang=en&amp;screen_name=TwitterDev&amp;show_count=true&amp;show_screen_name=false&amp;size=m&amp;time=1465233310438" style="position: static; visibility: visible; width: 150px; height: 20px;" data-screen-name="TwitterDev"></iframe>
                    </a>
                </div>
            </div>
                <div class="fb-comment">
            <iframe id="f14de432ee51e68" name="f987cbaad7fc9" scrolling="no" title="Facebook Social Plugin" class="fb_ltr" src="https://www.facebook.com/plugins/comments.php?api_key=&amp;channel_url=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df26d2b078d6408c%26domain%3Dwww.expertsinseo.info%26origin%3Dhttp%253A%252F%252Fwww.expertsinseo.info%252Ff9cb88b56f9614%26relation%3Dparent.parent&amp;href=http%3A%2F%2Fexpertsinseo.info%2Fblog%2Fultimate-list-of-url-shortner&amp;locale=en_GB&amp;numposts=5&amp;sdk=joey&amp;version=v2.5&amp;width=550" style="border: none; overflow: hidden; height: 221px; width: 550px;"></iframe>
        </div>
            </div>
        <div class="col-md-4">
        <div class="detail_right">
            <h4>Recent post</h4>
            <ul>
                 <?php foreach($allBlogs as $blog){   //print_r($blog['title']);exit; ?>
                        <li><a href="index.php?route=pavblog/blog&blog_id=<?php echo $blog['blog_id']; ?>" title=""><i class="fa fa-stop" aria-hidden="true"></i><?=$blog['title']?></a></li>
                <?php }?>
                 
            </ul>
        </div>
        </div>
    </div>
    </div>
</section>

<?php
$bloglink = HTTP_SERVER."index.php?route=pavblog/blog&blog_id=".$_REQUEST['blog_id'];
?>

<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_IMAGE; ?>socialshare/dist/jssocials.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_IMAGE; ?>socialshare/dist/jssocials-theme-flat.css" />

 
    <script src="<?php echo HTTP_IMAGE; ?>socialshare/dist/jssocials.js"></script>
    <script>
    $(function() {

        var url = "<?php echo $bloglink; ?>";
        var text = "Riwigo Blogs - <?php echo $blog_title;?>";

     

        $("#shareIcons").jsSocials({
            url: url,
            text: text,
            showLabel: false,
            showCount: false,
            shares: ["facebook", "twitter", "linkedin"]
        });

     

        $("#shareStandard").jsSocials({
            showLabel: false,
            showCount: false,

            shares: [{
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.text = "(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.3\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));";
                    $result.append(script);

                    $("<div>").addClass("fb-share-button")
                        .attr({
                            "data-href": "https://developers.facebook.com/docs/plugins/",
                            "data-layout": "button_count"
                        })
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.src = "https://apis.google.com/js/platform.js";
                    $result.append(script);

                    $("<div>").addClass("g-plus")
                        .attr({
                            "data-action": "share",
                            "data-annotation": "bubble"
                        })
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.src = "//platform.linkedin.com/in.js";
                    $result.append(script);

                    $("<script>").attr({ type: "IN/Share", "data-counter": "right" })
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.src = "//assets.pinterest.com/js/pinit.js";
                    $result.append(script);

                    $("<img>").attr("src", "//assets.pinterest.com/images/pidgets/pin_it_button.png")
                        .append($("<a>").attr({
                            "href": "https://www.pinterest.com/pin/create/button/",
                            "data-pin-do": "buttonPin"
                        }))
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.text = "window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,\"script\",\"twitter-wjs\"));";
                    $result.append(script);

                    $("<a>").addClass("twitter-share-button")
                        .text("Tweet")
                        .attr("href", "https://twitter.com/share")
                        .appendTo($result);

                    return $result;
                }
            }]
        });


        var currentTheme = "flat";

        var switchTheme = function() {
            var newTheme = $("#themeSelector").val();
            var $cssLink = $("link[href$='" + currentTheme + ".css']");
            var cssPath = $cssLink.attr("href");
            $cssLink.attr("href", cssPath.replace(currentTheme, newTheme));
            currentTheme = newTheme;
        };

        var switchFontSize = function() {
            var fontSize = parseInt($("#fontSizeSelector").val(), 10);
            $("body").css("fontSize", fontSize);
        };

        $("#themeSelector").on("change", switchTheme);
        $("#fontSizeSelector").on("change", switchFontSize);

    });
</script>
 <!-- End Div Container -->
<?php echo $footer; ?>