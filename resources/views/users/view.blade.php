@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('drivers') !!}">{{trans('lang.user_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.user_details')}}</li>
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
                                                                <th scope="col">{{trans('lang.driver')}}</th>
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
                                                {{--
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-center">
                                                        <li class="page-item ">
                                                            <a class="page-link" href="javascript:void(0);"
                                                                id="users_table_previous_btn" onclick="ride_prev()"
                                                                data-dt-idx="0"
                                                                tabindex="0">{{trans('lang.previous')}}</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="javascript:void(0);"
                                                                id="users_table_next_btn" onclick="ride_next()"
                                                                data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                --}}
                                            </div>

                                            <div class="tab-pane" id="intercity_ride_list" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                        id="intercityRideListTable">
                                                        <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col">{{trans('lang.ride_id')}}</th>
                                                                <th scope="col">{{trans('lang.driver')}}</th>
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
                                                {{--
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-center">
                                                        <li class="page-item ">
                                                            <a class="page-link" href="javascript:void(0);"
                                                                id="users_table_previous_btn" onclick="ride_prev()"
                                                                data-dt-idx="0"
                                                                tabindex="0">{{trans('lang.previous')}}</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="javascript:void(0);"
                                                                id="users_table_next_btn" onclick="ride_next()"
                                                                data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                --}}
                                            </div>

                                            <div class="tab-pane" id="wallet_transactions" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                        id="transactionListTable">
                                                        <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col"> {{trans('lang.id')}}</th>
                                                                <th scope="col">{{trans('lang.payment_method')}}</th>
                                                                <th scope="col">{{trans('lang.txn_id')}}</th>
                                                                <th scope="col">{{trans('lang.date')}}</th>
                                                                <th scope="col">{{trans('lang.note')}}</th>
                                                                <th scope="col">{{trans('lang.total_amount')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="wallet_transactions_rows"></tbody>
                                                    </table>
                                                </div>
                                                {{--
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-center">
                                                        <li class="page-item ">
                                                            <a class="page-link" href="javascript:void(0);"
                                                                id="users_table_previous_btn"
                                                                onclick="transaction_prev()" data-dt-idx="0"
                                                                tabindex="0">{{trans('lang.previous')}}</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="javascript:void(0);"
                                                                id="users_table_next_btn" onclick="transaction_next()"
                                                                data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 text-center btm-btn">
                <a href="{!! route('users.index') !!}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script>

    var id = "<?php echo $id; ?>";
    var database = firebase.firestore();
    var userRef = database.collection('users').doc(id);
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    var users_details = "{{trans('lang.users_details')}}";
    var notFound = "{{ trans('lang.doc_not_found') }}";
    var reviewRef = database.collection('review_customer').where("customerId", "==", id);
    var rideRef = database.collection('orders').where("userId", "==", id).orderBy('createdDate', 'desc');
    var intercityRideRef = database.collection('orders_intercity').where("userId", "==", id).orderBy('createdDate', 'desc');
    var walletRef = database.collection('wallet_transaction').where("userId", "==", id).orderBy('createdDate', 'desc');

    var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
    var decimal_degits = 0;
    var symbolAtRight = false;
    var currentCurrency = '';

    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        decimal_degits = currencyData.decimalDigits;
        if (currencyData.symbolAtRight) {
            symbolAtRight = true;
        }
    });

    $(document).ready(function () {
        $('.user_menu').addClass('active');
        getRideList();
    });

    $(document).on('click', '.ride_list', function () {
        getRideList();
    });

    $(document).on('click', '.intercity_ride_list', function () {
        getIntercityRideList();
    });

    userRef.get().then(async function (snapshot) {
        let data = snapshot.data();

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
    });

    $(document).on('click', '.wallet_transactions', function () {
        getWalletTransactions();
    });

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
                            //console.log(data);

                            return data;
                        }
                    },

                    { orderable: false, targets: [4, 5] },
                ],
                order: [['3', 'desc']],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
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
        var driver_view = '{{route("drivers.view",":id")}}';
        driver_view = driver_view.replace(':id', data.driverId);
        if (data.driverId) {
            var customer = await getDriver(data.driverId, data.id);
            if (customer != '') {
                html += '<td class="redirecttopage driver_name_' + data.id + '"><a href="' + driver_view + '">' + customer + '</a></td>';
            } else {
                html += '<td class="redirecttopage driver_name_' + data.id + '">{{trans("lang.unknown_user")}}</td>';
            }
        } else {
            html += '<td class="redirecttopage driver_name_' + data.id + '">-</td>';
        }

        html += '<td>' + data.service.title + '</td>';

        var date = data.createdDate.toDate().toDateString();
        var time = data.createdDate.toDate().toLocaleTimeString('en-US');

        html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';

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

    async function getDriver(userId, id) {

        await database.collection('driver_users').where('id', '==', userId).get().then(async function (snapshots) {
            driverName = '';
            if (snapshots.docs.length > 0) {
                var user = snapshots.docs[0].data();

                driverName = user.fullName;
                //$('.driver_name_' + id).html('<a href="' + driver_view + '">' + user.fullName + '</a>');
            } else {
                driverName = '';
                // $('.driver_name_' + id).html('{{trans("lang.unknown_user")}}');
            }

        });
        return driverName;
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
                order: [['3', 'desc']],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
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

        var driver_view = '{{route("drivers.view",":id")}}';
        driver_view = driver_view.replace(':id', data.driverId);
        if (data.driverId) {
            var customer = await getDriver(data.driverId, data.id);
            if (customer != '') {
                html += '<td class="redirecttopage driver_name_' + data.id + '"><a href="' + driver_view + '">' + customer + '</a></td>';
            } else {
                html += '<td class="redirecttopage driver_name_' + data.id + '">{{trans("lang.unknown_user")}}</td>';
            }
        } else {
            html += '<td class="redirecttopage driver_name_' + data.id + '">-</td>';
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
            html = html + '<td>' + date + ' ' + time + '</td>';
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

            table =
                $('#transactionListTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 3,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        { orderable: false, targets: 1 },
                    ],
                    order: [['3', 'desc']],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                        },
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
        var payImage = '';
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
            //$('.' + id + '_' + paymentType).html('<img width="80" src="' + payment.image + '" alt="image">');
        });
        return payImage;
    }
    $("#add-wallet-btn").click(function () {
        var date = firebase.firestore.FieldValue.serverTimestamp();
        var amount = $('#amount').val();
        if(amount==''){
            $('#wallet_error').text('{{trans("lang.add_wallet_amount_error")}}');
            return false;
        }
        var note = $('#note').val();

            database.collection('users').where('id', '==', id).get().then(async function (snapshot) {

            if (snapshot.docs.length > 0) {
                var data = snapshot.docs[0].data();

                var walletAmount = 0;

                if (data.hasOwnProperty('walletAmount') && !isNaN(data.walletAmount) && data.walletAmount != null) {
                    walletAmount = data.walletAmount;

                }
                 var user_id = data.id;
                var newWalletAmount = parseFloat(walletAmount) + parseFloat(amount);

                database.collection('users').doc(id).update({
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
                        'userType': "customer",

                    }).then(async function (result) {
                        window.location.reload();

                    });
                })
            }
            });
    })
</script>
@endsection