@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

<style type="text/css">
    
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #map {
        height: 100%;
        min-height: 568px;
    }

    .controls {
        /*margin-top: 10px;*/
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        margin-bottom: 10px;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        /*margin-left: 12px;*/
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 100%;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #location-search {
        width: 100%;
    }

    #legend {
        font-family: Arial, sans-serif;
        background: rgba(255,255,255,0.8);
        padding: 10px;
        margin: 10px;
        border: 2px solid #f3f3f3;
    }
    #legend h3 {
        margin-top: 0;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }
    #legend img {
        vertical-align: middle;
        margin-bottom: 5px;
    }
</style>

<div id="map"></div>
<div id="legend"><h3>Available Drivers</h3>  
@isset($data[0])
    @php
    $lat = $data[0]->lat;
    $lng = $data[0]->lng;
    @endphp
@else
    @php
    $lat = env('DEFAULT_LAT');
    $lng = env('DEFAULT_LNG');
    @endphp
@endisset
@endsection     
 
@section('script')
<script>
    var map;
    var markers = [
        @foreach($data as $val)
        { provider_id: "{{ $val->id }}",name: "{{ $val->name }}",partner_id: "{{ $val->partner_id }}",phone: "{{ $val->phone }}", lat: {{ $val->lat }}, lng: {{ $val->lng }}, available: {{ $val->is_available }} },
        @endforeach
    ];

    var mapIcons = [
        'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
        'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
        'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
        // '{{ asset('images/map-marker-red.png') }}',
        // '{{ asset('images/map-marker-blue.png') }}',
        'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
    ];
    var mapMarkers = [];
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });

        /*
        var input = document.getElementById('pac-input');

        var button = document.getElementById('location-search');

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        */

        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();

        function createMarker(element) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(element.lat, element.lng),
                map: map,
                title: element.name,
                icon: mapIcons[element.available],
            });
            var html = '<h6 class="firstHeading">'+element.name+'</h6>'+
            '<h6 class="firstHeading">'+element.phone+'</h6>'+
            '<h6 class="firstHeading">'+element.partner_id+'</h6>';

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(html);
                infowindow.open(map, marker);
            });
            bounds.extend(marker.position);
            return marker;
        }

        markers.forEach( function(element, index) {
            marker = createMarker(element);
            console.log(marker);
            mapMarkers.push(marker);

        });
        map.fitBounds(bounds);
        if(markers.length==0)
        {
            bounds.extend(new google.maps.LatLng({{$lat}}, {{$lng}}));
            map.fitBounds(bounds);
        }


        var legend = document.getElementById('legend');
        var div = document.createElement('div');
        div.innerHTML = '<img src="' + mapIcons[0] + '"> ' + 'Unavailable';
        legend.appendChild(div);
        var div = document.createElement('div');
        div.innerHTML = '<img src="' + mapIcons[1] + '"> ' + 'Available';
        legend.appendChild(div);
        var div = document.createElement('div');
        div.innerHTML = '<img src="' + mapIcons[2] + '"> ' + 'Busy';
        legend.appendChild(div);
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
        
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ GOOGLE_API_KEY }}&libraries=places&callback=initMap" async defer></script>
@endsection