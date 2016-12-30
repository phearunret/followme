
    <div class="intro-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" style="padding-left: 0; padding-right: 0;">
                    <div class="intro-message">
                        <?php echo $map['js']; ?>
                        <?php echo $map['html']; ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </div>
    <!-- /.intro-header -->
    <script src="<?php echo base_url('assets/js/oms.min.js');?>"></script>
     
  <script>
    window.onload = function() {

      var iw = new gm.InfoWindow();
      var oms = new Overlappingmarkers_mapSpiderfier(map,
        {markers_mapsWontMove: true, markers_mapsWontHide: true});
      var usualColor = 'eebb22';
      var spiderfiedColor = 'ffee22';
      var iconWithColor = function(color) {
        return 'https://chart.googleapis.com/chart?chst=d_map_xpin_letter&chld=pin|+|' +
          color + '|000000|ffff00';
      }
      var shadow = new gm.markers_mapImage(
        'https://www.google.com/intl/en_ALL/mapfiles/shadow50.png',
        new gm.Size(37, 34),  // size   - for sprite clipping
        new gm.Point(0, 0),   // origin - ditto
        new gm.Point(10, 34)  // anchor - where to meet map location
      );
      
      oms.addListener('click', function(markers_map) {
        iw.setContent(markers_map.desc);
        iw.open(map, markers_map);
      });
      oms.addListener('spiderfy', function(markers_maps) {
        for(var i = 0; i < markers_maps.length; i ++) {
          markers_maps[i].setIcon(iconWithColor(spiderfiedColor));
          markers_maps[i].setShadow(null);
        } 
        iw.close();
      });
      oms.addListener('unspiderfy', function(markers_maps) {
        for(var i = 0; i < markers_maps.length; i ++) {
          markers_maps[i].setIcon(iconWithColor(usualColor));
          markers_maps[i].setShadow(shadow);
        }
      });
      
      var bounds = new gm.LatLngBounds();
      for (var i = 0; i < window.mapData.length; i ++) {
        var datum = window.mapData[i];
        var loc = new gm.LatLng(datum.lat, datum.lon);
        bounds.extend(loc);
        var markers_map = new gm.markers_map({
          position: loc,
          title: datum.h,
          map: map,
          icon: iconWithColor(usualColor),
          shadow: shadow
        });
        markers_map.desc = datum.d;
        oms.addmarkers_map(markers_map);
      }
      map.fitBounds(bounds);
      // for debugging/exploratory use in console
      window.map = map;
      window.oms = oms;
    }
  </script>
</head>
 

    
