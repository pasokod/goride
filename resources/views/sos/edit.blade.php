@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.sos')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('sos') !!}">{{trans('lang.sos')}}</a></li>
                <li class="breadcrumb-item">{{trans('lang.edit_sos')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-body p-0 pb-5">

                        <div class="user-detail" role="tabpanel">

                            <div class="row">
                                <div class="col-12">
                                    <div class="box">
                                        <div class="box-header bb-2 border-primary">
                                            <h3 class="box-title">{{trans('lang.map_view')}}</h3>
                                        </div>
                                        <div class="box-body">
                                            <div id="map" style="height:300px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header bb-2 border-primary">
                                            <h3 class="box-title">{{trans('lang.general_details')}}</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                       <!-- <th>{{trans('lang.date_created')}}</th>-->
                                                        <th>{{trans('lang.status')}}</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <!--<td id="createdAt"></td>-->
                                                        <td> <select id="order_status" class="form-control">
                                                                <option value="Initiated" id="initiated">{{
                                                                    trans('lang.initiated')}}</option>
                                                                <option value="Processing" id="processing">{{
                                                                    trans('lang.in_process')}}</option>
                                                                <option value="Completed" id="completed">{{
                                                                    trans('lang.completed')}}</option>

                                                            </select></td>
                                                        <td><button type="button"
                                                                class="btn btn-primary save_order_btn"><i
                                                                    class="fa fa-save"></i>
                                                                {{trans('lang.update')}}</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header bb-2 border-primary">
                                            <h3 class="box-title">{{ trans('lang.billing_details')}}</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('lang.name')}}</th>

                                                        <th>{{trans('lang.email_address')}}</th>
                                                        <th>{{trans('lang.phone')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td id="billing_name"></td>
                                                        <td id="billing_email"></td>
                                                        <td id="billing_phone"> </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header bb-2 border-primary">
                                            <h3 class="box-title">{{ trans('lang.ride_detail')}}</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('lang.user')}}</th>
                                                        <th>{{trans('lang.driver_plural')}}</th>
                                                        <th>{{trans('lang.address')}}</th>
                                                        <th>{{trans('lang.status')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td id="client"></td>
                                                        <td id="driver"> </td>
                                                        <td id="address"></td>
                                                        <td id="status"> </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header bb-2 border-primary">
                                            <h3 class="box-title">{{ trans('lang.driver_detail')}}</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('lang.image')}}</th>
                                                        <th>{{trans('lang.driver_plural')}}</th>
                                                        <th>{{trans('lang.email_address')}}</th>
                                                        <th>{{trans('lang.phone')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><img src="" class="driver-img rounded-circle"
                                                                alt="driver" width="70px" height="70px"></td>
                                                        <td class="vendor-title"> </td>
                                                        <td id="vendor_email"></td>
                                                        <td id="vendor_phone"> </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header bb-2 border-primary">
                                            <h3 class="box-title">{{ trans('lang.car_info')}}</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('lang.car_number')}}</th>
                                                        <th>{{trans('lang.vehicle_type')}}</th>
                                                        <th>{{trans('lang.vehicle_color')}}</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td id="driver_carNumber"></td>
                                                        <td id="driver_car_make"> </td>
                                                        <td id="driver_car_color"> </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>

