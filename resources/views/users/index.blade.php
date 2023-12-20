@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.user_table')}}</li>
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
                        <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="fullName">{{ trans('lang.user_name')}}</option>
                                    <option value="email">{{ trans('lang.email')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search"
                                           aria-controls="users-table">
                            </label>&nbsp;<button onclick="searchtext();"
                                                  class="btn btn-warning btn-flat search_button">Search
                            </button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear
                            </button>
                        </div>
                    </div>
                    --}}
                    <div class="table-responsive m-t-10">
                        <table id="userTable"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <?php if (in_array('user.delete', json_decode(@session('user_permissions')))) { ?>
                                    <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                               class="do_not_delete"
                                                                                               href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                <?php } ?>


                                <th>{{trans('lang.extra_image')}}</th>
                                <th>{{trans('lang.user_name')}}</th>
                                <th>{{trans('lang.email')}}</th>
                                <th>{{trans('lang.phone')}}</th>
                                <th>{{trans('lang.date')}}</th>
                                <th>{{trans('lang.active')}}</th>
                                <th>{{trans('lang.dashboard_total_orders')}}</th>

                                <!-- <th >{{trans('lang.wallet_transaction')}}</th> -->
                                <!-- <th >{{trans('lang.role')}}</th> -->

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
</div>
</div>

@endsection

@section('scripts')


