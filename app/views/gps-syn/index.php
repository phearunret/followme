<ul class="point-color">
	<li class="item_in_day in_30_days">
		<?php echo img('assets/images/icons/overdue_in_30.png');?> Overdue in 30 days
	</li>
	<li class="item_in_day in_60_days">
		<?php echo img('assets/images/icons/overdue_in_60.png');?> Overdue in 60 days
	</li>
	<li class="item in_day in_90_days">
		<?php echo img('assets/images/icons/overdue_in_90.png');?> Overdue in 90 days
	</li>
	<li class="item_in_day no_overdue">
		<?php echo img('assets/images/icons/no_overdue.png');?> No Overude 
	</li>
	<li class="item_in_day fco">
		<?php echo img('assets/images/icons/fco.png');?> FCO Activity Profile
	</li>
	<li class="item_in_day other_col">
		<?php echo img('assets/images/icons/other_color.png');?> CO Activity Profile
	</li>
</ul> 

<?php echo $map['js']; ?>
<?php echo $map['html']; ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/oms.min.js');?>"></script>
<script type="text/javascript">
	var gm = google.maps;

	var iw = new gm.InfoWindow();
	oms.addListener('click', function(marker, event) {
	  iw.setContent(marker.desc);
	  iw.open(map, marker);
	});
	
    var oms = new OverlappingMarkerSpiderfier(map);
	    oms.addListener('spiderfy', function(markers) {
	  iw.close();
	});

	for (var i = 0; i < window.mapData.length; i ++) {
	  var datum = window.mapData[i];
	  var loc = new gm.LatLng(datum.lat, datum.lon);
	  var marker = new gm.Marker({
	    position: loc,
	    title: datum.h,
	    map: map
	  });
	  marker.desc = datum.d;
	  oms.addMarker(marker);  // <-- here
	}

</script>
                    
