@extends('layouts.app')

@section('content')

<div class="page-wrapper">

	<div class="row page-titles">

		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.live_tracking')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a>
				</li>
				<li class="breadcrumb-item active">
					{{trans('lang.live_tracking')}}
				</li>
			</ol>
		</div>
	</div>

	<div class="container-fluid">

        <!-- start row -->
        <div class="card mb-3">
            
            <div class="card-body">

                <div class="row">

                    <div class="col-lg-4">

                        <div class="table-responsive ride-list">

                            <div id="overlay" style="display:none">
                                <img src="{{ asset('images/spinner.gif') }}">
                            </div>

                            <div class="live-tracking-list">
                                
                            </div>
                            <div id="load-more-div" style="display:none"><a href="javascript:void(0)" class="btn btn-primary btn-sm" id="load-more">Load More</a></div>
                        </div>

                    </div>

                    <div class="col-lg-8">

                        <div id="map" style="height:450px"></div>

                        <div id="legend"><h3>Legend</h3></div>

                    </div> 

                </div>

            </div>

        </div>
	</div>

<style>
    #append_list12 tr{
        cursor:pointer;
    }
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 11px;
        border: 1px solid #000;
    }
    #legend h3 {
        margin-top: 0;
    }
    #legend img {
        vertical-align: middle;
    }
</style>

@endsection

@section('scripts')