<script type="text/javascript">

    var id_rendom = "<?php echo uniqid(); ?>";
    var id = "<?php echo $id; ?>";
    var driverId = '';
    var fcmToken = '';
    var old_order_status = '';
    var vendorname = '';
    var database = firebase.firestore();
    var ref = database.collection('sos').where("id", "==", id);
    var orderPreviousStatus = '';
    var manfcmTokenVendor = '';
    var manname = '';
    var geoFirestore = new GeoFirestore(database);
    var place_image = '{{asset("images/default_user.png")}}';

    $(document).ready(function () {
            $('.sos_menu').addClass('active');

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        jQuery("#overlay").show();

        ref.get().then(async function (snapshots) {
            var sos = snapshots.docs[0].data();

            sosStatus = sos.status;
            old_order_status=sos.status
            $("#order_status option[value='" + sos.status + "']").attr("selected", "selected");

            var price = 0;

            if (sos.orderId) {
                if(sos.orderType=="city"){
                  var ride = database.collection('orders').where("id", "==", sos.orderId);

                }else{
                    var ride = database.collection('orders_intercity').where("id", "==", sos.orderId);

                }
                ride.get().then(async function (snapshotsnew) {
                    var rideData = snapshotsnew.docs[0].data();
                    userData= await getUserInfo(rideData.userId);
                    
                    if (rideData.createdAt) {
                        var date1 = rideData.createdAt.toDate().toDateString();
                        var date = new Date(date1);
                        var dd = String(date.getDate()).padStart(2, '0');
                        var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = date.getFullYear();
                        var createdAt_val = yyyy + '-' + mm + '-' + dd;
                        var time = rideData.createdAt.toDate().toLocaleTimeString('en-US');

                        $('#createdAt').text(createdAt_val + ' ' + time);
                    }

                    $("#billing_name").text(userData.fullName);
                    var billingAddressstring = '';

                    if (userData.hasOwnProperty('phoneNumber')) {
                        $("#billing_phone").text(userData.countryCode+userData.phoneNumber);
                    }

                    if (userData.hasOwnProperty('email')) {
                        $("#billing_email").html('<a href="mailto:' + userData.email + '">' + userData.email + '</a>');
                    }
                    if (rideData.driverId) {
                        var route_view = '{{route("drivers.view",":id")}}';
                        route_view = route_view.replace(':id', rideData.driverId);

                        //$('#resturant-view').attr('data-url', route_view);
                    }
                    if (userData.fullName) {
                        $('#client').text(userData.fullName);
                    }
                   /* if (rideData.driver.firstName) {
                        $('#driver').text(rideData.driver.firstName);
                    }*/
                    if (rideData.sourceLocationName) {
                        $('#address').html(rideData.sourceLocationName);
                    }

                    if (rideData.status) {
                        $('#status').text(rideData.status);
                    }


                    if (rideData.driverId) {
                        var driver = database.collection('driver_users').where("id", "==", rideData.driverId);
                        driver.get().then(async function (snapshotsnew) {
                            if (snapshotsnew.empty) {
                                $('.driver-img').attr('src', place_image);
                                $('.vendor-title').html('-');
                                $('#vendor_email').html('-');
                                $('#vendor_phone').text('-');
                                $('#driver_carNumber').html('-');
                                $('#driver_car_make').text('-');
                                $('#driver_car_color').text('-');
                            } else {
                                var driver_data = snapshotsnew.docs[0].data();
                                //map view
                                var originAddress = driver_data.location.latitude + ',' + driver_data.location.longitude;
                                var destinationAddress = rideData.destinationLocationLAtLng.latitude + ',' + rideData.destinationLocationLAtLng.longitude;
                                drawRoute(originAddress, destinationAddress)
                                InitializeMap();

                                if (driver_data.id) {
                                    var route_view = '{{route("drivers.view",":id")}}';
                                    route_view = route_view.replace(':id', driver_data.id);

                                    //$('#resturant-view').attr('data-url', route_view);
                                }
                                $('#driver').text(driver_data.fullName);
                                if (driver_data.profilePic!='' ) {
                                    $('.driver-img').attr('src', driver_data.profilePic);
                                } else {
                                    $('.driver-img').attr('src', place_image);
                                }
                                if (driver_data.fullName) {
                                    $('.vendor-title').html(driver_data.fullName);
                                }

                                if (driver_data.email) {
                                    $('#vendor_email').html(driver_data.email);
                                }
                                if (driver_data.phoneNumber) {
                                    $('#vendor_phone').text(driver_data.phoneNumber);
                                }

                                if (driver_data.hasOwnProperty('vehicleInformation')) {

                                    if (driver_data.vehicleInformation.vehicleNumber) {
                                        $('#driver_carNumber').html(driver_data.vehicleInformation.vehicleNumber);
                                    }
                                    if (driver_data.vehicleInformation.vehicleType) {
                                        $('#driver_car_make').text(driver_data.vehicleInformation.vehicleType);
                                    }
                                    if (driver_data.vehicleInformation.vehiclColor) {
                                        $('#driver_car_color').text(driver_data.vehicleInformation.vehicleColor);
                                    }

                                }
                            }
                        });


                    }
                });

            }
            jQuery("#overlay").hide();
        })
 async function getUserInfo(userId) {
        var user = {};
        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                user = snapshots.docs[0].data();
            }
        });
        return user;
    }

        $(".save_order_btn").click(async function () {


            var clientName = $(".client_name").val();
            var orderStatus = $("#order_status").val();
            if (old_order_status != orderStatus) {
                database.collection('sos').doc(id).update({ 'status': orderStatus }).then(async function (result) {

                    await $.ajax({
                        type: 'POST',
                        url: "<?php echo route('send-notification'); ?>",
                        data: { _token: '<?php echo csrf_token() ?>', 'orderStatus': orderStatus },
                        success: function (data) {

                            window.location.href = '{{ route("sos")}}';

                        }
                    });

                });
            }

        })

    })

    var _mapPoints = new Array();

    function InitializeMap() {
        _directionsRenderer = new google.maps.DirectionsRenderer();

        var myOptions = {
            zoom: 12,
            center: new google.maps.LatLng(21.7679, 78.8718),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("map"), myOptions);
        _directionsRenderer.setMap(map);

        google.maps.event.addListener(map, "dblclick", function (event) {

            var _currentPoints = event.latLng;
            _mapPoints.push(_currentPoints);

            getRoutePointsAndWaypoints();
        });
    }

    function getRoutePointsAndWaypoints() {

        var _waypoints = new Array();
        if (_mapPoints.length > 2) {
            for (var j = 1; j < _mapPoints.length - 1; j++) {
                var address = _mapPoints[j];
                if (address !== "") {
                    _waypoints.push({
                        location: address,
                        stopover: true
                    });
                }
            }
            drawRoute(_mapPoints[0], _mapPoints[_mapPoints.length - 1], _waypoints);
        } else if (_mapPoints.length > 1) {
            drawRoute(_mapPoints[_mapPoints.length - 2], _mapPoints[_mapPoints.length - 1], _waypoints);
        } else {
            drawRoute(_mapPoints[_mapPoints.length - 1], _mapPoints[_mapPoints.length - 1], _waypoints);
        }
    }

    function drawRoute(originAddress, destinationAddress) {
        var directionsService = new google.maps.DirectionsService();
        var _request = '';

        _request = {
            origin: originAddress,
            destination: destinationAddress,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        }
        directionsService.route(_request, function (_response, _status) {
            if (_status == google.maps.DirectionsStatus.OK) {
                _directionsRenderer.setDirections(_response);
            }
        });
    }

</script>

@endsection