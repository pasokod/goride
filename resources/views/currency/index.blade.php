@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.currency_table')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.currency_table')}}</li>
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
                                            class="fa fa-list mr-2"></i>{{trans('lang.currency_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('currency.create')}}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.currency_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div class="table-responsive m-t-10">
                            <table id="taxTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <?php if (in_array('currency.delete', json_decode(@session('user_permissions')))) { ?>

                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                                   class="do_not_delete"
                                                                                                   href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                        </th>
                                    <?php } ?>
                                    <th>{{trans('lang.currency_name')}}</th>
                                    <th>{{trans('lang.currency_symbol')}}</th>
                                    <th>{{trans('lang.currency_code')}}</th>
                                    <th>{{trans('lang.symbole_at_right')}}</th>
                                    <th>{{trans('lang.active')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody id="append_list1">
                                </tbody>
                            </table>
                            <!--<nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item ">
                                        <a class="page-link" href="javascript:void(0);"
                                           id="service_table_previous_btn"
                                           onclick="prev()" data-dt-idx="0"
                                           tabindex="0">{{trans('lang.previous')}}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" id="service_table_next_btn"
                                           onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
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

    var ref = database.collection('currency');

    var append_list = '';

    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";
    var currencyDeleteAlert = "{{trans('lang.currency_delete_alert')}}";

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('currency.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }


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
                        {orderable: false, targets: [0, 4, 5, 6]},
                    ],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    }
                });
            } else {
                $('#taxTable').DataTable({
                    order: [[0, 'asc']],
                    columnDefs: [
                        {orderable: false, targets: [3, 4, 5]},
                    ],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    }
                });
            }
        });


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

        var id = val.id;
        var route1 = '{{route("currency.edit",":id")}}';
        route1 = route1.replace(':id', id);

        if (checkDeletePermission) {

            html = html + '<td class="delete-all" class="do_not_delete"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }
        html = html + '<td><a href="' + route1 + '">' + (val.name ? val.name : val.symbol) + '</a></td>';
        html = html + '<td>' + val.symbol + '</td>';
        html = html + '<td>' + (val.code ? val.code : '') + '</td>';


        if (val.symbolAtRight) {
            html = html + '<td><span class="badge badge-success">Yes</span></td>';
        } else {
            html = html + '<td><span class="badge badge-danger">No</span></td>';
        }

        if (val.enable) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="publish"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="publish"><span class="slider round"></span></label></td>';
        }

        html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';
        if (checkDeletePermission) {

            html = html + '<a id="' + val.id + '" name="currency-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';

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

                    database.collection('currency').doc(dataId).delete().then(function () {

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


            listener = ref.startAt(end).limit(pagesize).get();

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


            listener = ref.startAfter(start).limit(pagesize).get();

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
        searchtext();
    }


    function searchtext() {

        append_list.innerHTML = '';

        wherequery = ref.limit(pagesize).get();

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


    $(document).on("click", "input[name='publish']", function (e) {

        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('currency').doc(id).update({'enable': true}).then(function (result) {

            });
            //only 1 currency should active at a time
            database.collection('currency').where('enable', "==", true).get().then(function (snapshots) {
                var activeCurrency = snapshots.docs[0].data();
                var activeCurrencyId = activeCurrency.id;
                database.collection('currency').doc(activeCurrencyId).update({'enable': false});

                $("#append_list1 tr").each(function () {
                    $(this).find(".switch #" + activeCurrencyId).prop('checked', false);
                });
            });
        } else {
            database.collection('currency').where('enable', "==", true).get().then(function (snapshots) {
                var activeCurrency = snapshots.docs[0].data();
                var activeCurrencyId = activeCurrency.id;
                if (snapshots.docs.length == 1 && activeCurrencyId == id) {
                    alert(currencyDeleteAlert);
                    $("#" + id).prop('checked', true);
                    return false;
                } else {
                    database.collection('currency').doc(id).update({'enable': false}).then(function (result) {
                    });
                }
            });
        }

    });

    $(document).on("click", "a[name='currency-delete']", function (e) {
        if (confirm(deleteMsg)) {
            var id = this.id;
            jQuery("#overlay").show();
            database.collection('currency').doc(id).delete().then(function (result) {

                window.location.href = '{{ url()->current() }}';

            });

        } else {
            return false;
        }

    });

</script>

@endsection