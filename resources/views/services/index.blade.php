@extends('layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{ trans('lang.service_plural') }}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('lang.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('lang.service_table') }}</li>
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
                                            class="fa fa-list mr-2"></i>{{ trans('lang.service_table') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('services.create') }}"><i
                                            class="fa fa-plus mr-2"></i>{{ trans('lang.service_create') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{ trans('lang.processing') }}
                        </div>

                        <!--<div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by') }}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{ trans('lang.title') }}</option>
                                    <option value="kmCharge" class="global_value"></option>

                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search"
                                           aria-controls="users-table">
                            </label>&nbsp;
                            <button onclick="searchtext();" class="btn btn-warning btn-flat search_button">Search
                            </button>&nbsp;
                            <button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>
                        </div>-->
                        <div class="table-responsive m-t-10">
                            <table id="taxTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <?php if (in_array('service.delete', json_decode(@session('user_permissions')))) { ?>

                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                                   class="do_not_delete"
                                                                                                   href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{ trans('lang.all') }}</a></label>
                                        </th>
                                    <?php } ?>
                                    <th>{{ trans('lang.title') }}</th>
                                    <th>{{ trans('lang.image') }}</th>
                                    <th class="global_value"></th>
                                    <th>{{ trans('lang.enable_offer_rate') }}</th>
                                    <th>{{ trans('lang.status') }}</th>
                                    <th>{{ trans('lang.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody id="append_list1">
                                </tbody>
                            </table>
                            <!--<nav aria-label="Page navigation example" id="data-table_paginate">
                            <ul class="pagination justify-content-center">
                                <li class="page-item ">
                                    <a class="page-link" href="javascript:void(0);" id="service_table_previous_btn"
                                       onclick="prev()" data-dt-idx="0" tabindex="0">{{ trans('lang.previous') }}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" id="service_table_next_btn"
                                       onclick="next()" data-dt-idx="2" tabindex="0">{{ trans('lang.next') }}</a>
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

    var ref = database.collection('service');
    var defaultImg = "{{ asset('/images/default_user.png') }}";
    var append_list = '';

    var deleteMsg = "{{ trans('lang.delete_alert') }}";
    var deleteSelectedRecordMsg = "{{ trans('lang.selected_delete_alert') }}";
    var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('service.delete', user_permissions) >= 0) {
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
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
            }

            if (checkDeletePermission) {

                $('#taxTable').DataTable({
                    order: [
                        [1, 'asc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 2, 4, 5, 6]
                    },

                    ],
                    order: [
                        ['1', 'asc']
                    ],
                    "language": {
                        "zeroRecords": "{{ trans('lang.no_record_found') }}",
                        "emptyTable": "{{ trans('lang.no_record_found') }}"
                    },
                    responsive: true
                });
            } else {
                $('#taxTable').DataTable({
                    order: [
                        [0, 'asc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [1, 3, 4, 5]
                    },

                    ],
                    order: [
                        ['0', 'asc']
                    ],
                    "language": {
                        "zeroRecords": "{{ trans('lang.no_record_found') }}",
                        "emptyTable": "{{ trans('lang.no_record_found') }}"
                    },
                    responsive: true
                });
            }
            jQuery("#overlay").hide();

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
        newdate = '';
        var id = val.id;
        var route1 = '{{ route("services.edit",":id") }}';
        route1 = route1.replace(':id', id);

        var trroute1 = '';
        trroute1 = trroute1.replace(':id', id);
        if (checkDeletePermission) {


            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id +
                '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

        }
        html = html + '<td><a href="' + route1 + '" name="service-edit">' + val.title + '</a></td>';
        if (val.image == '') {
            html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
        } else {
            html = html + '<td><img class="rounded" style="width:50px" src="' + val.image + '" alt="image"></td>';
        }
        var kmCharge = parseFloat(val.kmCharge);

        if (symbolAtRight) {
            html += '<td>' + kmCharge.toFixed(decimal_degits) + currentCurrency + '</td>';

        } else {
            html += '<td>' + currentCurrency + kmCharge.toFixed(decimal_degits) + '</td>';

        }

        if (val.offerRate) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id +
                '" name="isofferRate"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id +
                '" name="isofferRate"><span class="slider round"></span></label></td>';
        }
        if (val.enable) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id +
                '" name="isEnabled"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id +
                '" name="isEnabled"><span class="slider round"></span></label></td>';
        }


        html = html + '<td class="action-btn"><a href="' + route1 +
            '" name="service-edit"><i class="fa fa-edit"></i></a>';


        if (checkDeletePermission) {

            html = html + '<a id="' + val.id +
                '" class="do_not_delete" name="service-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
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

                    database.collection('service').doc(dataId).delete().then(function () {

                        window.location.reload();

                    });
                });
            } else {
                return false;
            }
        } else {
            alert("{{ trans('lang.select_delete_alert') }}");
        }
    });


    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {
                listener = ref.orderBy('title').startAt(end).limit(pagesize).startAt(jQuery("#search").val()).endAt(
                    jQuery("#search").val() + '\uf8ff').get();

            } else if (jQuery("#selected_search").val() == 'kmCharge' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('kmCharge').startAt(end).limit(pagesize).startAt(jQuery("#search").val()).endAt(
                    jQuery("#search").val() + '\uf8ff').get();

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
                } else {
                    append_list.innerHTML = '<tr><td colspan="7" class="text-center font-weight-bold">{{ trans("lang.no_record_found") }}</td></tr>';


                }
            });
        }
    }

    function next() {

        if (start != undefined || start != null) {

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('title').startAfter(start).limit(pagesize).startAt(jQuery("#search").val())
                    .endAt(jQuery("#search").val() + '\uf8ff').get();

            } else if (jQuery("#selected_search").val() == 'kmCharge' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('kmCharge').startAfter(start).limit(pagesize).startAt(jQuery("#search").val())
                    .endAt(jQuery("#search").val() + '\uf8ff').get();

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
                } else {
                    append_list.innerHTML =
                        '<tr><td colspan="7" class="text-center font-weight-bold">{{ trans("lang.no_record_found") }}</td></tr>';


                }
            });
        }
    }

    function searchclear() {
        jQuery("#search").val('');
        jQuery("#selected_search").val('title').trigger('change');
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

            wherequery = ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search")
                .val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'kmCharge' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('kmCharge').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery(
                "#search").val() + '\uf8ff').get();

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
            } else {
                append_list.innerHTML =
                    '<tr><td colspan="7" class="text-center font-weight-bold">{{ trans("lang.no_record_found") }}</td></tr>';


            }
        });

    }


    $(document).on("click", "input[name='isEnabled']", function (e) {

        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('service').doc(id).update({
                'enable': true
            }).then(function (result) {

            });
        } else {
            database.collection('service').doc(id).update({
                'enable': false
            }).then(function (result) {

            });
        }

    });
    $(document).on("click", "input[name='isofferRate']", function (e) {

        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('service').doc(id).update({
                'offerRate': true
            }).then(function (result) {

            });
        } else {
            database.collection('service').doc(id).update({
                'offerRate': false
            }).then(function (result) {

            });
        }

    });


    $(document).on("click", "a[name='service-delete']", function (e) {
        if (confirm(deleteMsg)) {
            var id = this.id;
            jQuery("#overlay").show();
            database.collection('service').doc(id).delete().then(function (result) {

                window.location.href = '{{ url()->current() }}';

            });

        } else {
            return false;
        }

    });
    
</script>
@endsection
