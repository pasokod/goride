@extends('layouts.app')


@section('content')

<div class="page-wrapper">


    <div class="row page-titles">


        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.payout_request')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.payout_request')}}</li>

            </ol>

        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">

                        <div class="table-responsive m-t-10">


                            <table id="payoutTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">

                                <thead>


                                    <tr>
                                        <?php if ($id == "") { ?>
                                            <th>{{ trans('lang.driver')}}</th>

                                        <?php } ?>

                                        <th>{{trans('lang.amount')}}</th>
                                        <th>{{trans('lang.note')}}</th>
                                        <th>{{trans('lang.drivers_payout_paid_date')}}</th>
                                        <th>{{trans('lang.status')}}</th>
                                        <th>{{trans('lang.admin_note')}}</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>


                                <tbody id="append_list1">


                                </tbody>


                            </table>


                        </div>


                    </div>

                </div>
            </div>


        </div>
    </div>

</div>


<div class="modal fade" id="bankdetailsModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.bankdetails')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <input type="hidden" name="driverId" id="driverId">

                        <div class="form-group row">

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.bank_name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="bank_name" class="form-control" id="bankName">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.branch_name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="branch_name" class="form-control" id="branchName">
                                </div>
                            </div>


                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{
                                    trans('lang.holder_name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="holer_name" class="form-control" id="holderName">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.account_number')}}</label>
                                <div class="col-12">
                                    <input type="text" name="account_number" class="form-control" id="accountNumber">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.other_information')}}</label>
                                <div class="col-12">
                                    <input type="text" name="other_information" class="form-control" id="otherDetails">
                                </div>
                            </div>

                        </div>

                    </div>

                </form>

                <div class="modal-footer">

                    {{--
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        aria-label="Close">{{trans('close')}}</a>
                    </button>
                    --}}
                    <a class="btn btn-primary acceptBtn" href="javascript:void(0)">{{trans("lang.accept")}}</a>
                    <a name="reject-request" class="btn btn-primary rejectBtn" href="javascript:void(0)"
                        data-toggle="modal" data-target="#reasonModal">{{trans("lang.reject")}}</a>

                </div>
            </div>
        </div>

    </div>

</div>
<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.reason')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <div class="form-group row">

                            <div class="form-group row width-100">

                                <div class="col-12">
                                    <label class="col-12 control-label">{{trans('lang.reason_for_rejection')}}</label>
                                    <input type="text" name="reason" class="form-control" id="reason">
                                    <input type="text" name="ride_id" class="form-control" id="ride_id" hidden>
                                    <input type="text" name="driver_id" class="form-control" id="driver_id" hidden>
                                    <input type="text" name="price_add" class="form-control" id="price_add" hidden>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save_reason">{{trans('submit')}}</a>
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            aria-label="Close">{{trans('close')}}</a>
                        </button>


                    </div>
                </form>
            </div>
        </div>

    </div>

</div>


@endsection


@section('scripts')

