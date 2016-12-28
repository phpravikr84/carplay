<ul id="menu">
  <li id="dashboard"><a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i> <span><?php echo $text_dashboard; ?></span></a></li>
  <?php if($user_menu){?>
      <li id="user"><a class="parent"><i class="fa fa-users fa-fw"></i> <span><?php echo $text_users; ?></span></a>
        <ul>
          <?php if(($user != '')) {?>
          <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
          <?php } ?>
          <?php if(($user_group != '')) {?>
          <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
          <?php } ?>
          <?php if(($api != '')) {?>
          <li><a href="<?php echo $api; ?>"><?php echo $text_api; ?></a></li>
          <?php } ?>
        </ul>
      </li>
  <?php } ?>
  <?php if($catalog_menu){?>
      <li id="catalog"><a class="parent"><i class="fa fa-tags fa-fw"></i> <span><?php echo $text_catalog; ?></span></a>
        <ul>
          <?php if(($category != '')) {?>
          <li><a href="<?php echo $category;?>"><?php echo $text_category; ?></a></li>
          <?php } ?>
          <?php if(($mcategory != '')) {?>
          <li><a href="<?php echo $mcategory;?>">Merchant Category</a></li>
          <?php } ?>
          <?php if(($merchant != '')) {?>
          <li><a href="<?php echo $merchant;?>"><?php echo $text_spasalon; ?></a></li>
          <?php } ?>
           <?php if(($merchant_transacation != '')) {?>
          <li><a href="<?php echo $merchant_transacation;?>">Transacation</a></li>
          <?php } ?>
          <?php if(($product != '')) {?>
          <li><a href="<?php echo $product;?>"><?php echo $text_product; ?></a></li>
          <?php } ?>
          <?php if(($featured_product != '')) {?>
          <li><a href="<?php echo $featured_product;?>"><?php echo $text_featured_product; ?></a></li>
          <?php } ?>
          <?php if(($featured_merchant != '')) {?>
          <li><a href="<?php echo $featured_merchant;?>"><?php echo $text_featured_merchant; ?></a></li>
          <?php } ?>
          <?php if(($offer != '')) {?>
          <li><a href="<?php echo $offer;?>"><?php echo $text_offer; ?></a></li>
          <?php } ?>
          <?php if(($information != '')) {?>
          <li><a href="<?php echo $information;?>"><?php echo $text_information; ?></a></li>
          <?php } ?>
          <?php if(($faq != '')) {?>
          <li><a href="<?php echo $faq;?>"><?php echo $text_faq; ?></a></li>
          <?php } ?>
          <?php if(($atmosphere != '')) {?>
          <li><a href="<?php echo $atmosphere;?>"><?php echo $text_atmosphere; ?></a></li>
          <?php } ?>
          <?php if(($facilities != '')) {?>
          <li><a href="<?php echo $facilities;?>"><?php echo $text_facilities; ?></a></li>
          <?php } ?>
          <?php if(($spoken_languages != '')) {?>
          <li><a href="<?php echo $spoken_languages;?>"><?php echo $text_spoken_languages; ?></a></li>
          <?php } ?>
        </ul>
      </li>
  <?php }?>
   <?php if($merchant_profile){?>
      <li id="blog"><a href="<?=$merchant_profile?>" ><i class="fa fa-user fa-fw"></i> <span><?php echo $text_merchant_profile; ?></span></a></li>
  <?php }?>
  
  <?php if($ticketing){?>
      <li id="blog"><a href="<?=$ticketing?>" ><i class="fa fa-envelope fa-fw"></i> <span><?php echo $text_ticketing; ?></span></a></li>
  <?php }?>
  
  <?php if($user_blog){?>
      <li id="blog"><a href="<?=$blog?>" ><i class="fa fa-book fa-fw"></i> <span><?php echo $text_blog; ?></span></a></li>
  <?php }?>
  <?php if($customer_menu){?>
      <li id="customer"><a class="parent"><i class="fa fa-user fa-fw"></i> <span><?php echo $text_customer; ?></span></a>
        <ul>
          <?php if(($customer != '')) {?>
          <li><a href="<?php echo $customer; ?>"><?php echo $text_customer; ?></a></li>
          <?php } ?>
          <?php if(($customer_group != '')) {?>
          <li><a href="<?php echo $customer_group; ?>"><?php echo $text_customer_group; ?></a></li>
          <?php } ?>
        </ul>
      </li>
  <?php }?>
  
  <?php if($marketing_menu){?>
      <li><a class="parent"><i class="fa fa-share-alt fa-fw"></i> <span><?php echo $text_marketing; ?></span></a>
        <ul>
          <?php if(($coupon != '')) {?>
          <li><a href="<?php echo $coupon; ?>"><?php echo $text_coupon; ?></a></li>
          <?php } ?>
          <?php if(($voucher != '')) {?>
          <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
          <?php } ?>
          <?php if(($voucher_theme != '')) {?>
          <li><a href="<?php echo $voucher_theme; ?>"><?php echo $text_voucher_theme; ?></a></li>
          <?php } ?>
          <?php if(($contact != '')) {?>
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <?php } ?>
          <?php if(($requestmerchants != '')) {?>
          <li><a href="<?php echo $requestmerchants; ?>"><?php echo $text_requestmerchants; ?></a></li>
          <?php } ?>
          <?php if(($blog != '')) {?>
          <li><a href="<?php echo $blog; ?>"><?php echo $text_blog; ?></a></li>
          <?php } ?>
          <?php if(($banner != '')) {?>
          <li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
          <?php } ?>
          <!--<li><a href="#<?php //echo $marketing; ?>"><?php echo $text_marketing; ?></a></li>
          <li><a href="#<?php //echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li> -->
         </ul>
      </li>
  <?php }?>
  
  <?php if($reservation_menu){?>
  <li id="sale"><a class="parent"><i class="fa fa-shopping-cart fa-fw"></i> <span><?php echo $text_sale; ?></span></a>
    <ul>
      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
    </ul>
  </li>
 <?php }?>
 
 <?php if($system_menu){?>
      <li id="system"><a class="parent"><i class="fa fa-cog fa-fw"></i> <span><?php echo $text_system; ?></span></a>
        <ul>
            <?php if(($setting != '')) {?>
              <li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
            <?php }?>
            
            <?php if(($language != '')) {?>
              <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
            <?php }?>
            
            <?php if(($currency != '')) {?>
              <li><a href="<?php echo $currency; ?>"><?php echo $text_currency; ?></a></li>
            <?php }?>
            
            <?php if(($order_status != '')) {?>
              <li><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
            <?php }?>
          
            <?php if(($country != '')) {?>
              <li><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
            <?php }?>
            
            <?php if(($zone != '')) {?>
              <li><a href="<?php echo $zone; ?>"><?php echo $text_zone; ?></a></li>
            <?php }?>
          
            <?php if(($city != '')) {?>
              <li><a href="<?php echo $city; ?>"><?php echo $text_city; ?></a></li>
            <?php }?>
    
            <?php if(($locationcity != '')) {?>
              <li><a href="<?php echo $locationcity; ?>"><?php echo $text_location; ?></a></li>
            <?php }?>
          
            <?php if(($geo_zone != '')) {?>
              <li><a href="<?php echo $geo_zone; ?>"><?php echo $text_geo_zone; ?></a></li>
            <?php }?>
          
            <?php if(($tax_class != '')) {?>
              <li><a href="<?php echo $tax_class; ?>"><?php echo $text_geo_zone; ?></a></li>
            <?php }?>
            
            <?php if(($tax_rate != '')) {?>
              <li><a href="<?php echo $tax_rate; ?>"><?php echo $text_tax_rate; ?></a></li>
            <?php }?>
          
        </ul>
      </li>
 <?php } ?>
  <li id="reports"><a class="parent"><i class="fa fa-bar-chart-o fa-fw"></i> <span><?php echo $text_reports; ?></span></a> 
  		<ul>
            <?php //if(($setting != '')) {?>
              <li><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
            <?php //}?>
            
            <?php //if(($setting != '')) {?>
              <li><a href="<?php echo $report_customer_order; ?>"><?php echo $text_report_customer_order; ?></a></li>
            <?php //}?>
       </ul>
  </li>
</ul>
