<?php //echo $latitude; ?>
<div id="dvMap" style="height:400px;"></div>

<script type="text/javascript">

    var myLatlng = new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>);
    var myOptions = {
    zoom: 11,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(document.getElementById("dvMap"), myOptions);

    var contentString = <?php echo $latitude; ?>+','+<?php echo $longitude; ?>;

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"Riwigo"
    });

    google.maps.event.addListener(marker, 'click', function() {
   infowindow.open(map,marker);
});
infowindow.open(map,marker);

</script>