<script>
    var driverCheckConfirm = "{{ trans('lang.driver_check_confirm') }}";

    var database = firebase.firestore();

    if ('<?php echo $id ?>' != "") {
        var refData = database.collection('withdrawal_history').where('userId', '==', '<?php echo $id ?>');

    } else {
        var refData = database.collection('withdrawal_history');


    }

    var ref = refData.orderBy('createdDate', 'desc');
    var append_list = '';
    var currentCurrency = '';

    var currencyAtRight = false;
    var decimal_degits = 0;

    var refCurrency = database.collection('currency').where('enable', '==', true);

    refCurrency.get().then(async function (snapshots) {

        var currencyData = snapshots.docs[0].data();

        currentCurrency = currencyData.symbol;

        currencyAtRight = currencyData.symbolAtRight;

        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimalDigits) {
            decimal_degits = currencyData.decimalDigits;
        }


    });


    $(document).ready(function () {

        jQuery("#overlay").show();


        append_list = document.getElementById('append_list1');

        append_list.innerHTML = '';

        ref.get().then(async function (snapshots) {

            var html = '';

            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }

            if (html != '') {

                append_list.innerHTML = html;
            }

            $('#payoutTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 3,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    { orderable: false, targets: [0, 5] },

                ],
                order: [['3', 'desc']],
                "language": {
                    "zeroRecords": "{{trans('lang.no_record_found')}}",
                    "emptyTable": "{{trans('lang.no_record_found')}}"
                }
            });


            jQuery("#overlay").hide();

        });


    });

    $(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });

    async function buildHTML(snapshots) {

        var html = '';

        await Promise.all(snapshots.docs.map(async (listval) => {

            var val = listval.data();
            var getData = await getListData(val);
            html += getData;

        }));

        return html;

    }

    function getListData(val) {
        var html = '';
        html = html + '<tr>';

        if ('<?php echo $id ?>' == "") {
            const payoutDriver = payoutDriverfunction(val.userId, val.id, val.amount);

            html = html + '<td class="driver_' + val.userId + '"></td>';

        }

        if (currencyAtRight) {

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

        if (val.adminNote) {
            html = html + '<td>' + val.adminNote + '</td>';

        } else {
            html = html + '<td></td>';
        }

        if (val.paymentStatus && val.paymentStatus == "pending") {
            html += '<td class="action-btn"><div class="user_not_found_' + val.userId + '"></div>';
            html += '</td>';
        } else {
            html = html + '<td></td>';
        }

        html = html + '</tr>';
        return html;
    }

    async function getDriverBankDetails() {
        var driverId = $('#driverId').val();

        await database.collection('bank_details').where("userId", "==", driverId).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var user_data = snapshotss.docs[0].data();
                if (user_data) {

                    $('#bankName').val(user_data.bankName);
                    $('#branchName').val(user_data.branchName);
                    $('#holderName').val(user_data.holderName);
                    $('#accountNumber').val(user_data.accountNumber);
                    $('#otherDetails').val(user_data.otherInformation);

                }

            }
        });

    }

    $(document).on("click", "a[name='driver_view']", function (e) {
        $('#bankName').val("");
        $('#branchName').val("");
        $('#holderName').val("");
        $('#accountNumber').val("");
        $('#otherDetails').val("");

        var id = this.id;
        var auth = $(this).attr('data-auth');
        var price = $(this).attr('data-price');
        $('#driverId').val(auth);
        $('.acceptBtn').attr('data-auth', auth);
        $('.acceptBtn').attr('data-price', price);
        $('.acceptBtn').attr('id', id);
        $('.rejectBtn').attr('data-auth', auth);
        $('.rejectBtn').attr('data-price', price);
        $('.rejectBtn').attr('id', id);
        getDriverBankDetails();

    });

    async function payoutDriverfunction(driver, id, amount) {

        var payoutDriver = '';

        await database.collection('driver_users').where("id", "==", driver).get().then(async function (snapshotss) {


            if (snapshotss.docs[0]) {

                var driver_data = snapshotss.docs[0].data();

                payoutDriver = driver_data.fullName;

                var routedriver = '{{route("drivers.view",":id")}}';

                routedriver = routedriver.replace(':id', driver);

                jQuery(".driver_" + driver).html('<a href="' + routedriver + '" class="redirecttopage">' + payoutDriver + '</a>').addClass('redirecttopage');
                jQuery(".user_not_found_" + driver).html('<a id="' + id + '" data-price="' + amount + '" name="driver_view" data-auth="' + driver + '" href="javascript:void(0)" data-toggle="modal" data-target="#bankdetailsModal"><i class="fa fa-eye"></i></a><a id="' + id + '" name="driver_check" data-price="' + amount + '" data-auth="' + driver + '" href="javascript:void(0)" data-toggle="modal" data-target="#bankdetailsModal"><i class="fa fa-check" style="color:green"></i></a>' +
                    '<a id="' + id + '" data-price="' + amount + '" name="reject-request" data-auth="' + driver + '" href="javascript:void(0)" data-toggle="modal" data-target="#reasonModal"><i class="fa fa-close" ></i></a>');

            } else {

                jQuery(".driver_" + driver).html('{{trans("lang.unknown_user")}}');
            }

        });

        return payoutDriver;

    }


    $(document).on("click", "a[name='driver_check']", function (e) {
        var id = this.id;
        var fullname = $(this).attr('data-name');
        var auth = $(this).attr('data-auth');
        var price = $(this).attr('data-price');
        $('.acceptBtn').attr('data-auth', auth);
        $('.acceptBtn').attr('data-price', price);
        $('.acceptBtn').attr('id', id);
        $('.rejectBtn').attr('data-auth', auth);
        $('.rejectBtn').attr('data-price', price);
        $('.rejectBtn').attr('id', id);
        $('#driverId').val(auth);


        getDriverBankDetails();


    });

    $(document).on("click", "a[name='reject-request']", function (e) {
        $('#bankdetailsModal').modal('hide');
        var id = this.id;
        var auth = $(this).attr('data-auth');
        var priceadd = $(this).attr('data-price');
        $('#ride_id').val(id);
        $('#driver_id').val(auth);
        $('#price_add').val(priceadd);
    })
    $('.save_reason').click(function () {
         
        var id = $('#ride_id').val();
        var auth = $('#driver_id').val();
        var priceadd = $('#price_add').val();
        var reason = $('#reason').val();
        jQuery("#overlay").show().html("{{trans('lang.saving')}}");
        database.collection('driver_users').where("id", "==", auth).get().then(function (resultDriver) {
            if (resultDriver.docs.length) {
                var driver = resultDriver.docs[0].data();
                var walletAmount = 0;
                if (isNaN(driver.walletAmount) || driver.walletAmount == undefined) {
                    walletAmount = 0;
                } else {
                    walletAmount = driver.walletAmount;
                }

                price = parseFloat(walletAmount) + parseFloat(priceadd);
                price = price.toString();
                database.collection('withdrawal_history').doc(id).update({
                    'paymentStatus': 'rejected',
                    'adminNote': reason
                }).then(function (result) {
                    database.collection('driver_users').doc(driver.id).update({ 'walletAmount': price }).then(function (result) {
                        window.location.href = '{{ url()->current() }}';
                    });
                });

            } else {
                alert('driver not found.');
            }
        });
    });

    $('.acceptBtn').click(function () {
        
        var id = this.id;
        console.log(id);
        var auth = $(this).attr('data-auth');
        console.log(auth);
        jQuery("#overlay").show().html("{{trans('lang.saving')}}");
        database.collection('withdrawal_history').doc(id).update({ 'paymentStatus': 'approved' }).then(function (result) {
            window.location.href = '{{ url()->current() }}';
        });
    });


</script>


@endsection