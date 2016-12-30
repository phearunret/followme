 window.onload = function () {
    var json;
    $.ajax({
        dataType: "json",
        url: base_url + "maps/record",
        async: false, 
        success: function(data){
            json = data;                        
        }
    });


    var gm = google.maps;
    var map = new gm.Map(document.getElementById('map_canvas'), {
    mapTypeId: gm.MapTypeId.MAP,
        center: new gm.LatLng(11.562108, 104.888535), zoom: 7, // whatevs: fitBounds will override
    });
    
    var iw = new gm.InfoWindow();
    var oms = new OverlappingMarkerSpiderfier(map,
        {
        markersWontMove: true,
        markersWontHide: true,
        nudgeRadius: 0.5,
    });

    var usualColor = 'eebb22';
    var spiderfiedColor = 'ffee22';
    var iconWithColor = function (color) {
        return 'http://chart.googleapis.com/chart?chst=d_map_xpin_letter&chld=pin|+|' + color + '|f8d11a|ffff00';
    };
    
    var shadow = new gm.MarkerImage('https://www.google.com/intl/en_ALL/mapfiles/shadow50.png',
        new gm.Size(37, 34), // size   - for sprite clipping
        new gm.Point(0, 0), // origin - ditto
        new gm.Point(15, 42)  // anchor - where to meet map location
    );

    oms.addListener('click', function (marker) {
        iw.setContent(marker.desc);
            iw.open(map, marker);
    });
    
    oms.addListener('spiderfy', function (markers) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setIcon(markers[i].icon);
            markers[i].setShadow(null);
           //console.log(markers[i].icon);
        }
        iw.close();
    });

    oms.addListener('unspiderfy', function (markers) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setIcon(markers[i].icon);
            markers[i].setShadow(shadow);
            //console.log(markers[i].icon);
        }
    });

    map.addListener('zoom_changed', function() {        

        //map.addListenerOnce('idle', function() {

        // change spiderable markers to plus sign markers
        // we are lucky here in that initial map is completely clustered
        // for there is no init listener in oms :(
        // so we swap on the first zoom/idle
        // and subsequently any other zoom/idle

        var spidered = oms.markersNearAnyOtherMarker();

        for (var i = 0; i < spidered.length; i ++) {

            // this was set when we created the markers
            var url = spidered[i].icon;
            spidered[i].setIcon(url);
            // code to manipulate your spidered icon url
                            
        };

        //});

    });

    var markers_no_overdue= [];
    var markers_30= [];
    var markers_60= [];
    var markers_90= [];
    var markers_over_90= [];

    var bounds = new gm.LatLngBounds();
         
    $.each(json, function (key, data) {
        var loc = new gm.LatLng(data.lat, data.lon);

        var myIcon = {
            url: data.icon,
            origin: new google.maps.Point(0, 0),
            scaledSize: new google.maps.Size(15, 17),
            anchor: new google.maps.Point(15, 17)
        };

    
        var marker = new gm.Marker({
            position: loc,
            map: map,
            icon: myIcon,
            shadow: shadow
        });
        
        marker.desc = data.desc;
        //reigiter maker to array to do a clusting   
        switch (data.overdue_day){
            case 'No overdue':
                markers_no_overdue.push(marker);
                break;
            case 30:
                markers_30.push(marker);
                break;
            case 60:
                markers_60.push(marker);
                break;
            case 90:
                markers_90.push(marker);
                break;
            case 9168:
                markers_over_90.push(marker);
                break;
        }      
        //markers.push(marker);
        oms.addMarker(marker);
                
        });
                
        // Add a marker clusterer to manage the markers.
        var markerCluster_no_overdue = new MarkerClusterer(map, markers_no_overdue,{imagePath: base_url +'assets/images/icons/markers/no_overdue' });
        var markerCluster_30 = new MarkerClusterer(map, markers_30,{imagePath: base_url +'assets/images/icons/markers/over_in_30' });
        var markerCluster_60 = new MarkerClusterer(map, markers_60,{imagePath: base_url +'assets/images/icons/markers/over_in_60' });
        var markerCluster_90 = new MarkerClusterer(map, markers_90,{imagePath: base_url +'assets/images/icons/markers/over_in_90' });
        var markerCluster_over_90 = new MarkerClusterer(map, markers_over_90,{imagePath: base_url +'assets/images/icons/markers/overdue_over_90' });


        markerCluster_no_overdue.setMaxZoom(10);
        markerCluster_30.setMaxZoom(10);
        markerCluster_60.setMaxZoom(10);
        markerCluster_90.setMaxZoom(10);
        markerCluster_over_90.setMaxZoom(10);

    function updateMarker() {

        var n = 0;
                  
        $.ajax({

            dataType: "json",
            async: false,
            type: "GET",
            url: base_url + "maps/live_data_update",
            data: { n: n },
            success: function(data) {
                                    
                $.each(data, function( i,item ){

                    if( n !== item.n ){

                        markers = new google.maps.Marker({
                            position: new google.maps.LatLng(item.lat, item.lon ),
                            map: map,
                            icon: item.icon
                        });

                        google.maps.event.addListener(markers,'click', function(){
                            iw.setContent( item.desc );
                            iw.open(map, this);                        
                            //markers.setIcon(null);
                        });

                        n = item.n;

                    } // check duplicat                 
                
                });
                                        
                //console.log(markers); 
            }
        });
    }
    
    // every 10 seconds
    setInterval(updateMarker,10000);
};


















 