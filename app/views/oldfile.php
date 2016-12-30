
<?php echo $map['js']; ?>
<?php echo $map['html']; ?>


<aside id="color-helper">
    <ul>
        <li name ="hfhh"><a href="<?php echo base_url('maps/in_day/1/30');?>" class="entypo-overdue_in_30_days item_in_day" alt="Overdue in 30 days"> 30 <span>Overdue in 30 days</span></a></li>
        <li><a href="<?php echo base_url('maps/in_day/30/60');?>" class="entypo-overdue_in_60_days item_in_day" alt="Overdue in 60 days"> 60 <span> Overdue in 60 days</span></a></li>
        <li><a href="<?php echo base_url('maps/in_day/60/90');?>" class="entypo-overdue_in_90_days item_in_day" alt="Overdue in 90 days"> 90 <span> Overdue in 90 days</span></a></li>
        <li><a href="<?php echo base_url('maps/in_day/0/168');?>" class="entypo-no_overdue item_in_day" alt="No Overude"> 0 <span> No Overude </span></a></li>
        <li><a href="<?php echo base_url('maps/get_today/24/7');?>" class="entypo-fcc-o btn_fco_item" alt="FCO Activity Profile"> <i class="fa fa-map-marker" aria-hidden="true"></i> <span> FCO Activity Profile </span></a></li>
        <li><a href="#" class="entypo-refrash btn_fresh"> <i class="fa fa-refresh"></i> <span> Refresh </span></a></li>
    </ul>
</aside>

<ul class="dialog itm-wrpper" title="Color Helper"></ul> 

<script type="text/javascript">
    function refreshMarkers() {
         $.ajax({
              url: "<?php base_url('maps') ?>",
              type: "POST",
              data: ({value: $markers}),
              dataType: "json", //retrieved Markers Lat/lng in Json, thus using this dataType
              success: function(data){
                  //Removing already Added Markers//////////
                 for (var i = 0; i < $markers.length; i++) {
                     $markers[i].setMap(null);
                 }
                 $markers = new Array();
                 //////////////////////////////////////////
                  // Adding New Markers////////////////////

                  for (var i = 0, len = data.length; i < len; ++i) { // Iterating the Json Array
                var d = data[i];

                var lat = parseFloat(d.lat);
                var lng = parseFloat(d.lng);
                var myLatlng = new google.maps.LatLng(lat, lng);

                var marker = {
                    map: map,
                    position: myLatlng // These are the minimal Options, you can add others too
                };
                createMarker(marker);
            }
        }
    }
    );
</script>

