@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.airports_table')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.airports_table')}}</li>
            </ol>
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
                                            class="fa fa-list mr-2"></i>{{trans('lang.airports_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('airport.save')}}"><i class="fa fa-plus mr-2"></i>{{trans('lang.airport_add')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive m-t-10">
                            <table id="taxTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <?php if (in_array('airports.delete', json_decode(@session('user_permissions')))) { ?>

                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                                   class="do_not_delete"
                                                                                                   href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                        </th>
                                    <?php } ?>
                                    <th>{{trans('lang.airport')}}</th>
                                    <th>{{trans('lang.country')}}</th>
                                    <th>{{trans('lang.city')}}</th>
                                    <th>{{trans('lang.status')}}</th>
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
@endsection

@section('scripts')


<script type="text/javascript">
    var database = firebase.firestore();
    var ref = database.collection('airports');

    var defaultImg = "{{ asset('/images/default_user.png') }}";
    var append_list = '';

    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('airports.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }

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

            if (checkDeletePermission) {

                $('#taxTable').DataTable({
                    order: [
                        [1, 'asc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 4]
                    },],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
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
                        targets: [3]
                    },],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
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
        var route1 = '{{route("airport.save",":id")}}';
        route1 = route1.replace(':id', id);

        if (checkDeletePermission) {

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }

        html = html + '<td><a href="' + route1 + '">' + val.airportName + '</a></td>';

        html = html + '<td>' + val.country + '</td>';

        html = html + '<td>' + val.cityLocation + '</td>';
        if (val.enable) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        }
        html = html + '<td class="action-btn"><a href="' + route1 + '" name="airport-edit"><i class="fa fa-edit"></i></a>';
        if (checkDeletePermission) {

            html = html + '<a id="' + val.id + '" class="do_not_delete" name="airport-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
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
                    database.collection('airports').doc(dataId).delete().then(function () {

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


    $(document).on("click", "a[name='airport-delete']", function (e) {
        if (confirm(deleteMsg)) {
            var id = this.id;
            jQuery("#overlay").show();
            database.collection('airports').doc(id).delete().then(function (result) {

                window.location.href = '{{ url()->current() }}';

            });
        } else {
            return false;
        }
    });
    $(document).on("click", "input[name='isEnabled']", function (e) {

        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('airports').doc(id).update({
                'enable': true
            }).then(function (result) {

            });
        } else {
            database.collection('airports').doc(id).update({
                'enable': false
            }).then(function (result) {

            });
        }

    });

</script>

@endsection