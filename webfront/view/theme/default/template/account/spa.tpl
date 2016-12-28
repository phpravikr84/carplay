<?php echo $header; ?>



<div class="container">
<div class="row info">
<div class="col-md-12">
    <h1>More bookings, more easily. Join Riwigo</h1>
    <p>You create the style. You make people fabulous. We make the booking process faster, simpler and cheaper – and give you access to a massive customer base, too. <br>Thousands of salons and spas have joined Riwigo, and are now enjoying a slick and reliable booking platform that’s open 24/7 for customers. </p>
    <p>Join them. Join us. Keep doing what you do, and we’ll make sure you receive the customers you deserve. Leave your contact details and we will contact you.</p>
</div>
</div>
<div class="row form">
<form role="form" name="salonspaForm" action="index.php?route=account/spa" method="post">
<input type="hidden" name="recommendation" value="false">
<div class="col-md-6">
<h3>About the salon</h3>
<div class="row">
    <div class="col-md-12">
    <div class="form-group">
    <input type="text" name="companyName" id="companyName" class="form-control" placeholder="Company name" required="" tabindex="1"><p style="font-size:.9em; color:red;" id="companyNameError"> </p>
    </div>
    </div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="text" name="companyStreet" class="form-control" placeholder="Street" required="" tabindex="2">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="companyHousenumber" class="form-control" placeholder="House no." required="" tabindex="3">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="text" name="companyZipcode" class="form-control" placeholder="Postal code" required="" tabindex="4">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="companyCity" class="form-control" placeholder="City" required="" tabindex="5">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="text" name="companyCode" id="mobile-number" style="width:100px;"  class="form-control" tabindex="5"><input type="text" name="companyPhone" class="form-control" placeholder="Phone number salon" required="" tabindex="5">
</div>
</div>
</div>
</div>
<div class="col-md-5">
<h3>About you</h3>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="text" name="userName" class="form-control"  placeholder="First name" required="" tabindex="6">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="text" name="userSurname" class="form-control"  placeholder="Last name" required="" tabindex="7">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="email" name="userEmail" class="form-control" placeholder="E-mail address" required="" tabindex="8">
</div>
</div>
</div>
<!-- <input type="hidden" name="ts" value="MRR3BJ2QA4LI2FQ345DBMF2DXNSGN5QJ7YJTBZRZOBSFSJPTLBGQ"> -->
<div class="row submit text-right">
<div class="col-sm-30 col-sm-offset-18 col-xs-28 col-xs-offset-20">
<div class="form-group">
<!-- <button name="sendRecommendationButton" type="submit" onclick="return SubmitIfValid();" class="btn btn-lg btn-primary"> -->

<button name="sendRecommendationButton" type="submit" class="btn btn-lg btn-primary">
Register your salon
<i class="twicon-arrow-right"></i>
</button>
</div>
</div>
</div>
</div>
</form>
</div>
</div><!-- end container-->
<style type="text/css">.intl-tel-input .country-list{width:200px!important;} </style>
 <link rel="stylesheet" href="<?php echo HTTP_IMAGE; ?>build/css/intlTelInput.css">
<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
<script type="text/javascript" src="<?php echo HTTP_IMAGE; ?>build/js/intlTelInput.js"></script>

<script>
    $(function() {
$("#mobile-number").intlTelInput({
allowExtensions: true,
autoFormat: false,
autoHideDialCode: false,
//autoPlaceholder: false,
autoPlaceholder: "polite",
defaultCountry: "auto",
ipinfoToken: "yolo",
nationalMode: false,
numberType: "MOBILE",
//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
//preferredCountries: ['cn', 'jp'],
preferredCountries: [ "th", "us"],
preventInvalidNumbers: true,
utilsScript: "lib/libphonenumber/build/utils.js"
});
});
  </script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

<script>
$(function() {
  $("form[name='salonspaForm']").validate({
    // Specify validation rules
    rules: {
      userName: "required",
      userSurname: "required",
      userEmail: {
        required: true,
        userEmail: true
      }
    },
    // Specify validation error messages
    messages: {
      userName: "Please enter your firstname",
      lastname: "Please enter your lastname",
      userEmail: "Please enter a valid email address"
    }
    submitHandler: function(form) {
      form.submit();
    }
  });
});

</script>

<?php echo $footer; ?> 
