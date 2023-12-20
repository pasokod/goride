@extends('layouts.app')

@section('content')
<div class="page-wrapper pb-5">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.intercity_order_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item"><a href="{!! route('intercity-service-rides') !!}">{{trans('lang.intercity_order_plural')}}</a>
                </li>

                <li class="breadcrumb-item">{{trans('lang.order_show')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-body p-0 no_data_found">

            <div class="col-md-12">
                <div class="print-top non-printable mt-3">
                    <div class="text-right print-btn non-printable">
                        <button type="button" class="fa fa-print non-printable" onclick="printDiv('printableArea')"></button>
                    </div>
                </div>

                <hr class="non-printable">
            </div>

            <div class="row restaurant_payout_create" style="max-width:100%;" role="tabpanel" id="printableArea">

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="category_information">
                        <div class="order_detail" id="order_detail">

                            <div class="order_detail-top mb-3 printableArea">
                                <div class="row">


                                    <div class="order_edit-genrl col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-white">
                                                <h3>{{trans('lang.general_details')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="order_detail-top-box">
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.ride_id')}}
                                                                : </strong><span id="ride_id"></span></label>

                                                    </div>

                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.date_created')}}
                                                                : </strong><span id="createdAt"></span></label>

                                                    </div>

                                                    <div class="form-group row widt-100 gendetail-col payment_method">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.payment_status')}}
                                                                : </strong><span id="payment_status"></span></label>

                                                    </div>


                                                    <div class="form-group row widt-100 gendetail-col payment_method">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.payment_methods')}}
                                                                : </strong><span id="payment_method"></span></label>

                                                    </div>

                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.ride_status')}}
                                                                :</strong> <span id="order_status"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.ride_distance')}}
                                                                :</strong> <span id="distance"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.ride_date')}}
                                                                :</strong> <span id="ride_date"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.ride_time')}}
                                                                :</strong> <span id="ride_time"></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class=" order_edit-genrl col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-white">
                                                <h3>{{ trans('lang.billing_details')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="address order_detail-top-box user-details">
                                                    <p><strong>{{trans('lang.name')}}: </strong><span id="billing_name" class="d-flex"></span></p>

                                                    <p><strong>{{trans('lang.email')}}:</strong>
                                                        <span id="billing_email"></span>
                                                    </p>
                                                    <p><strong>{{trans('lang.phone')}}:</strong>
                                                        <span id="billing_phone"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card service-details">
                                            <div class="card-header bg-white">
                                                <h3>{{ trans('lang.service_details')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="address order_detail-top-box">
                                                    <p><strong>{{trans('lang.service_name')}}: </strong><span id="service_name"></span></p>

                                                    <p id="no_of_passanger">
                                                        <strong>{{trans('lang.no_of_passangers')}}:</strong>
                                                        <span id="no_of_passangers"></span>
                                                    </p>
                                                    <div class="parcel-data">
                                                        <p><strong>{{trans('lang.parcel_dimension')}}
                                                                : </strong><span id="parcel_dimension"></span></p>
                                                        <p><strong>{{trans('lang.parcel_weight')}}: </strong><span id="parcel_weight"></span></p>
                                                        <p><strong>{{trans('lang.parcel_image')}}: </strong><span id="parcel_image"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row ride-map-dredetail">
                                <div class="col-md-7 " id="ride-map-dredetail">
                                    <div class="card">
                                        <div class="box card-body p-0">
                                            <div class="box-header bb-2 card-header bg-white">
                                                <h3 class="box-title">{{trans('lang.map_view')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div id="map" style="height:300px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 ride-map-dredetail-rg">
                                    <div class="card">
                                        <div class="order_addre-edit ">
                                            <div class="card-header bg-white d-flex align-items-center">
                                                <h3>{{ trans('lang.awarded_driver_detail')}}</h3>
                                                <span class="badge badge-success ml-auto" style="display: block;white-space: nowrap;">Awarded</span>

                                            </div>
                                            <div class="card-body ">
                                                <div class="address order_detail-top-box driver_detail">
                                                    <p><strong>{{trans('lang.driver_name')}}:</strong>
                                                        <span id="driver_name" class="d-flex"></span> <br>
                                                    </p>
                                                    <p><strong>{{trans('lang.email')}}:</strong>
                                                        <span id="driver_email"></span>
                                                    </p>
                                                    <p><strong>{{trans('lang.phone')}}:</strong>
                                                        <span id="driver_phone"></span>
                                                    </p>
                                                    <p><strong>{{trans('lang.vehicle_type')}}:</strong>
                                                        <span id="vehicle_type"></span>
                                                    </p>
                                                    <p><strong>{{trans('lang.vehicle_number')}}:</strong>
                                                        <span id="vehicle_number"></span>

                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row ride-loct-pricedet printableArea">
                                <div class="col-md-7 ">
                                    <div class="card">
                                        <div class="box card-body p-0">
                                            <div class="box-header bb-2 card-header bg-white">
                                                <h3 class="box-title">{{trans('lang.location_details')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="live-tracking-list">
                                                    <div class="live-tracking-box track-from">
                                                        <div class="live-tracking-inner">
                                                            <div class="location-ride">
                                                                <div class="from-ride"></div>
                                                                <div class="to-ride"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="box-header bb-2 card-header bg-white">
                                            <h3>{{trans("lang.ride_reviews")}}</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="order_detail-review mt-0">
                                                <h4>{{trans("lang.reviews_for_customer")}}</h4>
                                                <div class="rental-review">
                                                    <div class="review-inner">

                                                        <div id="customers_rating_and_review">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="order_detail-review mt-4">
                                                <h4>{{trans("lang.reviews_for_driver")}}</h4>
                                                <div class="rental-review">
                                                    <div class="review-inner">

                                                        <div id="driver_rating_and_review">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-5 ml-auto">
                                    <div class="card">
                                        <div class="order_addre-edit ">
                                            <div class="card-header bg-white">
                                                <h3>{{ trans('lang.price_detail')}}</h3>
                                            </div>
                                            <div class="card-body price_detail">
                                                <div class="order-deta-btm-right">
                                                    <div class="order-totals-items pt-0">
                                                        <div class="row">
                                                            <div class="col-md-12 ml-auto">
                                                                <div class="table-responsive bk-summary-table">
                                                                    <table class="order-totals">

                                                                        <tbody id="order_products_total">

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

                            <div class="row printableArea">
                                <div class="col-md-7">
                                    <div class="card">

                                        <div class="box-header bb-2 card-header bg-white">
                                            <h3 class="box-title">{{trans('lang.applied_drivers')}}</h3>
                                        </div>
                                        <div class="card-body">

                                            <div id="applied_drivers"></div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 booked_for_someone" style="display: none">
                                <div class="card">

                                    <div class="box-header bb-2 card-header bg-white">
                                        <h3 class="box-title">{{trans('lang.booked_for')}}</h3>
                                    </div>
                                    <div class="card-body">

                                        <div id="booked_for">


                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 text-center btm-btn">
                <a href="{!! route('intercity-service-rides') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
                </a>

            </div>

        </div>


    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var database = firebase.firestore();

    var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');

    var decimal_degits = 0;
    var symbolAtRight = false;
    var currentCurrency = '';
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    refCurrency.get().then(async function(snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        decimal_degits = currencyData.decimalDigits;

        if (currencyData.symbolAtRight) {
            symbolAtRight = true;
        }
    });

    var refData = database.collection('orders_intercity').where('id', '==', '{{$id}}');


    $(document).ready(async function() {
        $('.intercity_service_sub_menu li').each(function() {
            var url = $(this).find('a').attr('href');
            if (url == document.referrer) {
                $(this).find('a').addClass('active');
                $('.intercity_service_menu').addClass('active').attr('aria-expanded', true);
            }
            $('.intercity_service_sub_menu').addClass('in').attr('aria-expanded', true);
        });
        getRideDeatils();
    });

    async function getRideDeatils() {
        jQuery("#overlay").show();
        await refData.get().then(async function(snapshots) {
            if (snapshots.docs[0]) {
                var orders = snapshots.docs[0].data();
                getCutomerReview(orders);
                getDriverReview(orders);
                getAppliedDriver(orders);
                var user_id = orders.userId;
                if (orders.createdDate) {
                    var date1 = orders.createdDate.toDate().toDateString();
                    var date = new Date(date1);
                    var dd = String(date.getDate()).padStart(2, '0');
                    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = date.getFullYear();
                    var createdAt_val = yyyy + '-' + mm + '-' + dd;
                    var time = orders.createdDate.toDate().toLocaleTimeString('en-US');

                    $('#createdAt').text(createdAt_val + ' ' + time);
                }
                $('#ride_id').html(orders.id);
                if (orders.paymentStatus) {
                    $('#payment_status').html('<span class="badge badge-success py-2 px-3">Paid</span>');
                } else {
                    $('#payment_status').html('<span class="badge badge-warning py-2 px-3">Not Paid</span>');
                }
                if (orders.paymentType) {
                    getPaymentImage(orders.paymentType);
                } else {
                    $('#payment_method').html("-");
                }

                if (orders.status == "Ride Placed") {
                    $('#order_status').html('<span class="badge badge-primary py-2 px-3">' + orders.status + '</span>');
                } else if (orders.status == "Ride Completed") {
                    $('#order_status').html('<span class="badge badge-success py-2 px-3">' + orders.status + '</span>');
                } else if (orders.status == "Ride Active") {
                    $('#order_status').html('<span class="badge badge-warning py-2 px-3">' + orders.status + '</span>');
                } else if (orders.status == "Ride InProgress") {
                    $('#order_status').html('<span class="badge badge-info py-2 px-3">' + orders.status + '</span>');
                } else if (orders.status == "Ride Canceled") {
                    $('#order_status').html('<span class="badge badge-danger py-2 px-3">' + orders.status + '</span>');
                }
                if (orders.hasOwnProperty('distanceType')) {
                    $('#distance').html(parseFloat(orders.distance).toFixed(2) + " " + orders.distanceType);
                } else {
                    $('#distance').html(parseFloat(orders.distance).toFixed(2) + " Km");
                }
                if (orders.hasOwnProperty('someOneElse')) {
                    $('.booked_for_someone').show();
                    $('#booked_for').html('<p><strong>{{trans("lang.name")}}:</strong><span id="full_name"> ' + orders.someOneElse.full_name + '</span></p><p><strong>{{trans("lang.contact_number")}}:</strong><span id="contact_number"> ' + orders.someOneElse.contact_number + '</span></p>')
                } else {
                    $('.booked_for_someone').hide();
                }
                $("#ride_date").html(orders.whenDates);
                $("#ride_time").html(formatTime(orders.whenTime));

                if (orders.intercityService) {
                    if (orders.intercityService.image != '' && orders.intercityService.image != null) {
                        profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + orders.intercityService.image + '" alt="Image"></span>';
                    } else {
                        profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="Image"></span>';
                    }
                    $('#service_name').html(profile + orders.intercityService.name);
                    if (orders.numberOfPassenger) {
                        $('#no_of_passangers').html(orders.numberOfPassenger);
                    } else {
                        $('#no_of_passanger').hide();
                    }
                    if (orders.intercityService.name == 'Parcel') {
                        $('#parcel_dimension').html(orders.parcelDimension + " ft");
                        $('#parcel_weight').html(orders.parcelWeight + ' Kg');
                        if (orders.parcelImage[0] != '' && orders.parcelImage[0] != null) {
                            parcelImage = '<img style="width:50px" src="' + orders.parcelImage[0] + '" alt="Image">';
                        } else {
                            parcelImage = '<img style="width:50px" src="' + placeholderImage + '" alt="Image">';
                        }
                        $('#parcel_image').html(parcelImage);
                    } else {
                        $(".parcel-data").hide();
                    }
                } else {
                    $('.service-details').html('<h3>{{trans("lang.no_details_found")}}</h3>');
                }


                var user_info = getUserInfo(user_id);

                if (orders.driverId) {
                    var driver_id = orders.driverId;

                    var driver_info = getDriverInfo(driver_id);
                } else {
                    $('.driver_detail').html('<h3>{{trans("lang.no_driver_found")}}</h3>');
                }

                var order_details = getOrderDetails(orders);

            } else {
                $('.no_data_found').html('<p align="center">{{trans("lang.no_data_found")}}</p>');
            }

        });
        jQuery("#overlay").hide();
    }

    function formatTime(timeString) {
        const [hourString, minute] = timeString.split(":");
        const hour = +hourString % 24;
        return (hour % 12 || 12) + ":" + minute + (hour < 12 ? " AM" : " PM");
    }

    async function getCutomerReview(orders) {
        var refCustomerReview = database.collection('review_customer').where('id', "==", orders.id);
        refCustomerReview.get().then(async function(userreviewsnapshot) {
            var reviewHTML = '';
            reviewHTML = buildCustomerRatingsHTML(orders, userreviewsnapshot);

            if (userreviewsnapshot.docs.length > 0) {
                jQuery("#customers_rating_and_review").append(reviewHTML);
            } else {
                jQuery("#customers_rating_and_review").html('<h5 class="no-review">No Reviews Found</h5>');
            }
        });
    }

    async function getDriverReview(orders) {
        var refDriverReview = database.collection('review_driver').where('id', "==", orders.id);
        refDriverReview.get().then(async function(driverreviewsnapshot) {
            var reviewHTML = '';
            reviewHTML = buildDriverRatingsHTML(orders, driverreviewsnapshot);

            if (driverreviewsnapshot.docs.length > 0) {
                jQuery("#driver_rating_and_review").append(reviewHTML);
            } else {
                jQuery("#driver_rating_and_review").html('<h5 class="no-review">{{trans("lang.no_reviews_found")}}</h5>');
            }
        });
    }

    async function getAppliedDriver(orders) {
        database.collection('orders_intercity').doc(orders.id).collection('acceptedDriver').get().then(async function(snapshot) {
            var appliedDriverHTML = '';
            appliedDriverHTML = await buildAppliedDriverHTML(orders, snapshot);
            //console.log(appliedDriverHTML);
            if (appliedDriverHTML != '') {
                jQuery("#applied_drivers").html(appliedDriverHTML);
            } else {
                jQuery("#applied_drivers").html('<h5 class="no-review">{{trans("lang.no_driver_applied")}}</h5>');
            }

        });
    }

    async function getPaymentImage(paymentType) {

        await database.collection('settings').doc('payment').get().then(async function(snapshots) {

            var payment = snapshots.data();
            type = paymentType.toLowerCase();
            if (type == "stripe") {
                type = "strip";
            }
            payment = payment[type];
            if (payment != undefined) {
                /*$('#payment_method').html('<img style="width:50px" src="' + payment.image + '" alt="image">' + " (" + paymentType + ")");*/
                $('#payment_method').html('<img src="' + payment.image + '" alt="image">');
            }
        });
    }

    async function getDriverInfo(driverId, awarded = null, orderDriverId = '', date = '', time = '', offerRate = '', rejectedDriverIds) {

        await database.collection('driver_users').where('id', '==', driverId).get().then(async function(snapshots) {
            if (snapshots.docs.length > 0) {

                var driver = snapshots.docs[0].data();
                var rating = 0;
                var reviewsCount = 0;
                if (driver.hasOwnProperty('reviewsCount') && driver.reviewsCount && driver.reviewsCount != "0.0" && driver.reviewsCount != null && driver.hasOwnProperty('reviewsSum') && driver.reviewsSum && driver.reviewsSum != "0.0" && driver.reviewsSum != null) {

                    rating = (parseFloat(driver.reviewsSum) / parseFloat(driver.reviewsCount));

                    rating = (rating * 10) / 10;

                    reviewsCount = parseInt(driver.reviewsCount);
                }
                if (driver.profilePic != '' && driver.profilePic != null) {
                    profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + driver.profilePic + '" alt="Image"></span>';
                } else {
                    profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="Image"></span>';
                }
                if (awarded != null) {


                    var html = '';
                    if (rejectedDriverIds == null || rejectedDriverIds.includes(driverId) != true || orderDriverId == driverId) {
                        html += '<div class="applied_drivers_list mt-3">';

                        html += ' <div class="d-flex"><div class="d-flex align-items-center driver_apply-left">';

                        html += profile + '<div class="applied_drivers_cont"><h4>' + driver.fullName + '</h4>';

                        html += '<div class="drivers-suggest"><span><label>{{trans("lang.suggested_date")}} :</label> ' + date + '</span><span><label>{{trans("lang.suggested_time")}} :</label> ' + formatTime(time) + '</span></div></div>';


                        html += '</div><div class="ml-auto app-drrg"><span class="driver-rate">' + offerRate + '</span>';
                        html += '<span class="badge badge-warning text-white dr-review mb-3"><i class="fa fa-star"></i>' + (rating).toFixed(1) + '</span>';

                        if (orderDriverId != '' && orderDriverId != null) {
                            if (orderDriverId == driverId) {

                                html += '<span class="badge badge-success" style="display: block;white-space: nowrap;">{{trans("lang.awarded")}}</span>';

                            }
                        }

                        html += '</div></div></div>';

                    }
                    $('.apply_drivers_div_' + driverId).html(html);

                } else {


                    ratingHtml = '<span class="badge badge-warning text-white ml-auto" ><i class="fa fa-star" ></i>' + (rating).toFixed(1) + '</span>';
                    driverHtml = '<div class="drove-det"><span class="drv-name">' + driver.fullName + '</span>' + ratingHtml + '</div>';
                    $('#driver_name').html(profile + driverHtml);

                    $('#driver_email').html(driver.email);
                    $('#driver_phone').html(driver.countryCode + '-' + driver.phoneNumber);
                    if (driver.vehicleInformation) {
                        $('#vehicle_type').html(driver.vehicleInformation.vehicleType);
                        $('#vehicle_number').html(driver.vehicleInformation.vehicleNumber);
                    }
                }
            } else {
                if (awarded != null) {
                    $('.apply_drivers_div_' + driverId).html('<div class="applied_drivers_list mt-3"><div class="d-flex"><div class="d-flex align-items-center driver_apply-left"><div class="applied_drivers_cont"><h4>{{trans("lang.unknown_user")}}</h4></div></div></div></div>');

                } else {
                    $(".driver_detail").html('<p>{{trans("lang.unknown_user")}}</p>');

                }
            }


        });
    }

    async function getUserInfo(userId) {

        await database.collection('users').where('id', '==', userId).get().then(async function(snapshots) {

            if (snapshots.docs.length > 0) {
                var user = snapshots.docs[0].data();
                if (user.profilePic != '' && user.profilePic != null) {
                    profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + user.profilePic + '" alt="Image"></span>';
                } else {
                    profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="Image"></span>';
                }

                var rating = 0;
                var reviewsCount = 0;
                if (user.hasOwnProperty('reviewsCount') && user.reviewsCount && user.reviewsCount != "0.0" && user.reviewsCount != null && user.hasOwnProperty('reviewsSum') && user.reviewsSum && user.reviewsSum != "0.0" && user.reviewsSum != null) {

                    rating = (parseFloat(user.reviewsSum) / parseFloat(user.reviewsCount));

                    rating = (rating * 10) / 10;

                    reviewsCount = parseInt(user.reviewsCount);
                }

                var ratingHtml = '<span class="badge badge-warning text-white ml-auto" ><i class="fa fa-star" ></i>' + (rating).toFixed(1) + '</span>';

                var userHtml = '<div class="drove-det"><span class="drv-name">' + user.fullName + '</span>' + ratingHtml + '</div>';
                $('#billing_name').html(profile + userHtml);

                //$('#billing_name').html(profile + user.fullName);
                $('#billing_email').html(user.email);
                $('#billing_phone').html(user.countryCode + '-' + user.phoneNumber);
            } else {
                $(".user-details").html('<p>{{trans("lang.unknown_user")}}</p>');
            }

        });
    }

    function getOrderDetails(orderData) {

        $('.from-ride').html(orderData.sourceLocationName);
        $('.to-ride').html(orderData.destinationLocationName);

        var order_amount_html = '';
        if (orderData.driverId) {

            var amount = 0;
            if (orderData.offerRate) {
                amount = parseFloat(orderData.offerRate);
            }

            var total_amount = 0;

            var transactionId = getTransactionId(orderData.id);

            order_amount_html += '<tr class="transaction_id_' + orderData.id + '"></tr>';

            order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.ride_price")}}</span></td></tr>';

            if (symbolAtRight) {
                order_amount_html += '<tr ><td class="label">{{trans("lang.offer_rate")}}</td><td>' + amount.toFixed(decimal_degits) + currentCurrency + '</td></tr>';

            } else {
                order_amount_html += '<tr><td class="label">{{trans("lang.offer_rate")}}</td><td>' + currentCurrency + amount.toFixed(decimal_degits) + '</td></tr>';

            }
            if (orderData.finalRate) {
                amount = parseFloat(orderData.finalRate);

            }

            if (symbolAtRight) {
                order_amount_html += '<tr class="final-rate"><td class="label">{{trans("lang.final_rate")}}</td><td>' + amount.toFixed(decimal_degits) + currentCurrency + '</td></tr>';

            } else {
                order_amount_html += '<tr class="final-rate"><td class="label">{{trans("lang.final_rate")}}</td><td>' + currentCurrency + amount.toFixed(decimal_degits) + '</td></tr>';
            }
            total_amount = amount;
            discount_amount = 0;
            if (orderData.hasOwnProperty('coupon') && orderData.coupon.enable) {
                order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.discount_calculation")}}</span></td></tr>';
                var data = orderData.coupon;

                order_amount_html += '';

                var discount_html = '<tr><td class="label">' + data.title + '(';

                if (data.type == "fix") {
                    discount_amount = data.amount;
                    if (symbolAtRight) {
                        discount_html += parseFloat(data.amount).toFixed(decimal_degits) + currentCurrency;

                    } else {
                        discount_html += currentCurrency + parseFloat(data.amount).toFixed(decimal_degits);

                    }

                } else {
                    discount_html += data.amount + '%';
                    discount_amount = (data.amount * amount) / 100;
                }

                discount_amount = parseFloat(discount_amount).toFixed(decimal_degits);

                discount_html += ')</td>';

                if (symbolAtRight) {
                    discount_html += '<td><span style="color:red">(-' + discount_amount + currentCurrency + ')</span></td>';

                } else {
                    discount_html += '<td><span style="color:red">(-' + currentCurrency + discount_amount + ')</span></td>';
                }

                discount_html += '</tr>';

                total_amount -= parseFloat(discount_amount);

                order_amount_html += discount_html;

            }

            if (orderData.hasOwnProperty('taxList') && orderData.taxList.length > 0) {
                order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.tax_calculation")}}</span></td></tr>';
                var taxData = orderData.taxList;
                order_amount_html += '';
                var tax_amount_total = parseFloat(0);
                for (var i = 0; i < taxData.length; i++) {

                    var data = taxData[i];

                    if (data.enable) {

                        var tax_html = '<tr><td class="label">' + data.title + '(';

                        var tax_amount = data.tax;

                        if (data.type == "percentage") {
                            tax_html += data.tax + '%';
                            tax_amount = (data.tax * total_amount) / 100;
                        } else {
                            if (symbolAtRight) {
                                tax_html += parseFloat(data.tax).toFixed(decimal_degits) + currentCurrency;

                            } else {
                                tax_html += currentCurrency + parseFloat(data.tax).toFixed(decimal_degits);

                            }
                        }

                        tax_amount = parseFloat(tax_amount).toFixed(decimal_degits);
                        tax_amount_total = parseFloat(tax_amount_total) + parseFloat(tax_amount);
                        tax_html += ')</td>';

                        if (symbolAtRight) {
                            tax_html += '<td>' + tax_amount + currentCurrency + '</td></tr>';

                        } else {
                            tax_html += '<td>' + currentCurrency + tax_amount + '</td></tr>';

                        }


                    }

                    order_amount_html += tax_html;
                }
                total_amount += parseFloat(tax_amount_total);

            }

            //total_amount += parseFloat(amount);

            var payableAmount = total_amount;
            if (orderData.hasOwnProperty('adminCommission')) {
                order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.commission")}}</span></td></tr>';
                var data = orderData.adminCommission;
                order_amount_html += '';
                var final_rate = 0;
                if (orderData.finalRate) {
                    final_rate = parseFloat(orderData.finalRate);
                }
                var finalMinusDiscountAmount = final_rate - discount_amount;

                var commission_html = '<tr><td class="label">{{trans("lang.admin_commission")}}(';

                if (data.type == "fix") {
                    commission_amount = data.amount;
                    if (symbolAtRight) {
                        commission_html += parseFloat(data.amount).toFixed(decimal_degits) + currentCurrency;

                    } else {
                        commission_html += currentCurrency + parseFloat(data.amount).toFixed(decimal_degits);

                    }

                } else {
                    commission_html += data.amount + '%';
                    commission_amount = (data.amount * finalMinusDiscountAmount) / 100;
                }

                commission_amount = parseFloat(commission_amount).toFixed(decimal_degits);

                commission_html += ')</td>';
                if (symbolAtRight) {
                    commission_html += '<td ><span style="color:red">(-' + commission_amount + currentCurrency + ')</span></td>';

                } else {
                    commission_html += '<td ><span style="color:red">(-' + currentCurrency + commission_amount + ')</span></td>';
                }

                commission_html += '</tr>';

                //total_amount += parseFloat(commission_amount);

                order_amount_html += commission_html;

                if (commission_amount) {
                    total_amount = total_amount - commission_amount;

                }

            }
            order_amount_html += '<tr><td class="seprater" colspan="2"><hr></td></tr>';
            total_amount = total_amount.toFixed(decimal_degits);
            payableAmount = payableAmount.toFixed(decimal_degits);

            if (symbolAtRight) {
                total_amount = total_amount + currentCurrency;
                payableAmount = payableAmount + currentCurrency;
            } else {
                total_amount = currentCurrency + total_amount;
                payableAmount = currentCurrency + payableAmount;
            }
            order_amount_html += '<tr class="grand-total"><td class="label"><strong>{{trans("lang.payable_amount")}}</strong></td><td><strong>' + payableAmount + '</strong></td></tr>';

            order_amount_html += '<tr><td class="label"><strong>{{trans("lang.total")}}</strong><span> ({{trans("lang.after_admin_commission")}}) </span></td><td><strong>' + total_amount + '</strong></td></tr>';

        } else {
            var amount = 0;
            if (orderData.offerRate) {
                amount = parseFloat(orderData.offerRate);
            }
            order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.ride_price")}}</span></td></tr>';

            if (symbolAtRight) {
                order_amount_html += '<tr ><td class="label">{{trans("lang.offer_rate")}}</td><td>' + amount.toFixed(decimal_degits) + currentCurrency + '</td></tr>';

            } else {
                order_amount_html += '<tr><td class="label">{{trans("lang.offer_rate")}}</td><td>' + currentCurrency + amount.toFixed(decimal_degits) + '</td></tr>';

            }
        }

        $('#order_products_total').html(order_amount_html);

        setTimeout(function() {
            setMap(orderData);
        }, 2000);


    }

    async function getTransactionId(orderId) {

        var transactionId = '';

        await database.collection('wallet_transaction').where('transactionId', '==', orderId).get().then(async function(snapshots) {

            if (snapshots.docs.length > 0) {
                var transactionData = snapshots.docs[0].data();
                transactionId = transactionData.id.substring(0, 7);
                $('.transaction_id_' + orderId).html('<td class="label"><strong>{{trans("lang.transaction_id")}}</strong></td><td><strong>' + transactionData.id + '</strong></td>');
            }
        });
        return transactionId;
    }

    function setMap(orders) {

        var map;
        var marker;

        var myLatlng = new google.maps.LatLng(orders.destinationLocationLAtLng.latitude, orders.destinationLocationLAtLng.longitude);
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        var mapOptions = {
            zoom: 10,
            center: myLatlng,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("map"), mapOptions);

        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(orders.destinationLocationName);
            infowindow.open(map, marker);
        });

        //Set direction route
        let directionsService = new google.maps.DirectionsService();

        let directionsRenderer = new google.maps.DirectionsRenderer();

        directionsRenderer.setOptions({
            polylineOptions: {
                strokeColor: '#000000'
            }
        });

        directionsRenderer.setMap(map);

        const origin = {
            lat: orders.sourceLocationLAtLng.latitude,
            lng: orders.sourceLocationLAtLng.longitude
        };
        const destination = {
            lat: orders.destinationLocationLAtLng.latitude,
            lng: orders.destinationLocationLAtLng.longitude
        };

        const route = {
            origin: origin,
            destination: destination,
            travelMode: 'DRIVING'
        };

        directionsService.route(route, function(response, status) {
            if (status !== 'OK') {
                window.alert('Directions request failed due to ' + status);
                return;
            } else {
                directionsRenderer.setDirections(response);
                var directionsData = response.routes[0].legs[0];
            }
        });

    }

    function buildCustomerRatingsHTML(vendorOrder, userreviewsnapshot) {
        var allreviewdata = [];
        var reviewhtml = '';

        userreviewsnapshot.docs.forEach((listval) => {
            var reviewDatas = listval.data();
            reviewDatas.id = listval.id;
            allreviewdata.push(reviewDatas);
        });

        reviewhtml += '<div class="user-ratings">';
        allreviewdata.forEach((listval) => {
            var val = listval;

            rating = val.rating;
            reviewhtml = reviewhtml + '<div class="reviews-members py-3 border mb-3"><div class="media">';
            reviewhtml = reviewhtml + '<div class="media-body d-flex"><div class="reviews-members-header"><div class="star-rating"><div class="d-inline-block" style="font-size: 14px;">';
            reviewhtml = reviewhtml + ' <ul class="rating" data-rating="' + parseInt(rating) + '">';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '</ul>';
            reviewhtml = reviewhtml + '</div></div>';
            reviewhtml = reviewhtml + '</div>';
            reviewhtml = reviewhtml + '<div class="review-date ml-auto">';
            if (val.date != null && val.date != "") {
                var review_date = val.date.toDate().toLocaleDateString('en', {
                    year: "numeric",
                    month: "short",
                    day: "numeric"
                });
                reviewhtml = reviewhtml + '<span>' + review_date + '</span>';
            }
            reviewhtml = reviewhtml + '</div>';


            reviewhtml = reviewhtml + '</div></div><div class="reviews-members-body w-100"><p class="mb-2">' + val.comment + '</div>';
            reviewhtml += '</div>';

            reviewhtml += '</div>';
        });


        reviewhtml += '</div>';

        return reviewhtml;
    }

    function buildDriverRatingsHTML(vendorOrder, userreviewsnapshot) {
        var allreviewdata = [];
        var reviewhtml = '';

        userreviewsnapshot.docs.forEach((listval) => {
            var reviewDatas = listval.data();
            reviewDatas.id = listval.id;
            allreviewdata.push(reviewDatas);
        });

        reviewhtml += '<div class="user-ratings">';
        allreviewdata.forEach((listval) => {
            var val = listval;

            rating = val.rating;
            reviewhtml = reviewhtml + '<div class="reviews-members py-3 border mb-3"><div class="media">';
            reviewhtml = reviewhtml + '<div class="media-body d-flex"><div class="reviews-members-header"><div class="star-rating"><div class="d-inline-block" style="font-size: 14px;">';
            reviewhtml = reviewhtml + ' <ul class="rating" data-rating="' + parseInt(rating) + '">';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '</ul>';
            reviewhtml = reviewhtml + '</div></div>';
            reviewhtml = reviewhtml + '</div>';
            reviewhtml = reviewhtml + '<div class="review-date ml-auto">';
            if (val.date != null && val.date != "") {
                var review_date = val.date.toDate().toLocaleDateString('en', {
                    year: "numeric",
                    month: "short",
                    day: "numeric"
                });
                reviewhtml = reviewhtml + '<span>' + review_date + '</span>';
            }
            reviewhtml = reviewhtml + '</div>';


            reviewhtml = reviewhtml + '</div></div><div class="reviews-members-body w-100"><p class="mb-2">' + val.comment + '</div>';
            reviewhtml += '</div>';

            reviewhtml += '</div>';
        });


        reviewhtml += '</div>';

        return reviewhtml;
    }

    async function buildAppliedDriverHTML(orders, snapshot) {
        var alldriverdata = [];
        var driverHtml = '';
        var rejectedDriverIds = orders.rejectedDriverId;
        snapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldriverdata.push(datas);
        });
        if (alldriverdata.length > 0) {
            alldriverdata.forEach(function(listval) {
                var val = listval;

                if (symbolAtRight) {
                    var offerRate = parseFloat(val.offerAmount).toFixed(decimal_degits) + currentCurrency;

                } else {
                    var offerRate = currentCurrency + parseFloat(val.offerAmount).toFixed(decimal_degits);

                }

                driverHtml += '<div class="apply_drivers_div_' + val.driverId + '"></div>';

                getDriverInfo(val.driverId, 'Awarded', orders.driverId, val.suggestedDate, val.suggestedTime, offerRate, rejectedDriverIds);


            });
        }

        return driverHtml;


    }

    function printDiv(divName) {
        var css = '@page { size: portrait; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');
        style.type = 'text/css';
        style.media = 'print';
        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }
        head.appendChild(style);
        document.getElementById('ride-map-dredetail').innerHTML = '';
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        document.getElementById('ride-map-dredetail').innerHTML = '<div class="card">\n' +
            '                                            <div class="box card-body p-0">\n' +
            '                                                <div class="box-header bb-2 card-header bg-white">\n' +
            '                                                    <h3 class="box-title">{{trans("lang.map_view")}}</h3>\n' +
            '                                                </div>\n' +
            '                                                <div class="card-body">\n' +
            '                                                    <div id="map" style="height:300px">\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </div>';
        getRideDeatils();
    }
</script>


@endsection