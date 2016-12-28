<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="robots" content="All" />
<meta name="viewport" content="width=device-width, user-scalable=no" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<link href="webfront/view/theme/default/stylesheet/style.css" rel="stylesheet" type="text/css">
<link href="webfront/view/theme/default/stylesheet/responsive.css" rel="stylesheet" type="text/css">
<link href="webfront/view/theme/default/stylesheet/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="webfront/view/theme/default/stylesheet/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<!-- Tmd Quick Login-Register-->
<link href="webfront/view/theme/default/stylesheet/quicklogin.css" rel="stylesheet">
<link href="webfront/view/theme/default/stylesheet/quicksignup.css" rel="stylesheet">
<script src="webfront/view/javascript/jquery/colorbox/jquery.colorbox.js" type="text/javascript"></script>
<link href="webfront/view/javascript/jquery/colorbox/quickcolorbox.css" rel="stylesheet" type="text/css" />
<!-- Tmd Quick Login-Register-->

 <link type="text/css" href="webfront/view/theme/default/stylesheet/jquery-gentleSelect.css" rel="stylesheet" />

<script type="text/javascript" src="webfront/view/javascript/js/angular.min.js"></script>
 <script src="webfront/view/javascript/angular/frontendApp.js"></script>

<script type="text/javascript" src="webfront/view/javascript/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="webfront/view/javascript/js/jquery.dropotron.min.js"></script>
<script type="text/javascript" src="webfront/view/javascript/bootstrap/js/bootstrap-select.js"></script>
 
 <link href="webfront/view/javascript/bootstrap/css/bootstrap-select.css" rel="stylesheet" type="text/css">

<!-- Header Jscripts files -->


 <?php 
 if(isset($scripts) && !empty($scripts)) {
 foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php }
} else {
 ?>
 <script src="webfront/view/javascript/js/jquery.multiselect.js" type="text/javascript"></script>
<script src="webfront/view/javascript/js/jquery.flexslider-min.js" type="text/javascript"></script>
<script src="webfront/view/javascript/js/bootstrap-suggest.js" type="text/javascript"></script>
<script src="webfront/view/javascript/js/jquery.flexisel.js" type="text/javascript"></script>
<script src="webfront/view/javascript/js/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
<script src="webfront/view/javascript/js/master.js" type="text/javascript"></script>
<?php } ?>

<!-- Header Jscripts End -->
<script src="webfront/view/javascript/owl-carousel/owl.carousel.js"></script>
<link href="webfront/view/javascript/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="webfront/view/javascript/owl-carousel/owl.theme.css" rel="stylesheet">
<link href="webfront/view/javascript/owl-carousel/owl.transitions.css" rel="stylesheet">

<!--=====================================================================================================================================-->
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>

<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="<?php echo $class; ?>" ng-app="frontendApp" ng-controller="getMerchantListController">

<header>
  <div class="header_inner">
    <nav id="main-nav">
      <ul class="drop">
        <li> <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
          <ul>
            <li><a href="<?php echo $home;?>" title="<?php echo $text_home;?>"><i class="fa fa-home" aria-hidden="true"></i><?php echo $text_home;?></a></li>
            <li><a href="<?php echo $searchmenu;?>" title="<?php echo $text_home;?>"><i class="fa fa-search" aria-hidden="true"></i><?php echo $text_search;?></a></li> 
            <li><a href="<?=$blog?>" title="<?php echo $text_blog;?>"><i class="fa fa-pencil" aria-hidden="true"></i><?php echo $text_blog;?></a></li>
            <li><a href="<?=$howriwigoWorks?>" title="<?php echo $text_how_spa_works;?>"><i class="fa fa-calculator" aria-hidden="true"></i><?php echo $text_how_spa_works;?></a></li>
            
            <li class="none_div"><a href="<?php echo $login;?>" title="<?php echo $text_login;?>"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo $text_login;?></a></li>
            <li class="none_div"><a href="<?php echo $register;?>" title="<?php echo $text_register;?>"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo $text_register;?></a></li>
          </ul>
        </li>
      </ul>
      <div class="logo"><a href="<?php echo $home;?>" alt="home"><img src="image/logo.png"></a></div>
      <!--<?php if($route != 'common/home'){?>
      <div class="input-group">
        <input type="text" class="form-control" id="test_data" placeholder="search for : enter spa name" autocomplete="off">
        <div class="input-group-btn">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle=""> <i class="fa fa-search" aria-hidden="true"></i> </button>
          <ul class="dropdown-menu dropdown-menu-right" role="menu" style="padding-top: 0px; max-height: 375px; max-width: 800px; overflow: auto; width: auto; transition: 0.3s;">
          </ul>
        </div>
      </div>
     <?php }?>-->
      <div class="right_nav">
        <ul>
          <?php if ($logged) { ?>
          <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
           
          <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
          <?php } else { ?>
          <!--<li><a href="<?php echo $login;?>" <?php if($route == 'account/login'){?> class="bg_color" <?php } ?> title="<?php echo $text_login;?>"><?php echo $text_login;?></a></li>
          <li><a href="<?php echo $register;?>" <?php if($route == 'account/register'){?> class="bg_color" <?php } ?> title="<?php echo $text_register;?>"><?php echo $text_register;?></a></li>
          
           <li  > <a href="" data-toggle="modal" data-target="#quickloginModal"><?php echo $text_register; ?></a> </li>
            <li  > <a href="" data-toggle="modal" data-target="#quickloginModal"><?php echo $text_login; ?></a> </li>-->
            
            <li  > <a href="javascript:void(0)" id="registerModal"  ><?php echo $text_register; ?></a> </li>
            <li  > <a href="javascript:void(0)" id="loginModal" ><?php echo $text_login; ?></a> </li>
            
          <?php } ?>
          <?php echo $city?>
          <?php echo $language?>
           <?php echo $currency?>
        </ul>
      </div>
    </nav>
  </div>
</header>
<!--Tmd Quick Login-Register-->
<div class="modal fade" id="quickloginModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content col-sm-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> <?php echo $quicklogin; ?> </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="quickSignupModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content col-sm-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> <?php echo $quicksignup; ?> </div>
    </div>
  </div>
</div>

 <!-- Merchant SPA Modal -->
<div class="modal fade spamenuModal" id="myspaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Spa Menu</h4>
      </div>
      <div class="modal-body" id="spaservicebody">
        ...
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

 
<script type="text/javascript">
$('#registerModal').on('click', function(){ 

  $('#quickSignupModal').modal('show');
  $('#quickloginModal').modal('hide');  
  $("#loginfront").hide();
   $("#login").hide();
   $("#forgottenfront").hide();
    $('#registrationfront').show();
  $('#registration').show();
  setTimeout(function() {   //calls click event after a certain time
     $('.regclick').trigger('click');
  }, 100);

});

$('#loginModal').on('click', function(){ 

  $('#quickloginModal').modal('show'); 
  $('#quickSignupModal').modal('hide');
  $('#registrationfront').hide();
  $("#forgottenfront").hide();
  $('#registration').hide();
   $("#loginfront").show();
   $("#login").show();
    setTimeout(function() {   //calls click event after a certain time
      $('.click').trigger('click');
  }, 100);
});


</script>
<!--Tmd Quick Login-Register--> 


  <!-- Trigger the modal with a button -->