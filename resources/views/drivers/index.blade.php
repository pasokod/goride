@extends('layouts.app')

@section('content')
@php
$type = 'all';
@endphp
<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">
                @if(request()->is('drivers/approved'))
                @php $type = 'approved'; @endphp
                {{trans('lang.approved_drivers')}}
                @elseif(request()->is('drivers/pending'))
                @php $type = 'pending'; @endphp
                {{trans('lang.approval_pending_drivers')}}
                @else
                {{trans('lang.all_drivers')}}
                @endif
            </h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.driver_table')}}</li>

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

                        <div class="table-responsive m-t-10">

                            <table id="driverTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">

                                <thead>

                                <tr>
                                    <?php if (in_array('driver.delete', json_decode(@session('user_permissions')))) { ?>
                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                                   class="do_not_delete"
                                                                                                   href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                        </th>
                                    <?php } ?>

                                    <th>{{trans('lang.extra_image')}}</th>

                                    <th>{{trans('lang.user_name')}}</th>
                                    <th>{{trans('lang.email')}}</th>
                                    <th>{{trans('lang.phone')}}</th>
                                    <th>{{trans('lang.document_plural')}}</th>
                                    <th>{{trans('lang.date')}}</th>
                                    <th>{{trans('lang.service')}}</th>
                                    <th>{{trans('lang.vehicle_type')}}</th>
                                    <th>{{trans('lang.dashboard_total_orders')}}</th>
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

</div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
    var database = firebase.firestore();

    var type = "{{$type}}";
    var ref = database.collection('driver_users').orderBy('createdAt', 'desc');
    if (type == 'pending') {
        ref = database.collection('driver_users').where("documentVerification", "==", false).orderBy('createdAt', 'desc');
    } else if (type == 'approved') {
        ref = database.collection('driver_users').where("documentVerification", "==", true).orderBy('createdAt', 'desc');
    }
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('driver.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }

    var append_list = '';

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

            var table = $('#driverTable').DataTable();

            table.destroy();

            if (checkDeletePermission) {
                table = $('#driverTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 6,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [0, 1, 5, 10]},
                    ],
                    order: ['6', 'desc'],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true
                });
            } else {
                table = $('#driverTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 5,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [0, 4, 9]},
                    ],
                    order: ['5', 'desc'],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
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
            const total_rides = await getTotalRides(val.id);

            var serviceType = '';

            if (val.serviceId) {
                serviceType = await getServiceType(val.serviceId, val.id);
            }
            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            var route1 = '{{route("drivers.edit",":id")}}';
            route1 = route1.replace(':id', id);

            var driverView = '{{route("drivers.view",":id")}}';
            driverView = driverView.replace(':id', id);
            if (checkDeletePermission) {
                html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                    'for="is_open_' + id + '" ></label></td>';
            }
            /* html=html+'<td>'+val.id+'</td>'; */
            if (val.profilePic == '' || val.profilePic == null) {
                html = html + '<td><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.profilePic + '" alt="image"></td>';
            }

            html = html + '<td><a href="' + driverView + '">' + val.fullName + '</a></td>';
            html = html + '<td>' + val.email + '</td>';
            html = html + '<td>' + '+' + (val.countryCode.includes('+') ? val.countryCode.slice(1) : val.countryCode) + '-' + val.phoneNumber + '</td>';

            var driverDocView = '{{route("drivers.document",":id")}}';
            driverDocView = driverDocView.replace(':id', id);

            html = html + '<td class="action-btn"><a href="' + driverDocView + '"><i class="fa fa-file"></i></a></td>';


            if (val.hasOwnProperty("createdAt") && val.createdAt != null && val.createdAt != '') {
                var date = val.createdAt.toDate().toDateString();
                var time = val.createdAt.toDate().toLocaleTimeString('en-US');
                html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
            } else {
                html = html + '<td></td>';
            }

            html = html + '<td class="driver_service' + val.id + '">' + serviceType + '</td>';

            var trroute1 = '';
            trroute1 = trroute1.replace(':id', 'driverId=' + id);

            if (val.hasOwnProperty('vehicleInformation') && val.vehicleInformation.vehicleType) {
                html = html + '<td>' + val.vehicleInformation.vehicleType + '</td>';
            } else {
                html = html + '<td></td>';
            }

            html = html + '<td class="total_rides_' + val.id + '">' + total_rides + '</td>';

            html = html + '<td class="action-btn"><a href="' + driverView + '"><i class="fa fa-eye"></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';

            if (checkDeletePermission) {
                html = html + '<a id="' + val.id + '" name="driver-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';

            }
            html = html + '</td></tr>';
        }));
        return html;
    }

    async function getTotalRides(driverId) {
        var total = 0;
        var rides = 0;
        var intercity = 0;
        await database.collection('orders').where('driverId', '==', driverId).get().then(async function (snapShots) {
            rides = snapShots.docs.length;
            // $('.total_rides_' + driverId).html(snapShots.docs.length);
        });

        await database.collection('orders_intercity').where('driverId', '==', driverId).get().then(async function (snapShots) {
            intercity = snapShots.docs.length;
            // $('.total_rides_' + driverId).html(snapShots.docs.length);
        });
        total = parseInt(rides) + parseInt(intercity);

        return total;
    }

    $(document).on("click", "input[name='isActive']", function (e) {
        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('users').doc(id).update({
                'isActive': true
            }).then(function (result) {
            });
        } else {
            database.collection('users').doc(id).update({
                'isActive': false
            }).then(function (result) {
            });
        }
    });

    $("#is_active").click(function () {
        $("#driverTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#driverTable .is_open:checked').length) {
            jQuery("#overlay").show();

            if (confirm("{{trans('lang.selected_delete_alert')}}")) {

                jQuery("#overlay").show();

                $('#driverTable .is_open:checked').each(function () {

                    var dataId = $(this).attr('dataId');

                    database.collection('driver_users').doc(dataId).delete().then(function () {
                        deleteUserData(dataId);
                        setTimeout(function () {
                            window.location.reload();
                        }, 7000);

                    });

                });

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

    $(document).on("click", "a[name='driver-delete']", function (e) {

        if (confirm(deleteMsg)) {
            jQuery("#overlay").show();
            var id = this.id;
            jQuery("#overlay").show();
            database.collection('driver_users').doc(id).delete().then(function (result) {
                setTimeout(function () {
                    window.location.href = '{{ url()->current() }}';
                }, 7000);
            });
        } else {
            return false;
        }
    });

    async function getServiceType(serviceId, id) {
        var title = '';
        if (serviceId != undefined) {
            await database.collection('service').doc(serviceId).get().then(async function (snapshots) {
                var service = snapshots.data();
                if (service != undefined) {
                    title = service.title;
                }
                //$('.driver_service' + id).html(service.title);
            });
        }
        return title;
    }

    async function deleteDriverData(driverId) {

        await database.collection('order_transactions').where('driverId', '==', driverId).get().then(async function (snapshotsOrderTransacation) {
            if (snapshotsOrderTransacation.docs.length > 0) {
                snapshotsOrderTransacation.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('order_transactions').doc(item_data.id).delete().then(function () {

                    });
                });
            }

        });

        await database.collection('driver_payouts').where('driverID', '==', driverId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('driver_payouts').doc(item_data.id).delete().then(function () {

                    });
                });
            }

        });

    }

</script>

@endsection