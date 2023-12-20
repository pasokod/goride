@extends('layouts.app')

@section('content')

<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor restaurantTitle">{{trans('lang.role_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.role_plural')}}</li>
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
                                            class="fa fa-list mr-2"></i>{{trans('lang.role_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('role.create') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.create_role')}}</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">Processing...
                        </div>

                        <div class="table-responsive m-t-10">

                            <table id="roleTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">

                                <thead>

                                <tr>
                                    <?php if (in_array('roles.delete', json_decode(@session('user_permissions')))) { ?>

                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active">
                                                <a id="deleteAll" class="do_not_delete" href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                        </th>
                                    <?php } ?>

                                    <th>{{trans('lang.name')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>

                                </thead>

                                <tbody id="append_list1">
                                @foreach($roles as $role)
                                <tr>
                                    <?php if (in_array('roles.delete', json_decode(@session('user_permissions')))) { ?>

                                        <td class="delete-all"><input type="checkbox" id="is_open_{{$role->id}}"
                                                                      class="is_open" dataId="{{$role->id}}"><label
                                                    class="col-3 control-label" for="is_open_{{$role->id}}"></label>
                                        </td>
                                    <?php } ?>

                                    <td>
                                        <a href="{{route('role.edit', ['id' => $role->id])}}">{{
                                            $role->role_name}}</a>
                                    </td>
                                    <td class="action-btn">

                                        <a href="{{route('role.edit', ['id' => $role->id])}}"><i
                                                    class="fa fa-edit"></i></a>

                                        <?php if (in_array('roles.delete', json_decode(@session('user_permissions')))) { ?>

                                            @if($role->role_name!="Super Administrator")
                                            <a href="{{route('role.delete', ['userid' => $role->id])}}"><i
                                                        class="fa fa-trash"></i></a>
                                            @endif
                                        <?php } ?>
                                    </td>
                                </tr>
                                @endforeach

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

    var user_permissions = '<?php echo @session('user_permissions')?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('roles.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }

    if (checkDeletePermission) {


        $('#roleTable').DataTable({
            order: [],
            columnDefs: [
                {orderable: false, targets: [0, 2]},

            ],
            "language": {
                "zeroRecords": "{{trans("lang.no_record_found")}}",
                "emptyTable": "{{trans("lang.no_record_found")}}"
            },
            responsive: true
        });
    } else {
        $('#roleTable').DataTable({
            order: [],
            columnDefs: [
                {orderable: false, targets: [1]},

            ],
            "language": {
                "zeroRecords": "{{trans("lang.no_record_found")}}",
                "emptyTable": "{{trans("lang.no_record_found")}}"
            },
            responsive: true
        });
    }

    $("#is_active").click(function () {
        $("#roleTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#roleTable .is_open:checked').length) {
            if (confirm('Are You Sure want to Delete Selected Data ?')) {
                var arrayUsers = [];
                $('#roleTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');
                    arrayUsers.push(dataId);

                });

                arrayUsers = JSON.stringify(arrayUsers);
                var url = "{{url('role/delete', 'userid')}}";
                url = url.replace('userid', arrayUsers);

                $(this).attr('href', url);
            }
        } else {
            alert('Please Select Any One Record .');
        }
    });
    
</script>


@endsection  