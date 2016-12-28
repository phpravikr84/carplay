<?php echo $header; ?>

<div class="container ">
  <div class="row">
    <?php $class = 'col-sm-12'; ?>
    <div id="content" class="<?php echo $class; ?> mar_top65">
      <h2>Confirm Booking</h2>
      <div class="checkout-area">
        <form action="">
        <div class="row">
        <div class="col-md-12">
        <div class="checkout-left">
          <div class="panel-group" id="accordion"> 
            <!--- Coupon section -->
            <div class="panel panel-default aa-checkout-coupon">
              <div class="panel-heading"> <span class="bkStepNum marginR10 fl">1.</span>
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">Review your booking
                  <?=$invoice_prefix;?>
                  </a> </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-5 col-xs-12 marginB10"> <img src="<?=$image?>" style="width:100%; float:left; max-height:150px;" pagespeed_url_hash="685397763" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> </div>
                  <div class="col-md-8 col-sm-7 col-xs-12">
                    <div class="width100 fl">
                      <h1 class="ico18 fl marginR20">
                        <?=$bookingMerchantName?>
                      </h1>
                      <div class="fl padT2"> </div>
                    </div>
                    <address class="padT5 fl width100 lh1-5">
                    <i class="icon-location ico15 blueLt padR5"></i><span class="ico14 greyLt">
                    <?=$address?>
                    </span>
                    </address>
                    <p class="ico16 fl padT15 width100 lh1-5"><span id="htl_room_type">
                      <?=$bookingServices?>
                      </span><i class="icon-no-smoking ico16 grey"></i></p>
                    <p id="htl-inclusions" class="ico13 fl width100 lh1-5 grey padT2"><span class="greyDr">Your stay includes: </span>
                    <div id="roomAmenties" class="db">
                      <ul>
                        <li><i class="fa fa-check"></i>Wifi</li>
                        <li><i class="fa fa-check"></i>Parking</li>
                      </ul>
                    </div>
                    </p>
                  </div>
                </div>
                <div class="bkChkDetails marginTB10">
                  <div class="bkChkDetailsIn">
                    <div class="col-md-12 col-sm-12 col-xs-12 padB10">
                      <div class="col-md-5 col-sm-3 col-xs-5 pad0"> <span class="ico14 greyLt lh1-5 db">Check-In</span> <span class="ico14 lh1-5 db">
                        <?=$checkinDate?>
                        </span> <span id="checkin-time" class="ico14 lh1-5 db">
                        <?=$bookingDiscountTime?>
                        </span> </div>
                      <div class="col-md-3 col-sm-6 col-xs-3 pad0"> <span class="ico14 greyLt lh1-5 db">Duration</span> <span class="ico14 lh1-5 db">
                        <?=$bookingDuration?>
                        min</span> </div>
                          <div class="col-md-2 col-sm-6 col-xs-2 pad0"> <span class="ico14 greyLt lh1-5 db">Service Rate</span> <span class="ico14 lh1-5 db">
                        <?=$servicerate?></span> </div>
                          <div class="col-md-2 col-sm-6 col-xs-2 padB10"> <span class="ico14 greyLt lh1-5 db" style="text-align:center;">Person</span> <span class="ico14 lh1-5 db" style="text-align:center;">
                      <?=$bookingPerson?>
                      </span> </div>
                    </div>
                    <!-- <div class="col-md-3 col-sm-3 col-xs-12 padB10"> <span class="ico14 lh1-5 db">Person</span> <span class="ico14 lh1-5 db">
                      <?=$bookingPerson?>
                      </span> </div> -->
                    <!-- <div class="col-md-4 col-sm-4 col-xs-12 padB10"> <span id="freecancel-message" class="ico14 greyLt lh1-5 db dn"></span> <a href="javascript:void(0)" class="ico14 lh1-5" id="cancelPolicyLinkV3">Booking &amp; Cancellation Policy</a> </div> -->
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 padT10 fare-promo-row">
                  <div class="col-md-12 col-sm-12 col-xs-12 padT10 booking-fare-info">
                    <div class="" id="tot_bk_fare_box">
                      <div class="summary-content mob-accordion-content"> <span class="left">Grand Total :</span> <span class="right"> <span class="standard-price">
                        <?=$currency_symbal.$bookingSubTotal?>
                        </span> </span> <span class="left">Disocunt                           (
                        <?=$bookingDiscount?>
                        ):</span> <span class="right green-txt">
                        <?=$currency_symbal.$bookingDiscountAmount?>
                        </span>
                        <div class="total"> <span class="left">Net Amount :</span> <span class="right"> <span class="rupee">
                          <?=$currency_symbal.$bookingPrice?>
                          </span> </span> </div>
                      </div>
                    </div>
                  </div>
                  <div style="float:left; padding:10px 0 0 10px;"><span id="freecancel-message" class="ico14 greyLt lh1-5 db dn"></span> <a href="index.php?route=information/information&information_id=11" class="ico14 lh1-5" id="cancelPolicyLinkV3">Booking &amp; Cancellation Policy</a></div>
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="contin" aria-expanded="false">Continue </a> </div>
              </div>
            </div>
            <!-- Login section --> 
            
            <!-- Billing Details -->
            <div class="panel panel-default aa-checkout-billaddress">
              <div class="panel-heading"> <span class="bkStepNum marginR10 fl">2.</span>
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="" aria-expanded="false"> Guest Details </a> </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" aria-expanded="true">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="aa-checkout-single-bill">
                        <input type="text" placeholder="Name*" value="<?=$customerName?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="aa-checkout-single-bill">
                        <input type="email" placeholder="Email Address*" value="<?=$customerEmail?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="aa-checkout-single-bill">
                        <p>Your voucher will be sent to this email address</p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="aa-checkout-single-bill">
                        <select class="form-control inputMedium" id="country_code_dropdown" name="ccd">
                          <option value="+93">Afghanistan ( +93 )</option>
                          <option value="+358">Aland Islands ( +358 )</option>
                          <option value="+355">Albania ( +355 )</option>
                          <option value="+213">Algeria ( +213 )</option>
                          <option value="+1684">AmericanSamoa ( +1684 )</option>
                          <option value="+376">Andorra ( +376 )</option>
                          <option value="+244">Angola ( +244 )</option>
                          <option value="+1264">Anguilla ( +1264 )</option>
                          <option value="+672">Antarctica ( +672 )</option>
                          <option value="+1268">Antigua and Barbuda ( +1268 )</option>
                          <option value="+54">Argentina ( +54 )</option>
                          <option value="+374">Armenia ( +374 )</option>
                          <option value="+297">Aruba ( +297 )</option>
                          <option value="+61">Australia ( +61 )</option>
                          <option value="+43">Austria ( +43 )</option>
                          <option value="+994">Azerbaijan ( +994 )</option>
                          <option value="+1242">Bahamas ( +1242 )</option>
                          <option value="+973">Bahrain ( +973 )</option>
                          <option value="+880">Bangladesh ( +880 )</option>
                          <option value="+1246">Barbados ( +1246 )</option>
                          <option value="+375">Belarus ( +375 )</option>
                          <option value="+32">Belgium ( +32 )</option>
                          <option value="+501">Belize ( +501 )</option>
                          <option value="+229">Benin ( +229 )</option>
                          <option value="+1441">Bermuda ( +1441 )</option>
                          <option value="+975">Bhutan ( +975 )</option>
                          <option value="+591">Bolivia, Plurinational State of ( +591 )</option>
                          <option value="+387">Bosnia and Herzegovina ( +387 )</option>
                          <option value="+267">Botswana ( +267 )</option>
                          <option value="+55">Brazil ( +55 )</option>
                          <option value="+246">British Indian Ocean Territory ( +246 )</option>
                          <option value="+673">Brunei Darussalam ( +673 )</option>
                          <option value="+359">Bulgaria ( +359 )</option>
                          <option value="+226">Burkina Faso ( +226 )</option>
                          <option value="+257">Burundi ( +257 )</option>
                          <option value="+855">Cambodia ( +855 )</option>
                          <option value="+237">Cameroon ( +237 )</option>
                          <option value="+1">Canada ( +1 )</option>
                          <option value="+238">Cape Verde ( +238 )</option>
                          <option value="+345">Cayman Islands ( +345 )</option>
                          <option value="+236">Central African Republic ( +236 )</option>
                          <option value="+235">Chad ( +235 )</option>
                          <option value="+56">Chile ( +56 )</option>
                          <option value="+86">China ( +86 )</option>
                          <option value="+61">Christmas Island ( +61 )</option>
                          <option value="+61">Cocos (Keeling) Islands ( +61 )</option>
                          <option value="+57">Colombia ( +57 )</option>
                          <option value="+269">Comoros ( +269 )</option>
                          <option value="+242">Congo ( +242 )</option>
                          <option value="+243">Congo, The Democratic Republic of the Congo ( +243 )</option>
                          <option value="+682">Cook Islands ( +682 )</option>
                          <option value="+506">Costa Rica ( +506 )</option>
                          <option value="+225">Cote d'Ivoire ( +225 )</option>
                          <option value="+385">Croatia ( +385 )</option>
                          <option value="+53">Cuba ( +53 )</option>
                          <option value="+357">Cyprus ( +357 )</option>
                          <option value="+420">Czech Republic ( +420 )</option>
                          <option value="+45">Denmark ( +45 )</option>
                          <option value="+253">Djibouti ( +253 )</option>
                          <option value="+1767">Dominica ( +1767 )</option>
                          <option value="+1849">Dominican Republic ( +1849 )</option>
                          <option value="+593">Ecuador ( +593 )</option>
                          <option value="+20">Egypt ( +20 )</option>
                          <option value="+503">El Salvador ( +503 )</option>
                          <option value="+240">Equatorial Guinea ( +240 )</option>
                          <option value="+291">Eritrea ( +291 )</option>
                          <option value="+372">Estonia ( +372 )</option>
                          <option value="+251">Ethiopia ( +251 )</option>
                          <option value="+500">Falkland Islands (Malvinas) ( +500 )</option>
                          <option value="+298">Faroe Islands ( +298 )</option>
                          <option value="+679">Fiji ( +679 )</option>
                          <option value="+358">Finland ( +358 )</option>
                          <option value="+33">France ( +33 )</option>
                          <option value="+594">French Guiana ( +594 )</option>
                          <option value="+689">French Polynesia ( +689 )</option>
                          <option value="+241">Gabon ( +241 )</option>
                          <option value="+220">Gambia ( +220 )</option>
                          <option value="+995">Georgia ( +995 )</option>
                          <option value="+49">Germany ( +49 )</option>
                          <option value="+233">Ghana ( +233 )</option>
                          <option value="+350">Gibraltar ( +350 )</option>
                          <option value="+30">Greece ( +30 )</option>
                          <option value="+299">Greenland ( +299 )</option>
                          <option value="+1473">Grenada ( +1473 )</option>
                          <option value="+590">Guadeloupe ( +590 )</option>
                          <option value="+1671">Guam ( +1671 )</option>
                          <option value="+502">Guatemala ( +502 )</option>
                          <option value="+44">Guernsey ( +44 )</option>
                          <option value="+224">Guinea ( +224 )</option>
                          <option value="+245">Guinea-Bissau ( +245 )</option>
                          <option value="+595">Guyana ( +595 )</option>
                          <option value="+509">Haiti ( +509 )</option>
                          <option value="+379">Holy See (Vatican City State) ( +379 )</option>
                          <option value="+504">Honduras ( +504 )</option>
                          <option value="+852">Hong Kong ( +852 )</option>
                          <option value="+36">Hungary ( +36 )</option>
                          <option value="+354">Iceland ( +354 )</option>
                          <option value="+91" selected="">India ( +91 )</option>
                          <option value="+62">Indonesia ( +62 )</option>
                          <option value="+98">Iran, Islamic Republic of Persian Gulf ( +98 )</option>
                          <option value="+964">Iraq ( +964 )</option>
                          <option value="+353">Ireland ( +353 )</option>
                          <option value="+44">Isle of Man ( +44 )</option>
                          <option value="+972">Israel ( +972 )</option>
                          <option value="+39">Italy ( +39 )</option>
                          <option value="+1876">Jamaica ( +1876 )</option>
                          <option value="+81">Japan ( +81 )</option>
                          <option value="+44">Jersey ( +44 )</option>
                          <option value="+962">Jordan ( +962 )</option>
                          <option value="+77">Kazakhstan ( +77 )</option>
                          <option value="+254">Kenya ( +254 )</option>
                          <option value="+686">Kiribati ( +686 )</option>
                          <option value="+850">Korea, Democratic People's Republic of Korea ( +850 )</option>
                          <option value="+82">Korea, Republic of South Korea ( +82 )</option>
                          <option value="+965">Kuwait ( +965 )</option>
                          <option value="+996">Kyrgyzstan ( +996 )</option>
                          <option value="+856">Laos ( +856 )</option>
                          <option value="+371">Latvia ( +371 )</option>
                          <option value="+961">Lebanon ( +961 )</option>
                          <option value="+266">Lesotho ( +266 )</option>
                          <option value="+231">Liberia ( +231 )</option>
                          <option value="+218">Libyan Arab Jamahiriya ( +218 )</option>
                          <option value="+423">Liechtenstein ( +423 )</option>
                          <option value="+370">Lithuania ( +370 )</option>
                          <option value="+352">Luxembourg ( +352 )</option>
                          <option value="+853">Macao ( +853 )</option>
                          <option value="+389">Macedonia ( +389 )</option>
                          <option value="+261">Madagascar ( +261 )</option>
                          <option value="+265">Malawi ( +265 )</option>
                          <option value="+60">Malaysia ( +60 )</option>
                          <option value="+960">Maldives ( +960 )</option>
                          <option value="+223">Mali ( +223 )</option>
                          <option value="+356">Malta ( +356 )</option>
                          <option value="+692">Marshall Islands ( +692 )</option>
                          <option value="+596">Martinique ( +596 )</option>
                          <option value="+222">Mauritania ( +222 )</option>
                          <option value="+230">Mauritius ( +230 )</option>
                          <option value="+262">Mayotte ( +262 )</option>
                          <option value="+52">Mexico ( +52 )</option>
                          <option value="+691">Micronesia, Federated States of Micronesia ( +691 )</option>
                          <option value="+373">Moldova ( +373 )</option>
                          <option value="+377">Monaco ( +377 )</option>
                          <option value="+976">Mongolia ( +976 )</option>
                          <option value="+382">Montenegro ( +382 )</option>
                          <option value="+1664">Montserrat ( +1664 )</option>
                          <option value="+212">Morocco ( +212 )</option>
                          <option value="+258">Mozambique ( +258 )</option>
                          <option value="+95">Myanmar ( +95 )</option>
                          <option value="+264">Namibia ( +264 )</option>
                          <option value="+674">Nauru ( +674 )</option>
                          <option value="+977">Nepal ( +977 )</option>
                          <option value="+31">Netherlands ( +31 )</option>
                          <option value="+599">Netherlands Antilles ( +599 )</option>
                          <option value="+687">New Caledonia ( +687 )</option>
                          <option value="+64">New Zealand ( +64 )</option>
                          <option value="+505">Nicaragua ( +505 )</option>
                          <option value="+227">Niger ( +227 )</option>
                          <option value="+234">Nigeria ( +234 )</option>
                          <option value="+683">Niue ( +683 )</option>
                          <option value="+672">Norfolk Island ( +672 )</option>
                          <option value="+1670">Northern Mariana Islands ( +1670 )</option>
                          <option value="+47">Norway ( +47 )</option>
                          <option value="+968">Oman ( +968 )</option>
                          <option value="+92">Pakistan ( +92 )</option>
                          <option value="+680">Palau ( +680 )</option>
                          <option value="+970">Palestinian Territory, Occupied ( +970 )</option>
                          <option value="+507">Panama ( +507 )</option>
                          <option value="+675">Papua New Guinea ( +675 )</option>
                          <option value="+595">Paraguay ( +595 )</option>
                          <option value="+51">Peru ( +51 )</option>
                          <option value="+63">Philippines ( +63 )</option>
                          <option value="+872">Pitcairn ( +872 )</option>
                          <option value="+48">Poland ( +48 )</option>
                          <option value="+351">Portugal ( +351 )</option>
                          <option value="+1939">Puerto Rico ( +1939 )</option>
                          <option value="+974">Qatar ( +974 )</option>
                          <option value="+40">Romania ( +40 )</option>
                          <option value="+7">Russia ( +7 )</option>
                          <option value="+250">Rwanda ( +250 )</option>
                          <option value="+262">Reunion ( +262 )</option>
                          <option value="+590">Saint Barthelemy ( +590 )</option>
                          <option value="+290">Saint Helena, Ascension and Tristan Da Cunha ( +290 )</option>
                          <option value="+1869">Saint Kitts and Nevis ( +1869 )</option>
                          <option value="+1758">Saint Lucia ( +1758 )</option>
                          <option value="+590">Saint Martin ( +590 )</option>
                          <option value="+508">Saint Pierre and Miquelon ( +508 )</option>
                          <option value="+1784">Saint Vincent and the Grenadines ( +1784 )</option>
                          <option value="+685">Samoa ( +685 )</option>
                          <option value="+378">San Marino ( +378 )</option>
                          <option value="+239">Sao Tome and Principe ( +239 )</option>
                          <option value="+966">Saudi Arabia ( +966 )</option>
                          <option value="+221">Senegal ( +221 )</option>
                          <option value="+381">Serbia ( +381 )</option>
                          <option value="+248">Seychelles ( +248 )</option>
                          <option value="+232">Sierra Leone ( +232 )</option>
                          <option value="+65">Singapore ( +65 )</option>
                          <option value="+421">Slovakia ( +421 )</option>
                          <option value="+386">Slovenia ( +386 )</option>
                          <option value="+677">Solomon Islands ( +677 )</option>
                          <option value="+252">Somalia ( +252 )</option>
                          <option value="+27">South Africa ( +27 )</option>
                          <option value="+500">South Georgia and the South Sandwich Islands ( +500 )</option>
                          <option value="+34">Spain ( +34 )</option>
                          <option value="+94">Sri Lanka ( +94 )</option>
                          <option value="+249">Sudan ( +249 )</option>
                          <option value="+597">Suriname ( +597 )</option>
                          <option value="+47">Svalbard and Jan Mayen ( +47 )</option>
                          <option value="+268">Swaziland ( +268 )</option>
                          <option value="+46">Sweden ( +46 )</option>
                          <option value="+41">Switzerland ( +41 )</option>
                          <option value="+963">Syrian Arab Republic ( +963 )</option>
                          <option value="+886">Taiwan ( +886 )</option>
                          <option value="+992">Tajikistan ( +992 )</option>
                          <option value="+255">Tanzania, United Republic of Tanzania ( +255 )</option>
                          <option value="+66">Thailand ( +66 )</option>
                          <option value="+670">Timor-Leste ( +670 )</option>
                          <option value="+228">Togo ( +228 )</option>
                          <option value="+690">Tokelau ( +690 )</option>
                          <option value="+676">Tonga ( +676 )</option>
                          <option value="+1868">Trinidad and Tobago ( +1868 )</option>
                          <option value="+216">Tunisia ( +216 )</option>
                          <option value="+90">Turkey ( +90 )</option>
                          <option value="+993">Turkmenistan ( +993 )</option>
                          <option value="+1649">Turks and Caicos Islands ( +1649 )</option>
                          <option value="+688">Tuvalu ( +688 )</option>
                          <option value="+256">Uganda ( +256 )</option>
                          <option value="+380">Ukraine ( +380 )</option>
                          <option value="+971">United Arab Emirates ( +971 )</option>
                          <option value="+44">United Kingdom ( +44 )</option>
                          <option value="+1">United States ( +1 )</option>
                          <option value="+598">Uruguay ( +598 )</option>
                          <option value="+998">Uzbekistan ( +998 )</option>
                          <option value="+678">Vanuatu ( +678 )</option>
                          <option value="+58">Venezuela, Bolivarian Republic of Venezuela ( +58 )</option>
                          <option value="+84">Vietnam ( +84 )</option>
                          <option value="+1284">Virgin Islands, British ( +1284 )</option>
                          <option value="+1340">Virgin Islands, U.S. ( +1340 )</option>
                          <option value="+681">Wallis and Futuna ( +681 )</option>
                          <option value="+967">Yemen ( +967 )</option>
                          <option value="+260">Zambia ( +260 )</option>
                          <option value="+263">Zimbabwe ( +263 )</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="aa-checkout-single-bill">
                        <input type="tel" placeholder="Mobile*" value="<?=$customerMobile?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="aa-checkout-single-bill">
                        <p>Special Request</p>
                        <textarea cols="8" rows="3" placeholder="Eg: I need special treatment.."></textarea>
                      </div>
                    </div>
                  </div>
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="contin" aria-expanded="false">Continue</a> </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default aa-checkout-login">
        <div class="panel-heading"> <span class="bkStepNum marginR10 fl">3.</span>
          <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="" aria-expanded="false">Payment Method </a> </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
        <div class="col-md-12">
        <div class="checkout-right">
        <div role="tabpanel" class="pymnt">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#payatHotel" data-toggle="tab" role="tab" aria-controls="tab1">Pay on arrival</a></li>
          <li role="presentation"><a href="#paneOne1" data-toggle="tab" role="tab" aria-controls="tab1">Saved Details</a></li>
          <li role="presentation"><a href="#paneTwo1" data-toggle="tab" role="tab" aria-controls="tab2">Debit Card</a></li>
          <li role="presentation"><a href="#paneThree1" data-toggle="tab" role="tab" aria-controls="tab3">Credit Card</a></li>
          <li role="presentation"><a href="#paneFour1" data-toggle="tab" role="tab" aria-controls="tab4">Net Banking</a></li>
        </ul>
        <div id="tabContent1" class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="payatHotel">
          <div class="summary-content mob-accordion-content"> 
           <span class="left">Grand Total :</span> <span class="right"> <span class="standard-price">
                        <?=$currency_symbal.$bookingSubTotal?>
                        </span> </span> <span class="left">Disocunt                           (
                        <?=$bookingDiscount?>
                        ):</span> <span class="right green-txt">
                        <?=$currency_symbal.$bookingDiscountAmount?>
                        </span>
                        <div class="total"> <span class="left">Net Amount :</span> <span class="right"> <span class="rupee">
                          <?=$currency_symbal.$bookingPrice?>
                          </span> </span> </div>
                      
          
          
           
          </div>
          
          <a href="javascript:void(0)" id="confirmReservation" class="contin collapsed" aria-expanded="false">Confirm Reservation</a> </div>
        <div role="tabpanel" class="tab-pane fade" id="paneOne1">
          <div class="summary-content mob-accordion-content"> <span class="left">Grand Total :</span> <span class="right"> <span class="standard-price">฿600</span> </span> <span class="left">Disocunt                           (
            35%                          ):</span> <span class="right green-txt"> ฿210 </span>
            <div class="total"> <span class="left">Net Amount :</span> <span class="right"> <span class="rupee">฿390</span> </span> </div>
          </div>
          <div class="control-group card active">
            <div class="controls">
              <div class="input-prepend grid">
                <div class="cardHeading"> <span class="add-on fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i> </span>
                  <div class="fl ml20"> <span class="fl mr10 mt6 lt-grey-text default">ICICI</span> </div>
                  <span class="deleteCard fr" cardid="14726083" id="delete-14726083"><a href="#" class="blue blue-text-2">Remove Card</a></span> </div>
                <div class="sc-number"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use cc-visa"></i>
                  <input id="prependedradio-14726083" name="prependedradio" class="savedCardLabel text-input fl disabled" disabled="disabled" type="text" value="4704 XXXX XXXX 8344" style="position: relative;">
                  <div class="saveCardCvvDiv fr" id="cvvDiv-14726083">
                    <ul class="">
                      <li>
                        <div class="ml15 mt24 mr10 fl">
                          <input type="password" id="cvv-14726083" class="scCvvInput text-input small-input type-tel" maxlength="4" minlength="3" value="" placeholder="Enter CVV">
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>
          <div class="action-btns mt20 fl relative" style="margin-left:3%;" id="ccdcCards">
            <div class="savedCardbtn ">
              <input name="submit-btn-" type="submit" class="gry-btn btn-normal " value="Proceed Securely" id="scSubmit">
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="paneTwo1">
        <div class="summary-content mob-accordion-content"> <span class="left">Grand Total :</span> <span class="right"> <span class="standard-price">฿600</span> </span> <span class="left">Disocunt                           (
          35%                          ):</span> <span class="right green-txt"> ฿210 </span>
          <div class="total"> <span class="left">Net Amount :</span> <span class="right"> <span class="rupee">฿390</span> </span> </div>
        </div>
        <div class="card content active" id="dc-card">
        <div class="card-header xsmall grey-text mb10 relative">
          <div class="fr">
            <div class="secure lt-grey-text">
              <div class="img img-lock fl" alt="Secure" title="Secure"></div>
              <span><i>Your payment details are secured via<br>
              128 Bit encryption by Verisign</i></span> </div>
          </div>
          <div class="clear"></div>
        </div>
        <form autocomplete="off" name="creditcard-form" method="post" action="submitTransaction?MID=slSpEG68327288525417&amp;ORDER_ID=2160852633&amp;route=webjvm8" id="card" class="dc-form validated">
          <input type="hidden" name="txnMode" value="DC">
          <input type="hidden" name="txn_Mode" value="DC">
          <input type="hidden" name="channelId" value="WEB">
          <input type="hidden" name="AUTH_MODE" value="3D">
          <input type="hidden" name="CARD_TYPE" id="cardType" value="">
          <input type="hidden" name="walletAmount" id="walletAmountDC" value="0">
          <ul class="grid">
            <li class="mb20 card-wrapper">
              <label for="cardNumber" class="mb10">ENTER DEBIT CARD NUMBER</label>
              <p class="cd">
                <input class="dcCardNumber  d text-input large-input cardInput type-tel" autocomplete="off" name="" id="cn1" type="text" maxlength="23" style="width: 278px" data-type="dc" value="">
                <input type="hidden" name="cardNumber" value="" class="required">
              </p>
            </li>
            <li class="fl expiry-wrapper" style="overflow:hidden; clear:both;">
              <label class="mb10 dcExpMonth dcExpYear" for="dcExpMonth">EXPIRY DATE</label>
              <div class="mb10">
                <div class="fl" id="dcExpMonthWrapper">
                  <select class="dcExpMonth  combobox required" id="dcExpMonth" name="ccExpiryMonth" style="width: 80px;">
                    <option value="0">MM</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
                <div class="fl ml10" id="dcExpYearWrapper">
                  <select class="dcExpYear  combobox required" id="dcExpYear" name="ccExpiryYear" style="width: 80px;">
                    <option value="0">YY</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                    <option value="2032">2032</option>
                    <option value="2033">2033</option>
                    <option value="2034">2034</option>
                    <option value="2035">2035</option>
                    <option value="2036">2036</option>
                    <option value="2037">2037</option>
                    <option value="2038">2038</option>
                    <option value="2039">2039</option>
                    <option value="2040">2040</option>
                    <option value="2041">2041</option>
                    <option value="2042">2042</option>
                    <option value="2043">2043</option>
                    <option value="2044">2044</option>
                    <option value="2045">2045</option>
                    <option value="2046">2046</option>
                    <option value="2047">2047</option>
                    <option value="2048">2048</option>
                    <option value="2049">2049</option>
                    <option value="2050">2050</option>
                    <option value="2051">2051</option>
                  </select>
                </div>
                <div class="clear"></div>
              </div>
            </li>
            <li class="ml10 fl relative" id="dcCvvWrapper">
              <div class="cvv-block">
                <label for="cvvNumber" class="mb10">CVV</label>
                <input type="text" name="" class="f-hide" autocomplete="off">
                <input class="dcCvvBox  text-input small-input width40 required type-tel" autocomplete="off" type="password" name="cvvNumber" id="dcCvvBox" maxlength="4">
                <div class="clear"></div>
              </div>
              <div class="cvv-clue-box hide">
                <div class="dc-cvv-clue ui-cluetip mt10"> The last 3 digit printed on the signature panel on the back of your debit card. </div>
              </div>
            </li>
          </ul>
          <div id="cardInfo" class="storeCardWrapper">
            <div class="txt12 opt mt10" id="maestroOpt" style="display:none;">If your Maestro Card does not have Expiry Date/CVV, skip these fields</div>
            <div id="dcStoreCardWrapper" class="fl mt20">
              <div id="dcSaveCardLabel" class="fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i> </div>
              <label for="card1" class="save fl mt8">Save this card for faster checkout</label>
            </div>
            <div class="clear"></div>
          </div>
          <div class="clear"></div>
          <div class="mt20">
            <div class="btn-submit  fl">
              <input name="" type="submit" class="gry-btn fr btn-normal" value="Pay now" id="dcSubmit">
            </div>
            <a href="/oltp-web/cancelTransaction?MID=slSpEG68327288525417&amp;ORDER_ID=2160852633&amp;route=webjvm8" class="cancel">Cancel</a>
            <div class="clear"></div>
          </div>
        </form>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="paneThree1">
      <div class="summary-content mob-accordion-content"> <span class="left">Grand Total :</span> <span class="right"> <span class="standard-price">฿600</span> </span> <span class="left">Disocunt(35%):</span> <span class="right green-txt"> ฿210 </span>
        <div class="total"> <span class="left">Net Amount :</span> <span class="right"> <span class="rupee">฿390</span> </span> </div>
      </div>
      <div class="card content active" id="cc-card">
        <div class="card-header xsmall grey-text mb10 relative">
          <div class="fr">
            <div class="secure lt-grey-text">
              <div class="img img-lock fl" alt="Secure" title="Secure"></div>
              <span><i>Your payment details are secured via<br>
              128 Bit encryption by Verisign</i></span> </div>
          </div>
          <div class="clear"></div>
        </div>
        <form autocomplete="off" name="creditcard-form" method="post" action="submitTransaction?MID=slSpEG68327288525417&amp;ORDER_ID=2160852633&amp;route=webjvm8" id="card" class="cc-form validated">
          <input type="hidden" name="txnMode" value="CC">
          <input type="hidden" name="txn_Mode" value="CC">
          <input type="hidden" name="channelId" value="WEB">
          <input type="hidden" name="AUTH_MODE" value="3D">
          <input type="hidden" name="CARD_TYPE" id="cardType" value="">
          <input type="hidden" name="walletAmount" id="walletAmountCC" value="0">
          <ul class="grid">
            <li class="mb20 card-wrapper">
              <label class="mb10" for="cardNumber">ENTER CREDIT CARD NUMBER</label>
              <p class="cd">
                <input type="text" name="" class="ccCardNumber  text-input large-input c cardInput type-tel" id="cn" size="16" maxlength="19" style="width: 278px" data-type="cc" value="">
                <input type="hidden" name="cardNumber" value="" class="required">
              </p>
              <div class="error error2 promo-code-error hide"> </div>
            </li>
            <li class="expiry-wrapper" style="overflow:hidden; clear:both;">
              <label class="mb10 ccExpMonth ccExpYear" for="ccExpMonth">EXPIRY DATE</label>
              <div class="mb10">
                <div class="fl" id="ccExpMonthWrapper">
                  <select class="ccExpMonth  combobox required" id="ccExpMonth" name="ccExpiryMonth" style="width: 80px;">
                    <option value="0">MM</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
                <div class="fl ml10" id="ccExpYearWrapper">
                  <select class="ccExpYear  combobox required" id="ccExpYear" name="ccExpiryYear" style="width: 80px;">
                    <option value="0">YY</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                    <option value="2032">2032</option>
                    <option value="2033">2033</option>
                    <option value="2034">2034</option>
                    <option value="2035">2035</option>
                    <option value="2036">2036</option>
                    <option value="2037">2037</option>
                    <option value="2038">2038</option>
                    <option value="2039">2039</option>
                    <option value="2040">2040</option>
                    <option value="2041">2041</option>
                    <option value="2042">2042</option>
                    <option value="2043">2043</option>
                    <option value="2044">2044</option>
                    <option value="2045">2045</option>
                    <option value="2046">2046</option>
                    <option value="2047">2047</option>
                    <option value="2048">2048</option>
                    <option value="2049">2049</option>
                    <option value="2050">2050</option>
                    <option value="2051">2051</option>
                  </select>
                </div>
                <div class="clear"></div>
              </div>
            </li>
            <li class="ml10 fl" id="ccCvvWrapper">
              <div class="cvv-block">
                <label class="mb10" for="cvvNumber">CVV/SECURITY CODE</label>
                <input type="text" name="" class="f-hide" autocomplete="off">
                <input class="ccCvvBox  text-input small-input required type-tel" autocomplete="off" type="password" name="cvvNumber" id="ccCvvBox" maxlength="4">
                <div class="clear"></div>
              </div>
              <div class="clue-box hide">
                <div class="cc-cvv-clue default-clue ui-cluetip hide mt10"> The last 3 digit printed on the signature panel on the back of your credit card. </div>
                <div class="cc-cvv-clue amex-clue ui-cluetip hide mt10"> Four digits code printed at <br>
                  top of Amex logo on your card. </div>
              </div>
            </li>
          </ul>
          <div class="storeCardWrapper">
            <div id="ccStoreCardWrapper" class="fl mt20">
              <div class="fl" id="ccSaveCardLabel"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i></div>
              <label for="card1" class="save fl mt8">Save this card for faster checkout</label>
            </div>
            <div class="clear"></div>
          </div>
          <div class="mt20">
            <div class="btn-submit  fl">
              <input name="" type="submit" class="gry-btn btn-normal" value="Pay now" id="ccSubmit">
            </div>
            <a href="/oltp-web/cancelTransaction?MID=slSpEG68327288525417&amp;ORDER_ID=2160852633&amp;route=webjvm8" class="cancel">Cancel</a>
            <div class="clear"></div>
          </div>
        </form>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="paneFour1">
      <div class="summary-content mob-accordion-content"> <span class="left">Grand Total :</span> <span class="right"> <span class="standard-price">฿600</span> </span> <span class="left">Disocunt                           (
        35%                          ):</span> <span class="right green-txt"> ฿210 </span>
        <div class="total"> <span class="left">Net Amount :</span> <span class="right"> <span class="rupee">฿390</span> </span> </div>
      </div>
      <form autocomplete="off" name="netbanking-form" method="post" action="submitTransaction?MID=slSpEG68327288525417&amp;ORDER_ID=2160852633&amp;route=webjvm8" style="padding: 0px" class="validated">
        <input type="hidden" name="txnMode" value="NB">
        <input type="hidden" name="channelId" value="WEB">
        <input type="hidden" name="txn_Mode" value="NB">
        <input type="hidden" name="AUTH_MODE" value="USRPWD">
        <input type="hidden" name="bankCode" id="bankCode">
        <input type="hidden" name="walletAmount" id="walletAmountNB" value="0">
        <div id="popular-banks-wrapper">
          <label class="mb10" for="submit-btn">SELECT FROM POPULAR BANKS</label>
          <ul class="netbanking-panel pt20 pbanks grid banks-panel">
            <script type="text/javascript">
                
                  lowPerfNBBank["SBI"] = true;
                </script>
            <li>
              <div id="SBI" title="State Bank of India" class="radio" style="background-position: center 0px;">
                <input type="radio" class="bankRadio pcb checkbox fl" value="SBI" name="bank" autocomplete="off" style="display: none;">
                <span class="button-checkbox bootstrap-checkbox bankRadio pcb fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i></span>
                <label class="fl"> <span class="bank-logo" alt="State Bank of India" style="background : url(https://static1.paytm.in/1/images/web/bank/sbi.png) no-repeat;"></span> </label>
              </div>
            </li>
            <script type="text/javascript">
                
                  lowPerfNBBank["HDFC"] = true;
                </script>
            <li>
              <div id="HDFC" title="HDFC Bank" class="radio" style="background-position: center 0px;">
                <input type="radio" class="bankRadio pcb checkbox fl" value="HDFC" name="bank" autocomplete="off" style="display: none;">
                <span class="button-checkbox bootstrap-checkbox bankRadio pcb fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i> </span>
                <label class="fl"> <span class="bank-logo" alt="HDFC Bank" style="background : url(https://static3.paytm.in/1/images/web/bank/hdfc.png) no-repeat;"></span> </label>
              </div>
            </li>
            <script type="text/javascript">
                </script>
            <li>
              <div id="CITI" title="Citibank" class="radio" style="background-position: center 0px;">
                <input type="radio" class="bankRadio pcb checkbox fl" value="CITI" name="bank" autocomplete="off" style="display: none;">
                <span class="button-checkbox bootstrap-checkbox bankRadio pcb fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i></span>
                <label class="fl"> <span class="bank-logo" alt="Citibank" style="background : url(https://static3.paytm.in/1/images/web/bank/citibank.png) no-repeat;"></span> </label>
              </div>
            </li>
            <script type="text/javascript">
                </script>
            <li>
              <div id="ICICI" title="ICICI Bank" class="radio" style="background-position: center 0px;">
                <input type="radio" class="bankRadio pcb checkbox fl" value="ICICI" name="bank" autocomplete="off" style="display: none;">
                <span class="button-checkbox bootstrap-checkbox bankRadio pcb fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i> </span>
                <label class="fl"> <span class="bank-logo" alt="ICICI Bank" style="background : url(https://static3.paytm.in/1/images/web/bank/icici.png) no-repeat;"></span> </label>
              </div>
            </li>
            <script type="text/javascript">
                </script>
            <li>
              <div id="AXIS" title="Axis Bank" class="radio" style="background-position: center 0px;">
                <input type="radio" class="bankRadio pcb checkbox fl" value="AXIS" name="bank" autocomplete="off" style="display: none;">
                <span class="button-checkbox bootstrap-checkbox bankRadio pcb fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i></span>
                <label class="fl"> <span class="bank-logo" alt="Axis Bank" style="background : url(https://static1.paytm.in/1/images/web/bank/axis.png) no-repeat;"></span> </label>
              </div>
            </li>
            <script type="text/javascript">
                
                  lowPerfNBBank["PNB"] = true;
                </script>
            <li>
              <div id="PNB" title="Punjab National Bank" class="radio" style="background-position: center 0px;">
                <input type="radio" class="bankRadio pcb checkbox fl" value="PNB" name="bank" autocomplete="off" style="display: none;">
                <span class="button-checkbox bootstrap-checkbox bankRadio pcb fl"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use check-circle"></i> </span>
                <label class="fl"> <span class="bank-logo" alt="Punjab National Bank" style="background : url(https://static2.paytm.in/1/images/web/bank/pnb.png) no-repeat;"></span> </label>
              </div>
            </li>
          </ul>
          <div class="clear"></div>
          <div class="clear"></div>
        </div>
        <div id="other-banks-wrapper">
          <label class="mt20 mb10" for="submit-btn">OR SELECT OTHER BANK</label>
          <div id="nbWrapper">
            <select class="nbSelect" id="nbSelect" data-size="5">
              <option value="-1">Select</option>
              <option value="SBI">State Bank of India</option>
              <script type="text/javascript">
                  
                    lowPerfNBBank["SBI"] = true;
                  </script>
              <option value="HDFC">HDFC Bank</option>
              <script type="text/javascript">
                  
                    lowPerfNBBank["HDFC"] = true;
                  </script>
              <option value="CITI">Citibank</option>
              <script type="text/javascript">
                  </script>
              <option value="ICICI">ICICI Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="AXIS">Axis Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="PNB">Punjab National Bank</option>
              <script type="text/javascript">
                  
                    lowPerfNBBank["PNB"] = true;
                  </script>
              <option value="KOTAK">Kotak Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="BHARAT">Bharat Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="ALH">Allahabad Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="ANDHRA">Andhra Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="BBK">Bank of Bahrain and Kuwait</option>
              <script type="text/javascript">
                  </script>
              <option value="BOB">Bank of Baroda</option>
              <script type="text/javascript">
                  </script>
              <option value="BOI">Bank of India</option>
              <script type="text/javascript">
                  </script>
              <option value="BOM">Bank of Maharashtra</option>
              <script type="text/javascript">
                  </script>
              <option value="BOR">Bank of Rajasthan</option>
              <script type="text/javascript">
                  </script>
              <option value="CANARA">Canara Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="CSB">Catholic Syrian Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="CBI">Central Bank of India</option>
              <script type="text/javascript">
                  </script>
              <option value="CITIUB">City Union Bank</option>
              <script type="text/javascript">
                  
                    lowPerfNBBank["CITIUB"] = true;
                  </script>
              <option value="CORP">Corporation Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="COSMOS">Cosmos Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="DEUTS">Deutsche Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="JSB">Janata Sahakari Bank Ltd Pune</option>
              <script type="text/javascript">
                  </script>
              <option value="DCB">Development Credit Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="DENA">Dena Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="IDBI">IDBI Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="INDB">Indian Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="IOB">Indian Overseas Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="INDS">IndusInd Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="JKB">Jammu and Kashmir Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="KTKB">Karnataka Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="KVB">Karur Vysya Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="LVB">Lakshmi Vilas Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="OBPRF">Oriental Bank of Commerce</option>
              <script type="text/javascript">
                  </script>
              <option value="STB">Saraswat Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="SIB">South Indian Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="SCB">Standard Chartered Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="SBJ">State Bank of Bikaner and Jaipur</option>
              <script type="text/javascript">
                  
                    lowPerfNBBank["SBJ"] = true;
                  </script>
              <option value="SBH">State Bank Of Hyderabad</option>
              <script type="text/javascript">
                  </script>
              <option value="SBOP">State Bank of Patiala</option>
              <script type="text/javascript">
                  </script>
              <option value="SBT">State Bank of Travancore</option>
              <script type="text/javascript">
                  
                    lowPerfNBBank["SBT"] = true;
                  </script>
              <option value="SYNBK">Syndicate Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="TNMB">Tamilnad Mercantile Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="UNI">Union Bank of India</option>
              <script type="text/javascript">
                  
                    lowPerfNBBank["UNI"] = true;
                  </script>
              <option value="UBI">United Bank of India</option>
              <script type="text/javascript">
                  </script>
              <option value="VJYA">Vijaya Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="YES">Yes Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="SVC">SVC Cooperative Bank Ltd</option>
              <script type="text/javascript">
                  </script>
              <option value="UCO">UCO Bank</option>
              <script type="text/javascript">
                  </script>
              <option value="PSB">Punjab &amp; Sind Bank</option>
              <script type="text/javascript">
                  </script>
            </select>
          </div>
        </div>
        <div id="warningDiv" class="hide clear">
          <div id="errorMsg" class="mt10"></div>
        </div>
        <div class="mt20">
          <div class="btn-submit  fl">
            <input name="submit-btn" type="submit" class="blue-btn required btn-normal" value="Pay now" id="nbSubmit">
          </div>
          <a href="/oltp-web/cancelTransaction?MID=slSpEG68327288525417&amp;ORDER_ID=2160852633&amp;route=webjvm8" class="cancel">Cancel</a>
          <div class="clear"></div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Login section -->

</div>
</form>
</div>
</div>
</div>
</div>
<script type="text/javascript"><!--
$('#editReservation').on('click', function() { //alert('hi');
  $('#login').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>'); 
  jQuery("#preloader").delay(1000).fadeOut("slow");
  var url = '<?=$editReservation?>';
  var url = url.replace(/&amp;/g, "&");
  location =  url;
  
});

$('#confirmReservation').on('click', function() { //alert('hi');
  $.ajax({
    url: 'index.php?route=checkout/confirm/confirmOrder',
    type: 'post',
        data: $('#orderform input[type=\'text\'], #orderform input[type=\'hidden\'], #orderform select'),
        dataType: 'json',
    beforeSend: function() {
      //$('#confirmReservation').button('loading');
      $('#login').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');  
    },
    complete: function() {
      //$('#confirmReservation').button('reset');
      jQuery("#preloader").delay(1000).fadeOut("slow");
      
    },
    success: function(json) {
      //alert('success');
      var url = json['redirect'];
      var url = url.replace(/&amp;/g, "&");
            $(location).attr('href',url);
    }
  });
});
//--></script> 
<?php echo $footer; ?>