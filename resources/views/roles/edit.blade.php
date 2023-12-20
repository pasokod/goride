@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.edit_role')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('role') }}">{{trans('lang.role_plural')}}</a>
                </li>

                <li class="breadcrumb-item active">{{trans('lang.edit_role')}}</li>

            </ol>
        </div>

    </div>

    <div class="card-body">

        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
            {{trans('lang.processing')}}
        </div>

        <div class="error_top" style="display:none"></div>

        <div class="success_top" style="display:none"></div>

        <form action="{{route('role.update',$id)}}" method="post" id="roleForm">
            @csrf
            <div class="row restaurant_payout_create">

                <div class="restaurant_payout_create-inner">

                    <fieldset>
                        <legend>{{trans('lang.role_details')}}</legend>
                        <div class="form-group row width-100 d-flex">
                            <label class="col-3 control-label">{{trans('lang.name')}}</label>
                            <div class="col-6">
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{$roles->role_name}}" {{$roles->id == 1 ?
                                'disabled' : ''}}>
                            </div>
                            <div class="col-6 text-right">
                                <label for="permissions"
                                       class="form-label">{{trans('lang.assign_permissions')}}</label>
                                <div class="text-right">
                                    <input type="checkbox" name="all_permission" id="all_permission" {{$roles->id ==
                                    1 ? 'disabled' : ''}}>
                                    <label class="control-label"
                                           for="all_permission">{{trans('lang.all_permissions')}}</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row width-100">

                            <div class="role-table width-100">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Menu</th>
                                        <th>Permission</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.gods_eye')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="god-eye" value="map" name="god-eye[]"
                                                       class="permission"
                                                       {{in_array('map',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>

                                                <label class="control-label2"
                                                       for="god-eye">{{trans('lang.view')}}</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.role_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="role-list" value="roles.list"
                                                       name="roles[]" class="permission"
                                                       {{in_array('roles.list',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="role-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="role-save" value="roles.create"
                                                       name="roles[]" class="permission"
                                                       {{in_array('roles.create',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="role-save">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="role-store" value="roles.store"
                                                       name="roles[]" class="permission"
                                                       {{in_array('roles.store',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="role-store">{{trans('lang.store')}}</label>

                                                <input type="checkbox" id="role-edit" value="roles.edit"
                                                       name="roles[]" class="permission"
                                                       {{in_array('roles.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="role-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="role-update" value="roles.update"
                                                       name="roles[]" class="permission"
                                                       {{in_array('roles.update',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="role-update">{{trans('lang.update')}}</label>

                                                <input type="checkbox" id="role-delete" value="roles.delete"
                                                       name="roles[]" class="permission"
                                                       {{in_array('roles.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="role-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.admin_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="admin-list" value="admin.list"
                                                       name="admins[]" class="permission"
                                                       {{in_array('admin.list',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="admin-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="admin-create" value="admin.create"
                                                       name="admins[]" class="permission"
                                                       {{in_array('admin.create',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="admin-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="admin-store" value="admin.store"
                                                       name="admins[]" class="permission"
                                                       {{in_array('admin.store',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="admin-store">{{trans('lang.store')}}</label>

                                                <input type="checkbox" id="admin-edit" value="admin.edit"
                                                       name="admins[]" class="permission"
                                                       {{in_array('admin.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="admin-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="admin-update" value="admin.update"
                                                       name="admins[]" class="permission"
                                                       {{in_array('admin.update',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="admin-update">{{trans('lang.update')}}</label>

                                                <input type="checkbox" id="admin-delete" value="admin.delete"
                                                       name="admins[]" class="permission"
                                                       {{in_array('admin.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="admin-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.user_customer')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="user-list" value="user.list"
                                                       name="users[]" class="permission"
                                                       {{in_array('user.list',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="user-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="user-edit" value="user.edit"
                                                       name="users[]" class="permission"
                                                       {{in_array('user.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="user-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="user-view" value="user.view"
                                                       name="users[]" class="permission"
                                                       {{in_array('user.view',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="user-view">{{trans('lang.view')}}</label>

                                                <input type="checkbox" id="user-delete" value="user.delete"
                                                       name="users[]" class="permission"
                                                       {{in_array('user.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="user-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.all_driver_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="drivers-list" value="driver.list"
                                                       name="drivers[]" class="permission"
                                                       {{in_array('driver.list',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="drivers-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="drivers-edit" value="driver.edit"
                                                       name="drivers[]" class="permission"
                                                       {{in_array('driver.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="drivers-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="drivers-view" value="driver.view"
                                                       name="drivers[]" class="permission"
                                                       {{in_array('driver.view',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="drivers-view">{{trans('lang.view')}}</label>

                                                <input type="checkbox" id="drivers-delete" value="driver.delete"
                                                       name="drivers[]" class="permission"
                                                       {{in_array('driver.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="drivers-delete">{{trans('lang.delete')}}</label>


                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.approve_driver_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="approve-drivers-list"
                                                       value="approve.driver.list"
                                                       name="approve_drivers[]" class="permission"
                                                       {{in_array('approve.driver.list',$permissions) ? "checked" : ""
                                                }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="approve-drivers-list">{{trans('lang.list')}}</label>

                                                <!--<input type="checkbox" id="approve-drivers-edit" value="approve.driver.edit"
                                                       name="approve_drivers[]" class="permission"
                                                       {{in_array('approve.driver.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="approve-drivers-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="approve-drivers-view" value="approve.driver.view"
                                                       name="approve_drivers[]" class="permission"
                                                       {{in_array('approve.driver.view',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="approve-drivers-view">{{trans('lang.view')}}</label>-->
                                                <input type="checkbox" id="approve-drivers-delete"
                                                       value="approve.driver.delete"
                                                       name="approve_drivers[]" class="permission"
                                                       {{in_array('approve.driver.delete',$permissions) ? "checked" : ""
                                                }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="approve-drivers-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.pending_driver_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="pending-drivers-list"
                                                       value="pending.driver.list"
                                                       name="pending_drivers[]" class="permission"
                                                       {{in_array('pending.driver.list',$permissions) ? "checked" : ""
                                                }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2"
                                                       for="pending-drivers-list">{{trans('lang.list')}}</label>

                                                <!--<input type="checkbox" id="pending-drivers-edit" value="pending.driver.edit"
                                                       name="pending_drivers[]" class="permission"
                                                       {{in_array('pending.driver.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="pending-drivers-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="pending-drivers-view" value="pending.driver.view"
                                                       name="pending_drivers[]" class="permission"
                                                       {{in_array('pending.driver.view',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2"
                                                       for="pending-drivers-view">{{trans('lang.view')}}</label>-->

                                                <input type="checkbox" id="pending-drivers-delete"
                                                       value="pending.driver.delete"
                                                       name="pending_drivers[]" class="permission"
                                                       {{in_array('pending.driver.delete',$permissions) ? "checked" : ""
                                                }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="pending-drivers-delete">{{trans('lang.delete')}}</label>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.document_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="documents-list" value="document.list"
                                                       name="documents[]" class="permission"
                                                       {{in_array('document.list',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="documents-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="documents-create" value="document.create"
                                                       name="documents[]" class="permission"
                                                       {{in_array('document.create',$permissions) ? "checked" : ""
                                                }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="documents-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="documents-edit" value="document.edit"
                                                       name="documents[]" class="permission"
                                                       {{in_array('document.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="documents-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="documents-delete" value="document.delete"
                                                       name="documents[]" class="permission"
                                                       {{in_array('document.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="documents-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.deleted_document_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="deleted-documents-list"
                                                       value="document.deleted" name="deleted-documents[]"
                                                       class="permission" {{in_array('document.deleted',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>

                                                <label class=" control-label2" for="deleted-documents-list">{{trans('lang.list')}}</label>


                                            </td>
                                        </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.driver_document_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="driver-document-list" value="driver.document.list" name="drivers-document[]" class="permission"
                                                               {{in_array('driver.document.list',$permissions) ? "checked" : "" }}
                                                                {{$roles->id == 1 ? 'disabled' : ''}}>

                                                        <label class=" control-label2" for="driver-document-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="driver-document-edit" value="driver.document.edit" name="drivers-document[]" 
                                                        class="permission" {{in_array('driver.document.edit',$permissions) ? "checked" : "" }}
                                                            {{$roles->id == 1 ? 'disabled' : ''}}>

                                                        <label class=" control-label2" for="driver-document-edit">{{trans('lang.edit')}}</label>

                                                    </td>
                                                </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.report_plural')}}</strong>

                                            </td>
                                            <td>
                                                <input type="checkbox" id="user-report" value="user.report"
                                                       name="reports[]" class="permission"
                                                       {{in_array('user.report',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2"
                                                       for="user-report">{{trans('lang.user')}}</label>

                                                <input type="checkbox" id="driver-report" value="driver.report"
                                                       name="reports[]" class="permission"
                                                       {{in_array('driver.report',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2" for="driver-report">{{trans('lang.driver')}}</label>

                                                <input type="checkbox" id="ride-report" value="ride.report"
                                                       name="reports[]" class="permission"
                                                       {{in_array('ride.report',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2"
                                                       for="ride-report">{{trans('lang.ride')}}</label>

                                                <input type="checkbox" id="intercity-report"
                                                       value="intercity.report" name="reports[]" class="permission"
                                                       {{in_array('intercity.report',$permissions) ? "checked" : ""
                                                }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2" for="intercity-report">{{trans('lang.intercity')}}</label>

                                                <input type="checkbox" id="transaction-report"
                                                       value="transaction.report" name="reports[]"
                                                       class="permission" {{in_array('transaction.report',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2" for="transaction-report">{{trans('lang.transaction')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.service_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="service-list" value="service.list"
                                                       name="service[]" class="permission"
                                                       {{in_array('service.list',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="service-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="service-create" value="service.create"
                                                       name="service[]" class="permission"
                                                       {{in_array('service.create',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="service-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="service-edit" value="service.edit"
                                                       name="service[]" class="permission"
                                                       {{in_array('service.edit',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="service-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="service-delete" value="service.delete"
                                                       name="service[]" class="permission"
                                                       {{in_array('service.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="service-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.ride_order_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="ride-order-list" value="order.list"
                                                       name="ride_order[]" class="permission"
                                                       {{in_array('order.list',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="ride-order-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="ride-order-view" value="order.view"
                                                       name="ride_order[]" class="permission"
                                                       {{in_array('order.view',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="ride-order-view">{{trans('lang.view')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.intercity_service_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="intercity-list"
                                                       value="intercity.service.list" name="intercity_service[]"
                                                       class="permission" {{in_array('intercity.service.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="intercity-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="intercity-edit"
                                                       value="intercity.service.edit" name="intercity_service[]"
                                                       class="permission" {{in_array('intercity.service.edit',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="intercity-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="intercity-delete"
                                                       value="intercity.service.delete"
                                                       name="intercity_service[]" class="permission"
                                                       {{in_array('intercity.service.delete',$permissions) ? "checked" :
                                                "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="intercity-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.intercity_order_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="intercity-order-list"
                                                       value="intercity.order.list" name="intercity_order[]"
                                                       class="permission" {{in_array('intercity.order.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="intercity-order-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="intercity-order-view"
                                                       value="intercity.order.view" name="intercity_order[]"
                                                       class="permission" {{in_array('intercity.order.view',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="intercity-order-view">{{trans('lang.view')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.freight_vehicles')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="freight-list" value="freight.list"
                                                       name="freight[]"
                                                       class="permission" {{in_array('freight.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="freight-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="freight-create" value="freight.create"
                                                       name="freight[]"
                                                       class="permission" {{in_array('freight.create',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="freight-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="freight-edit" value="freight.edit"
                                                       name="freight[]"
                                                       class="permission" {{in_array('freight.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="freight-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="freight-delete"
                                                       value="freight.delete"
                                                       name="freight[]" class="permission"
                                                       {{in_array('freight.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="freight-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.airports')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="airports-list" value="airports.list"
                                                       name="airports[]"
                                                       class="permission" {{in_array('airports.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="airports-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="airports-create" value="airports.create"
                                                       name="airports[]"
                                                       class="permission" {{in_array('airports.create',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="airports-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="airports-edit" value="airports.edit"
                                                       name="airports[]"
                                                       class="permission" {{in_array('airports.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="airports-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="airports-delete"
                                                       value="airports.delete"
                                                       name="airports[]" class="permission"
                                                       {{in_array('airports.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="airports-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.vehicle_type')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="vehicle-type-list"
                                                       value="vehicle.type.list" name="vehicle-type[]"
                                                       class="permission" {{in_array('vehicle.type.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="vehicle-type-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="vehicle-type-create"
                                                       value="vehicle.type.create" name="vehicle-type[]"
                                                       class="permission" {{in_array('vehicle.type.create',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="vehicle-type-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="vehicle-type-edit"
                                                       value="vehicle.type.edit" name="vehicle-type[]"
                                                       class="permission" {{in_array('vehicle.type.edit',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="vehicle-type-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="vehicle-type-delete"
                                                       value="vehicle.type.delete"
                                                       name="vehicle-type[]" class="permission"
                                                       {{in_array('vehicle.type.delete',$permissions) ? "checked" : ""
                                                }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="vehicle-type-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.driver_rule_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="driver-rules-list" value="rule.list"
                                                       name="driver-rules[]"
                                                       class="permission" {{in_array('rule.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="driver-rules-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="driver-rules-create" value="rule.create"
                                                       name="driver-rules[]"
                                                       class="permission" {{in_array('rule.create',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="driver-rules-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="driver-rules-edit" value="rule.edit"
                                                       name="driver-rules[]"
                                                       class="permission" {{in_array('rule.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="driver-rules-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="driver-rules-delete"
                                                       value="rule.delete"
                                                       name="driver-rules[]" class="permission"
                                                       {{in_array('rule.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="driver-rules-delete">{{trans('lang.delete')}}</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.deleted_driver_rule_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="deleted-driver-rules-list"
                                                       value="rule.delete.list" name="deleted-driver-rules[]"
                                                       class="permission" {{in_array('rule.delete.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="deleted-driver-rules-list">{{trans('lang.list')}}</label>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.cms_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="cms" value="cms.list" name="cms[]"
                                                       class="permission" {{in_array('cms.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="cms">{{trans('lang.list')}}</label>
                                                <input type="checkbox" id="cms-create" value="cms.create"
                                                       name="cms[]"
                                                       class="permission" {{in_array('cms.create',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="cms-create">{{trans('lang.create')}}</label>
                                                <input type="checkbox" id="cms-edit" value="cms.edit" name="cms[]"
                                                       class="permission" {{in_array('cms.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="cms-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="cms-delete"
                                                       value="cms.delete"
                                                       name="cms[]" class="permission"
                                                       {{in_array('cms.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2"
                                                       for="cms-delete">{{trans('lang.delete')}}</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.menu_items')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="banners" value="banners.list"
                                                       name="banners[]"
                                                       class="permission" {{in_array('banners.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="banners">{{trans('lang.list')}}</label>
                                                <input type="checkbox" id="banners-create" value="banners.create"
                                                       name="banners[]"
                                                       class="permission" {{in_array('banners.create',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="banners-create">{{trans('lang.create')}}</label>
                                                <input type="checkbox" id="banners-edit" value="banners.edit"
                                                       name="banners[]"
                                                       class="permission" {{in_array('banners.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="banners-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="banners-delete" value="banners.delete"
                                                       name="banners[]" class="permission"
                                                       {{in_array('banners.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="banners-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.deleted_banner_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="deleted-banner"
                                                       value="banner.delete.list" name="deleted-banner[]"
                                                       class="permission" {{in_array('banner.delete.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class="control-label2" for="deleted-banner">{{trans('lang.list')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.on_board_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="on-board-list" value="onboard.list"
                                                       name="on-board[]"
                                                       class="permission" {{in_array('onboard.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="on-board-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="on-board-edit" value="onboard.edit"
                                                       name="on-board[]"
                                                       class="permission" {{in_array('onboard.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="on-board-edit">{{trans('lang.edit')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.faq_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="faq-list" value="faq.list" name="faq[]"
                                                       class="permission" {{in_array('faq.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="faq-list">{{trans('lang.list')}}</label>
                                                <input type="checkbox" id="faq-create" value="faq.create"
                                                       name="faq[]"
                                                       class="permission" {{in_array('faq.create',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="faq-create">{{trans('lang.create')}}</label>
                                                <input type="checkbox" id="faq-edit" value="faq.edit" name="faq[]"
                                                       class="permission" {{in_array('faq.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="faq-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="faq-delete" value="faq.delete"
                                                       name="faq[]" class="permission"
                                                       {{in_array('faq.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="faq-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.sos')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="sos-list" value="sos.list" name="sos[]"
                                                       class="permission" {{in_array('sos.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="sos-list">{{trans('lang.list')}}</label>

                                                <input type="checkbox" id="sos-edit" value="sos.edit" name="sos[]"
                                                       class="permission" {{in_array('sos.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="sos-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="sos-delete" value="sos.delete"
                                                       name="sos[]" class="permission"
                                                       {{in_array('sos.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="sos-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.tax_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="tax-list" value="tax.list" name="tax[]"
                                                       class="permission" {{in_array('tax.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="tax-list">{{trans('lang.list')}}</label>
                                                <input type="checkbox" id="tax-create" value="tax.create"
                                                       name="tax[]"
                                                       class="permission" {{in_array('tax.create',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="tax-create">{{trans('lang.create')}}</label>
                                                <input type="checkbox" id="tax-edit" value="tax.edit" name="tax[]"
                                                       class="permission" {{in_array('tax.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="tax-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="tax-delete" value="tax.delete"
                                                       name="tax[]" class="permission"
                                                       {{in_array('tax.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="tax-delete">{{trans('lang.delete')}}</label>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.all_coupon_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="coupon-list" value="coupon.list"
                                                       name="coupon[]"
                                                       class="permission" {{in_array('coupon.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="coupon-list">{{trans('lang.list')}}</label>
                                                <input type="checkbox" id="coupon-create" value="coupon.create"
                                                       name="coupon[]"
                                                       class="permission" {{in_array('coupon.create',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="coupon-create">{{trans('lang.create')}}</label>
                                                <input type="checkbox" id="coupon-edit" value="coupon.edit"
                                                       name="coupon[]"
                                                       class="permission" {{in_array('coupon.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="coupon-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="coupon-delete" value="coupon.delete"
                                                       name="coupon[]" class="permission"
                                                       {{in_array('coupon.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="coupon-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.deleted_coupon_plural')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="deleted-coupon-list"
                                                       value="coupon.delete.list" name="deleted-coupon[]"
                                                       class="permission" {{in_array('coupon.delete.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="deleted-coupon-list">{{trans('lang.list')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.currencies')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="currency-list" value="currency.list"
                                                       name="currency[]"
                                                       class="permission" {{in_array('currency.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="currency-list">{{trans('lang.list')}}</label>
                                                <input type="checkbox" id="currency-create" value="currency.create"
                                                       name="currency[]"
                                                       class="permission" {{in_array('currency.create',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="currency-create">{{trans('lang.create')}}</label>

                                                <input type="checkbox" id="currency-edit" value="currency.edit"
                                                       name="currency[]"
                                                       class="permission" {{in_array('currency.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="currency-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="currency-delete" value="currency.delete"
                                                       name="currency[]" class="permission"
                                                       {{in_array('currency.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="currency-delete">{{trans('lang.delete')}}</label>


                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.all_languages')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="language-list" value="language.list"
                                                       name="language[]"
                                                       class="permission" {{in_array('language.list',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="language-list">{{trans('lang.list')}}</label>
                                                <input type="checkbox" id="language-create" value="language.create"
                                                       name="language[]"
                                                       class="permission" {{in_array('language.create',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="language-create">{{trans('lang.create')}}</label>
                                                <input type="checkbox" id="language-edit" value="language.edit"
                                                       name="language[]"
                                                       class="permission" {{in_array('language.edit',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="language-edit">{{trans('lang.edit')}}</label>

                                                <input type="checkbox" id="language-delete" value="language.delete"
                                                       name="language[]" class="permission"
                                                       {{in_array('language.delete',$permissions) ? "checked" : "" }}
                                                {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="language-delete">{{trans('lang.delete')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.deleted_languages')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="deleted-language"
                                                       value="language.delete.list" name="deleted-language[]"
                                                       class="permission" {{in_array('language.delete.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="deleted-language">{{trans('lang.list')}}</label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.payout_request')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="payout-request-list"
                                                       value="payout-request" name="payout-request[]"
                                                       class="permission" {{in_array('payout-request',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="payout-request-list">{{trans('lang.list')}}</label>


                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.drivers_wallet_transactions')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="drivers-wallet-transactions"
                                                       value="driver.wallet.list"
                                                       name="drivers-wallet-transaction[]"
                                                       class="permission" {{in_array('driver.wallet.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="drivers-wallet-transactions">{{trans('lang.list')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.users_wallet_transactions')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="users-wallet-transactions"
                                                       value="user.wallet.list"
                                                       name="users-wallet-transaction[]"
                                                       class="permission" {{in_array('user.wallet.list',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="users-wallet-transactions">{{trans('lang.list')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.app_setting_globals')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="global-setting" value="global-setting"
                                                       name="global-setting[]"
                                                       class="permission" {{in_array('global-setting',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="global-setting">{{trans('lang.update')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.admin_commission')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="admin-commission" value="admin-commision"
                                                       name="admin-commission[]"
                                                       class="permission" {{in_array('admin-commision',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="admin-commission">{{trans('lang.update')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.payment_methods')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="payment-method-list"
                                                       value="payment-method" name="payment-method[]"
                                                       class="permission" {{in_array('payment-method',$permissions)
                                                ? "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="payment-method-list">{{trans('lang.update')}}</label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.homepageTemplate')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="homepageTemplate" value="home-page"
                                                       name="homepageTemplate[]"
                                                       class="permission" {{in_array('home-page',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="homepageTemplate">{{trans('lang.update')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.header_template')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="header-template" value="header"
                                                       name="header-template[]"
                                                       class="permission" {{in_array('header',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="header-template">{{trans('lang.update')}}</label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.footer_template')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="footer-template" value="footer"
                                                       name="footer-template[]"
                                                       class="permission" {{in_array('footer',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2" for="footer-template">{{trans('lang.update')}}</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.privacy_policy')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="privacy" value="privacy" name="privacy[]"
                                                       class="permission" {{in_array('privacy',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="privacy">{{trans('lang.update')}}</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>{{trans('lang.terms_and_conditions')}}</strong>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="terms" value="terms" name="terms[]"
                                                       class="permission" {{in_array('terms',$permissions) ?
                                                "checked" : "" }} {{$roles->id == 1 ? 'disabled' : ''}}>
                                                <label class=" control-label2"
                                                       for="terms">{{trans('lang.update')}}</label>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </fieldset>
                </div>

            </div>

            <div class="form-group col-12 text-center btm-btn">
                @if($roles->id != 1)
                <button type="button" class="btn btn-primary save_role"><i class="fa fa-save"></i> {{
                    trans('lang.save')}}
                </button>
                @endif
                <a href="{{url('role')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                    trans('lang.cancel')}}</a>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')

<script>
    $(".save_role").click(async function () {

        $(".success_top").hide();
        $(".error_top").hide();
        var name = $("#name").val();

        if (name == "") {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.user_name_help')}}</p>");
            window.scrollTo(0, 0);
            return false;
        } else {
            $('form#roleForm').submit();

        }

    });

    $('#all_permission').on('click', function () {

        if ($(this).is(':checked')) {
            $.each($('.permission'), function () {
                $(this).prop('checked', true);
            });
        } else {
            $.each($('.permission'), function () {
                $(this).prop('checked', false);
            });
        }

    });
</script>

@endsection