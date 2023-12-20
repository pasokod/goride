@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.all_coupon_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.coupon_table')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                            class="fa fa-list mr-2"></i>{{trans('lang.coupon_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/coupons/save/0') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <!--  <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                  <select name="selected_search" id="selected_search" class="form-control input-sm">
                                      <option value="title">{{ trans('lang.coupon_title')}}</option>
                                      <option value="code">{{ trans('lang.coupon_code')}}</option>
                                      <option value="type">{{ trans('lang.coupon_type')}}</option>
                                  </select>
                                  <div class="form-group">
                                      <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table">
                              </label>&nbsp;
                              <select class="form-control" name="search_tax_type" style="display:none" id="search_tax_type">
                                  <option value="">
                                      {{trans('lang.select_type')}}
                                  </option>
                                  <option value="fix">
                                      {{trans('lang.fixed')}}
                                  </option>
                                  <option value="percentage">
                                      {{trans('lang.percentage')}}
                                  </option>
                              </select>&nbsp;
                              <button onclick="searchtext();" class="btn btn-warning btn-flat search_button">Search</button>&nbsp;
                              <button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>
                          </div>
                      </div>-->
                        <div class="table-responsive m-t-10">
                            <table id="taxTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <?php if (in_array('coupon.delete', json_decode(@session('user_permissions')))) { ?>

                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                                   class="do_not_delete"
                                                                                                   href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                        </th>
                                    <?php } ?>
                                    <th>{{trans('lang.coupon_title')}}</th>
                                    <th>{{trans('lang.coupon_code')}}</th>
                                    <th>{{trans('lang.coupon_type')}}</th>
                                    <th>{{trans('lang.coupon_discount')}}</th>
                                    <th>{{trans('lang.coupon_enable')}}</th>
                                    <th>{{trans('lang.privacy')}}</th>
                                    <th>{{trans('lang.coupon_validity')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody id="append_list1">
                                </tbody>
                            </table>
                            <!--<nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item ">
                                        <a class="page-link" href="javascript:void(0);" id="coupon_table_previous_btn" onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" id="coupon_table_next_btn" onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                    </li>
                                </ul>
                            </nav>-->

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

@section('scripts')


<script type="text/javascript">
    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];

    var ref = database.collection('coupon').where('isDeleted', '==', false).orderBy('title');

    var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('coupon.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }


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
    var append_list = '';

    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

    $(document).ready(function () {
        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#overlay").show();
        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.get().then(async function (snapshots) {
            html = '';
            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }
            //html = buildHTML(snapshots);
            jQuery("#overlay").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);

                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
                // disableClick();
            }

            if (checkDeletePermission) {
                $('#taxTable').DataTable({
                    order: [[1, 'asc']],
                    columnDefs: [
                        {
                            targets: 6,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [0, 5, 8]},

                    ],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    },
                    responsive: true
                });
            } else {
                $('#taxTable').DataTable({
                    order: [[0, 'asc']],
                    columnDefs: [
                        {
                            targets: 5,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [4, 7]},

                    ],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    },
                    responsive: true
                });
            }

        });

        $('#selected_search').on('change', function () {
            selected_search = $('#selected_search').val();
            if (selected_search == "type") {
                $('#search').hide();
                $('#search_tax_type').show();
            } else {
                $('#search').show();
                $('#search_tax_type').hide();
            }
        })
    });


    async function buildHTML(snapshots) {


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
        newdate = '';
        var id = val.id;
        var route1 = '{{route("coupons.save",":id")}}';
        route1 = route1.replace(':id', id);
        var trroute1 = '';
        trroute1 = trroute1.replace(':id', id);

        if (checkDeletePermission) {

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }
        html = html + '<td><a href="' + route1 + '">' + val.title + '</a></td>';
        html = html + '<td>' + val.code + '</td>';
        var type = val.type;
        html = html + '<td>' + (type.charAt(0).toUpperCase()) + type.slice(1) + '</td>';

        if (val.type == "fix") {

            var amount = parseFloat(val.amount);
            if (symbolAtRight) {
                html += '<td>' + amount.toFixed(decimal_degits) + currentCurrency + '</td>';

            } else {
                html += '<td>' + currentCurrency + amount.toFixed(decimal_degits) + '</td>';

            }
        } else {
            html = html + '<td>' + val.amount + '%</td>';

        }

        if (val.enable) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        }
        if (val.isPublic) {
            html += '<td><span class="badge badge-success py-2 px-3">{{trans("lang.public")}}</span></td>';
        } else {
            html += '<td><span class="badge badge-danger py-2 px-3">{{trans("lang.private")}}</span></td>';
        }
        var date = new Date(val.validity.seconds * 1000);
        var dateFormat = date.toDateString() + " , " + date.toLocaleString('en-US', {
            hour: 'numeric',
            minute: 'numeric',
            hour12: true
        });
        html = html + '<td class="dt-time">' + dateFormat + '</td>';
        html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';
        if (checkDeletePermission) {

            html = html + '<a id="' + val.id + '" class="do_not_delete" name="tax-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }
        html = html + '</td>';
        html = html + '</tr>';
        return html;
    }


    $("#is_active").click(function () {
        $("#taxTable .is_open").prop('checked', $(this).prop('checked'));
    });

    $("#deleteAll").click(function () {
        if ($('#taxTable .is_open:checked').length) {
            if (confirm(deleteSelectedRecordMsg)) {
                jQuery("#overlay").show();
                $('#taxTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');
                    database.collection('coupon').doc(dataId).update({
                        'isDeleted': true,
                        'enable': false
                    }).then(function () {
                        window.location.reload();
                    });
                });
            } else {
                return false;
            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {
                listener = ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            } else if (jQuery("#selected_search").val() == 'code' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            } else if (jQuery("#selected_search").val() == 'type' && jQuery("#search_tax_type").val().trim() != '') {

                listener = ref.orderBy('type').limit(pagesize).startAt(jQuery("#search_tax_type").val()).endAt(jQuery("#search_tax_type").val() + '\uf8ff').startAt(end).get();

            } else {
                listener = ref.startAt(end).limit(pagesize).get();
            }

            listener.then((snapshots) => {
                html = '';
                html = buildHTML(snapshots);

                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);
                }
            });
        }
    }

    function next() {

        if (start != undefined || start != null) {

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            } else if (jQuery("#selected_search").val() == 'code' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            } else if (jQuery("#selected_search").val() == 'type' && jQuery("#search_tax_type").val().trim() != '') {

                listener = ref.orderBy('type').limit(pagesize).startAt(jQuery("#search_tax_type").val()).endAt(jQuery("#search_tax_type").val() + '\uf8ff').startAfter(start).get();

            } else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then((snapshots) => {

                html = '';
                html = buildHTML(snapshots);

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

    function searchclear() {
        jQuery("#search").val('');
        jQuery('#search_tax_type').val("").trigger('change');
        searchtext();
    }

    $('#search').keypress(function (e) {
        if (e.which == 13) {
            $('.search_button').click();
        }
    });

    function searchtext() {

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'code' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'type' && jQuery("#search_tax_type").val().trim() != '') {

            wherequery = ref.orderBy('type').limit(pagesize).startAt(jQuery("#search_tax_type").val()).endAt(jQuery("#search_tax_type").val() + '\uf8ff').get();

        } else {

            wherequery = ref.limit(pagesize).get();
        }

        wherequery.then((snapshots) => {

            html = '';
            html = buildHTML(snapshots);

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
        });
    }

    $(document).on("click", "input[name='isEnabled']", function (e) {

        var ischeck = $(this).is(':checked');
        var id = this.id;
        database.collection('coupon').doc(id).update({
            'enable': ischeck ? true : false
        }).then(function (result) {
        });
    });


    $(document).on("click", "a[name='tax-delete']", function (e) {
        if (confirm(deleteMsg)) {
            var id = this.id;
            jQuery("#overlay").show();
            database.collection('coupon').doc(id).update({
                'isDeleted': true,
                'enable': false
            }).then(function (result) {
                window.location.href = '{{ url()->current() }}';
            });
        } else {
            return false;
        }
    });
</script>

@endsection