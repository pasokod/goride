@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.all_document_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.document_table')}}</li>
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
                                            class="fa fa-list mr-2"></i>{{trans('lang.document_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/documents/save/0') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.document_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>
                        <div class="error_top"></div>
                        {{--
                        <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{ trans('lang.document_title')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search"
                                           aria-controls="document-table">
                            </label>&nbsp;
                            <button onclick="searchtext();" class="btn btn-warning btn-flat search_button">Search
                            </button>&nbsp;
                            <button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>
                        </div>
                    </div>
                    --}}
                    <div class="table-responsive m-t-10">
                        <table id="taxTable"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <?php if (in_array('document.delete', json_decode(@session('user_permissions')))) { ?>

                                    <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                               class="do_not_delete"
                                                                                               href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>
                                <?php } ?>
                                <th>{{trans('lang.document_title')}}</th>
                                <th>{{trans('lang.enable')}}</th>
                                <th>{{trans('lang.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody id="append_list1">
                            </tbody>
                        </table>
                        {{--
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item ">
                                    <a class="page-link" href="javascript:void(0);" id="document_table_previous_btn"
                                       onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" id="document_table_next_btn"
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
    var ref = database.collection('documents').orderBy('id', 'desc').where('isDeleted', '==', false);
    var alldriver = database.collection('driver_users');
    var append_list = '';
    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";
    var docDeleteAlert = "{{trans('lang.doc_delete_alert')}}";

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('document.delete', user_permissions) >= 0) {
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

            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
                // disableClick();
            }
            // setTimeout(function(){
            if (checkDeletePermission) {
                $('#taxTable').DataTable({
                    columnDefs: [{orderable: false, targets: [0, 3]}],
                    order: [[1, 'asc']],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true,

                });
            } else {
                $('#taxTable').DataTable({
                    columnDefs: [{orderable: false, targets: [2]}],
                    order: [[0, 'asc']],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true,

                });
            }

            jQuery("#overlay").hide();
            // },2000);
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
        var route1 = '{{route("documents.save",":id")}}';
        route1 = route1.replace(':id', id);
        var trroute1 = '';
        trroute1 = trroute1.replace(':id', id);
        if (checkDeletePermission) {

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }
        html = html + '<td><a href="' + route1 + '">' + val.title + '</a></td>';
        if (val.enable) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        }
        html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';

        if (checkDeletePermission) {

            html = html + '<a id="' + val.id + '" class="do_not_delete" name="doc-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }

        html = html + '</td></tr>';
        return html;
    }

    $("#is_active").click(function () {
        $("#taxTable .is_open").prop('checked', $(this).prop('checked'));
    });

    $("#deleteAll").click(function () {
        if ($('#taxTable .is_open:checked').length) {
            if (confirm(deleteSelectedRecordMsg)) {
                jQuery("#overlay").show();
                $('#taxTable .is_open:checked').each(function (key) {
                    var arr = $('#taxTable .is_open:checked');
                    var dataId = $(this).attr('dataId');
                    database.collection('documents').doc(dataId).update({
                        'isDeleted': true,
                        'enable': false
                    }).then(async function () {
                        var enableDocIds = await getDocId();
                        await alldriver.get().then(async function (snapshotsdriver) {
                            if (snapshotsdriver.docs.length > 0) {
                                var verification = await driverDocVerification(enableDocIds, snapshotsdriver);
                                if (verification) {
                                    jQuery("#overlay").hide();
                                    window.location.href = '{{ route("documents")}}';
                                }
                            } else {
                                jQuery("#overlay").hide();
                                window.location.href = '{{ route("documents")}}';
                            }
                        })
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
            } else {
                listener = ref.orderBy('id', 'desc').startAt(end).limit(pagesize).get();
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

            } else {
                listener = ref.orderBy('id', 'desc').startAfter(start).limit(pagesize).get();
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
        jQuery('#selected_search').val("title").trigger('change');
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

        } else {

            wherequery = ref.orderBy('id', 'desc').limit(pagesize).get();
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
        var id = $(this).attr('id');
        database.collection('documents').where('enable', "==", true).get().then(function (snapshots) {
            if (ischeck == false && snapshots.docs.length == 1) {
                $("#" + id).prop('checked', true);
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>" + docDeleteAlert + "</p>");
                window.scrollTo(0, 0);
                return false;
            } else {
                jQuery("#overlay").show();
                database.collection('documents').doc(id).update({
                    'enable': ischeck ? true : false
                }).then(async function (result) {
                    var enableDocIds = await getDocId();
                    await alldriver.get().then(async function (snapshotsdriver) {
                        if (snapshotsdriver.docs.length > 0) {
                            var verification = await driverDocVerification(enableDocIds, snapshotsdriver);
                            if (verification) {
                                jQuery("#overlay").hide();
                                window.location.href = '{{ route("documents")}}';
                            }
                        } else {
                            jQuery("#overlay").hide();
                            window.location.href = '{{ route("documents")}}';
                        }
                    })
                });
            }
        });
    });


    $(document).on("click", "a[name='doc-delete']", function (e) {
        if (confirm(deleteMsg)) {
            var id = $(this).attr('id');
            jQuery("#overlay").show();
            database.collection('documents').doc(id).update({
                'isDeleted': true,
                'enable': false
            }).then(async function (result) {
                var enableDocIds = await getDocId();
                await alldriver.get().then(async function (snapshotsdriver) {
                    if (snapshotsdriver.docs.length > 0) {
                        var verification = await driverDocVerification(enableDocIds, snapshotsdriver);
                        if (verification) {
                            jQuery("#overlay").hide();
                            window.location.href = '{{ route("documents")}}';
                        }
                    } else {
                        jQuery("#overlay").hide();
                        window.location.href = '{{ route("documents")}}';
                    }
                })
            });
        } else {
            return false;
        }
    });

    async function getDocId() {
        var enableDocIds = [];
        await database.collection('documents').where('isDeleted', '==', false).where('enable', "==", true).get().then(async function (snapshots) {
            await snapshots.forEach((doc) => {
                enableDocIds.push(doc.data().id);
            });
        });
        return enableDocIds;
    }

    async function driverDocVerification(enableDocIds, snapshotsdriver) {
        var isCompleted = false;
        await Promise.all(snapshotsdriver.docs.map(async (driver) => {
            await database.collection('driver_document').doc(driver.id).get().then(async function (docrefSnapshot) {
                if (docrefSnapshot.data() && docrefSnapshot.data().documents.length > 0) {
                    var driverDocId = await docrefSnapshot.data().documents.filter((doc) => doc.verified == true).map((docData) => docData.documentId);
                    if (driverDocId.length >= enableDocIds.length) {
                        await database.collection('driver_users').doc(driver.id).update({'documentVerification': true});
                    } else {
                        await enableDocIds.forEach(async (docId) => {
                            if (!driverDocId.includes(docId)) {
                                await database.collection('driver_users').doc(driver.id).update({'documentVerification': false});
                            }
                        });
                    }
                } else {
                    await database.collection('driver_users').doc(driver.id).update({'documentVerification': false});
                }
            });
            isCompleted = true;
        }));
        return isCompleted;
    }
</script>

@endsection