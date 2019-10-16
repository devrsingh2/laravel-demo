<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="RKS">
    <title>{{ config('app.name', 'PDF Extractor') }}</title>
    @include('web.includes.head')
    <style>
        .form-control {
            margin-bottom: 2px !important;
        }
    </style>
    @yield('header')
</head>
<body>

@include('web.includes.header')

@yield('content')

@include('web.includes.footer')

<a href="#" class="back-to-top">
    <i class="lnr lnr-arrow-up"></i>
</a>
<div id="loader">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

<script src="{{ asset("assets/js/jquery-min.js") }}"></script>
<script src="{{ asset("assets/js/popper.min.js") }}"></script>
<script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("assets/js/classie.js") }}"></script>
{{--<script src="{{ asset("assets/js/color-switcher.js") }}"></script>--}}
<script src="{{ asset("assets/js/jquery.mixitup.js") }}"></script>
<script src="{{ asset("assets/js/nivo-lightbox.js") }}"></script>
<script src="{{ asset("assets/js/owl.carousel.js") }}"></script>
<script src="{{ asset("assets/js/jquery.stellar.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.nav.js") }}"></script>
<script src="{{ asset("assets/js/scrolling-nav.js") }}"></script>
<script src="{{ asset("assets/js/jquery.easing.min.js") }}"></script>
<script src="{{ asset("assets/js/wow.js") }}"></script>
<script src="{{ asset("assets/js/jquery.vide.js") }}"></script>
<script src="{{ asset("assets/js/jquery.counterup.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.magnific-popup.min.js") }}"></script>
<script src="{{ asset("assets/js/waypoints.min.js") }}"></script>
<script src="{{ asset("assets/js/form-validator.min.js") }}"></script>
<script src="{{ asset("assets/js/contact-form-script.js") }}"></script>
<script src="{{ asset("assets/js/main.js") }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHo_WtZ2nIYCgCLf7sINZaqcrpqSDio9o"></script>

<script type="text/javascript">
    var map;
    var defult = new google.maps.LatLng(44.2072183, -101.3681486);
    var mapCoordinates = new google.maps.LatLng(44.2072183, -101.3681486);


    var markers = [];
    var image = new google.maps.MarkerImage(
        '{{ url('/') }}/assets/img/map-marker.png',
        new google.maps.Size(84, 70),
        new google.maps.Point(0, 0),
        new google.maps.Point(60, 60)
    );

    function addMarker() {
        markers.push(new google.maps.Marker({
            position: defult,
            raiseOnDrag: false,
            icon: image,
            map: map,
            draggable: false
        }));

    }

    function initialize() {
        var mapOptions = {
            backgroundColor: "#fff",
            zoom: 8,
            disableDefaultUI: true,
            center: mapCoordinates,
            zoomControl: false,
            scaleControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{
                "featureType": "landscape.natural",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "landscape.man_made",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "visibility": "off"
                }]
            }, {
                "featureType": "water",
                "stylers": [{
                    "color": "#80C8E5"
                }, {
                    "saturation": 0
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#999999"
                }]
            }, {
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "elementType": "labels.text",
                "stylers": [{
                    "color": "#333333"
                }]
            }

                , {
                    "featureType": "road.local",
                    "stylers": [{
                        "color": "#dedede"
                    }]
                }, {
                    "featureType": "road.local",
                    "elementType": "labels.text",
                    "stylers": [{
                        "color": "#666666"
                    }]
                }, {
                    "featureType": "transit.station.bus",
                    "stylers": [{
                        "saturation": -57
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }

            ]

        };
        map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
        addMarker();

    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

</body>
</html>
