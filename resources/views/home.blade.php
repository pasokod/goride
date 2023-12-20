@extends('layouts.app')
@section('content')
    <div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">

        <div class="container-fluid">

            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                style="display: none;margin-top:20px;">{{ trans('lang.processing') }}
            </div>

            <div class="card mb-3 business-analytics">

                <div class="card-body">

                    <div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
                        <div class="col-sm-6">
                            <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                                {{ trans('lang.dashboard_today_trip') }}</h4>
                        </div>
                    </div>

                    <div class="row business-analytics_list">

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_orders') }}</h5>
                                <h2 id="total_rides_today"></h2>
                                <h6 id="total_rides_today_intercity"></h6>
                                <i class="mdi mdi-map-marker-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('users.index') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_clients') }}</h5>
                                <h2 id="users_count_today"></h2>
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('drivers') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_drivers') }}</h5>
                                <h2 id="driver_count_today"></h2>
                                <h6 id="driver_count_today_intercity">{{ trans('lang.intercity') }} / 0</h6>
                                <i class="mdi mdi-account-card-details"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_earnings') }}</h5>
                                <h2 id="earnings_count_today"></h2>
                                <h6 id="earnings_count_today_intercity"></h6>
                                <i class="mdi mdi-cash-usd"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_admin_commission') }}</h5>
                                <h2 id="admincommission_count_today"></h2>
                                <h6 id="admincommission_count_today_intercity"></h6>
                                <i class="ti-wallet"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">

                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_placed') }}</h5>
                                <h2 id="placed_count_today"></h2>
                                <h6 id="placed_count_today_intercity"></h6>
                                <i class="mdi mdi-check-circle"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_active') }}</h5>
                                <h2 id="active_count_today"></h2>
                                <h6 id="active_count_today_intercity"></h6>
                                <i class="mdi mdi-car-connected"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_completed') }}</h5>
                                <h2 id="completed_count_today"></h2>
                                <h6 id="completed_count_today_intercity"></h6>
                                <i class="mdi mdi-check-circle-outline"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_canceled') }}</h5>
                                <h2 id="canceled_count_today"></h2>
                                <h6 id="canceled_count_today_intercity"></h6>
                                <i class="mdi mdi-window-close"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-3 business-analytics">

                <div class="card-body">

                    <div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
                        <div class="col-sm-6">
                            <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                                {{ trans('lang.dashboard_total_trip') }}</h4>
                        </div>
                    </div>

                    <div class="row business-analytics_list">

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_orders') }}</h5>
                                <h2 id="total_rides"></h2>
                                <h6 id="total_rides_intercity"></h6>
                                <i class="mdi mdi-map-marker-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('users.index') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_clients') }}</h5>
                                <h2 id="users_count"></h2>
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('drivers') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_drivers') }}</h5>
                                <h2 id="driver_count"></h2>
                                <h6 id="driver_count_intercity">{{ trans('lang.intercity') }} / 0</h6>
                                <i class="mdi mdi-account-card-details"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_total_earnings') }}</h5>
                                <h2 id="earnings_count"></h2>
                                <h6 id="earnings_count_intercity"></h6>
                                <i class="mdi mdi-cash-usd"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_admin_commission') }}</h5>
                                <h2 id="admincommission_count"></h2>
                                <h6 id="admincommission_count_intercity"></h6>
                                <i class="ti-wallet"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">

                        </div>


                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_placed') }}</h5>
                                <h2 id="placed_count"></h2>
                                <h6 id="placed_count_intercity"></h6>
                                <i class="mdi mdi-check-circle"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_active') }}</h5>
                                <h2 id="active_count"></h2>
                                <h6 id="active_count_intercity"></h6>
                                <i class="mdi mdi-car-connected"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_completed') }}</h5>
                                <h2 id="completed_count"></h2>
                                <h6 id="completed_count_intercity"></h6>
                                <i class="mdi mdi-check-circle-outline"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                            <div class="card-box">
                                <h5>{{ trans('lang.dashboard_ride_canceled') }}</h5>
                                <h2 id="canceled_count"></h2>
                                <h6 id="canceled_count_intercity"></h6>
                                <i class="mdi mdi-window-close"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{ trans('lang.dashboard_total_sales') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2"> <i class="fa fa-square" style="color:#80b140"></i>
                                    {{ trans('lang.dashboard_this_year') }} </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{ trans('lang.dashboard_service_overview') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex-row">
                                <canvas id="service-overview" height="222"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{ trans('lang.dashboard_sales_overview') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex-row">
                                <canvas id="sales-overview" height="222"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row daes-sec-sec">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header no-border d-flex justify-content-between">
                            <h3 class="card-title">{{ trans('lang.dashboard_recent_rides') }}</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">{{ trans('lang.order_id') }}</th>
                                        <th>{{ trans('lang.dashboard_user') }}</th>
                                        <th>{{ trans('lang.dashboard_driver') }}</th>
                                        <th>{{ trans('lang.location_details') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="append_list_recent_rides">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header no-border d-flex justify-content-between">
                            <h3 class="card-title">{{ trans('lang.dashboard_top_drivers') }}</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">{{ trans('lang.image') }}</th>
                                        <th>{{ trans('lang.driver') }}</th>
                                        <th>{{ trans('lang.rating') }}</th>
                                        <th>{{ trans('lang.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="append_list_top_drivers">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chart.js') }}"></script>


    <script type="text/javascript">
        jQuery("#data-table_processing").show();

        var database = firebase.firestore();

        var currency = database.collection('settings');
        const todayDate = new Date();
        todayDate.setHours(0, 0, 0, 0);

        var rides_data = [];
        var intercity_data = [];
        var currentCurrency = '';
        var currencyAtRight = false;
        var decimal_degits = 0;
        var refCurrency = database.collection('currency').where('enable', '==', true);
        refCurrency.get().then(async function(snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            currencyAtRight = currencyData.symbolAtRight;
            if (currencyData.decimalDigits) {
                decimal_degits = currencyData.decimalDigits;
            }
        });

        $(document).ready(function() {

            {{-- jQuery("#overlay").show(); --}}
            //today records
            database.collection('orders').where('createdDate', '>', todayDate).get().then((snapshot) => {

                jQuery("#total_rides_today").empty();
                jQuery("#total_rides_today").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').where('createdDate', '>', todayDate).get().then((snapshot) => {
                jQuery("#total_rides_today_intercity").empty();
                jQuery("#total_rides_today_intercity").text(
                    "{{ trans('lang.intercity_ride_plural') }} / " + snapshot.docs.length);
            });

            database.collection('orders').where('status', '==', 'Ride Placed').where('createdDate', '>', todayDate)
                .get().then((snapshot) => {
                    jQuery("#placed_count_today").empty();
                    jQuery("#placed_count_today").text(snapshot.docs.length);
                });

            database.collection('orders_intercity').where('status', '==', 'Ride Placed').where('createdDate', '>',
                todayDate).get().then((snapshot) => {
                jQuery("#placed_count_today_intercity").empty();
                jQuery("#placed_count_today_intercity").text(
                    "{{ trans('lang.intercity_ride_plural') }} / " + snapshot.docs.length);
            });

            database.collection('orders').where('status', '==', 'Ride Active').where('createdDate', '>', todayDate)
                .get().then((snapshot) => {
                    jQuery("#active_count_today").empty();
                    jQuery("#active_count_today").text(snapshot.docs.length);
                });

            database.collection('orders_intercity').where('status', '==', 'Ride Active').where('createdDate', '>',
                todayDate).get().then((snapshot) => {
                jQuery("#active_count_today_intercity").empty();
                jQuery("#active_count_today_intercity").text(
                    "{{ trans('lang.intercity_ride_plural') }} / " + snapshot.docs.length);
            });

            database.collection('orders').where('status', '==', 'Ride Completed').where('createdDate', '>',
                todayDate).get().then((snapshot) => {
                jQuery("#completed_count_today").empty();
                jQuery("#completed_count_today").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').where('status', '==', 'Ride Completed').where('createdDate',
                '>', todayDate).get().then((snapshot) => {
                jQuery("#completed_count_today_intercity").empty();
                jQuery("#completed_count_today_intercity").text(
                    "{{ trans('lang.intercity_ride_plural') }} / " + snapshot.docs.length);
            });

            database.collection('orders').where('status', '==', 'Ride Canceled').where('createdDate', '>',
                todayDate).get().then((snapshot) => {
                jQuery("#canceled_count_today").empty();
                jQuery("#canceled_count_today").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').where('status', '==', 'Ride Canceled').where('createdDate', '>',
                todayDate).get().then((snapshot) => {
                jQuery("#canceled_count_today_intercity").empty();
                jQuery("#canceled_count_today_intercity").text(
                    "{{ trans('lang.intercity_ride_plural') }} / " + snapshot.docs.length);
            });

            database.collection('users').where('createdAt', '>', todayDate).get().then((snapshot) => {
                jQuery("#users_count_today").empty();
                jQuery("#users_count_today").text(snapshot.docs.length);
            });

            
            database.collection('driver_users').where('createdAt', '>', todayDate).get().then((snapshot) => {
                jQuery("#driver_count_today").empty();
                jQuery("#driver_count_today").text(snapshot.docs.length);

                if (snapshot.docs.length > 0) {
                    let inercityDriversToday = 0;
                    snapshot.docs.forEach((listval) => {
                        val = listval.data();
                        if (val.serviceId != null) {
                            database.collection('service').doc(val.serviceId).get().then((
                                snapshot) => {
                                let data = snapshot.data();
                                if (data != "" && data != undefined) {
                                    if (data.intercityType == true) {
                                        inercityDriversToday++;
                                        jQuery("#driver_count_today_intercity").text(
                                            "{{ trans('lang.intercity') }} / " +
                                            inercityDriversToday);
                                    }
                                }
                            })
                        }
                    })
                }
            });


            //todal records
            database.collection('orders').get().then((snapshot) => {
                jQuery("#total_rides").empty();
                jQuery("#total_rides").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').get().then((snapshot) => {
                jQuery("#total_rides_intercity").empty();
                jQuery("#total_rides_intercity").text("{{ trans('lang.intercity_ride_plural') }} / " +
                    snapshot.docs.length);
            });

            database.collection('users').get().then((snapshot) => {
                jQuery("#users_count").empty();
                jQuery("#users_count").text(snapshot.docs.length);
            });

            database.collection('driver_users').get().then((snapshot) => {
                jQuery("#driver_count").empty();
                jQuery("#driver_count").text(snapshot.docs.length);

                if (snapshot.docs.length > 0) {
                    let inercityDrivers = 0;
                    snapshot.docs.forEach((listval) => {
                        val = listval.data();
                        if (val.serviceId != null) {
                            database.collection('service').doc(val.serviceId).get().then((
                                snapshot) => {
                                let data = snapshot.data();
                                if (data != "" && data != undefined) {
                                    if (data.intercityType == true) {
                                        inercityDrivers++;
                                        jQuery("#driver_count_intercity").text(
                                            "{{ trans('lang.intercity') }} / " +
                                            inercityDrivers);
                                    }
                                }
                            })
                        }
                    })
                }
            });

            database.collection('orders').where('status', '==', 'Ride Placed').get().then((snapshot) => {
                jQuery("#placed_count").empty();
                jQuery("#placed_count").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').where('status', '==', 'Ride Placed').get().then((snapshot) => {
                jQuery("#placed_count_intercity").empty();
                jQuery("#placed_count_intercity").text("{{ trans('lang.intercity_ride_plural') }} / " +
                    snapshot.docs.length);
            });

            database.collection('orders').where('status', '==', 'Ride Active').get().then((snapshot) => {
                jQuery("#active_count").empty();
                jQuery("#active_count").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').where('status', '==', 'Ride Active').get().then((snapshot) => {
                jQuery("#active_count_intercity").empty();
                jQuery("#active_count_intercity").text("{{ trans('lang.intercity_ride_plural') }} / " +
                    snapshot.docs.length);
            });

            database.collection('orders').where('status', '==', 'Ride Completed').get().then((snapshot) => {
                jQuery("#completed_count").empty();
                jQuery("#completed_count").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').where('status', '==', 'Ride Completed').get().then((
                snapshot) => {
                jQuery("#completed_count_intercity").empty();
                jQuery("#completed_count_intercity").text("{{ trans('lang.intercity_ride_plural') }} / " +
                    snapshot.docs.length);
            });

            database.collection('orders').where('status', '==', 'Ride Canceled').get().then((snapshot) => {
                jQuery("#canceled_count").empty();
                jQuery("#canceled_count").text(snapshot.docs.length);
            });

            database.collection('orders_intercity').where('status', '==', 'Ride Canceled').get().then((
                snapshot) => {
                jQuery("#canceled_count_intercity").empty();
                jQuery("#canceled_count_intercity").text("{{ trans('lang.intercity_ride_plural') }} / " +
                    snapshot.docs.length);
            });

            getTotalEarnings();
            getTotalEarningsToday();


            var offest = 1;
            var pagesize = 5;
            var limit = parseInt(offest) * parseInt(pagesize);
            var append_list_recent_rides = document.getElementById('append_list_recent_rides');
            append_list_recent_rides.innerHTML = '';

            database.collection('orders').orderBy('createdDate', 'desc').where('status', 'in', ["Ride Placed",
                "Ride Active"
            ]).limit(limit).get().then((snapshots) => {
                html = '';
                html = buildRidesHTML(snapshots);
                if (html != '') {
                    append_list_recent_rides.innerHTML = html;
                }
            });

            var append_listtop_drivers = document.getElementById('append_list_top_drivers');
            append_listtop_drivers.innerHTML = '';
            database.collection('driver_users').orderBy('reviewsCount', 'desc').limit(limit).get().then((
                snapshots) => {
                html = '';
                html = buildDriverHTML(snapshots);
                if (html != '') {
                    append_listtop_drivers.innerHTML = html;
                }
            });
        });

        function buildRidesHTML(snapshots) {
            var html = '';
            snapshots.docs.forEach((listval) => {
                val = listval.data();
                val.id = listval.id;
                var ride_id = val.id.substring(0, 7);

                var ride_route = '<?php echo route('rides.show', ':id'); ?>';
                ride_route = ride_route.replace(':id', val.id);

                html = html + '<tr>';

                html = html + '<td><a href="' + ride_route + '">' + ride_id + '</a></td>';
                if (val.userId != null) {
                    getUserName(val.userId, ride_id);
                }
                html = html + '<td class="user_name_' + ride_id + '"></td>';

                if (val.driverId != null) {
                    getDriverName(val.driverId, ride_id);
                }
                html = html + '<td class="driver_name_' + ride_id + '"></td>';

                html = html + '<td>';
                html = html + '<div class="live-tracking-list">';
                html = html + '<div class="live-tracking-box track-from">';
                html = html + '<div class="live-tracking-inner">';
                html = html + '<div class="location-ride">';
                html = html + '<div class="from-ride">' + val.destinationLocationName + '</div>';
                html = html + '<div class="to-ride">' + val.sourceLocationName + '</div>';
                html = html + '</div>';
                html = html + '</div>';
                html = html + '</div>';
                html = html + '</div>';
                html = html + '</td>';
                html = html + '</tr>';
            });
            return html;
        }

        function buildDriverHTML(snapshots) {
            var html = '';
            var count = 1;
            snapshots.docs.forEach((listval) => {
                val = listval.data();
                val.id = listval.id;
                var driverroute = '<?php echo route('drivers.view', ':id'); ?>';
                driverroute = driverroute.replace(':id', val.id);
                var placeholderImage = "{{ asset('/images/default_user.png') }}";

                html = html + '<tr>';
                if (val.profilePic == '') {
                    html = html +
                        '<td class="text-center"><img class="img-circle img-size-32" style="width:50px;height:50px;" src="' +
                        placeholderImage + '" alt="image"></td>';
                } else {
                    html = html +
                        '<td class="text-center"><img class="img-circle img-size-32" style="width:50px;height:50px;" src="' +
                        val.profilePic + '" alt="image"></td>';
                }
                // html=html+'<td>'+val.firstName+' '+val.lastName+'</td>';
                html = html + '<td class="redirecttopage"><a href="' + driverroute + '">' + val.fullName +
                    '</a></td>';
                html = html +
                    '<td class="redirecttopage"><div class="reviews-members-header"><div class="star-rating"><div class="d-inline-block" style="font-size: 14px;"> <ul class="rating" data-rating="' +
                    parseInt(val.reviewsCount) +
                    '"><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li></ul></div></div></div></td>';
                html = html + '<td class="redirecttopage"><a href="' + driverroute +
                    '" ><span class="fa fa-edit"></span></a></td>';
                html = html + '</tr>';
                count++;
            });
            return html;
        }

        async function getUserName(userId, id) {
            await database.collection('users').doc(userId).get().then(async function(snapshots) {
                var user = snapshots.data();
                var customer_view = '{{ route('users.view', ':id') }}';
                customer_view = customer_view.replace(':id', userId);
                $('.user_name_' + id).html('<a href="' + customer_view + '">' + user.fullName + '</a>');
            });
        }

        async function getDriverName(driverId, id) {
            await database.collection('driver_users').doc(driverId).get().then(async function(snapshots) {
                var driver = snapshots.data();
                var driver_view = '{{ route('drivers.view', ':id') }}';
                driver_view = driver_view.replace(':id', driverId);
                $('.driver_name_' + id).html('<a href="' + driver_view + '">' + driver.fullName + '</a>');
            });
        }

        async function getTotalEarnings() {
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
            var v01 = 0;
            var v02 = 0;
            var v03 = 0;
            var v04 = 0;
            var v05 = 0;
            var v06 = 0;
            var v07 = 0;
            var v08 = 0;
            var v09 = 0;
            var v10 = 0;
            var v11 = 0;
            var v12 = 0;
            var currentYear = new Date().getFullYear();

            await database.collection('orders').where('status', 'in', ["Ride Completed"]).get().then(async function(
                orderSnapshots) {

                var paymentData = orderSnapshots.docs;
                var totalEarning = 0;
                var adminCommission = 0;
                var discount = 0;

                paymentData.forEach((order) => {

                    var orderData = order.data();
                    var price = 0;

                    if (orderData.finalRate != null && orderData.finalRate != '' && orderData
                        .finalRate != undefined) {
                        price = orderData.finalRate;
                    } else {
                        price = orderData.offerRate;
                    }

                    if (orderData.coupon != undefined && orderData.coupon.amount != null) {
                        discount = orderData.coupon.amount;
                    }

                    if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(
                            discount)) {
                        discount = parseFloat(discount).toFixed(decimal_degits);
                        price = price - parseFloat(discount);
                    }
                    var adminCommissionPrice=price;
                    tax = 0;
                    if (orderData.taxList != undefined && $.isArray(orderData.taxList)) {
                        for (let i = 0; i < orderData.taxList.length; i++) {
                            let taxData = orderData.taxList[i];
                            if (taxData.type == "percentage") {
                                tax = tax + (parseFloat(taxData.tax) * price) / 100;
                            } else {
                                tax = tax + parseFloat(taxData.tax);
                            }
                        }
                    }

                    if (!isNaN(tax)) {
                        price = price + tax;
                    }

                    /*if(orderData.deliveryCharge != undefined && orderData.deliveryCharge != "" && orderData.deliveryCharge > 0){
                    	price = price + parseFloat(orderData.deliveryCharge);
                    }*/

                    if (orderData.adminCommission != undefined && orderData.adminCommission.type !=
                        undefined && orderData.adminCommission.amount > 0 && price > 0) {
                        var commission = 0;
                        if (orderData.adminCommission.type == "percentage") {
                            commission = (adminCommissionPrice * parseFloat(orderData.adminCommission.amount)) /
                                100;
                        } else {
                            commission = parseFloat(orderData.adminCommission.amount);
                        }
                        adminCommission = commission + adminCommission;
                    }

                    totalEarning = parseFloat(totalEarning) + parseFloat(price);

                    if (orderData.createdDate) {
                        var orderMonth = orderData.createdDate.toDate().getMonth() + 1;
                        var orderYear = orderData.createdDate.toDate().getFullYear();
                        if (currentYear == orderYear) {
                            switch (parseInt(orderMonth)) {
                                case 1:
                                    v01 = parseFloat(v01) + parseFloat(price);
                                    break;
                                case 2:
                                    v02 = parseFloat(v02) + parseFloat(price);
                                    break;
                                case 3:
                                    v03 = parseFloat(v03) + parseFloat(price);
                                    break;
                                case 4:
                                    v04 = parseFloat(v04) + parseFloat(price);
                                    break;
                                case 5:
                                    v05 = parseFloat(v05) + parseFloat(price);
                                    break;
                                case 6:
                                    v06 = parseFloat(v06) + parseFloat(price);
                                    break;
                                case 7:
                                    v07 = parseFloat(v07) + parseFloat(price);
                                    break;
                                case 8:
                                    v08 = parseFloat(v08) + parseFloat(price);
                                    break;
                                case 9:
                                    v09 = parseFloat(v09) + parseFloat(price);
                                    break;
                                case 10:
                                    v10 = parseFloat(v10) + parseFloat(price);
                                    break;
                                case 11:
                                    v11 = parseFloat(v11) + parseFloat(price);
                                    break;
                                default:
                                    v12 = parseFloat(v12) + parseFloat(price);
                                    break;
                            }
                        }
                    }
                });

                if (currencyAtRight) {
                    totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                    adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" +
                        currentCurrency;
                } else {
                    totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                    adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(
                        decimal_degits);
                }

                $("#earnings_count").append(totalEarning);
                $("#admincommission_count").append(adminCommission);

                rides_data = [v01, v02, v03, v04, v05, v06, v07, v08, v09, v10, v11, v12];

                getTotalEarningsIntercity(rides_data);
            });

            jQuery("#data-table_processing").hide();
        }

        async function getTotalEarningsIntercity(rides_data) {

            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
            var v01 = 0;
            var v02 = 0;
            var v03 = 0;
            var v04 = 0;
            var v05 = 0;
            var v06 = 0;
            var v07 = 0;
            var v08 = 0;
            var v09 = 0;
            var v10 = 0;
            var v11 = 0;
            var v12 = 0;
            var currentYear = new Date().getFullYear();

            await database.collection('orders_intercity').where('status', '==', 'Ride Completed').get().then(async function(
                orderSnapshots) {

                var paymentData = orderSnapshots.docs;
                var totalEarning = 0;
                var adminCommission = 0;
                var discount = 0;

                paymentData.forEach((order) => {

                    var orderData = order.data();
                    var price = 0;

                    if (orderData.finalRate != null && orderData.finalRate != '' && orderData
                        .finalRate != undefined) {
                        price = orderData.finalRate;
                    } else {
                        price = orderData.offerRate;
                    }

                    if (orderData.coupon != undefined && orderData.coupon.amount != null) {
                        discount = orderData.coupon.amount;
                    }

                    if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(
                            discount)) {
                        discount = parseFloat(discount).toFixed(decimal_degits);
                        price = price - parseFloat(discount);
                    }
                    var adminCommissionPrice = price;

                    tax = 0;
                    if (orderData.taxList != undefined && $.isArray(orderData.taxList)) {
                        for (let i = 0; i < orderData.taxList.length; i++) {
                            let taxData = orderData.taxList[i];
                            if (taxData.type == "percentage") {
                                tax = tax + (parseFloat(taxData.tax) * price) / 100;
                            } else {
                                tax = tax + parseFloat(taxData.tax);
                            }
                        }
                    }

                    if (!isNaN(tax)) {
                        price = price + tax;
                    }

                    /*if(orderData.deliveryCharge != undefined && orderData.deliveryCharge != "" && orderData.deliveryCharge > 0){
                    	price = price + parseFloat(orderData.deliveryCharge);
                    }*/

                    if (orderData.adminCommission != undefined && orderData.adminCommission.type !=
                        undefined && orderData.adminCommission.amount > 0 && price > 0) {
                        var commission = 0;
                        if (orderData.adminCommission.type == "percentage") {
                            commission = (adminCommissionPrice * parseFloat(orderData.adminCommission.amount)) /
                                100;
                        } else {
                            commission = parseFloat(orderData.adminCommission.amount);
                        }
                        adminCommission = commission + adminCommission;
                    }

                    totalEarning = parseFloat(totalEarning) + parseFloat(price);

                    if (orderData.createdDate) {
                        var orderMonth = orderData.createdDate.toDate().getMonth() + 1;
                        var orderYear = orderData.createdDate.toDate().getFullYear();
                        if (currentYear == orderYear) {
                            switch (parseInt(orderMonth)) {
                                case 1:
                                    v01 = parseFloat(v01) + parseFloat(price);
                                    break;
                                case 2:
                                    v02 = parseFloat(v02) + parseFloat(price);
                                    break;
                                case 3:
                                    v03 = parseFloat(v03) + parseFloat(price);
                                    break;
                                case 4:
                                    v04 = parseFloat(v04) + parseFloat(price);
                                    break;
                                case 5:
                                    v05 = parseFloat(v05) + parseFloat(price);
                                    break;
                                case 6:
                                    v06 = parseFloat(v06) + parseFloat(price);
                                    break;
                                case 7:
                                    v07 = parseFloat(v07) + parseFloat(price);
                                    break;
                                case 8:
                                    v08 = parseFloat(v08) + parseFloat(price);
                                    break;
                                case 9:
                                    v09 = parseFloat(v09) + parseFloat(price);
                                    break;
                                case 10:
                                    v10 = parseFloat(v10) + parseFloat(price);
                                    break;
                                case 11:
                                    v11 = parseFloat(v11) + parseFloat(price);
                                    break;
                                default:
                                    v12 = parseFloat(v12) + parseFloat(price);
                                    break;
                            }
                        }
                    }

                })

                if (currencyAtRight) {
                    totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                    adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" +
                        currentCurrency;
                } else {
                    totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                    adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(
                        decimal_degits);
                }

                $("#earnings_count_intercity").append("{{ trans('lang.intercity') }} / " + totalEarning);
                $("#admincommission_count_intercity").append("{{ trans('lang.intercity') }} / " +
                    adminCommission);

                intercity_data = [v01, v02, v03, v04, v05, v06, v07, v08, v09, v10, v11, v12];
                var labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV',
                    'DEC'
                ];
                var $salesChart = $('#sales-chart');

                salesChart($salesChart, rides_data, intercity_data, labels);
                serviceOverview();
                salesOverview();
                getTotalEarningsIntercityToday();
                jQuery("#overlay").hide();
            })
        }
        async function getTotalEarningsToday() {
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
            var v01 = 0;
            var v02 = 0;
            var v03 = 0;
            var v04 = 0;
            var v05 = 0;
            var v06 = 0;
            var v07 = 0;
            var v08 = 0;
            var v09 = 0;
            var v10 = 0;
            var v11 = 0;
            var v12 = 0;
            var currentYear = new Date().getFullYear();

            await database.collection('orders').where('status', 'in', ["Ride Completed"]).where('createdDate', '>=', todayDate)
                .get().then(async function(orderSnapshots) {

                    var paymentData = orderSnapshots.docs;

                    var totalEarning = 0;
                    var adminCommission = 0;
                    var discount = 0;

                    paymentData.forEach((order) => {

                        var orderData = order.data();
                        var price = 0;

                        if (orderData.finalRate != null && orderData.finalRate != '' && orderData
                            .finalRate != undefined) {
                            price = orderData.finalRate;
                        } else {
                            price = orderData.offerRate;
                        }
                        if (orderData.coupon != undefined && orderData.coupon.amount != null) {
                            discount = orderData.coupon.amount;
                        }

                        if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(
                                discount)) {
                            discount = parseFloat(discount).toFixed(decimal_degits);
                            price = price - parseFloat(discount);
                        }
                        var AdminCommissionPrice=price;
                        tax = 0;
                        var totalTaxAmount=0;
                        if (orderData.taxList != undefined && orderData.taxList!='') {
                            for (let i = 0; i < orderData.taxList.length; i++) {
                                let taxData = orderData.taxList[i];
                                if (taxData.type == "percentage") {
                                    tax =  (parseFloat(taxData.tax) * price) / 100;
                                } else {
                                    tax =  parseFloat(taxData.tax);
                                }
                                totalTaxAmount=totalTaxAmount+tax;
                            }
                        }

                        if (!isNaN(totalTaxAmount)) {
                            price = price + totalTaxAmount;
                        }

                        if (orderData.adminCommission != undefined && orderData.adminCommission.type !=
                            undefined && orderData.adminCommission.amount > 0 && price > 0) {
                            var commission = 0;
                            if (orderData.adminCommission.type == "percentage") {
                                commission = (AdminCommissionPrice * parseFloat(orderData.adminCommission.amount)) /
                                    100;
                            } else {
                                commission = parseFloat(orderData.adminCommission.amount);
                            }
                            adminCommission = commission + adminCommission;
                        }

                        totalEarning = parseFloat(totalEarning) + parseFloat(price);

                    })

                    if (currencyAtRight) {
                        totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                        adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" +currentCurrency;
                    } else {
                        totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                        adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(decimal_degits);
                    }

                    $("#earnings_count_today").append(totalEarning);
                    $("#admincommission_count_today").append(adminCommission);

                });

            jQuery("#data-table_processing").hide();

        }
        async function getTotalEarningsIntercityToday() {

            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

            await database.collection('orders_intercity').where('status', '==', 'Ride Completed').where('createdDate', '>',
                todayDate).get().then(async function(orderSnapshots) {

                var paymentData = orderSnapshots.docs;
                var totalEarning = 0;
                var adminCommission = 0;
                var discount = 0;

                paymentData.forEach((order) => {

                    var orderData = order.data();
                    var price = 0;

                    if (orderData.finalRate != null && orderData.finalRate != '' && orderData
                        .finalRate != undefined) {
                        price = orderData.finalRate;
                    } else {
                        price = orderData.offerRate;
                    }

                    if (orderData.coupon != undefined && orderData.coupon.amount != null) {
                        discount = orderData.coupon.amount;
                    }

                    if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(
                        discount)) {
                        discount = parseFloat(discount).toFixed(decimal_degits);
                        price = price - parseFloat(discount);
                    }
                    var adminCommissionPrice=price;

                    tax = 0;

                    if (orderData.taxList != undefined && $.isArray(orderData.taxList)) {
                        for (let i = 0; i < orderData.taxList.length; i++) {
                            let taxData = orderData.taxList[i];
                            if (taxData.type == "percentage") {
                                tax = tax + (parseFloat(taxData.tax) * price) / 100;
                            } else {
                                tax = tax + parseFloat(taxData.tax);
                            }
                        }
                    }

                    if (!isNaN(tax)) {
                        price = price + tax;
                    }

                    /*if(orderData.deliveryCharge != undefined && orderData.deliveryCharge != "" && orderData.deliveryCharge > 0){
                    	price = price + parseFloat(orderData.deliveryCharge);
                    }*/

                    if (orderData.adminCommission != undefined && orderData.adminCommission.type !=
                        undefined && orderData.adminCommission.amount > 0 && price > 0) {
                        var commission = 0;
                        if (orderData.adminCommission.type == "percentage") {
                            commission = (adminCommissionPrice * parseFloat(orderData.adminCommission.amount)) /
                                100;
                        } else {
                            commission = parseFloat(orderData.adminCommission.amount);
                        }
                        adminCommission = commission + adminCommission;
                    }

                    totalEarning = parseFloat(totalEarning) + parseFloat(price);

                })

                if (currencyAtRight) {
                    totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                    adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" +
                        currentCurrency;
                } else {
                    totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                    adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(
                        decimal_degits);
                }

                $("#earnings_count_today_intercity").append("{{ trans('lang.intercity') }} / " +
                    totalEarning);
                $("#admincommission_count_today_intercity").append("{{ trans('lang.intercity') }} / " +
                    adminCommission);
            })

        }

        function salesChart(chartNode, rides_data, intercity_data, labels) {
            var ticksStyle = {
                fontColor: '#666',
                fontStyle: 'bold'
            };

            var mode = 'index';
            var intersect = true;
            return new Chart(chartNode, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: "{{ trans('lang.order_plural') }}",
                            backgroundColor: '#80b140',
                            data: rides_data
                        },
                        {
                            label: "{{ trans('lang.intercity') }}",
                            backgroundColor: '#000000',
                            data: intercity_data
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return currentCurrency + parseFloat(value).toFixed(decimal_degits);
                            }
                        },
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: true
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    return currentCurrency + value.toFixed(decimal_degits);
                                }


                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        }

        function serviceOverview() {

            const data = {
                labels: [
                    "{{ trans('lang.dashboard_total_orders') }}",
                    "{{ trans('lang.dashboard_total_clients') }}",
                    "{{ trans('lang.dashboard_total_drivers') }}",
                    "{{ trans('lang.dashboard_ride_placed') }}",
                    "{{ trans('lang.dashboard_ride_active') }}",
                    "{{ trans('lang.dashboard_ride_completed') }}",
                    "{{ trans('lang.dashboard_ride_canceled') }}",
                ],
                datasets: [{
                    data: [
                        jQuery("#total_rides").text(),
                        jQuery("#users_count").text(),
                        jQuery("#driver_count").text(),
                        jQuery("#placed_count").text(),
                        jQuery("#active_count").text(),
                        jQuery("#completed_count").text(),
                        jQuery("#canceled_count").text(),
                    ],
                    backgroundColor: [
                        '#218be1',
                        '#5865F2',
                        '#FF0000',
                        '#FFAB2E',
                        '#FF683A',
                        '#80b140',
                        '#000000',
                    ],
                    hoverOffset: 4
                }]
            };

            return new Chart('service-overview', {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                }
            });
        }

        function salesOverview() {

            const data = {
                labels: [
                    "{{ trans('lang.dashboard_total_earnings') }}",
                    "{{ trans('lang.dashboard_admin_commission') }}",
                    "{{ trans('lang.dashboard_total_earnings_intercity') }}",
                    "{{ trans('lang.dashboard_admin_commission_intercity') }}",
                ],
                datasets: [{
                    data: [
                        jQuery("#earnings_count").text().replace(currentCurrency, ""),
                        jQuery("#admincommission_count").text().replace(currentCurrency, ""),
                        jQuery("#earnings_count_intercity").text().match(/\d+/)[0],
                        jQuery("#admincommission_count_intercity").text().match(/\d+/)[0],
                    ],
                    backgroundColor: [
                        '#80b140',
                        '#000000',
                        '#5865F2',
                        '#800000',
                    ],
                    hoverOffset: 4
                }]
            };
            return new Chart('sales-overview', {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItems, data) {
                                return data.labels[tooltipItems.index] + ': ' + currentCurrency + data.datasets[
                                    0].data[tooltipItems.index];
                            }
                        }
                    }
                }
            })
        }
    </script>
@endsection
