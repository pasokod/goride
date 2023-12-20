@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.driver_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('drivers') !!}">{{trans('lang.driver_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.driver_details')}}</li>
            </ol>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card card-block p-card">
                                    <div class="profile-box">
                                        <div class="profile-card rounded">
                                            <img src="https://goride.siswebapp.com/images/default_user.png"
                                                 alt="profile-bg"
                                                 class="avatar-100 d-block mx-auto img-fluid mb-3  avatar-rounded user-image">
                                            <h3 class="font-600 text-white text-center user-name"></h3>
                                            <div class="font-600 text-white text-center mb-3 user-total-ratings"></div>
                                            <h3 class="font-600 text-white text-center mb-5 user-wallet"></h3>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#addWalletModal" class="ml-3 mb-2 text-white add-wallate btn btn-sm btn-success"><i class="fa fa-plus"></i>{{trans("lang.add_wallet_amount")}}</a>

                                        </div>
                                        <div class="pro-content rounded">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-icon mr-3">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <p class="mb-0 eml user-email"></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-icon mr-3">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <p class="mb-0 user-phone"></p>
                                            </div>
                                        </div>

                                        <div class="personal-detail">
                                            <h3>Vehicle Information</h3>
                                            <div class="table-responsive user-list-table">
                                                <table class="table mb-0">
                                                    <tbody id="vehicle_information">
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                <span
                                                                        class="font-weight-bold w-100">{{trans("lang.seats")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0 seats"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                <span
                                                                        class="font-weight-bold w-100">{{trans("lang.vehicle_color")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0 vehicle_color"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                 <span
                                                                         class="font-weight-bold w-100">{{trans("lang.vehicle_number")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0"><span
                                                                    class="num-plat vehicle_number"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                <span
                                                                        class="font-weight-bold w-100">{{trans("lang.vehicle_type")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0 vehicle_type"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="personal-detail">
                                            <h3>Rules</h3>
                                            <div class="rules-list">
                                                <ul id="driver_rules"></ul>

                                            </div>

                                        </div>

                                        <div class="personal-detail mb-0">
                                            <h3>Bank Details</h3>
                                            <div class="table-responsive user-list-table">
                                                <table class="table mb-0">
                                                    <tbody id="bank_information">
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                <span
                                                                        class="font-weight-bold w-100">{{trans("lang.bank_name")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0 bank_name"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                <span
                                                                        class="font-weight-bold w-100">{{trans("lang.branch_name")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0 branch_name"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                 <span
                                                                         class="font-weight-bold w-100">{{trans("lang.holder_name")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0 holder_name"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                <span
                                                                        class="font-weight-bold w-100">{{trans("lang.account_number")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0"><span
                                                                    class="num-plat account_number"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 px-0">
                                                                 <span
                                                                         class="font-weight-bold w-100">{{trans("lang.other_information")}}:</span>
                                                        </td>
                                                        <td class="py-2 px-0 other_info"></td>
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
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-block card-stretch">
                                    <div class="card-header bg-white">
                                        <ul class="nav nav-pills mb-3" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link ride_list active" data-toggle="pill"
                                                   href="#ride_list" role="tab">{{trans('lang.ride_list')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link intercity_ride_list" data-toggle="pill"
                                                   href="#intercity_ride_list"
                                                   role="tab">{{trans('lang.intercity_ride_list')}}</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link wallet_transactions" data-toggle="pill"
                                                   href="#wallet_transactions"
                                                   role="tab">{{trans('lang.wallet_transactions')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link payout_request" data-toggle="pill"
                                                   href="#payout_request"
                                                   role="tab">{{trans('lang.payout_request')}}</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <div class="tab-content">

                                            <div class="tab-pane active" id="ride_list" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                           id="rideListTable">
                                                        <thead class="table-color-heading">
                                                        <tr class="text-secondary">
                                                            <th scope="col">{{trans('lang.ride_id')}}</th>
                                                            <th scope="col">{{trans('lang.customer')}}</th>
                                                            <th scope="col">{{trans('lang.user_service')}}</th>
                                                            <th scope="col">{{trans('lang.date')}}</th>
                                                            <th scope="col">{{trans('lang.ride_status')}}</th>
                                                            <th scope="col">{{trans('lang.payment_method')}}</th>
                                                            <th scope="col">{{trans('lang.payment_status')}}</th>
                                                            <th scope="col">{{trans('lang.total_amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="ride_list_rows"></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="intercity_ride_list" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                           id="intercityRideListTable">
                                                        <thead class="table-color-heading">

                                                        <tr class="text-secondary">
                                                            <th scope="col">{{trans('lang.ride_id')}}</th>
                                                            <th scope="col">{{trans('lang.customer')}}</th>

                                                            <th scope="col">{{trans('lang.user_service')}}</th>
                                                            <th scope="col">{{trans('lang.date')}}</th>
                                                            <th scope="col">{{trans('lang.ride_status')}}</th>

                                                            <th scope="col">{{trans('lang.payment_method')}}</th>
                                                            <th scope="col">{{trans('lang.payment_status')}}</th>
                                                            <th scope="col">{{trans('lang.total_amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="intercity_ride_list_rows"></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="wallet_transactions" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                           id="transactionListTable">
                                                        <thead class="table-color-heading">
                                                        <tr class="text-secondary">
                                                            <th scope="col"> {{trans('lang.id')}}</th>
                                                            <th scope="col">{{trans('lang.payment_method')}}</th>
                                                            <th scope="col">{{trans('lang.order_type')}}</th>
                                                            <th scope="col">{{trans('lang.txn_id')}}</th>
                                                            <th scope="col">{{trans('lang.date')}}</th>
                                                            <th scope="col">{{trans('lang.note')}}</th>
                                                            <th scope="col">{{trans('lang.total_amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="wallet_transactions_rows"></tbody>
                                                    </table>
                                                </div>

                                            </div>

                                            <div class="tab-pane" id="payout_request" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                           id="payoutRequestTable">
                                                        <thead class="table-color-heading">
                                                        <tr class="text-secondary">
                                                            <th>{{trans('lang.amount')}}</th>

                                                            <th>{{trans('lang.note')}}</th>

                                                            <th>{{trans('lang.drivers_payout_paid_date')}}</th>

                                                            <th>{{trans('lang.status')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="payout_request_rows"></tbody>
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
            <div class="form-group col-12 text-center btm-btn doc-footer">
                <a href="{!! route('drivers') !!}" class="btn btn-default"><i
                            class="fa fa-undo cancel-btn"></i>{{trans('lang.cancel')}}</a>
            </div>

        </div>

    </div>

</div>
<div class="modal fade" id="addWalletModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.add_wallet_amount')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <div class="form-group row">

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.amount')}}</label>
                                <div class="col-12">
                                    <input type="number" name="amount" class="form-control" id="amount">
                                    <div id="wallet_error" style="color:red"></div>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.note')}}</label>
                                <div class="col-12">
                                    <input type="text" name="note" class="form-control" id="note">
                                </div>
                            </div>
                            <div class="form-group row width-100">

                                <div id="user_account_not_found_error" class="align-items-center"  style="color:red"></div>
                            </div>


                        </div>

                    </div>

                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add-wallet-btn">{{trans('submit')}}</a>
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        {{trans('close')}}</a>
                    </button>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>
    var id = "{{$id}}";
    var database = firebase.firestore();
    var ref = database.collection('driver_users').doc(id);
    var rideRef = database.collection('orders').where("driverId", "==", id).orderBy('createdDate', 'desc');
    var intercityRideRef = database.collection('orders_intercity').where("driverId", "==", id).orderBy('createdDate', 'desc');
    var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
    var refBankDetails = database.collection('bank_details').doc(id);
    var walletRef = database.collection('wallet_transaction').where("userId", "==", id).orderBy('createdDate', 'desc');
    var refPayoutRequest = database.collection('withdrawal_history').where('userId', '==', id).orderBy('createdDate', 'desc');

    var decimal_degits = 0;
    var symbolAtRight = false;
    var currentCurrency = '';
    var storageRef = firebase.storage().ref('images');
    var storage = firebase.storage();
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    var driver_details = "{{trans('lang.driver_details')}}";
    var notFound = "{{ trans('lang.doc_not_found') }}"
    var docsRef = database.collection('documents');
    var docref = database.collection('driver_document').doc(id);
    var reviewRef = database.collection('review_driver').where("driverId", "==", id);
    var requestUrl = "{{request()->is('drivers/document/*')}}";
    var back_photo = '';
    var front_photo = '';
    var backFileName = '';
    var frontFileName = '';
    var backFileOld = '';
    var frontFileOld = '';

    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        decimal_degits = currencyData.decimalDigits;
        if (currencyData.symbolAtRight) {
            symbolAtRight = true;
        }
    });
    $(document).ready(async function () {
        if (requestUrl) {
            $('li').removeClass('active');
            $("#documents-tab").addClass('active');
            $("#documents-tab").click();
        } else {
            $(".driver-tab").first().addClass('active');
            $(".driver-tab").first().click();
        }

        $('.driver_sub_menu li').each(function () {

            var url = $(this).find('a').attr('href');

            if (url == document.referrer) {
                $(this).find('a').addClass('active');
                $('.driver_menu').addClass('active').attr('aria-expanded', true);

            }
            $('.driver_sub_menu').addClass('in').attr('aria-expanded', true);
        });

        getRideList();

    });

    /*$(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });*/

    ref.get().then(async function (snapshot) {
        let data = snapshot.data();
        //console.log(data);
        $(".user-name").text(data.fullName);
        $(".user-email").text(data.email);
        $(".user-phone").text(data.countryCode + data.phoneNumber);

        var rating = 0;
        var reviewsCount = 0;

        if (data.hasOwnProperty('reviewsCount') && data.reviewsCount && data.reviewsCount != "0.0" && data.reviewsCount != null && data.hasOwnProperty('reviewsSum') && data.reviewsSum && data.reviewsSum != "0.0" && data.reviewsSum != null) {

            rating = (parseFloat(data.reviewsSum) / parseFloat(data.reviewsCount));

            rating = (rating * 10) / 10;

            reviewsCount = parseInt(data.reviewsCount);
        }

        $('.user-total-ratings').html('<span class="badge badge-warning text-white dr-review"><i class="fa fa-star"></i>' + (rating).toFixed(1) + '</span>');

        var walletAmount = 0;
        if (data.hasOwnProperty('walletAmount') && data.walletAmount != null) {
            walletAmount = data.walletAmount;
        }
        if (symbolAtRight) {
            $(".user-wallet").text("{{trans('lang.wallet_Balance')}} : " + parseFloat(walletAmount).toFixed(decimal_degits) + currentCurrency);
        } else {
            $(".user-wallet").text("{{trans('lang.wallet_Balance')}} : " + currentCurrency + parseFloat(walletAmount).toFixed(decimal_degits));
        }

        if (data.profilePic != null && data.profilePic != '') {
            $(".user-image").attr('src', data.profilePic);
        }

        if (data.hasOwnProperty('vehicleInformation')) {

            if (data.vehicleInformation.seats != "" || data.vehicleInformation.vehicleColor != "" || data.vehicleInformation.vehicleNumber != "" || data.vehicleInformation.vehicleType != "") {

                if (data.vehicleInformation.seats != "") {
                    $(".seats").text(data.vehicleInformation.seats);
                }
                if (data.vehicleInformation.vehicleColor != "") {
                    $(".vehicle_color").text(data.vehicleInformation.vehicleColor);
                }
                if (data.vehicleInformation.vehicleNumber != "") {
                    $(".vehicle_number").text(data.vehicleInformation.vehicleNumber);

                }
                if (data.vehicleInformation.vehicleType != "") {
                    $(".vehicle_type").text(data.vehicleInformation.vehicleType);

                }
            } else {
                $("#vehicle_information").html('<tr><td><span class="font-weight-bold w-100">{{trans("lang.no_vehicle_information")}}</span></td></tr>');

            }
            var driverhtml = '';
            if (data.vehicleInformation.driverRules != undefined) {
                var rulesLength = data.vehicleInformation.driverRules.length;

                if (rulesLength > 0) {
                    for (i = 0; i < rulesLength; i++) {
                        name = data.vehicleInformation.driverRules[i].name;
                        image = data.vehicleInformation.driverRules[i].image;

                        driverhtml += '<li>';
                        driverhtml += '<span class="rule-img"><img  style="width:50px" src=" ' + image + ' " /></span>';
                        driverhtml += '<span class="font-weight-bold w-100">' + name + '</span>';
                        driverhtml += '</li>';
                        $("#driver_rules").html(driverhtml);
                    }

                } else {
                    driverhtml += '<tr><td>{{trans("lang.no_rules_found")}}</td></tr>';
                    $("#driver_rules").html(driverhtml);
                }

            } else {
                $("#driver_rules").html('{{trans("lang.no_rules_found")}}');
            }
        } else {
            $("#driver_rules").html('{{trans("lang.no_rules_found")}}');
            $("#vehicle_information").html('<tr><td><span class="font-weight-bold w-100">{{trans("lang.no_vehicle_information")}}</span></td></tr>');

        }
    });
    refBankDetails.get().then(async function (snapshot) {
        let data = snapshot.data();
        if (data != undefined && (data.bankName != "" || data.branchName != '' || data.accountNumber != "" || data.holderName != "" || data.otherInformation != "")) {
            $(".bank_name").text(data.bankName);
            $(".branch_name").text(data.branchName);
            $(".account_number").text(data.accountNumber);
            $(".holder_name").text(data.holderName);
            $(".other_info").text(data.otherInformation);
        } else {
            $("#bank_information").html('<tr><td><span class="font-weight-bold w-100">{{trans("lang.no_bank_details")}}</span></td></tr>');

        }


    });
    reviewRef.get().then(async function (docSnapshot) {
        let html = '';
        if (docSnapshot.docs.length > 0) {
            docSnapshot.docs.forEach((docs) => {
                var data = docs.data();

                getReviwerInfo(data.customerId);
                html += '<tr>';

                html += '<td><a href="/users/edit/' + data.customerId + '" class="reviewer_name"></a></td>';
                html += '<td>' + data.comment + '</td>';
                html += '<td>' + getStars(data.rating) + '</td>';
                html += '</tr>';
                $("#review_list_rows").html(html);
            });

        } else {
            html += '<tr><td colspan="6" class="text-center font-weight-bold">{{trans("lang.no_record_found")}}</td></tr>';
            $("#review_list_rows").html(html);
        }
    });

    async function getReviwerInfo(id) {
        await database.collection('users').where('id', '==', id).get().then(async function (snapshots) {
            var user = snapshots.docs[0].data();
            $('.reviewer_name').html(user.fullName)

        });
    }

    // rideRef.get().then(async function(docSnapshot) {
    //     let html = '';
    //     if (docSnapshot.docs.length > 0) {
    //         docSnapshot.docs.forEach((docs) => {
    //             var data = docs.data();
    //             html += '<tr>';

    //             html += '<td><a href="/rides/show/' + data.id + '" target="_blank">' + data.id.substring(0, 7) + '</a></td>';

    //             html += '<td>' + data.service.title + '</td>';

    //             if (data.hasOwnProperty("createdDate")) {
    //                 date = data.createdDate.toDate().toDateString();
    //                 time = data.createdDate.toDate().toLocaleTimeString('en-US');
    //                 html = html + '<td class="dt-time"><span class="date">' + date + '</span><span class="time"> ' + time + '</span></td>';
    //             } else {
    //                 html = html + '<td></td>';
    //             }

    //             if (data.status == "Ride Placed") {
    //                 html += '<td><span class="badge badge-primary py-2 px-3">' + data.status + '</span></td>';
    //             } else if (data.status == "Ride Completed") {
    //                 html += '<td><span  class="badge badge-success py-2 px-3">' + data.status + '</span></td>';
    //             } else if (data.status == "Ride Active") {
    //                 html += '<td><span class="badge badge-warning py-2 px-3">' + data.status + '</span></td>';
    //             } else if (data.status == "Ride InProgress") {
    //                 html += '<td><span class="badge badge-info py-2 px-3">' + data.status + '</span></td>';
    //             } else if (data.status == "Ride Canceled") {
    //                 html += '<td><span class="badge badge-danger py-2 px-3">' + data.status + '</span></td>';
    //             }

    //             var amount = parseFloat(data.offerRate);
    //             if (data.finalRate) {
    //                 amount = parseFloat(data.finalRate);
    //             }
    //             if (symbolAtRight) {
    //                 html += '<td>' + amount.toFixed(decimal_degits) + currentCurrency + '</td>';
    //             } else {
    //                 html += '<td>' + currentCurrency + amount.toFixed(decimal_degits) + '</td>';
    //             }

    //             html += '</tr>';
    //             $("#ride_list_rows").html(html);
    //         });
    //     } else {
    //         html += '<tr><td colspan="6" class="text-center font-weight-bold">{{trans("lang.no_record_found")}}</td></tr>';
    //         $("#ride_list_rows").html(html);
    //     }
    // });

    $(document).on('click', '.wallet_transactions', function () {
        getWalletTransactions();
    });
    $(document).on('click', '.ride_list', function () {
        getRideList();
    });
    $(document).on('click', '.intercity_ride_list', function () {
        getIntercityRideList();
    });

    $(document).on('click', '.payout_request', function () {
        getPayoutRequestList();
    });

    function getPayoutRequestList() {
        jQuery("#overlay").show();

        append_list = document.getElementById('payout_request_rows');

        append_list.innerHTML = '';

        refPayoutRequest.get().then(async function (snapshots) {

            var html = '';


            html = await buildPayoutRequestHTML(snapshots);

            if (html != '') {

                append_list.innerHTML = html;

            }
            var table = $('#payoutRequestTable').DataTable();

            table.destroy();
            //$('#payoutRequestTable').empty();

            table = $('#payoutRequestTable').DataTable({
                //order: [[2, 'desc']],
                order: [],
                columnDefs: [
                    {orderable: false, targets: 3},
                ],
                language: {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                order: [[2, "desc"]],
                responsive: true

            });
            jQuery("#overlay").hide();
        });

    }

    async function buildPayoutRequestHTML(snapshots) {
        var html = '';
        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getPayoutRequestListData(val);
            html += getData;
        }));
        return html;
    }

    function getPayoutRequestListData(val) {

        var html = '';


        var route1 = '{{route("drivers.view",":id")}}';

        route1 = route1.replace(':id', val.userId);

        html = html + '<tr>';

        if (symbolAtRight) {

            html = html + '<td>' + parseFloat(val.amount).toFixed(decimal_degits) + '' + currentCurrency + '</td>';

        } else {

            html = html + '<td>' + currentCurrency + '' + parseFloat(val.amount).toFixed(decimal_degits) + '</td>';

        }


        var date = val.createdDate.toDate().toDateString();

        var time = val.createdDate.toDate().toLocaleTimeString('en-US');

        html = html + '<td>' + val.note + '</td>';

        html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';

        if (val.paymentStatus) {

            if (val.paymentStatus == "approved") {
                html = html + '<td><span  class="badge badge-success py-2 px-3">Approved</span></td>';
            } else if (val.paymentStatus == "pending") {
                html = html + '<td><span class="badge badge-warning py-2 px-3">Pending</span></td>';
            } else if (val.paymentStatus == "rejected") {
                html = html + '<td><span class="badge badge-danger py-2 px-3">Rejected</span></td>';
            }

        } else {
            html = html + '<td></td>';

        }

        //  html = html + '<td class="action-btn"><a id="' + val.id + '" name="driver_check" data-auth="' + val.userId + '" href="javascript:void(0)"><i class="fa fa-check" style="color:green"></i></a><a id="' + val.id + '" data-price="' + val.amount + '" name="reject-request" data-auth="' + val.userId + '" href="javascript:void(0)" data-toggle="modal" data-target="#reasonModal"><i class="fa fa-close" ></i></a></td>';

        html = html + '</tr>';

        return html;

    }

    function getRideList() {

        $("#ride_list_rows").html('');

        jQuery("#overlay").show();
        rideRef.get().then(async function (docSnapshot) {
            let html = '';

            html = await buildRidesHtml(docSnapshot);
            if (html != '') {
                $("#ride_list_rows").html(html);

            }

            var table = $('#rideListTable').DataTable();

            table.destroy();
            //$('#rideListTable').empty();

            table = $('#rideListTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 3,
                        type: 'date',
                        render: function (data) {

                            console.log(data);
                            return data;
                        }
                    }, {
                        orderable: false,
                        targets: [4, 5]
                    },
                ],
                language: {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                order: [[3, "desc"]],

                responsive: true

            });

            jQuery("#overlay").hide();

        });
    }

    async function buildRidesHtml(snapshots) {
        var html = '';
        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getRidesListData(val);
            html += getData;
        }));
        return html;
    }

    async function getRidesListData(data) {

        var html = '';

        html += '<tr>';

        html += '<td><a href="/rides/show/' + data.id + '" target="_blank">' + data.id.substring(0, 7) + '</a></td>';
        var customer_view = '{{route("users.view",":id")}}';
        customer_view = customer_view.replace(':id', data.userId);
        var customer = await getUser(data.userId, data.id);
        if (customer != '') {
            html += '<td class="redirecttopage user_name_' + data.id + '"><a href="' + customer_view + '">' + customer + '</a></td>';
        } else {
            html += '<td class="redirecttopage user_name_' + data.id + '">{{trans("lang.unknown_user")}}</td>';
        }


        html += '<td>' + data.service.title + '</td>';

        var date = data.createdDate.toDate().toDateString();
        var time = data.createdDate.toDate().toLocaleTimeString('en-US');

        html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';

        console.log(data.createdDate);

        if (data.status == "Ride Placed") {
            html += '<td><span class="badge badge-primary py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride Completed") {
            html += '<td><span  class="badge badge-success py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride Active") {
            html += '<td><span class="badge badge-warning py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride InProgress") {
            html += '<td><span class="badge badge-info py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride Canceled") {
            html += '<td><span class="badge badge-danger py-2 px-3">' + data.status + '</span></td>';
        }

        if (data.hasOwnProperty('paymentType')) {
            var image = await getPaymentImage(data.id.substring(0, 7), data.paymentType);
            html += '<td class="payment_icon ' + data.id.substring(0, 7) + '_' + data.paymentType + '"><img width="80" src="' + image + '" alt="image"></td>';
        } else {
            html += '<td>-</td>';
        }

        if (data.hasOwnProperty('paymentStatus') && data.paymentStatus == true) {
            html += '<td><span class="badge badge-success py-2 px-3">{{trans("lang.paid")}}</span></td>';
        } else {
            html += '<td><span class="badge badge-warning py-2 px-3">{{trans("lang.not_paid")}}</span></td>';
        }

        var amount = await getOrderDetails(data);

        if (symbolAtRight) {
            html += '<td>' + amount + currentCurrency + '</td>';

        } else {
            html += '<td>' + currentCurrency + amount + '</td>';

        }

        html += '</tr>';

        return html;
    }

    async function getUser(userId, id) {
        var userName = '';
        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {

            if (snapshots.docs.length > 0) {
                var user = snapshots.docs[0].data();
                //var customer_view = '{{route("users.view",":id")}}';
                //customer_view = customer_view.replace(':id', userId);
                userName = user.fullName;
                //$('.user_name_' + id).html('<a href="' + customer_view + '">' + user.fullName + '</a>');
            } else {
                //$('.user_name_' + id).html('{{trans("lang.unknown_user")}}');

            }

        });
        return userName;
    }

    function getIntercityRideList() {

        $("#intercity_ride_list_rows").html('');

        jQuery("#overlay").show();
        intercityRideRef.get().then(async function (docSnapshot) {
            let html = '';

            html = await buildIntercityRidesHtml(docSnapshot);
            if (html != '') {
                $("#intercity_ride_list_rows").html(html);

            }

            var table = $('#intercityRideListTable').DataTable();

            table.destroy();
            //$('#rideListTable').empty();

            table = $('#intercityRideListTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 3,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    }, {
                        orderable: false,
                        targets: [4, 5]
                    },
                ],
                language: {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                order: [[3, "desc"]],

                responsive: true

            });

            jQuery("#overlay").hide();

        });
    }

    async function buildIntercityRidesHtml(snapshots) {
        var html = '';
        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getIntercityRidesListData(val);
            html += getData;
        }));
        return html;
    }

    async function getIntercityRidesListData(data) {

        var html = '';

        html += '<tr>';

        html += '<td><a href="/intercity-service-rides/view/' + data.id + '" target="_blank">' + data.id.substring(0, 7) + '</a></td>';

        var customer_view = '{{route("users.view",":id")}}';
        customer_view = customer_view.replace(':id', data.userId);
        var customer = await getUser(data.userId, data.id);
        if (customer != '') {
            html += '<td class="redirecttopage user_name_' + data.id + '"><a href="' + customer_view + '">' + customer + '</a></td>';
        } else {
            html += '<td class="redirecttopage user_name_' + data.id + '">{{trans("lang.unknown_user")}}</td>';
        }
        html += '<td>' + data.intercityService.name + '</td>';

        var date = '';
        var time = '';
        if (data.hasOwnProperty("createdDate")) {
            try {
                date = data.createdDate.toDate().toDateString();
                time = data.createdDate.toDate().toLocaleTimeString('en-US');
            } catch (err) {

            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
        } else {
            html = html + '<td></td>';
        }


        if (data.status == "Ride Placed") {
            html += '<td><span class="badge badge-primary py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride Completed") {
            html += '<td><span  class="badge badge-success py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride Active") {
            html += '<td><span class="badge badge-warning py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride InProgress") {
            html += '<td><span class="badge badge-info py-2 px-3">' + data.status + '</span></td>';
        } else if (data.status == "Ride Canceled") {
            html += '<td><span class="badge badge-danger py-2 px-3">' + data.status + '</span></td>';
        }

        if (data.hasOwnProperty('paymentType')) {
            var image = await getPaymentImage(data.id.substring(0, 7), data.paymentType);
            html += '<td class="payment_icon ' + data.id.substring(0, 7) + '_' + data.paymentType + '"><img width="80" src="' + image + '" alt="image"></td>';
        } else {
            html += '<td>-</td>';
        }

        if (data.hasOwnProperty('paymentStatus') && data.paymentStatus == true) {
            html += '<td><span class="badge badge-success py-2 px-3">{{trans("lang.paid")}}</span></td>';
        } else {
            html += '<td><span class="badge badge-warning py-2 px-3">{{trans("lang.not_paid")}}</span></td>';
        }

        var amount = await getOrderDetails(data);

        if (symbolAtRight) {
            html += '<td>' + amount + currentCurrency + '</td>';

        } else {
            html += '<td>' + currentCurrency + amount + '</td>';

        }

        html += '</tr>';

        return html;
    }

    async function getOrderDetails(orderData) {

        var amount = 0;
        var total_amount = 0;

        if (orderData.offerRate) {
            amount = parseFloat(orderData.offerRate);

        }
        if (orderData.finalRate) {
            amount = parseFloat(orderData.finalRate);

        }

        total_amount = amount;

        var discount_amount = 0;
        if (orderData.hasOwnProperty('coupon') && orderData.coupon.enable) {
            var data = orderData.coupon;

            if (data.type == "fix") {
                discount_amount = data.amount;
            } else {
                discount_amount = (data.amount * amount) / 100;
            }

            total_amount -= parseFloat(discount_amount);

        }


        if (orderData.hasOwnProperty('taxList') && orderData.taxList.length > 0) {
            var taxData = orderData.taxList;

            var tax_amount_total = 0;
            for (var i = 0; i < taxData.length; i++) {

                var data = taxData[i];

                if (data.enable) {

                    var tax_amount = data.tax;

                    if (data.type == "percentage") {

                        tax_amount = (data.tax * total_amount) / 100;
                    }

                    tax_amount_total += parseFloat(tax_amount);

                }
            }
            total_amount += parseFloat(tax_amount_total);


        }
        total_amount = total_amount.toFixed(decimal_degits);

        return total_amount;
    }

    function getWalletTransactions() {

        $("#wallet_transactions_rows").html('');

        jQuery("#overlay").show();

        walletRef.get().then(async function (docSnapshot) {

            let html = '';

            html = await buildWalletTransactionsHtml(docSnapshot);

            if (html != '') {
                $("#wallet_transactions_rows").html(html);
            }

            var table = $('#transactionListTable').DataTable();

            table.destroy();
            //$('#rideListTable').empty();

            table = $('#transactionListTable').DataTable({
                order: [],
                columnDefs: [{
                    orderable: false,
                    targets: 1
                },{
                    targets: 4,
                    type: 'date',
                },],
                language: {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                order: [[4, "desc"]],

                responsive: true

            });

            jQuery("#overlay").hide();

        });

    }

    async function buildWalletTransactionsHtml(snapshots) {
        var html = '';
        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getWalletTransactionsListData(val);
            html += getData;
        }));
        return html;
    }

    async function getWalletTransactionsListData(data) {

        let html = '';

        html += '<tr>';

        html += '<td>' + data.id.substring(0, 7) + '</td>';

        if (data.paymentType) {
            var image = await getPaymentImage(data.id.substring(0, 7), data.paymentType);
            html += '<td class="payment_icon ' + data.id.substring(0, 7) + '_' + data.paymentType + '"><img width="80" src="' + image + '" alt="image"></td>';
        } else {
            html += '<td>-</td>';
        }

        if (data.orderType) {
            html += '<td>' + data.orderType + '</td>';

        } else {
            html += '<td></td>';

        }
        html += '<td>' + data.transactionId + '</td>';

        if (data.hasOwnProperty("createdDate")) {
            date = data.createdDate.toDate().toDateString();
            time = data.createdDate.toDate().toLocaleTimeString('en-US');
            html = html + '<td class="dt-time"><span class="date">' + date + '</span><span class="time"> ' + time + '</span></td>';
        } else {
            html = html + '<td></td>';
        }

        html += '<td>' + data.note + '</td>';

        var amount = parseFloat(data.amount);

        if (symbolAtRight) {
            if (amount.toFixed(decimal_degits) <= 0) {
                amount = Math.abs(amount);
                html += '<td><span style="color:red">(-' + amount.toFixed(decimal_degits) + currentCurrency + ')</span></td>';
            } else {
                html += '<td><span style="color:green">' + amount.toFixed(decimal_degits) + currentCurrency + '</sapn></td>';
            }
        } else {
            if (amount.toFixed(decimal_degits) <= 0) {
                amount = Math.abs(amount);

                html += '<td><span style="color:red">(-' + currentCurrency + amount.toFixed(decimal_degits) + ')</span></td>';
            } else {
                html += '<td><span style="color:green">' + currentCurrency + amount.toFixed(decimal_degits) + '</sapn></td>';
            }
        }

        html += '</tr>';

        return html;
    }

    async function getPaymentImage(id, paymentType) {
        await database.collection('settings').doc('payment').get().then(async function (snapshots) {
            var payment = snapshots.data();
            type = paymentType.toLowerCase();
            if (type == "flutterwave") {
                type = "flutterWave";
            } else if (type == "stripe") {
                type = "strip";
            } else if (type == "paystack") {
                type = "payStack";
            } else if (type == "mercadopago") {
                type = "mercadoPago";
            }
            payment = payment[type];
            payImage = payment.image;
            /*$('.'+id+'_'+paymentType).html('<img style="width:50px" src="' + payment.image + '" alt="image">' + " (" + paymentType + ")");*/
            // $('.' + id + '_' + paymentType).html('<img width="80" src="' + payment.image + '" alt="image">');
        });
        return payImage;
    }


    /* $(document).on('click', '.driver-tab', function () {
         $(".doc-body").html('');
         $('li').removeClass('active');
         $(this).addClass('active');
         var tabVal = $(this).attr('data-value');
         if (tabVal == 'reviews') {
             jQuery("#data-table_processing").show();
             reviewRef.get().then(async function (docSnapshot) {
                 if (docSnapshot.docs.length > 0) {
                     docSnapshot.docs.forEach((docs) => {
                         var doc = docs.data();
                         var html = '';
                         var reviewRefs = database.collection('users').doc(doc.customerId.trim());
                         reviewRefs.get().then(async function (reviewRefSnapshot) {
                             var reviewRef = reviewRefSnapshot.data();
                             html += '<fieldset><legend>' + reviewRef.fullName + '</legend>';
                             html += '<div class="form-group row width-100"><label class="col-3 control-label">' + "{{trans('lang.comment')}}" + '</label><div class="col-7" class="user_comment"><span class="user_comment" id="user_comment">' + doc.comment + '</span></div></div>';
                            html += '<div class="form-group row width-100"><label class="col-3 control-label">' + "{{trans('lang.rating')}}" + '</label><div class="col-7" class="user_rating"><span class="user_rating" id="user_rating">' + getStars(doc.rating) + '</span></div></div>';
                            html += '</fieldset>';
                            $(".doc-body").append(html);
                        })
                    });
                } else {
                    $(".doc-body").append(notFound);
                }
                jQuery("#data-table_processing").hide();
            })
        }
        if (tabVal == 'basic') {
            jQuery("#data-table_processing").show();
            ref.get().then(async function (snapshots) {
                var driver = snapshots.docs[0].data();
                var html = '<fieldset><legend>' + driver_details + '</legend><div class="form-group row width-50"><label class="col-3 control-label">' + "{{trans('lang.user_name')}}" + '</label><div class="col-7" class="user_name"><span class="user_name" id="user_name">' + driver.fullName + '</span></div></div><div class="form-group row width-50"><label class="col-3 control-label">' + "{{trans('lang.email')}}" + '</label><div class="col-7"><span class="email">' + driver.email + '</span></div></div><div class="form-group row width-50"><label class="col-3 control-label">' + "{{trans('lang.user_phone')}}" + '</label><div class="col-7"><span class="phone">' + driver.phoneNumber + '</span></div></div><div class="form-group row width-50"><label class="col-3 control-label">' + "{{trans('lang.profile_image')}}" + '</label><div class="col-7 profile_image"><img width="200px" id="" height="auto" src="' + (driver.profilePic ? driver.profilePic : placeholderImage) + '"></div></div></fieldset>';
                $(".doc-body").html(html);
                jQuery("#data-table_processing").hide();
            });
        }
    });*/

    function getStars(rating) {
        rating = Math.round(rating * 2) / 2;
        let output = [];
        for (var i = rating; i >= 1; i--)
            output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');
        if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
        for (let i = (5 - rating); i >= 1; i--)
            output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
        return output.join('');
    }
        $("#add-wallet-btn").click(function () {
        var date = firebase.firestore.FieldValue.serverTimestamp();
        var amount = $('#amount').val();
        if(amount==''){
            $('#wallet_error').text('{{trans("lang.add_wallet_amount_error")}}');
            return false;
        }
        var note = $('#note').val();

            database.collection('driver_users').where('id', '==', id).get().then(async function (snapshot) {

            if (snapshot.docs.length > 0) {
                var data = snapshot.docs[0].data();

                var walletAmount = 0;

                if (data.hasOwnProperty('walletAmount') && !isNaN(data.walletAmount) && data.walletAmount != null) {
                    walletAmount = data.walletAmount;

                }
                var user_id = data.id;
                var newWalletAmount = parseFloat(walletAmount) + parseFloat(amount);

                database.collection('driver_users').doc(id).update({
                    'walletAmount': newWalletAmount.toString()
                }).then(function (result) {
                    var tempId = database.collection("tmp").doc().id;
                    var transactionId=(new Date()).getTime();
                    database.collection('wallet_transaction').doc(tempId).set({
                        'amount': amount.toString(),
                        'createdDate': date,
                        'id': tempId,
                        'note': note,
                        'orderType': '',
                        'paymentType': 'Wallet',
                        'transactionId':transactionId.toString(),
                        'userId': user_id,
                        'userType': "driver",

                    }).then(async function (result) {
                        window.location.reload();

                    });
                })
            }
            });
    })

</script>
@endsection