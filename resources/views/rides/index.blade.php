@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">{{trans('lang.order_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.order_plural')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                            style="display: none;">{{trans('lang.processing')}}
                        </div>

                        {{--
                        <div id="users-table_filter" class="pull-right">
                            <div class="row">
                                <div class="col-sm-12">

                                    <label>{{trans('lang.search_by')}}
                                        <select name="selected_search" id="selected_search"
                                            class="form-control input-sm">
                                            <option value="status">{{trans('lang.order_order_status_id')}}</option>
                                            <option value="rideid">{{trans('lang.order_id')}}</option>
                                            <option value="service">{{trans('lang.service')}}</option>
                                            <option value="customer">{{trans('lang.customer')}}</option>
                                            <option value="driver">{{trans('lang.driver')}}</option>
                                        </select>
                                    </label>
                                    <div class="form-group">
                                        <!-- <div id="selected_change"> -->
                                        <select id="order_status" class="form-control">
                                            <option value="">{{ trans('lang.all')}}</option>
                                            <option value="Ride Placed">{{ trans('lang.order_placed')}}</option>
                                            <option value="Ride Active">{{ trans('lang.order_active')}}</option>
                                            <option value="Ride InProgress">{{ trans('lang.ride_inprogress')}}</option>
                                            <option value="Ride Completed">{{ trans('lang.order_completed')}}</option>
                                        </select>
                                        <input type="search" id="search" class="search form-control"
                                            placeholder="Search" aria-controls="users-table">

                                        <button onclick="searchtext();"
                                            class="btn btn-warning btn-flat search_button">{{trans('lang.search')}}
                                        </button>
                                        &nbsp;<button onclick="searchclear();"
                                            class="btn btn-warning btn-flat">{{trans('lang.clear')}}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        --}}

                        <div class="table-responsive m-t-10">
                            <table id="orderTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <!-- <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                                   class="do_not_delete"
                                                                                                   href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                        </th> -->
                                        <th>{{trans('lang.order_id')}}</th>
                                        <th>{{trans('lang.customer')}}</th>
                                        <th>{{trans('lang.driver')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.service')}}</th>
                                        <th>{{trans('lang.amount')}}</th>
                                        <th>{{trans('lang.order_order_status_id')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="append_list1">
                                </tbody>
                            </table>

                            <div class="ride-status-info" style="display:none">
                                <h3>{{trans('lang.status_info')}}</h3>
                                <ul>
                                    <li><span class="status"><span
                                                class="badge badge-primary py-2 px-3">{{trans('lang.order_placed')}}</span></span><span
                                            class="info">{{trans('lang.ride_placed_info')}}</span>
                                    </li>
                                    <li><span class="status"><span
                                                class="badge badge-warning py-2 px-3">{{trans('lang.order_active')}}</span></span><span
                                            class="info">{{trans('lang.ride_active_info')}}</span>
                                    </li>
                                    <li><span class="status"><span
                                                class="badge badge-info py-2 px-3">{{trans('lang.ride_inprogress')}}</span></span><span
                                            class="info">{{trans('lang.ride_inprogress_info')}}</span>
                                    </li>
                                    <li><span class="status"><span
                                                class="badge badge-danger py-2 px-3">{{trans('lang.dashboard_ride_canceled')}}</span></span><span
                                            class="info">{{trans('lang.ride_canceled_info')}}</span>
                                    </li>
                                    <li><span class="status"><span
                                                class="badge badge-success py-2 px-3">{{trans('lang.order_completed')}}</span></span><span
                                            class="info">{{trans('lang.ride_completed_info')}}</span>
                                    </li>
                                    <li><span class="status"><span
                                                class="badge py-2 px-3 unknown-badge">{{trans('lang.unknown_user')}}</span></span><span
                                            class="info">{{trans('lang.unknown_user_info')}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="tip-box search-info" style="display:none">
                                <h5> <i class="fa fa-info-circle"> </i> Info</h5>
                                <p>{{trans('lang.search_filter_info')}}</p>
                            </div>


                            {{--
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item ">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn"
                                            onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                            onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
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

@endsection

@section('scripts')

<script type="text/javascript">
    var database = firebase.firestore();
    var offest = 1;

    var end = null;
    var endarray = [];
    var start = null;
    var append_list = '';

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

    var refData = database.collection('orders').orderBy('createdDate', 'desc');

    $(document).ready(function () {

        jQuery('#search').hide();

        /*$(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });*/

        jQuery("#overlay").show();

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';

        refData.get().then(async function (snapshots) {
            html = '';
            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
            }
            // setTimeout(function () {
            $('#orderTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 3,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    { orderable: false, targets: [1, 2, 6, 7] },
                ],
                order: [['3', 'desc']],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                responsive: true
            });
            $(".ride-status-info").show();
            $('.search-info').show();
            jQuery("#overlay").hide();
            // }, 2000);
        });
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

    async function getListData(val) {
        var html = '';
        html = html + '<tr>';
        var id = val.id;
        var user_id = val.userId;
        var ride_view = '{{route("rides.show",":id")}}';
        ride_view = ride_view.replace(':id', val.id);
        // html += '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
        //     'for="is_open_' + id + '" ></label></td>';
        /*id = id.substr(id.length - 10);*/
        id = id.substring(0, 7);
        html += '<td><a href="' + ride_view + '">' + id + '</a></td>';
        if (val.userId) {
            var userData = await getUserName(user_id, id);
            if (Object.keys(userData).length > 0) {
                var customer_view = '{{route("users.view",":id")}}';
                customer_view = customer_view.replace(':id', val.userId);
                html += '<td class="redirecttopage user_name_' + val.id + '"><a href="' + customer_view + '">' + userData.fullName + '</a></td>';
            } else {
                html += '<td class="redirecttopage user_name_' + val.id + '">' + '{{trans("lang.unknown_user")}}' + '</td>';
            }
        } else {
            html += '<td class="redirecttopage user_name_' + val.id + '"></td>';
        }

        if (val.driverId && val.driverId != null) {
            var driver_id = val.driverId;
            var driverData = await getDriverName(driver_id, id);
            if (Object.keys(driverData).length > 0) {
                var driver_view = '{{route("drivers.view",":id")}}';
                driver_view = driver_view.replace(':id', driverData.id);
                html += '<td class="redirecttopage driver_name_' + val.id + '"><a href="' + driver_view + '">' + driverData.fullName + '</a></td>';
            } else {
                html += '<td class="redirecttopage driver_name_' + val.id + '">' + '{{trans("lang.unknown_user")}}' + '</td>';
            }
        } else {
            html += '<td class="redirecttopage driver_name_' + val.id + '"></td>';
        }
        var date = '';
        var time = '';
        if (val.hasOwnProperty("createdDate")) {
            try {
                date = val.createdDate.toDate().toDateString();
                time = val.createdDate.toDate().toLocaleTimeString('en-US');
            } catch (err) {
            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
        } else {
            html = html + '<td></td>';
        }
        html = html + '<td>' + val.service.title + '</td>';
        var amount = 0;
        if (val.driverId) {
            amount = await getOrderDetails(val);
        } else {
            if (val.offerRate) {
                amount = parseFloat(val.offerRate);
            }
            amount = amount.toFixed(decimal_degits);
        }
        if (symbolAtRight) {
            html += '<td>' + amount + currentCurrency + '</td>';
        } else {
            html += '<td>' + currentCurrency + amount + '</td>';
        }
        if (val.status == "Ride Placed") {
            html += '<td><span class="badge badge-primary py-2 px-3">' + val.status + '</span></td>';
        } else if (val.status == "Ride Completed") {
            html += '<td><span  class="badge badge-success py-2 px-3">' + val.status + '</span></td>';
        } else if (val.status == "Ride Active") {
            html += '<td><span class="badge badge-warning py-2 px-3">' + val.status + '</span></td>';
        } else if (val.status == "Ride InProgress") {
            html += '<td><span class="badge badge-info py-2 px-3">' + val.status + '</span></td>';
        } else if (val.status == "Ride Canceled") {
            html += '<td><span class="badge badge-danger py-2 px-3">' + val.status + '</span></td>';
        }
        html += '<td class="action-btn"><a href="' + ride_view + '"><i class="fa fa-eye"></i></a></td>';
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


    $("#is_active").click(function () {
        $("#orderTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#orderTable .is_open:checked').length) {
            if (confirm("{{trans('lang.selected_delete_alert')}}")) {
                jQuery("#overlay").show();
                $('#orderTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');
                    database.collection('orders').doc(dataId).delete().then(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 5000);
                    });

                });

            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });

    $(document.body).on('change', '#selected_search', function () {

        if (jQuery(this).val() == 'status') {
            jQuery('#order_status').show();
            jQuery('#search').hide();
        } else {

            jQuery('#order_status').hide();
            jQuery('#search').show();

        }
    });

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {

            jQuery("#overlay").show();
            if (jQuery("#selected_search").val() == 'status' && jQuery("#order_status").val().trim() != '') {
                var order_status = jQuery('#order_status').val();

                var listener = refData.orderBy('status').startAt(end).limit(pagesize).startAt(order_status).endAt(order_status + '\uf8ff').get();

                listener.then((snapshots) => {
                    html = '';

                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();
                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];
                        endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                    }
                });

            } else if (jQuery("#selected_search").val() == 'service' && jQuery("#search").val().trim() != '') {
                var search = jQuery('#search').val();

                var wherequery = refData.orderBy('service.title').startAt(end).limit(pagesize).startAt(search).endAt(search + '\uf8ff').get();

                wherequery.then((snapshots) => {

                    if (snapshots.docs.length > 0) {
                        html = '';
                        html = buildHTML(snapshots);
                        jQuery("#overlay").hide();
                        if (html != '') {
                            append_list.innerHTML = html;
                            start = snapshots.docs[snapshots.docs.length - 1];

                            endarray.push(snapshots.docs[0]);
                            if (snapshots.docs.length < pagesize) {

                                jQuery("#data-table_paginate").hide();
                            } else {

                                jQuery("#data-table_paginate").show();
                            }
                        }
                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }

                });

            } else if (jQuery("#selected_search").val() == 'rideid' && jQuery("#search").val().trim() != '') {
                var search = jQuery('#search').val();

                var wherequery = refData.orderBy('id').startAt(end).limit(pagesize).startAt(search).endAt(search + '\uf8ff').get();

                wherequery.then((snapshots) => {

                    if (snapshots.docs.length > 0) {
                        html = '';
                        html = buildHTML(snapshots);
                        jQuery("#overlay").hide();
                        if (html != '') {
                            append_list.innerHTML = html;
                            start = snapshots.docs[snapshots.docs.length - 1];

                            endarray.push(snapshots.docs[0]);
                            if (snapshots.docs.length < pagesize) {

                                jQuery("#data-table_paginate").hide();
                            } else {

                                jQuery("#data-table_paginate").show();
                            }
                        }
                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }

                });

            } else if (jQuery("#selected_search").val() == 'customer' && jQuery("#search").val().trim() != '') {
                var search = jQuery("#search").val();

                database.collection('users').orderBy('fullName').startAt(search).endAt(search + '\uf8ff').get().then(async function (snapshots) {

                    if (snapshots.docs.length > 0) {

                        var userID = [];
                        snapshots.docs.forEach((listval) => {
                            var datas = listval.data();
                            datas.id = listval.id;

                            userID.push(datas.id);
                        });

                        var listener = refData.where('userId', 'in', userID).startAt(end).limit(pagesize).get();

                        listener.then((snapshots) => {
                            html = '';
                            html = buildHTML(snapshots);
                            jQuery("#overlay").hide();
                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshots.docs[snapshots.docs.length - 1];
                                endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                            } else {
                                jQuery("#overlay").hide();
                                append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                            }
                        });

                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }
                });

            } else if (jQuery("#selected_search").val() == 'driver' && jQuery("#search").val().trim() != '') {
                var search = jQuery("#search").val();

                database.collection('driver_users').orderBy('fullName').startAt(search).endAt(search + '\uf8ff').get().then(async function (snapshots) {

                    if (snapshots.docs.length > 0) {

                        var driverID = [];
                        snapshots.docs.forEach((listval) => {
                            var datas = listval.data();
                            datas.id = listval.id;

                            driverID.push(datas.id);
                        });

                        var listener = refData.where('driverId', 'in', driverID).startAt(end).limit(pagesize).get();

                        listener.then((snapshots) => {
                            html = '';
                            html = buildHTML(snapshots);
                            jQuery("#overlay").hide();
                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshots.docs[snapshots.docs.length - 1];
                                endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                            } else {
                                jQuery("#overlay").hide();
                                append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                            }
                        });

                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }
                });

            } else {

                var listener = refData.limit(pagesize).startAt(end).get();

                listener.then((snapshots) => {
                    html = '';
                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();
                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];
                        endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                    }
                });
            }


        }
    }

    function next() {

        if (start != undefined || start != null) {

            jQuery("#overlay").show();

            if (jQuery("#selected_search").val() == 'status' && jQuery("#order_status").val().trim() != '') {
                var order_status = jQuery('#order_status').val();

                var listener = refData.orderBy('status').startAfter(start).limit(pagesize).startAt(order_status).endAt(order_status + '\uf8ff').get();

                listener.then((snapshots) => {

                    html = '';
                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();

                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];

                        if (endarray.indexOf(snapshots.docs[0]) != -1) {
                            endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                        }
                        endarray.push(snapshots.docs[0]);
                    }
                });

            } else if (jQuery("#selected_search").val() == 'service' && jQuery("#search").val().trim() != '') {
                var search = jQuery('#search').val();

                var wherequery = refData.orderBy('service.title').startAfter(start).limit(pagesize).startAt(search).endAt(search + '\uf8ff').get();

                wherequery.then((snapshots) => {

                    if (snapshots.docs.length > 0) {
                        html = '';
                        html = buildHTML(snapshots);
                        jQuery("#overlay").hide();
                        if (html != '') {
                            append_list.innerHTML = html;
                            start = snapshots.docs[snapshots.docs.length - 1];

                            endarray.push(snapshots.docs[0]);
                            if (snapshots.docs.length < pagesize) {

                                jQuery("#data-table_paginate").hide();
                            } else {

                                jQuery("#data-table_paginate").show();
                            }
                        }
                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }

                });

            } else if (jQuery("#selected_search").val() == 'rideid' && jQuery("#search").val().trim() != '') {
                var search = jQuery('#search').val();

                var wherequery = refData.orderBy('id').startAfter(start).limit(pagesize).startAt(search).endAt(search + '\uf8ff').get();

                wherequery.then((snapshots) => {

                    if (snapshots.docs.length > 0) {
                        html = '';
                        html = buildHTML(snapshots);
                        jQuery("#overlay").hide();
                        if (html != '') {
                            append_list.innerHTML = html;
                            start = snapshots.docs[snapshots.docs.length - 1];

                            endarray.push(snapshots.docs[0]);
                            if (snapshots.docs.length < pagesize) {

                                jQuery("#data-table_paginate").hide();
                            } else {

                                jQuery("#data-table_paginate").show();
                            }
                        }
                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }

                });

            } else if (jQuery("#selected_search").val() == 'customer' && jQuery("#search").val().trim() != '') {
                var search = jQuery("#search").val();

                database.collection('users').orderBy('fullName').startAt(search).endAt(search + '\uf8ff').get().then(async function (snapshots) {

                    if (snapshots.docs.length > 0) {

                        var userID = [];
                        snapshots.docs.forEach((listval) => {
                            var datas = listval.data();
                            datas.id = listval.id;

                            userID.push(datas.id);
                        });

                        var listener = refData.where('userId', 'in', userID).startAfter(start).limit(pagesize).get();

                        listener.then((snapshots) => {
                            html = '';
                            html = buildHTML(snapshots);
                            jQuery("#overlay").hide();

                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshots.docs[snapshots.docs.length - 1];

                                if (endarray.indexOf(snapshots.docs[0]) != -1) {
                                    endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                                }
                                endarray.push(snapshots.docs[0]);
                            } else {
                                jQuery("#overlay").hide();
                                append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                            }
                        });

                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }
                });

            } else if (jQuery("#selected_search").val() == 'driver' && jQuery("#search").val().trim() != '') {
                var search = jQuery("#search").val();

                database.collection('driver_users').orderBy('fullName').startAt(search).endAt(search + '\uf8ff').get().then(async function (snapshots) {

                    if (snapshots.docs.length > 0) {

                        var driverID = [];
                        snapshots.docs.forEach((listval) => {
                            var datas = listval.data();
                            datas.id = listval.id;

                            driverID.push(datas.id);
                        });

                        var listener = refData.where('driverId', 'in', driverID).startAfter(start).limit(pagesize).get();

                        listener.then((snapshots) => {
                            html = '';
                            html = buildHTML(snapshots);
                            jQuery("#overlay").hide();

                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshots.docs[snapshots.docs.length - 1];

                                if (endarray.indexOf(snapshots.docs[0]) != -1) {
                                    endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                                }
                                endarray.push(snapshots.docs[0]);
                            } else {
                                jQuery("#overlay").hide();
                                append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                            }
                        });

                    } else {
                        jQuery("#overlay").hide();
                        append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                    }
                });

            } else {

                var listener = refData.startAfter(start).limit(pagesize).get();

                listener.then((snapshots) => {
                    html = '';
                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();

                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];

                        if (endarray.indexOf(snapshots.docs[0]) != -1) {
                            endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                        }
                        endarray.push(snapshots.docs[0]);
                    }
                });
            }


        }
    }

    $(document).on("click", "a[name='ride-delete']", function (e) {

        var id = this.id;
        jQuery("#overlay").show();
        database.collection('orders').doc(id).delete().then(function (result) {

            window.location.href = '{{ url()->current() }}';
        });

    });

    async function getUserName(userId, id) {
        var user = {};
        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                user = snapshots.docs[0].data();
                // var customer_view = '{{route("users.edit",":id")}}';
                // customer_view = customer_view.replace(':id', userId);
                // $('.user_name_' + id).html('<a href="' + customer_view + '">' + user.fullName + '</a>');
            }
            // else {
            //     $('.user_name_' + id).html('{{trans("lang.unknown_user")}}');
            // }
        });
        return user;
    }

    async function getDriverName(driverId, id) {
        var driver = {};
        await database.collection('driver_users').where('id', '==', driverId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                driver = snapshots.docs[0].data();
                // var driver_view = '{{route("drivers.edit",":id")}}';
                // driver_view = driver_view.replace(':id', driver.id);

                // $('.driver_name_' + id).html('<a href="' + driver_view + '">' + driver.fullName + '</a>');
            }
            // else {
            //     $('.driver_name_' + id).html('{{trans("lang.unknown_user")}}');
            // }
        });
        return driver;
    }

    function searchclear() {
        jQuery("#search").val('');
        $("#search").hide();
        $('#order_status').val("").trigger('change');
        $('#selected_search').val("status").trigger('change');
        searchtext();
    }

    $('#search').keypress(function (e) {
        if (e.which == 13) {
            $('.search_button').click();
        }
    });

    function searchtext() {

        var offest = 1;
        jQuery("#overlay").show();
        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'status' && jQuery("#order_status").val().trim() != '') {
            var order_status = jQuery('#order_status').val();

            var wherequery = refData.orderBy('status').limit(pagesize).startAt(order_status).endAt(order_status + '\uf8ff').get();

            wherequery.then((snapshots) => {

                if (snapshots.docs.length > 0) {
                    html = '';
                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();
                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];

                        endarray.push(snapshots.docs[0]);
                    }
                } else {
                    jQuery("#overlay").hide();
                    append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                }
            });

        } else if (jQuery("#selected_search").val() == 'service' && jQuery("#search").val().trim() != '') {
            var search = jQuery('#search').val();

            var wherequery = refData.orderBy('service.title').limit(pagesize).startAt(search).endAt(search + '\uf8ff').get();

            wherequery.then((snapshots) => {

                if (snapshots.docs.length > 0) {
                    html = '';
                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();
                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];

                        endarray.push(snapshots.docs[0]);

                    }
                } else {
                    jQuery("#overlay").hide();
                    append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                }

            });

        } else if (jQuery("#selected_search").val() == 'rideid' && jQuery("#search").val().trim() != '') {
            var search = jQuery('#search').val();

            var wherequery = refData.orderBy('id').limit(pagesize).startAt(search).endAt(search + '\uf8ff').get();

            wherequery.then((snapshots) => {

                if (snapshots.docs.length > 0) {
                    html = '';
                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();
                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];

                        endarray.push(snapshots.docs[0]);

                    }
                } else {
                    jQuery("#overlay").hide();
                    append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';
                }

            });

        } else if (jQuery("#selected_search").val() == 'customer' && jQuery("#search").val().trim() != '') {
            var search = jQuery("#search").val();

            database.collection('users').orderBy('fullName').startAt(search).endAt(search + '\uf8ff').get().then(async function (snapshots) {

                if (snapshots.docs.length > 0) {

                    var userID = [];
                    snapshots.docs.forEach((listval) => {
                        var datas = listval.data();
                        datas.id = listval.id;

                        userID.push(datas.id);
                    });

                    var wherequery = refData.where('userId', 'in', userID).limit(pagesize).get();

                    wherequery.then((snapshots) => {
                        html = '';
                        html = buildHTML(snapshots);
                        jQuery("#overlay").hide();
                        if (html != '') {
                            append_list.innerHTML = html;
                            start = snapshots.docs[snapshots.docs.length - 1];

                            endarray.push(snapshots.docs[0]);
                        } else {
                            jQuery("#overlay").hide();
                            append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                        }
                    });

                } else {
                    jQuery("#overlay").hide();
                    append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                }
            });

        } else if (jQuery("#selected_search").val() == 'driver' && jQuery("#search").val().trim() != '') {
            var search = jQuery("#search").val();

            database.collection('driver_users').orderBy('fullName').startAt(search).endAt(search + '\uf8ff').get().then(async function (snapshots) {

                if (snapshots.docs.length > 0) {

                    var driverID = [];
                    snapshots.docs.forEach((listval) => {
                        var datas = listval.data();
                        datas.id = listval.id;

                        driverID.push(datas.id);
                    });

                    var wherequery = refData.where('driverId', 'in', driverID).limit(pagesize).get();

                    wherequery.then((snapshots) => {
                        html = '';
                        html = buildHTML(snapshots);
                        jQuery("#overlay").hide();
                        if (html != '') {
                            append_list.innerHTML = html;
                            start = snapshots.docs[snapshots.docs.length - 1];

                            endarray.push(snapshots.docs[0]);
                        } else {
                            jQuery("#overlay").hide();
                            append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                        }
                    });

                } else {
                    jQuery("#overlay").hide();
                    append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                }
            });

        } else {

            var wherequery = refData.limit(pagesize).get();
            wherequery.then((snapshots) => {
                if (snapshots.docs.length > 0) {

                    html = '';
                    html = buildHTML(snapshots);
                    jQuery("#overlay").hide();
                    if (html != '') {
                        append_list.innerHTML = html;
                        start = snapshots.docs[snapshots.docs.length - 1];

                        endarray.push(snapshots.docs[0]);

                    }

                } else {
                    jQuery("#overlay").hide();
                    append_list.innerHTML = '<tr><td colspan="9" class="text-center font-weight-bold"></td></tr>';

                }
            });

        }


    }
</script>

@endsection