<script type="text/javascript">

    var database = firebase.firestore();

    var map;
    var marker;
    var markers = [];
    var map_data = [];
    var base_url = '{!! asset('/images/') !!}';
    var itemsPerPage = 5; 
    var currentPage = 1; 
    var rides = [];
    var drivers = [];

    $(document).ready(function () {
        
        jQuery("#overlay").show();

        var database = firebase.firestore();
        
        var ride_drivers = [];
        database.collection('orders').where('status','==','Ride Active').get().then(async function (snapshots) {
            if(snapshots.docs.length > 0){
                snapshots.docs.forEach((doc) => {
                    var data = doc.data();
                    data.flag = 'on_ride';
                    rides.push(data);
                    ride_drivers.push(data.driverId);
                });    
            }
        });

        database.collection('driver_users').where('location','!=',null).get().then(async function (snapshots) {
            if(snapshots.docs.length > 0){
                snapshots.docs.forEach((doc) => {
                    var data = doc.data();
                    data.flag = 'available';
                    if($.inArray(data.id,ride_drivers) === -1) {
                        drivers.push(data);
                    }
                });    
            }
            
            let mapdata = $.merge( rides, drivers )
            loadData(mapdata,currentPage);
        });
        
        setTimeout(function(){
            $(".sidebartoggler").click();
            InitializeGodsEyeMap();
        },4000);

        $(document).on("click",".ride-list .track-from",function(){
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            var index = $(this).data('index');
            map.panTo(new google.maps.LatLng(lat,lng));
            google.maps.event.trigger(markers[index], 'click');
        });

    });

    function InitializeGodsEyeMap() {

        var default_lat = getCookie('default_latitude');
        var default_lng = getCookie('default_longitude');

        var myLatlng = new google.maps.LatLng(default_lat,default_lng);
        var infowindow = new google.maps.InfoWindow();
        var legend = document.getElementById('legend');

        var mapOptions = {
            zoom: 10,
            center: myLatlng,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("map"), mapOptions);       

        var base_url = '{!! asset('/images/') !!}';

        var fliter_icons = {
            available: {
                name: 'Available',
                icon: base_url + '/available.png'
            },
            ontrip: {
                name: 'On Ride',
                icon: base_url + '/ontrip.png'
            }
        };

        for (var key in fliter_icons) {
            var type = fliter_icons[key];
            var name = type.name;
            var icon = type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
    }

    async function loadData(data,page) {
        var startIndex = (page - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var itemsToDisplay = data.slice(startIndex, endIndex);
         itemsToDisplay.forEach(async(item,i) => {

            val = item;
            var html = '';

            if(val.flag == "on_ride"){
                var driverId = val.driverId;
            }else{
                var driverId = val.id;
            }
            
            let driver = await getDriverDetail(driverId);
    
            if(val.flag == "on_ride"){

                let user = await getUserDetail(val.userId);

                if(user != undefined){

                    html += '<div class="live-tracking-box track-from" data-index="'+i+'" data-lat="'+driver.location.latitude+'" data-lng="'+driver.location.longitude+'">';
                        html += '<div class="live-tracking-inner">';
                            html += '<span class="listicon"></span>';
                            /*html += '<a href="/rides/show/'+val.id+'" target="_blank"><i class="text-dark fs-12 fa-solid fa-circle-info" data-toggle="tooltip"></i></a>';*/
                            html += '<h3 class="drier-name">{{trans("lang.driver_name")}} : '+driver.fullName+'</h3>';
                            if(user.fullName){
                                html += '<h4 class="user-name">{{trans("lang.user_name")}} : '+user.fullName+'</h4>';
                            }
                            if(val.sourceLocationName && val.destinationLocationName){
                                html += '<div class="location-ride">';	
                                    html += '<div class="from-ride"><span>'+val.sourceLocationName+'</span></div>';
                                    html += '<div class="to-ride"><span>'+val.destinationLocationName+'</span></div>';
                                html += '</div>';
                            }
                            html += '<span class="badge badge-danger">On Ride</span>';
                            html += '&nbsp;&nbsp;<a href="/rides/show/'+val.id+'" class="badge badge-info" target="_blank">{{trans("lang.ride_id")}} : '+val.id.substring(0,7)+'</a>';
                        html += '</div>';
                    html += '</div>';

                }

            }else{
                
                html += '<div class="live-tracking-box track-from" data-lat="'+driver.location.latitude+'" data-lng="'+driver.location.longitude+'">';
                    html += '<div class="live-tracking-inner">';
                        html += '<span class="listicon"></span>';
                        html += '<h3 class="drier-name">{{trans("lang.driver_name")}} : '+driver.fullName+'</h3>';
                        html += '<span class="badge badge-success">Available<span>';
                    html += '</div>';
                html += '</div>';
            }

            $(".live-tracking-list").append(html);
            
            if (typeof driver.location.latitude != 'undefined' && typeof driver.location.longitude != 'undefined') {

                let iconImg = '';
                let position = '';

                if(val.flag == "available"){
                    iconImg = base_url + '/car_available.png';
                }else{
                    iconImg = base_url + '/car_on_trip.png';
                }
                
                let marker = new google.maps.Marker({
                    position: new google.maps.LatLng(driver.location.latitude, driver.location.longitude),
                    icon: {
                        url: iconImg,
                        scaledSize: new google.maps.Size(25, 25)
                    },
                    map: map
                });

                
                if(driver.vehicleInformation != undefined){
                    var content = `
                    <div class="p-2">
                        <h6>{{trans('lang.driver_name')}} : ${driver.fullName ?? '-'} </h6>
                        <h6>{{trans('lang.phone')}} : ${driver.countryCode+driver.phoneNumber ?? '-'} </h6>
                        <h6>{{trans('lang.car_number')}} : ${driver.vehicleInformation.vehicleNumber ?? '-'} </h6>
                        <h6>{{trans('lang.car_model')}} : ${driver.vehicleInformation.vehicleType ?? '-'} </h6>
                    </div>`;
                }else{
                    var content = `
                    <div class="p-2">
                        <h6>{{trans('lang.driver_name')}} : ${driver.fullName ?? '-'} </h6>
                        <h6>{{trans('lang.phone')}} : ${driver.countryCode+driver.phoneNumber ?? '-'} </h6>
                    </div>`;
                }
                
                let infowindow = new google.maps.InfoWindow({
                    content: content
                });

                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });

                markers.push(marker);
                
                marker.setMap(map);
                
                setInterval(function() {
                    locationUpdate(marker,driver);
                },10000);
            }
        })

        async function locationUpdate(marker,driver) {
            database.collection("driver_users").doc(driver.id).get().then((doc) => {
                let data = doc.data();
                marker.setPosition(new google.maps.LatLng(data.location.latitude,data.location.longitude));
            });
        }
        jQuery("#overlay").hide();
         if (endIndex >= data.length) {
            $('#load-more-div').css('display','none');
        }else{
            $('#load-more-div').css('display','block');

        }
 
    }
$('#load-more').on('click',function(){
  currentPage++;
  let mapdata = $.merge( rides, drivers );
  loadData(mapdata,currentPage);
})
    async function getUserDetail(userId) {
        return database.collection("users").doc(userId).get().then((doc) => {
            return doc.data();
        });
    }

    async function getDriverDetail(driverId) {
        return database.collection("driver_users").doc(driverId).get().then((doc) => {
            return doc.data();
        });
    }

</script>

@endsection