<script type="text/javascript">

    var database = firebase.firestore();
    var defaultImg = "{{ asset('/images/default_user.png') }}";
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];

    var ref = database.collection('users').orderBy('createdAt', 'desc');

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('user.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }

    var placeholderImage = '';
    var append_list = '';

    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

    $(document).ready(function () {
        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
        jQuery("#overlay").show();
        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.get().then(async function (snapshots) {
            html = '';
            html = await buildHTML(snapshots);
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
                $('#userTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 5,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [0, 1, 6, 7, 8]},
                    ],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true
                });
            } else {
                $('#userTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 4,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [0, 5, 7]},
                    ],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true
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

        const total_rides = await getTotalRides(val.id);

        newdate = '';
        var id = val.id;
        var route1 = '{{route("users.edit",":id")}}';
        route1 = route1.replace(':id', id);

        var trroute1 = '';
        trroute1 = trroute1.replace(':id', id);

        var userview = '{{route("users.view",":id")}}';
        userview = userview.replace(':id', id);

        if (checkDeletePermission) {
            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }


        if (val.profilePic == '' || val.profilePic == null) {

            html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
        } else {
            html = html + '<td><img class="rounded" style="width:50px" src="' + val.profilePic + '" alt="image"></td>';
        }

        html = html + '<td><a href="' + userview + '">' + val.fullName + '</a></td>';

        html = html + '<td>' + val.email + '</td>';
        html = html + '<td>' + '+' + (val.countryCode.includes('+') ? val.countryCode.slice(1) : val.countryCode) + '-' + val.phoneNumber + '</td>';

        var date = '';
        var time = '';
        if (val.hasOwnProperty("createdAt")) {
            try {
                date = val.createdAt.toDate().toDateString();
                time = val.createdAt.toDate().toLocaleTimeString('en-US');
            } catch (err) {

            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
        } else {
            html = html + '<td></td>';
        }
        if (val.isActive) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
        }
        // html=html+'<td data-url="'+trroute1+'" class="redirecttopage">{{trans("lang.transaction")}}</td>';
        html = html + '<td class="total_rides_' + val.id + '">' + total_rides + '</td>';


        html = html + '<td class="action-btn"><a href="' + userview + '"><i class="fa fa-eye"></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';

        if (checkDeletePermission) {
            html = html + '<a id="' + val.id + '" class="do_not_delete" name="user-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }
        html = html + '</td>';

        html = html + '</tr>';
        return html;
    }

    async function getTotalRides(userId) {
        var total = 0;
        var rides = 0;
        var intercity = 0;
        await database.collection('orders').where('userId', '==', userId).get().then(async function (snapShots) {
            rides = snapShots.docs.length;
            // $('.total_rides_' + driverId).html(snapShots.docs.length);
        });

        await database.collection('orders_intercity').where('userId', '==', userId).get().then(async function (snapShots) {
            intercity = snapShots.docs.length;
            // $('.total_rides_' + driverId).html(snapShots.docs.length);
        });
        total = parseInt(rides) + parseInt(intercity);

        return total;
    }

    $("#is_active").click(function () {
        $("#userTable .is_open").prop('checked', $(this).prop('checked'));
    });

    $("#deleteAll").click(function () {
        if ($('#userTable .is_open:checked').length) {
            if (confirm(deleteSelectedRecordMsg)) {
                jQuery("#overlay").show();
                $('#userTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');

                    database.collection('users').doc(dataId).delete().then(function () {
                        deleteUserData(dataId);
                        setTimeout(function () {
                            window.location.reload();
                        }, 7000);
                    });
                });
            } else {
                return false;
            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });

    async function deleteUserData(userId) {
        //delete user from authentication
        var dataObject = {"data": {"uid": userId}};
        var projectId = '<?php echo env('FIREBASE_PROJECT_ID') ?>';
        jQuery.ajax({
            url: 'https://us-central1-' + projectId + '.cloudfunctions.net/deleteUser',
            method: 'POST',
            crossDomain: true,
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(dataObject),
            success: function (data) {
                console.log('Delete user success:', data.result);
            },
            error: function (xhr, status, error) {
                var responseText = JSON.parse(xhr.responseText);
                console.log('Delete user error:', responseText.error);
            }
        });
    }

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {

            if (jQuery("#selected_search").val() == 'fullName' && jQuery("#search").val().trim() != '') {
                listener = ref.orderBy('fullName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

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
                } else {
                    html += '<tr><td colspan="7" class="text-center font-weight-bold">{{trans("lang.no_record_found")}}</td></tr>';
                    append_list.innerHTML = html;
                }
            });
        }
    }

    function next() {

        if (start != undefined || start != null) {

            if (jQuery("#selected_search").val() == 'fullName' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('fullName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            } else {
                listener = ref.orderBy('id', 'desc').startAfter(start).limit(pagesize).get();
            }
            listener.then((snapshots) => {

                html = '';
                html = buildHTML(snapshots);
                console.log(snapshots);

                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];


                    if (endarray.indexOf(snapshots.docs[0]) != -1) {
                        endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                    }
                    endarray.push(snapshots.docs[0]);
                } else {
                    html += '<tr><td colspan="7" class="text-center font-weight-bold">{{trans("lang.no_record_found")}}</td></tr>';
                    append_list.innerHTML = html;
                }
            });
        }
    }

    function searchclear() {
        jQuery("#search").val('');
        jQuery("#selected_search").val('fullName').trigger('change');
        searchtext();
    }

    $('#search').keypress(function (e) {
        if (e.which == 13) {
            $('.search_button').click();
        }
    });

    function searchtext() {

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'fullName' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('fullName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

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
            } else {
                html += '<tr><td colspan="7" class="text-center font-weight-bold">{{trans("lang.no_record_found")}}</td></tr>';
                append_list.innerHTML = html;
            }
        });

    }

    $(document).on("click", "a[name='user-delete']", function (e) {

        if (confirm(deleteMsg)) {
            jQuery("#overlay").show();
            var id = this.id;

            database.collection('users').doc(id).delete().then(function (result) {
                deleteUserData(id);
                setTimeout(function () {
                    window.location.href = '{{ url()->current() }}';
                }, 7000);
            });

        } else {
            return false;
        }

    });

    $(document).on("click", "input[name='isActive']", function (e) {
        var ischeck = $(this).is(':checked');
        var id = this.id;
        database.collection('users').doc(id).update({'isActive': ischeck ? true : false}).then(function (result) {
        });
    });
</script>

@endsection